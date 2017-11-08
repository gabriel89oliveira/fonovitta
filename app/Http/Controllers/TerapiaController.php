<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;



use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class TerapiaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }


    /**
     * Pagina para criar nova terapia
     *
     */
    public function create(Request $request)
    {
        
		// Buscar permissões
		$permissions = Permission::all();
		
		// Dados do paciente
		$paciente = DB::table('pacientes')->where('id', $request->id)->first();
		
		// Acesso para editar todos pacientes
		if (Auth::user()->hasPermissionTo('Terapia_Todos')){
			return view('terapia/cadastrar', ['paciente' => $paciente])->with(['page' => '']);
		}else{
			
			// Verifica se o paciente esta sendo atendido pela equipe
			if($paciente->fon == 1){
				
				// Aceso para editar pacientes da minha equipe
				if(Auth::user()->hasPermissionTo('Terapia_Equipe')){
					return view('terapia/cadastrar', ['paciente' => $paciente])->with(['page' => '']);
				}else{
					
					$equipe = DB::table(Auth::user()->equipe.'s')->where('id_paciente', $request->id)->first();
					
					// Acesso para editar pacientes que o usuario atende
					if(Auth::user()->hasPermissionTo('Terapia_Meu') AND $equipe->id_responsavel == Auth::user()->id){
						return view('terapia/cadastrar', ['paciente' => $paciente])->with(['page' => 'meus_pacientes']);
					}else{
						abort('401');
					}
					
				}
				
			}else{
				abort('401');
			}
			
		}
		
    }

    
    /**
     * Salvar a terapia
     *
     */
    public function store(Request $request)
    {
        
		$this->validate($request, [
				'id_paciente'=>'required|integer',
				'conduta'=>'required'
			]);
			
		// Dados adicionais da terapia
		$adicional[1] = $request->input('adicional_1');
		$adicional[2] = $request->input('adicional_2');
		$adicional[3] = $request->input('adicional_3');
		$adicional[4] = $request->input('adicional_4');
		$adicional[5] = $request->input('adicional_5');
		$adicional[6] = $request->input('adicional_6');
		$adicional[7] = $request->input('adicional_7');
		$adicional[8] = $request->input('adicional_8');
		
		$terapia_2 = null;
		
		foreach($adicional as $add){
			
			if(isset($add) and $terapia_2==null){
				$terapia_2 = $add;
			}elseif(isset($add) and $terapia_2!=null){
				$terapia_2 .= " / ".$add;
			}
			
		}

		if($terapia_2==null){
			$terapia_2 = "Nenhuma";
		}
		
		$acomp_liquido    = !empty($request->input('acomp_liquido')) 	? $request->input('acomp_liquido') 	: 0;
		$acomp_refeicao   = !empty($request->input('acomp_refeicao')) 	? $request->input('acomp_refeicao') : 0;
		$prescricao		  = !empty($request->input('prescricao')) 		? $request->input('prescricao') 	: 'Não';
		
		
		/* ----- INSERIR OS DADOS NAS TABELAS ----- */
		
		// Inserir nova terapia
		$id_insert = DB::table('terapias')->insertGetId([
			'id_paciente'          			=> $request->id_paciente,
			'id_usuario'           			=> Auth::user()->id,
			'equipe'               			=> 'fon',
			'terapia'              			=> $request->terapia,
			'terapia_2'            			=> $terapia_2,
			'evolucao'			   			=> $request->evolucao,
			'conduta'              			=> $request->conduta,
			'comentario'           			=> $request->comentario,
			'aval_dieta'           			=> $acomp_refeicao,
			'aval_liquido'         			=> $acomp_liquido,
			'prescricao'					=> $prescricao,
			'dieta_anterior'				=> $request->dieta_anterior,
			'comentario_dieta_anterior'		=> $request->comentario_dieta_anterior,
			'treino_anterior'				=> $request->treino_anterior,
			'comentario_treino_anterior'	=> $request->comentario_treino_anterior,
			'data'				   			=> $request->data_terapia,
			'prescricao'		   			=> $request->prescricao
		]);
			
			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'terapia',
				'id_linha'       => $id_insert,
				'acao'           => 'criar',
				'id_usuario'     => Auth::user()->id
			]);


		// Busca último registro na tabela de dietas
		$dietas = DB::table('historico_dietas')->where('id_paciente', $id)->orderBy('id', 'desc')->first();

		// Inserir nova dieta e liquido
		if($request->dieta != 'Mantida' && $request->liquido != 'Mantida'){

			DB::table('historico_dietas')
    			->insert([
    				'id_paciente' 	=> $request->id_paciente,
					'dieta' 		=> $request->dieta,
					'liquido' 		=> $request->liquido,
					'data'			=> $request->data_terapia
				]);

		}

		// Inserir nova dieta
		if($request->dieta != 'Mantida' && $request->liquido == 'Mantida'){

			DB::table('historico_dietas')
    			->insert([
					'id_paciente' 	=> $request->id_paciente,
					'dieta' 		=> $request->dieta,
					'liquido' 		=> $dietas->liquido,
					'data'			=> $request->data_terapia
				]);

		}

		// Inserir novo liquido
		if($request->dieta == 'Mantida' && $request->liquido != 'Mantida'){

			DB::table('historico_dietas')
    			->insert([
					'id_paciente' 	=> $request->id_paciente,
					'dieta' 		=> $dietas->dieta,
					'liquido' 		=> $request->liquido,
					'data'			=> $request->data_terapia
				]);

		}
		
			
		
		/* ----- ENCAMINHA PARA NOVA PÁGINA ----- */
		return redirect()->route('pacientes.show', ['id' => $request->id_paciente]);
		
    }


    /**
     * Mostrar uma terapia. SEM USO
     *
     */
    public function show($id)
    {
        //
    }


    /**
     * Pagina para editar terapia
     *
     */
    public function edit($id)
    {
        
		// Buscar permissões
		$permissions = Permission::all();
		
		// Dados do paciente
		$terapia = DB::table('terapias')->where('id', $id)->first();
		$paciente = DB::table('pacientes')->where('id', $terapia->id_paciente)->first();
		
		
		// Acesso para editar todos pacientes
		if (Auth::user()->hasPermissionTo('Terapia_Editar_Todos')){
			return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente])->with(["page" => ""]);
		}else{
			
			// Verifica se o paciente esta sendo atendido pela equipe
			if($paciente->fon == 1){
				
				// Aceso para editar pacientes da minha equipe
				if(Auth::user()->hasPermissionTo('Terapia_Editar_Equipe')){
					return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente])->with(["page" => ""]);
				}else{
					
					$equipe = DB::table(Auth::user()->equipe.'s')->where('id_paciente', $id)->first();
					
					// Acesso para editar pacientes que o usuario atende
					if(Auth::user()->hasPermissionTo('Terapia_Editar_Meu') AND $equipe->id_responsavel == Auth::user()->id){
						return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente])->with(["page" => ""]);
					}else{
						abort('401');
					}
					
				}
				
			}else{
				abort('401');
			}
			
		}
		
    }


    /**
     * Salvar alterações na terapia
     *
     */
    public function update(Request $request, $id)
    {
        //
		$this->validate($request, [
				'id_paciente'=>'required|integer',
				'conduta'=>'required'
			]);

		/**
		 * Busca os dados da terapia anterior
		 * Para validação de datas das dietas
		 *
		 */
		$terapia_anterior = DB::table('terapias')->where('id', $id)->first();

		
		// Dados adicionais da terapia
		$adicional[1] = $request->input('adicional_1');
		$adicional[2] = $request->input('adicional_2');
		$adicional[3] = $request->input('adicional_3');
		$adicional[4] = $request->input('adicional_4');
		$adicional[5] = $request->input('adicional_5');
		$adicional[6] = $request->input('adicional_6');
		$adicional[7] = $request->input('adicional_7');
		$adicional[8] = $request->input('adicional_8');
		
		$terapia_2 = null;
		
		foreach($adicional as $add){
			
			if(isset($add) and $terapia_2==null){
				$terapia_2 = $add;
			}elseif(isset($add) and $terapia_2!=null){
				$terapia_2 .= " / ".$add;
			}
			
		}

		if($terapia_2==null){
			$terapia_2 = "Nenhuma";
		}
		
		$acomp_liquido    = !empty($request->input('acomp_liquido')) 	? $request->input('acomp_liquido') 	: 0;
		$acomp_refeicao   = !empty($request->input('acomp_refeicao')) 	? $request->input('acomp_refeicao') : 0;
		$prescricao		  = !empty($request->input('prescricao')) 		? $request->input('prescricao') 	: 'Não';
		
		DB::table('terapias')
            ->where('id', $id)
            ->update([
				'terapia'              			=> $request->terapia,
				'terapia_2'            			=> $terapia_2,
				'evolucao'			   			=> $request->evolucao,
				'conduta'              			=> $request->conduta,
				'comentario'           			=> $request->comentario,
				'aval_dieta'           			=> $acomp_refeicao,
				'aval_liquido'         			=> $acomp_liquido,
				'prescricao'					=> $prescricao,
				'dieta_anterior'				=> $request->dieta_anterior,
				'comentario_dieta_anterior'		=> $request->comentario_dieta_anterior,
				'treino_anterior'				=> $request->treino_anterior,
				'comentario_treino_anterior'	=> $request->comentario_treino_anterior,
				'data'				   			=> $request->data_terapia,
				'prescricao'		   			=> $request->prescricao,
			]);
			
			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'terapia',
				'id_linha'       => $id,
				'acao'           => 'atualizar',
				'id_usuario'     => Auth::user()->id
			]);


			// Busca último registro na tabela de dietas
			$dietas = DB::table('historico_dietas')->where('id_paciente', $request->id_paciente)->orderBy('id', 'desc')->first();

			// Checa se foi alterado dieta na terapia que esta sendo editada
			if($dietas->data == $terapia_anterior->data){

				
				/**
				 * Busca os dados da dieta anterior
				 * Para caso a dieta/liquido escolhida seja 'Mantida'
				 *
				 */
				$dietas_2 = DB::table('historico_dietas')
					->where('id_paciente', $request->id_paciente)
					->where('id', '!=', $dietas->id)
					->orderBy('id', 'desc')->first();


				/**
				 * Se a dieta e liquido foi mantida, a linha deve ser excluida
				 * Já foi verificado as datas, isso significa que a linha foi criada errada
				 *
				 */
				if($request->dieta == 'Mantida' && $request->liquido == 'Mantida'){

					DB::table('historico_dietas')->where('id', $dietas->id)->delete();

				}


				// Atualizar dieta
				if($request->dieta != 'Mantida'){

					/**
					 * Atualiza com a dieta escolhida
					 * Significa que foi alterada a dieta
					 *
					 */
					DB::table('historico_dietas')
						->where('id', $dietas->id)
	        			->update([
	        				'data'	=> $request->data_terapia,
							'dieta' => $request->dieta
						]);

				}else{

					/**
					 * Atualiza com a dieta aterior
					 * Significa que a dieta deve ser mantida
					 *
					 */
					DB::table('historico_dietas')
						->where('id', $dietas->id)
	        			->update([
	        				'data'	=> $request->data_terapia,
							'dieta' => $dieta_2->dieta
						]);

				}


				// Atualizar liquido
				if($request->liquido != 'Mantida'){

					/**
					 * Atualiza com o liquido escolhido
					 * Significa que foi alterado o liquido
					 *
					 */
					DB::table('historico_dietas')
						->where('id', $dietas->id)
	        			->update([
	        				'data'	=> $request->data_terapia,
							'liquido' => $request->liquido
						]);

				}else{

					/**
					 * Atualiza com o liquido aterior
					 * Significa que o liquido deve ser mantido
					 *
					 */
					DB::table('historico_dietas')
						->where('id', $dietas->id)
	        			->update([
	        				'data'	=> $request->data_terapia,
							'liquido' => $dieta_2->liquido
						]);

				}

			}else{

				// Inserir nova dieta e liquido
				if($request->dieta != 'Mantida' && $request->liquido != 'Mantida'){

					DB::table('historico_dietas')
		    			->insert([
		    				'id_paciente' 	=> $request->id_paciente,
							'dieta' 		=> $request->dieta,
							'liquido' 		=> $request->liquido,
							'data'			=> $request->data_terapia
						]);

				}

				// Inserir nova dieta
				if($request->dieta != 'Mantida' && $request->liquido == 'Mantida'){

					DB::table('historico_dietas')
		    			->insert([
							'id_paciente' 	=> $request->id_paciente,
							'dieta' 		=> $request->dieta,
							'liquido' 		=> $dietas->liquido,
							'data'			=> $request->data_terapia
						]);

				}

				// Inserir novo liquido
				if($request->dieta == 'Mantida' && $request->liquido != 'Mantida'){

					DB::table('historico_dietas')
		    			->insert([
							'id_paciente' 	=> $request->id_paciente,
							'dieta' 		=> $dietas->dieta,
							'liquido' 		=> $request->liquido,
							'data'			=> $request->data_terapia
						]);

				}

			}
			
		return redirect()->action('PacienteController@show', $request->id_paciente);
		
    }


    /**
     * Excluir uma terapia.
     *
     */
    public function destroy($id)
    {
        //
    }

	
}
