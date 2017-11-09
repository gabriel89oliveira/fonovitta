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

class AvaliacaoController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }


    /**
     * Página para criar nova avaliação
     *
     */
    public function create(Request $request)
    {
        
        // Busca dados do paciente
		$paciente = DB::table('pacientes')->where('id', $request->id)->first();
		
		// Encaminha para view
		return view('avaliacao/cadastrar', ['paciente' => $paciente])->with(["page" => ""]);

    }


    /**
     * Salvar dados da avaliação.
     *
     */
    public function store(Request $request)
    {
		
        // Permissão para avaliar
		if (Auth::user()->hasPermissionTo('Paciente_Avaliar')) {
			
			$this->validate($request, [
				'id_paciente'		=> 'required|integer',
				'dieta_inicial'		=> 'required|min:3',
				'liquido_inicial'	=> 'required|min:3',
				'motivo_avaliacao'	=> 'required|min:3',
				'frequencia'		=> 'required',
				'local'				=> 'required',
				'terapia'			=> 'required|min:3',
				'conduta'			=> 'required'
			]);
			
			$paliativo	= !empty($request->input('paliativo')) 	? $request->input('paliativo') 	: 'Não';
			$prescricao	= !empty($request->input('prescricao')) ? $request->input('prescricao') : 'Não';

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
			
			
			/* ----- INSERIR OS DADOS NAS TABELAS ----- */
			
			// Inserir dados na tabela 'fon'
			$id_insert = DB::table('fonos')->insertGetId([
				'id_paciente'          => $request->id_paciente, 
				'id_responsavel'	   => Auth::user()->id,
				'data_inicio'          => date("Y-m-d H:i:s"),
				'frequencia'           => $request->frequencia,
				'dieta_inicial'        => $request->dieta_inicial,
				'liquido_inicial'      => $request->liquido_inicial,
				'motivo_avaliacao'     => $request->motivo_avaliacao,
				'comentario'           => $request->comentario,
				'local'				   => $request->local,
				'paliativo'			   => $paliativo,
				'diagnostico_1'		   => $request->diagnostico_1,
				'diagnostico_2'		   => $request->diagnostico_2,
				'diagnostico_3'		   => $request->diagnostico_3,
				'numero_atendimento'   => $request->numero_atendimento
			]);
			
				// Histórico
				DB::table('historicos')->insert([
					'tabela'         => 'fon',
					'id_linha'       => $id_insert,
					'acao'           => 'criar',
					'id_usuario'     => Auth::user()->id
				]);
			
			
			// Inserir nova terapia
			$id_insert = DB::table('terapias')->insertGetId([
				'id_paciente'          => $request->id_paciente,
				'id_usuario'           => Auth::user()->id,
				'id_fonos'			   => $id_insert,
				'equipe'               => 'fon',
				'terapia'              => $request->terapia,
				'terapia_2'            => $terapia_2,
				'conduta'              => $request->conduta,
				'comentario'           => $request->comentario,
				'aval_dieta'           => $request->dieta,
				'aval_liquido'         => $request->liquido,
				'prescricao'		   => $prescricao,
				'data'				   => date("Y-m-d")
			]);
				
				// Histórico
				DB::table('historicos')->insert([
					'tabela'         => 'terapia',
					'id_linha'       => $id_insert,
					'acao'           => 'criar',
					'id_usuario'     => Auth::user()->id
				]);
			

			// Insere novas dietas
			$id_insert = DB::table('historico_dietas')->insertGetId([
    				'id_paciente' 	=> $request->id_paciente,
					'dieta' 		=> $request->dieta,
					'liquido' 		=> $request->liquido,
					'data'			=> date("Y-m-d")
				]);

				// Histórico
				DB::table('historicos')->insert([
					'tabela'         => 'historico_dietas',
					'id_linha'       => $id_insert,
					'acao'           => 'criar',
					'id_usuario'     => Auth::user()->id
				]);

			
			// Atualiza atendimento de fono na tabela 'pacientes'
			DB::table('pacientes')
				->where('id', $request->id_paciente)
				->update(['fon' => 1]);
				
				// Histórico
				DB::table('historicos')->insert([
					'tabela'         => 'pacientes',
					'id_linha'       => $request->id_paciente,
					'acao'           => 'atualizar',
					'id_usuario'     => Auth::user()->id
				]);
				
			
			/* ----- ENCAMINHA PARA NOVA PÁGINA ----- */
			return redirect()->route('pacientes.show', ['id' => $request->id_paciente]);
			
		}else{
			
			return redirect()->action('PacienteController@show', $request->id_paciente);
			
		}
		
    }


    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }
}
