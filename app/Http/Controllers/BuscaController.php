<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class BuscaController extends Controller
{
    
    /**
     * Pagina para mostrar busca por pacientes.
     *
     */
	public function index(Request $request){

		$pacientes = DB::table('pacientes')
			->where('nome', 'LIKE', '%' . $request->busca . '%')
			->orWhere('antecedente_1', 'LIKE', '%' . $request->busca . '%')
			->orWhere('antecedente_2', 'LIKE', '%' . $request->busca . '%')
			->orWhere('antecedente_3', 'LIKE', '%' . $request->busca . '%')
			->orderBy('nome', 'asc')
			->paginate(15);

		$pacientes->appends(['busca' => $request->busca]);

		return view('busca', compact('pacientes'))->with(["page" => ""]);

	}

}
