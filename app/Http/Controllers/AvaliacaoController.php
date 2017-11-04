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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
		$paciente = DB::table('pacientes')->where('id', $request->id)->first();
		
		return view('avaliacao/cadastrar', ['paciente' => $paciente])->with(["page" => ""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
        // Permiss�o para avaliar
		if (Auth::user()->hasPermissionTo('Paciente_Avaliar')) {
			
			$this->validate($request, [
				'id_paciente'=>'required|integer',
				'dieta_inicial'=>'required|min:3',
				'motivo_avaliacao'=>'required|min:3',
				'comentario'=>'required|min:3',
				'frequencia'=>'required',
				'local'=>'required',
				'terapia'=>'required|min:3',
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
				'local'				   => $request->local
			]);
			
				// Hist�rico
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
				'equipe'               => 'fon',
				'terapia'              => $request->terapia,
				'terapia_2'            => $terapia_2,
				'conduta'              => $request->conduta,
				'comentario'           => $request->comentario,
				'aval_dieta'           => $request->dieta,
				'aval_liquido'         => $request->liquido,
				'data'				   => date("Y-m-d")
			]);
				
				// Hist�rico
				DB::table('historicos')->insert([
					'tabela'         => 'terapia',
					'id_linha'       => $id_insert,
					'acao'           => 'criar',
					'id_usuario'     => Auth::user()->id
				]);
			
			
			// Atualiza atendimento de fono na tabela 'pacientes'
			DB::table('pacientes')
				->where('id', $request->id_paciente)
				->update(['fon' => 1]);
				
				// Hist�rico
				DB::table('historicos')->insert([
					'tabela'         => 'pacientes',
					'id_linha'       => $request->id_paciente,
					'acao'           => 'atualizar',
					'id_usuario'     => Auth::user()->id
				]);
				
			
			/* ----- ENCAMINHA PARA NOVA P�GINA ----- */
			return redirect()->route('pacientes.show', ['id' => $request->id_paciente]);
			
		}else{
			
			return redirect()->action('PacienteController@show', $request->id_paciente);
			
		}
		
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
