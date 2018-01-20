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


// Index
Route::get('/home', ['uses' => 'SiteController@index', 'as' => 'site.index']);
Route::get('/', ['uses' => 'SiteController@index', 'as' => 'site.index']);

// Contato
Route::post('/contato', ['as' => 'contato', 'uses' => 'ContatoController@store']);
Route::get('/email', function(){
	return view('email');
});

// Area restrita
Route::auth();
Route::group(['middleware' => ['auth']], function() {

	Route::get('/restrito', function () {

		$id_usuario = Auth::user()->id;
		$url = URL::route('usuarios.show', array('usuarios'=>$id_usuario,'mo'=>true));

		return Redirect::to($url);

	});


	/**
	 * Routes para paginas diversas
	 *
	 */
	
		// Pagina de logs
		Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

		// Pagina de busca
		Route::get('busca', ['uses' => 'BuscaController@index', 'as' => 'busca.index']);

		// Pagina para corrigir objetivos
		Route::get('corrigir', ['uses' => 'ObjetivoController@corrigir_objetivos', 'as' => 'objetivo.corrigir']);
	

	/**
	 * Routes para pagina pacientes
	 *
	 */
		
		// Extras
		Route::get('pacientes/estatistica', 
			['uses' => 'PacienteEstatisticaController@estatistica', 'as' => 'pacientes.estatistica']);
		Route::get('pacientes/meus_pacientes', ['uses' => 'PacienteController@mine', 'as' => 'pacientes.mine']);
		// Resources para pacientes
		Route::resource('pacientes', 'PacienteController');

		// Resources para avaliação
		Route::resource('avaliacao', 'AvaliacaoController');
		// Resources para SNE
		Route::put('create', 'SNEController@create');
		Route::put('edit', 'SNEController@edit');
		// Resources para frequencia
		Route::resource('frequencia', 'FrequenciaController');
		// Resources para riscos
		Route::resource('riscos', 'RiscosController');
		// Resources para responsavel
		Route::resource('responsavel', 'ResponsavelController');
	
		// Extras
		Route::delete('terapia/deletar/{id}', ['uses' => 'TerapiaController@deletar', 'as' => 'terapia.deletar']);
		// Routes para terapias
		Route::resource('terapia', 'TerapiaController');

		// Resources para altas
		Route::delete('pacientes/alta/{id}', ['uses' => 'AltaController@alta', 'as' => 'pacientes.alta']);
		Route::delete('pacientes/altahospitalar/{id}', ['uses' => 'AltaController@altahospitalar', 'as' => 'pacientes.altahospitalar']);
		Route::delete('pacientes/suspensao/{id}', ['uses' => 'AltaController@suspensao', 'as' => 'pacientes.suspensao']);
		Route::delete('pacientes/obito/{id}', ['uses' => 'AltaController@obito', 'as' => 'pacientes.obito']);
	
	
	/**
	 * Routes para pagina usuarios
	 *
	 */

		// Extras
		Route::get('usuarios/meu_perfil', ['uses' => 'UsuarioController@mine', 'as' => 'usuarios.mine']);
		Route::put('usuarios/senha/{id}', ['uses' => 'UsuarioController@password', 'as' => 'usuarios.password']);
		Route::put('usuarios/foto/{id}', ['uses' => 'UsuarioController@foto', 'as' => 'usuarios.foto']);
		// Resources para usuarios
		Route::resource('usuarios', 'UsuarioController');
	
	
	/**
	 * Routes para pagina objetivos
	 *
	 */

		// Extras
		Route::delete('objetivos/deletar/{id}', ['uses' => 'ObjetivoController@deletar', 'as' => 'objetivos.deletar']);
		Route::put('objetivos/conclude/{id}', ['uses' => 'ObjetivoController@conclude', 'as' => 'objetivos.conclude']);
		Route::get('objetivos/estatistica', ['uses' => 'ObjetivoEstatisticaController@estatistica', 'as' => 'objetivos.estatistica']);
		// Resources para objetivos
		Route::resource('objetivos', 'ObjetivoController');
		

	/**
	 * Routes para pagina de sugestões
	 *
	 */

		// Resources para sugestoes
		Route::delete('sugestoes/iniciar/{id}', ['uses' => 'SugestaoController@iniciar', 'as' => 'sugestao.iniciar']);
		Route::delete('sugestoes/finalizar/{id}', ['uses' => 'SugestaoController@finalizar', 'as' => 'sugestao.finalizar']);
		Route::get('sugestoes/cadastrar', ['uses' => 'SugestaoController@create', 'as' => 'sugestao.create']);
		Route::get('sugestoes/meus_tickets', ['uses' => 'SugestaoController@meus', 'as' => 'sugestao.meus']);
		Route::get('sugestoes/tickets', ['uses' => 'SugestaoController@tickets', 'as' => 'sugestao.tickets']);
		Route::get('sugestoes/mostrar_ticket/{id}', ['uses' => 'SugestaoController@mostrar_ticket', 'as' => 'sugestao.mostrar_ticket']);
		Route::post('sugestoes/store', ['uses' => 'SugestaoController@store', 'as' => 'sugestao.store']);
		Route::post('sugestoes/comentar', ['uses' => 'SugestaoController@comentar', 'as' => 'sugestao.comentar']);


	/**
	 * Routes para pagina de broncoaspiração
	 *
	 */

		// Resources para broncoaspiração
		Route::resource('broncoaspiracao', 'BroncoaspiracaoController');

	
	/**
	 * Routes para controle de acessos
	 *
	 */

		// Resources para controle de permissões
		Route::resource('users', 'UserController');
		Route::resource('roles', 'RoleController');
		Route::resource('permissions', 'PermissionController');


});
