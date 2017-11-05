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
	
	
    /**
     * Listar todos objetivos.
     *
     */
    public function index()
    {
        
        // Listar todos objetivos
		$objetivos = DB::table('objetivos')
            ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
			->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
			->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
			->orderBy('objetivos.prazo', 'asc')
			->orderBy('objetivos.id', 'desc')
			->paginate(10);

        // Retorna p�gina de objetivos
        return view('objetivos.index', compact('objetivos'))->with(["page" => "todos_objetivos"]);

    }


    /**
     * Formul�rio para criar um novo objetivo.
     *
     */
    public function create()
    {
        
        // Buscar pacientes que n�o tem objetivo associado
		$paciente = DB::table('pacientes')
			->leftJoin('objetivos', 'pacientes.id', '=', 'objetivos.id_paciente')
			->select('pacientes.nome', 'pacientes.id')
			->where('objetivos.status', '=', null)
			->where('pacientes.fon', '=', 1)
			->pluck('pacientes.nome', 'pacientes.id');
		
        // Retorna p�gina para criar objetivo
		return view('objetivos/cadastrar', ['paciente' => $paciente])->with(["page" => "cadastrar_objetivo"]);
		
    }


    /**
     * Cadastrar novo objetivo.
     *
     */
    public function store(Request $request)
    {
        
		// Buscar dados do respons�vel
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
		
        // Retorna p�gina de objetivos
		return redirect()->action('ObjetivoController@index');
		
    }


    /**
     * Atualizar objetivo.
     *
     */
    public function update(Request $request, $id)
    {
        
        // Valida dados de entrada
		$this->validate($request, [
			'objetivo'      =>'required',
			'progresso' 	=>'required',
			'prazo'    		=>'required'
		]);
		
        // Atualiza tabela de objetivos
		DB::table('objetivos')
            ->where('id', $id)
            ->update([
				'objetivo'      => $request->objetivo,
				'progresso' 	=> $request->progresso,
                'status'        => $request->status,
				'prazo'    		=> $request->prazo,
				'updated_by'    => Auth::user()->id
			]);
		
        // Retorna p�gina de objetivos
		return redirect()->action('ObjetivoController@index');
		
    }


    /**
     * Excluir um registro. FORA DE USO
     *
     */
    public function destroy($id)
    {
        
        // Excluir item da tabela de objetivos
		Objetivo::destroy($id);
		
        // Retorna resposta para AJAX
		return redirect()->action('ObjetivoController@index');
		
    }


    /**
     * Deletar um objetivo.
     *
     */
    public function deletar($id)
    {
        
        // Excluir item da tabela de objetivos
        Objetivo::destroy($id);
        
        // Retorna resposta para AJAX
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
        
    }


	/**
     * Concluir um objetivo.
     *
     */
    public function conclude(Request $request, $id)
    {
        
        // Busca dados do objetivo
		$objetivo = DB::table('objetivos')
            ->where('id', $id)
			->first();
		
        // Salva dados no historico de objetivos
		$historico = DB::table('historico_objetivos')->insertGetId([
			'data'			=> $objetivo->data,
			'id_paciente'   => $objetivo->id_paciente, 
			'id_usuario'    => $objetivo->id_usuario,
			'objetivo'      => $objetivo->objetivo,
			'prazo'    		=> $objetivo->prazo,
			'conclusao'		=> $request->data,
			'updated_by'    => Auth::user()->id
		]);
		
        // Excluir item da tabela de objetivos
		Objetivo::destroy($id);
		
        // Retorna resposta para AJAX
		return redirect()->action('ObjetivoController@index');
		
    }


	/**
     * Mostrar meus objetivos.
     *
     */
    public function mine($id)
    {
        
		$objetivos = DB::table('objetivos')
            ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
			->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
			->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
			->where('objetivos.id_usuario', '=', $id)
			->orderBy('objetivos.prazo', 'asc')
			->orderBy('objetivos.id', 'desc')
			->paginate(10);

        return view('objetivos.index', compact('objetivos'))->with(["page" => "meus_objetivos"]);
		
    }
	
	
}
