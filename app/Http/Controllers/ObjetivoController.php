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
use URL;
use Redirect;
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
    public function index(Request $request)
    {
        

    	// Listar todos objetivos
		$objetivos = DB::table('objetivos')
            ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
			->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
			->join('fonos', 'objetivos.id_paciente', '=', 'fonos.id_paciente');


    	// Caso exista um usuario definido
		$objetivos = ($request->usuario) ? $objetivos->where('objetivos.id_usuario', $request->usuario) : $objetivos ;

		// Caso exista um local definido
		$objetivos = ($request->local) ? $objetivos->where('fonos.local', $request->local) : $objetivos ;

		// Datas para prazos
		$hoje 	 = Carbon::today()->addDays(1)->toDateString();
		$expDate = Carbon::today()->addDays(10)->toDateString();

		// Caso exista um prazo definido
		if($request->status == 'Atrasado'){

			$objetivos 	= $objetivos->whereDate('objetivos.prazo', '<', $hoje );

		}elseif($request->status == 'Proximo'){

			$objetivos 	= $objetivos->whereBetween('objetivos.prazo', [$hoje, $expDate] );

		}elseif($request->status == 'No prazo'){

			$objetivos 	= $objetivos->whereDate('objetivos.prazo', '>=', $expDate );

		}


		// Listar todos objetivos
		$objetivos = $objetivos
			->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
			->orderBy('objetivos.prazo', 'asc')
			->orderBy('objetivos.id', 'desc')
			->paginate(10);


		// Lista de usuarios
		$usuarios = DB::table('usuarios')->pluck('nome', 'id');

		// Pagina visitada
		$pagina = ($request->mo == true) ? "meus_objetivos" : "todos_objetivos";

        // Retorna página de objetivos
        return view('objetivos.index', compact('objetivos'))->with(["page" => $pagina, "usuarios" => $usuarios]);

    }


    /**
     * Formulário para criar um novo objetivo.
     *
     */
    public function create()
    {
        
        // Buscar pacientes que não tem objetivo associado
		$paciente = DB::table('pacientes')
			->leftJoin('objetivos', 'pacientes.id', '=', 'objetivos.id_paciente')
			->select('pacientes.nome', 'pacientes.id')
			->where('objetivos.status', '=', null)
			->where('pacientes.fon', '=', 1)
			->pluck('pacientes.nome', 'pacientes.id');
		
        // Retorna página para criar objetivo
		return view('objetivos/cadastrar', ['paciente' => $paciente])->with(["page" => "cadastrar_objetivo"]);
		
    }


    /**
     * Cadastrar novo objetivo.
     *
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
		
        // Retorna página de objetivos
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
		
        // Retorna página de objetivos
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
  //   public function mine($id)
  //   {
        
		// $objetivos = DB::table('objetivos')
  //           ->join('pacientes', 'objetivos.id_paciente', '=', 'pacientes.id')
		// 	->join('usuarios', 'objetivos.id_usuario', '=', 'usuarios.id')
		// 	->select('objetivos.*', 'pacientes.nome as paciente_nome', 'usuarios.nome as usuario_nome', 'usuarios.id as usuario_id')
		// 	->where('objetivos.id_usuario', '=', $id)
		// 	->orderBy('objetivos.prazo', 'asc')
		// 	->orderBy('objetivos.id', 'desc')
		// 	->paginate(10);

		// $url = URL::route('objetivos.index', array('usuario'=>$id,'mo'=>true));
		// return Redirect::to($url);
		
  //   }
	
	
}
