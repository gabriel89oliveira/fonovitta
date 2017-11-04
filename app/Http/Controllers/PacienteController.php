<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Paciente;
use App\Usuario;
use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class PacienteController extends Controller
{
	
	public function __construct() {
        $this->middleware(['auth', 'clearance']);
    }
	
    /**
    * Pagina para listar todos pacientes.
    *
    */
    public function index() {
	
        $pacientes = Paciente::where('status', '=', 'ativo')->orderby('nome', 'asc')->paginate(15);
        return view('pacientes.index', compact('pacientes'))->with(["page" => "todos_pacientes"]);
		
    }
	
	
    /**
    * Pagina para cadastrar um novo paciente
    *
    */
    public function create() {
    
		return view('pacientes.cadastrar')->with(["page" => "cadastrar_paciente"]);
		
    }
	
	
    /**
    * Efetua o cadastro do novo paciente
    *
    */
    public function store(Request $request) {
		
		// Buscar permissões
		$permissions = Permission::all();
		
		if (Auth::user()->hasPermissionTo('Paciente_Cadastrar')) {
			
			$this->validate($request, [
				'nome'=>'required|min:2',
				'sexo'=>'required',
				'diagnostico_1'=>'required|min:2'
			]);
			
			$id_paciente = DB::table('pacientes')->insertGetId([
				'nome'          => $request->nome, 
				'nascimento'    => $request->nascimento,
				'sexo'          => $request->sexo,
				'diagnostico_1' => $request->diagnostico_1,
				'diagnostico_2' => $request->diagnostico_2,
				'diagnostico_3' => $request->diagnostico_3,
				'responsavel'   => $request->responsavel,
				'relacao'       => $request->relacao,
				'cuidador'      => $request->cuidador,
				'telefone_1'    => $request->contato_1,
				'nome_1'        => $request->nome_contato_1,
				'telefone_2'    => $request->contato_2,
				'nome_2'        => $request->nome_contato_2,
				'endereco'    	=> $request->endereco,
				'bairro'        => $request->bairro,
				'cidade'        => $request->cidade,
				'status'        => 'ativo',
				'fon'			=> 0,
				'enf'			=> 0,
				'med'			=> 0,
				'nut'			=> 0,
				'fir'			=> 0,
				'fim'			=> 0
			]);
			
			return redirect()->route('pacientes.show', ['id' => $id_paciente]);
		
		}else{
			abort('401');
		}
		
    }
	
	
    /**
    * Pagina para mostrar os dados de um paciente
    *
    */
    public function show($id) {
		
        $paciente = DB::table('pacientes')->where('id', $id)->first();
		$idade = Carbon::parse($paciente->nascimento)->age;
		
		if($paciente->nascimento == Carbon::today()){
			$aniversario = 0;
		}else{
			$hoje = Carbon::now();
			$nascimento = Carbon::parse($paciente->nascimento)->year(date('Y'));
			
			$aniversario = Carbon::now()->diffInDays($nascimento, false);
			
			if($aniversario>0 && $aniversario<1){
				$aniversario = 1;
			}
		}
		
		$terapia = DB::table('terapias')
            ->join('users', 'terapias.id_usuario', '=', 'users.id')
			->select('terapias.*', 'users.name')
			->where('id_paciente', '=', $id)
			->orderBy('data', 'desc')
			->orderBy('id', 'desc')
			->get();
		
		$equipe = DB::table('usuarios')->pluck('nome', 'id');
		
		$fono = DB::table('fonos')
			->join('usuarios', 'fonos.id_responsavel', '=', 'usuarios.id')
			->select('fonos.*', 'usuarios.nome')
			->where('id_paciente', $paciente->id)
			->orderBy('data_inicio', 'desc')->first();
		
		return view('pacientes/perfil', ['paciente' => $paciente, 'idade' => $idade, 'aniversario' => $aniversario, 'terapia' => $terapia, 'fono' => $fono, 'equipe' => $equipe])->with(["page" => ""]);
		
    }
	
	
    /**
    * Pagina para editar os dados de um paciente
    *
    */
    public function edit($id) {
    
		// Buscar permissões
		$permissions = Permission::all();
		
		// Dados do paciente
		$paciente = DB::table('pacientes')->where('id', $id)->first();
		
		// Acesso para editar todos pacientes
		if (Auth::user()->hasPermissionTo('Paciente_Editar_Todos')){
			return view('pacientes/editar', ['paciente' => $paciente])->with(["page" => ""]);
		}else{
			
			// Verifica se o paciente esta sendo atendido pela equipe
			if($paciente->fon == 1){
				
				// Aceso para editar pacientes da minha equipe
				if(Auth::user()->hasPermissionTo('Paciente_Editar_Equipe')){
					return view('pacientes/editar', ['paciente' => $paciente])->with(["page" => ""]);
				}else{
					
					$equipe = DB::table(Auth::user()->equipe.'s')->where('id_paciente', $id)->first();
					
					// Acesso para editar pacientes que o usuario atende
					if(Auth::user()->hasPermissionTo('Paciente_Editar_Meu') AND $equipe->id_responsavel == Auth::user()->id){
						return view('pacientes/editar', ['paciente' => $paciente])->with(["page" => ""]);
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
    * Efetua a alteração dos dados do paciente
    *
    */
    public function update(Request $request, $id) {
		
		// Buscar permissões
		$permissions = Permission::all();
		
		$paciente = DB::table('pacientes')->where('id', $id)->first();
		$fono = DB::table('fonos')->where('id_paciente', $id)->first();
		
		if (
			Auth::user()->hasPermissionTo('Paciente_Editar_Todos') OR 
			(Auth::user()->hasPermissionTo('Paciente_Editar_Meu') AND $fono->id_responsavel == Auth::user()->id) OR 
			(Auth::user()->hasPermissionTo('Paciente_Editar_Equipe') AND $paciente->fon == 1)
		) {
			
			// Validação dos dados
			$this->validate($request, [
				'nome'=>'required|max:120',
				'sexo'=>'required',
				'diagnostico_1'=>'required|min:2'
			]);
			
			DB::table('pacientes')
				->where('id', $id)
				->update([
					'nome'          => $request->nome, 
					'nascimento'    => $request->nascimento, 
					'sexo'          => $request->sexo, 
					'diagnostico_1' => $request->diagnostico_1, 
					'diagnostico_2' => $request->diagnostico_2,
					'diagnostico_3' => $request->diagnostico_3,
					'responsavel'   => $request->responsavel,
					'relacao'       => $request->relacao,
					'cuidador'      => $request->cuidador,
					'telefone_1'    => $request->contato_1,
					'nome_1'        => $request->nome_contato_1,
					'telefone_2'    => $request->contato_2,
					'nome_2'        => $request->nome_contato_2,
					'endereco'    	=> $request->endereco,
					'bairro'        => $request->bairro,
					'cidade'        => $request->cidade
				]);
				
			return redirect()->action('PacienteController@show', $id);
			
		}else{
			abort('401');
		}
		
    }
	
	
    /**
    * Excluir um paciente
    *
    */
    public function destroy($id) {
		abort('401');
    }
	
	
	/**
     * Pagina para mostrar pacientes em atendimento pelo usuário.
     *
     */
    public function mine()
    {
		
		$pacientes = DB::table('pacientes')
			->join('fonos', 'pacientes.id', '=', 'fonos.id_paciente')
			->select('pacientes.*')
			->where('fonos.id_responsavel', '=', Auth::user()->id)
			->orderBy('nome', 'desc')
			->paginate(15);

        return view('pacientes.index', compact('pacientes'))->with(["page" => "meus_pacientes"]);
		
	}
	
}
