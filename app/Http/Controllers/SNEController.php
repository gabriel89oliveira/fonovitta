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

class SNEController extends Controller
{
    
    public function create(Request $request){

    	/**
    	 * Novo registro de passagem de SNE
    	 *
    	 */

    	$passagem = DB::table('sne')->insertGetId([
    		'id_fonos' 		=> $request->id_fonos,
    		'id_paciente' 	=> $request->id_paciente,
    		'data' 			=> $request->data,
    		'tipo'			=> $request->tipo
    	]);

    	return redirect()->action('PacienteController@show', $request->id_paciente);

    }

}
