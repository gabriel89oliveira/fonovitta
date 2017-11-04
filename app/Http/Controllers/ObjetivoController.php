<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Objetivo;
use App\HistoricoObjetivo;
use App\Paciente;
use App\Usuario;
use App\Fono;
use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class ObjetivoController extends Controller
{
	
	// Apenas usuários com a permissão 'Administrativo'
	public function __construct() {
        $this->middleware(['auth', 'clearance']);
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$objetivos = DB::table('objetivos')
            ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
			->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
			->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
			->where('objetivos.status', '=', 'ativo')
			->orderBy('objetivos.prazo', 'asc')
			->orderBy('objetivos.id', 'desc')
			->get();

        return view('objetivos.index', compact('objetivos'))->with(["page" => "todos_objetivos"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$paciente = DB::table('pacientes')
			->leftJoin('objetivos', 'pacientes.id', '=', 'objetivos.id_paciente')
			->select('pacientes.nome', 'pacientes.id')
			->where('objetivos.status', '=', null)
			->where('pacientes.fon', '=', 1)
			->pluck('pacientes.nome', 'pacientes.id');
		
		return view('objetivos/cadastrar', ['paciente' => $paciente])->with(["page" => "cadastrar_objetivo"]);
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		// Buscar dados do responsável
		$responsavel = DB::table('fonos')
			->select('id_responsavel')
			->where('id_paciente', '=', $request->id_paciente)
			->where('data_termino', '<', 'data_inicio')
			->first();
		
		// Cadastra novo objetivo
		$objetivo = DB::table('objetivos')->insertGetId([
			'data'			=> Carbon::now(),
			'id_paciente'   => $request->id_paciente, 
			'id_usuario'    => $responsavel->id_responsavel,
			'objetivo'      => $request->objetivo,
			'progresso' 	=> 0,
			'status' 		=> 'ativo',
			'prazo'    		=> $request->prazo,
			'updated_by'    => Auth::user()->id
		]);
		
		return redirect()->action('ObjetivoController@index');
		
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
		$this->validate($request, [
			'objetivo'      =>'required',
			'progresso' 	=>'required',
			'prazo'    		=>'required'
		]);
		
		DB::table('objetivos')
            ->where('id', $id)
            ->update([
				'objetivo'      => $request->objetivo,
				'progresso' 	=> $request->progresso,
				'prazo'    		=> $request->prazo,
				'updated_by'    => Auth::user()->id
			]);
			
		return redirect()->action('ObjetivoController@index');
		
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
		Objetivo::destroy($id);
		
		return redirect()->action('ObjetivoController@index');
		
    }
	
	/**
     * Conclude the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function conclude(Request $request, $id)
    {
        //
		$objetivo = DB::table('objetivos')
            ->where('id', $id)
			->first();
			
		$historico = DB::table('historico_objetivos')->insertGetId([
			'data'			=> $objetivo->data,
			'id_paciente'   => $objetivo->id_paciente, 
			'id_usuario'    => $objetivo->id_usuario,
			'objetivo'      => $objetivo->objetivo,
			'prazo'    		=> $objetivo->prazo,
			'conclusao'		=> $request->data,
			'updated_by'    => Auth::user()->id
		]);
			
		Objetivo::destroy($id);
		
		return redirect()->action('ObjetivoController@index');
		
    }
	
	/**
     * Conclude the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mine($id)
    {
        //
		$objetivos = DB::table('objetivos')
            ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
			->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
			->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
			->where('objetivos.id_usuario', '=', $id)
			->orderBy('objetivos.prazo', 'asc')
			->orderBy('objetivos.id', 'desc')
			->get();

        return view('objetivos.index', compact('objetivos'))->with(["page" => "meus_objetivos"]);
		
    }
	
	
}
