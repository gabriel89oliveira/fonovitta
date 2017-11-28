<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class SiteController extends Controller
{
    //

	public function index(){

		$usuarios = DB::table('usuarios')
					->where('id', '<>', '2')
					->where('status', 'ativo')
					->orderby('nome', 'asc')
					->get();

		$pacientes = DB::table('pacientes')
					->count();

		$avaliacoes_1 = DB::table('fonos')
						->count();
		$avaliacoes_2 = DB::table('historico_fonos')
						->count();
		$avaliacoes = $avaliacoes_1 + $avaliacoes_2;

		$terapias = DB::table('terapias')
					->count();


		return view('home')->with(["usuarios" => $usuarios, "pacientes" => $pacientes, "avaliacoes" => $avaliacoes, "terapias" => $terapias]);

	}

}
