<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();
Route::group(['middleware' => ['auth']], function() {

	Route::get('/', function () {
		$id_usuario = Auth::user()->id;
		return redirect()->route('usuarios.show', ['id' => $id_usuario]);
	});

	// Pagina inicial
	Route::get('/home', 'HomeController@index');
	

	// Routes para busca
	Route::get('busca', ['uses' => 'BuscaController@index', 'as' => 'busca.index']);
	

	// Routes para funções do menu
	Route::resource('avaliacao', 'AvaliacaoController');
	Route::resource('frequencia', 'FrequenciaController');
	Route::resource('responsavel', 'ResponsavelController');
	
	
	// Routes para terapias
	Route::delete('terapia/deletar/{id}', ['uses' => 'TerapiaController@deletar', 'as' => 'terapia.deletar']);
	Route::resource('terapia', 'TerapiaController');

	// Routes para altas
	Route::delete('pacientes/alta/{id}', ['uses' => 'AltaController@alta', 'as' => 'pacientes.alta']);
	Route::delete('pacientes/suspensao/{id}', ['uses' => 'AltaController@suspensao', 'as' => 'pacientes.suspensao']);
	Route::delete('pacientes/obito/{id}', ['uses' => 'AltaController@obito', 'as' => 'pacientes.obito']);
	
	
	// Resources para pacientes
	Route::get('pacientes/meus_pacientes', ['uses' => 'PacienteController@mine', 'as' => 'pacientes.mine']);
	Route::resource('pacientes', 'PacienteController');
	
	
	// Resources para usuarios
	Route::get('usuarios/meu_perfil', ['uses' => 'UsuarioController@mine', 'as' => 'usuarios.mine']);
	Route::put('usuarios/senha/{id}', ['uses' => 'UsuarioController@password', 'as' => 'usuarios.password']);
	Route::put('usuarios/foto/{id}', ['uses' => 'UsuarioController@foto', 'as' => 'usuarios.foto']);
	Route::resource('usuarios', 'UsuarioController');
	
	
	// Resources para objetivos
	Route::delete('objetivos/deletar/{id}', ['uses' => 'ObjetivoController@deletar', 'as' => 'objetivos.deletar']);
	Route::put('objetivos/conclude/{id}', ['uses' => 'ObjetivoController@conclude', 'as' => 'objetivos.conclude']);
	Route::get('objetivos/meus_objetivos/{id}', ['uses' => 'ObjetivoController@mine', 'as' => 'objetivos.mine']);
	Route::get('objetivos/estatistica', ['uses' => 'ObjetivoEstatisticaController@estatistica', 'as' => 'objetivos.estatistica']);
	Route::resource('objetivos', 'ObjetivoController');
	

	// Resources para sugestoes
	Route::get('sugestoes/cadastrar', ['uses' => 'SugestaoController@create', 'as' => 'sugestao.create']);
	Route::get('sugestoes/meus_tickets', ['uses' => 'SugestaoController@meus', 'as' => 'sugestao.meus']);
	Route::get('sugestoes/tickets', ['uses' => 'SugestaoController@tickets', 'as' => 'sugestao.tickets']);
	Route::post('sugestoes/store', ['uses' => 'SugestaoController@store', 'as' => 'objetivos.store']);

	
	// Controle de permissões
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');


});
