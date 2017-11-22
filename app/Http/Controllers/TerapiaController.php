<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;



use Auth;
use DB;
use Carbon\Carbon;
use App\Terapia;

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
			
		$id_fonos = DB::table('fonos')->where('id_paciente', $request->id_paciente)->first();

		// Confirma se o paciente já possui uma avaliação
		if($id_fonos->id > 0){

			// Dados adicionais da terapia
			$adicional[1] = $request->input('adicional_1');
			$adicional[2] = $request->input('adicional_2');
			$adicional[3] = $request->input('adicional_3');
			$adicional[4] = $request->input('adicional_4');
			$adicional[5] = $request->input('adicional_5');
			$adicional[6] = $request->input('adicional_6');
			$adicional[7] = $request->input('adicional_7');
			$adicional[8] = $request->input('adicional_8');
			$adicional[9] = $request->input('adicional_9');
			
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
			
			$acomp_liquido    = !empty($request->input('acomp_liquido')) 	? $request->input('acomp_liquido') 	: 'Sim';
			$acomp_refeicao   = !empty($request->input('acomp_refeicao')) 	? $request->input('acomp_refeicao') : 'Sim';
			
			
			/* ----- INSERIR OS DADOS NAS TABELAS ----- */
			
			// Inserir nova terapia
			$id_insert = DB::table('terapias')->insertGetId([
				'id_paciente'          			=> $request->id_paciente,
				'id_usuario'           			=> Auth::user()->id,
				'id_fonos'						=> $id_fonos->id,
				'equipe'               			=> 'fon',
				'terapia'              			=> $request->terapia,
				'terapia_2'            			=> $terapia_2,
				'evolucao'			   			=> $request->evolucao,
				'conduta'              			=> $request->conduta,
				'comentario'           			=> $request->comentario,
				'aval_dieta'           			=> $acomp_refeicao,
				'aval_liquido'         			=> $acomp_liquido,
				'prescricao'					=> $request->prescricao,
				'dieta_anterior'				=> $request->dieta_anterior,
				'comentario_dieta_anterior'		=> $request->comentario_dieta_anterior,
				'treino_anterior'				=> $request->treino_anterior,
				'comentario_treino_anterior'	=> $request->comentario_treino_anterior,
				'data'				   			=> $request->data_terapia
			]);
				
			// Cadastra prescrição
			DB::table('prescricao')->insert([
				'id_terapia'  => $id_insert,
				'prescricao'  => $request->prescricao,
				'equipe'	  => $request->equipe_prescricao,
				'updated_by'  => Auth::user()->id
			]);

				// Histórico
				DB::table('historicos')->insert([
					'tabela'         => 'terapia',
					'id_linha'       => $id_insert,
					'acao'           => 'criar',
					'id_usuario'     => Auth::user()->id
				]);


			// Busca último registro na tabela de dietas
			$dietas = DB::table('historico_dietas')->where('id_paciente', $request->id_paciente)->orderBy('id', 'desc')->first();

			// Inserir nova dieta e liquido
			if($request->dieta != 'Mantida' && $request->liquido != 'Mantida'){

				DB::table('historico_dietas')
	    			->insert([
	    				'id_paciente' 	=> $request->id_paciente,
	    				'id_fonos'		=> $id_fonos->id,
	    				'id_terapias'	=> $id_insert,
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
						'id_fonos'		=> $id_fonos->id,
	    				'id_terapias'	=> $id_insert,
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
						'id_fonos'		=> $id_fonos->id,
	    				'id_terapias'	=> $id_insert,
						'dieta' 		=> $dietas->dieta,
						'liquido' 		=> $request->liquido,
						'data'			=> $request->data_terapia
					]);

			}
		
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
		$historico_dietas = DB::table('historico_dietas')->where('id_terapias', $terapia->id)->orderBy('id', 'desc')->first();
		$prescricao = DB::table('prescricao')->where('id_terapia', $terapia->id)->first();

		
		// Acesso para editar todos pacientes
		if (!Auth::user()->hasPermissionTo('Terapia_Editar_Todos')){
			
			// Verifica se o paciente esta sendo atendido pela equipe
			if($paciente->fon == 1){
				
				// Aceso para editar pacientes da minha equipe
				if(!Auth::user()->hasPermissionTo('Terapia_Editar_Equipe')){

					$equipe = DB::table(Auth::user()->equipe.'s')->where('id_paciente', $id)->first();
					
					// Acesso para editar pacientes que o usuario atende
					if(Auth::user()->hasPermissionTo('Terapia_Editar_Meu') AND $equipe->id_responsavel == Auth::user()->id){
						// return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente])->with(["page" => ""]);
					}else{
						abort('401');
					}
					
				}
				
			}else{
				abort('401');
			}
			
		}

		return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente, 'prescricao' => $prescricao, 'historico_dietas' => $historico_dietas])->with(["page" => ""]);
		
    }


    /**
     * Salvar alterações na terapia
     *
     */
    public function update(Request $request, $id)
    {
        //
		$this->validate($request, [
				'id_paciente'	=> 'required|integer',
				'conduta'		=> 'required',
				'dieta'			=> 'required',
				'liquido'		=> 'required'
			]);

		/**
		 * Busca os dados da terapia anterior (que esta sendo editada)
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
		$adicional[9] = $request->input('adicional_9');
		
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
		
		$acomp_liquido    = !empty($request->input('acomp_liquido')) 	? $request->input('acomp_liquido') 	: 'Sim';
		$acomp_refeicao   = !empty($request->input('acomp_refeicao')) 	? $request->input('acomp_refeicao') : 'Sim';
		
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
				'prescricao'					=> $request->prescricao,
				'dieta_anterior'				=> $request->dieta_anterior,
				'comentario_dieta_anterior'		=> $request->comentario_dieta_anterior,
				'treino_anterior'				=> $request->treino_anterior,
				'comentario_treino_anterior'	=> $request->comentario_treino_anterior,
				'data'				   			=> $request->data_terapia
			]);
			
		// Atualiza prescrição
		DB::table('prescricao')
			->where('id_terapia', $id)
			->update([
			'prescricao'  => $request->prescricao,
			'equipe'	  => $request->equipe_prescricao,
			'updated_by'  => Auth::user()->id
			]);

			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'terapia',
				'id_linha'       => $id,
				'acao'           => 'atualizar',
				'id_usuario'     => Auth::user()->id
			]);



		/**
		 * Busca os dados da dieta anterior
		 * Para caso a dieta/liquido escolhida seja 'Mantida'
		 *
		 */
		$dieta_antiga = DB::table('historico_dietas')
			->where('id_paciente', $terapia_anterior->id_paciente)
			->where('id_terapias', '<', $id)
			->orderBy('id', 'desc')
			->first();


		// Checa se foi alterado dieta na terapia que esta sendo editada
		if( DB::table('historico_dietas')->where('id_terapias', $id)->exists() ){

			// Busca registro na tabela de dietas
			$dietas = DB::table('historico_dietas')->where('id_terapias', $id)->first();

			/**
			 * Se a dieta e liquido foi mantida, a linha deve ser excluida
			 * Já foi verificado as datas, isso significa que a linha foi criada errada
			 *
			 */
			if($request->dieta == 'Mantida' && $request->liquido == 'Mantida'){

				DB::table('historico_dietas')
					->where('id', $dietas->id)
					->where('id_terapias', '>', 0)
					->delete();

			}else{


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
							'dieta' => $dieta_antiga->dieta
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
							'liquido' => $dieta_antiga->liquido
						]);

				}

			}

		}else{

			// Inserir nova dieta e liquido
			if($request->dieta != 'Mantida' && $request->liquido != 'Mantida'){

				DB::table('historico_dietas')
	    			->insert([
	    				'id_paciente' 	=> $request->id_paciente,
	    				'id_fonos'		=> $terapia_anterior->id_fonos,
	    				'id_terapias'	=> $terapia_anterior->id,
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
						'id_fonos'		=> $terapia_anterior->id_fonos,
	    				'id_terapias'	=> $terapia_anterior->id,
						'dieta' 		=> $request->dieta,
						'liquido' 		=> $dieta_antiga->liquido,
						'data'			=> $request->data_terapia
					]);

			}

			// Inserir novo liquido
			if($request->dieta == 'Mantida' && $request->liquido != 'Mantida'){

				DB::table('historico_dietas')
	    			->insert([
						'id_paciente' 	=> $request->id_paciente,
						'id_fonos'		=> $terapia_anterior->id_fonos,
	    				'id_terapias'	=> $terapia_anterior->id,
						'dieta' 		=> $dieta_antiga->dieta,
						'liquido' 		=> $request->liquido,
						'data'			=> $request->data_terapia
					]);

			}

		}
			
		return redirect()->action('PacienteController@show', $request->id_paciente);
		
    }


    /**
     * Deletar uma terapia.
     *
     */
    public function deletar($id)
    {
        
        // Excluir item da tabela de objetivos
        Terapia::destroy($id);

        DB::table('historico_dietas')
        	->where('id_terapias', $id)
        	->delete();

        DB::table('prescricao')
        	->where('id_terapia', $id)
        	->delete();

        
        // Retorna resposta para AJAX
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
        
    }

	
}
