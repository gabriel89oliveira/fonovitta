<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\User;
use App\Usuario;
use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		$usuarios = Usuario::orderby('nome', 'desc')->paginate(10); //show only 5 items at a time in descending order

        return view('usuarios.index', compact('usuarios'))->with(["page" => "todos_usuarios"]);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //Cadastrar novos usuarios no sistema
		$permissions = Permission::all();//Get all permissions
		
		if (Auth::user()->hasPermissionTo('Usuario_Cadastrar')) {
			return view('usuarios.cadastrar', ['permissions'=>$permissions])->with(["page" => "cadastrar_usuario"]);
		}else{
			return redirect('usuarios')->with(["page" => "todos_usuarios"]);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		
		$user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
		
		$usuario = DB::table('usuarios')->insertGetId([
			'id'			=> $user->id,
			'nome'          => $user->name, 
			'nascimento'    => $request->nascimento,
			'sexo'          => $request->sexo,
			'equipe' 		=> $request->equipe,
			'cargo' 		=> $request->cargo,
			'email'    		=> $user->email,
			'telefone'      => $request->telefone
		]);
		
		return redirect()->route('usuarios.show', ['id' => $user->id]);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
		$usuario = DB::table('usuarios')->where('id', $id)->first();
		$idade = Carbon::parse($usuario->nascimento)->age;
		
		if($usuario->nascimento == Carbon::today()){
			$aniversario = 0;
		}else{
			$hoje = Carbon::now();
			$nascimento = Carbon::parse($usuario->nascimento)->year(date('Y'));
			
			$aniversario = Carbon::now()->diffInDays($nascimento, false);
			
			if($aniversario>0 && $aniversario<1){
				$aniversario = 1;
			}
		}
		
		$terapias = DB::table('terapias')
            ->join('pacientes', 'terapias.id_paciente', '=', 'pacientes.id')
			->select('terapias.*', 'pacientes.nome')
			->where('id_usuario', '=', $id)
			->orderBy('data', 'desc')
			->orderBy('id', 'desc')
			->paginate(15);
			
		$internacao = DB::table('fonos')
            ->join('pacientes', 'fonos.id_paciente', '=', 'pacientes.id')
			->select('fonos.*', 'pacientes.nome', 'pacientes.diagnostico_1')
			->where('id_responsavel', '=', $id)
			->where('local', '=', 'Internação')
			->orderBy('pacientes.nome', 'asc')
			->get();
			
		$domiciliar = DB::table('fonos')
            ->join('pacientes', 'fonos.id_paciente', '=', 'pacientes.id')
			->select('fonos.*', 'pacientes.nome', 'pacientes.diagnostico_1')
			->where('id_responsavel', '=', $id)
			->where('local', '=', 'Domiciliar')
			->orderBy('pacientes.nome', 'asc')
			->get();
		
		return view('usuarios/perfil', ['usuario' => $usuario, 'idade' => $idade, 'aniversario' => $aniversario, 'terapias' => $terapias, 'internacao' => $internacao, 'domiciliar' => $domiciliar])->with(["page" => "todos_usuarios"]);
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
		// Buscar permissões
		$permissions = Permission::all();
		
		$usuario = DB::table('usuarios')->where('id', $id)->first();
		
		return view('usuarios/editar', ['permissions'=>$permissions, 'usuario' => $usuario])->with(["page" => "todos_usuarios"]);
		
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
        
		$user = User::findOrFail($id); //Get role specified by id

		//Validate name, email and password fields  
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        $input = $request->only(['name', 'email']);
        $user->fill($input)->save();
		
		// Dados do usuario
		$input = $request->only(['nascimento', 'sexo', 'telefone', 'equipe', 'cargo']);
		$usuario = Usuario::where('id', '=', $id)->update($input);
		
		
        return redirect()->route('usuarios.show', ['id' => $id]);
		
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
	
	/**
     * Conclude the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mine()
    {
		//
		$id = Auth::user()->id;
		
        $usuario = DB::table('usuarios')->where('id', $id)->first();
		$idade = Carbon::parse($usuario->nascimento)->age;
		
		if($usuario->nascimento == Carbon::today()){
			$aniversario = 0;
		}else{
			$hoje = Carbon::now();
			$nascimento = Carbon::parse($usuario->nascimento)->year(date('Y'));
			
			$aniversario = Carbon::now()->diffInDays($nascimento, false);
			
			if($aniversario>0 && $aniversario<1){
				$aniversario = 1;
			}
		}
		
		$terapias = DB::table('terapias')
            ->join('pacientes', 'terapias.id_paciente', '=', 'pacientes.id')
			->select('terapias.*', 'pacientes.nome')
			->where('id_usuario', '=', $id)
			->orderBy('data', 'desc')
			->orderBy('id', 'desc')
			->get();
			
		$internacao = DB::table('fonos')
            ->join('pacientes', 'fonos.id_paciente', '=', 'pacientes.id')
			->select('fonos.*', 'pacientes.nome', 'pacientes.diagnostico_1')
			->where('id_responsavel', '=', $id)
			->where('local', '=', 'Internação')
			->orderBy('pacientes.nome', 'asc')
			->get();
			
		$domiciliar = DB::table('fonos')
            ->join('pacientes', 'fonos.id_paciente', '=', 'pacientes.id')
			->select('fonos.*', 'pacientes.nome', 'pacientes.diagnostico_1')
			->where('id_responsavel', '=', $id)
			->where('local', '=', 'Domiciliar')
			->orderBy('pacientes.nome', 'asc')
			->get();
		
		return view('usuarios/perfil', ['usuario' => $usuario, 'idade' => $idade, 'aniversario' => $aniversario, 'terapias' => $terapias, 'internacao' => $internacao, 'domiciliar' => $domiciliar])->with(["page" => "meu_perfil"]);
		
    }
	
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password(Request $request, $id)
    {
        
		$user = User::findOrFail($id); //Get role specified by id

		//Validate name, email and password fields  
        $this->validate($request, [
            'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->only(['password']);
        $user->fill($input)->save();
		
        return redirect()->route('usuarios.show', ['id' => $id]);
		
    }
	
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function foto(Request $request, $id)
    {
        
		// get current time and append the upload file extension to it,
		// then put that name to $photoName variable.
		$photoName = time().'.'.$request->user_photo->getClientOriginalExtension();

		/*
		talk the select file and move it public directory and make avatars
		folder if doesn't exsit then give it that unique name.
		*/
		$request->user_photo->move(public_path('dist/img/avatar'), $photoName);
		  
		DB::table('usuarios')
            ->where('id', $id)
            ->update([
				'foto'      => $photoName,
				'updated_by'    => Auth::user()->id
			]);
		
        return redirect()->route('usuarios.show', ['id' => $id]);
		
    }
	
}
