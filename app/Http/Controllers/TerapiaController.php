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
				'comentario'=>'required|min:3',
				'terapia'=>'required|min:3',
				'conduta'=>'required',
				'evolucao'=>'required|min:3'
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
		
		$acomp_liquido    = !empty($request->input('acomp_liquido')) ? $request->input('acomp_liquido') : 0;
		$acomp_refeicao   = !empty($request->input('acomp_refeicao')) ? $request->input('acomp_refeicao') : 0;
		
		
		/* ----- INSERIR OS DADOS NAS TABELAS ----- */
		
		// Inserir nova terapia
		$id_insert = DB::table('terapias')->insertGetId([
			'id_paciente'          => $request->id_paciente,
			'id_usuario'           => Auth::user()->id,
			'equipe'               => 'fon',
			'terapia'              => $request->terapia,
			'terapia_2'            => $terapia_2,
			'evolucao'			   => $request->evolucao,
			'conduta'              => $request->conduta,
			'comentario'           => $request->comentario,
			'aval_dieta'           => $acomp_refeicao,
			'aval_liquido'         => $acomp_liquido,
			'data'				   => $request->data_terapia
		]);
			
			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'terapia',
				'id_linha'       => $id_insert,
				'acao'           => 'criar',
				'id_usuario'     => Auth::user()->id
			]);
		
			
		
		/* ----- ENCAMINHA PARA NOVA PÁGINA ----- */
		return redirect()->route('pacientes.show', ['id' => $request->id_paciente]);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
			return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente]);
		}else{
			
			// Verifica se o paciente esta sendo atendido pela equipe
			if($paciente->fon == 1){
				
				// Aceso para editar pacientes da minha equipe
				if(Auth::user()->hasPermissionTo('Terapia_Editar_Equipe')){
					return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente]);
				}else{
					
					$equipe = DB::table(Auth::user()->equipe.'s')->where('id_paciente', $id)->first();
					
					// Acesso para editar pacientes que o usuario atende
					if(Auth::user()->hasPermissionTo('Terapia_Editar_Meu') AND $equipe->id_responsavel == Auth::user()->id){
						return view('terapia/editar', ['terapia' => $terapia, 'paciente' => $paciente]);
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
				'comentario'=>'required|min:3',
				'terapia'=>'required|min:3',
				'conduta'=>'required',
				'evolucao'=>'required|min:3'
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
		
		$acomp_liquido    = !empty($request->input('acomp_liquido')) ? $request->input('acomp_liquido') : 0;
		$acomp_refeicao   = !empty($request->input('acomp_refeicao')) ? $request->input('acomp_refeicao') : 0;
		
		DB::table('terapias')
            ->where('id', $id)
            ->update([
				'terapia'              => $request->terapia,
				'terapia_2'            => $terapia_2,
				'evolucao'			   => $request->evolucao,
				'conduta'              => $request->conduta,
				'comentario'           => $request->comentario,
				'aval_dieta'           => $acomp_refeicao,
				'aval_liquido'         => $acomp_liquido,
				'data'				   => $request->data_terapia
			]);
			
			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'terapia',
				'id_linha'       => $id,
				'acao'           => 'atualizar',
				'id_usuario'     => Auth::user()->id
			]);
			
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
