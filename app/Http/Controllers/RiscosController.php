<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Paciente;
use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class RiscosController extends Controller
{
    
	/**
     * Atualizar riscos do paciente.
     *
     */
    public function update(Request $request, $id)
    {
        //
		DB::table('fonos')
            ->where('id', $id)
            ->update([
				'paliativo' => $request->paliativo
			]);
			
			// Histórico
			DB::table('historicos')->insert([
				'tabela'         => 'fonos',
				'id_linha'       => $id,
				'acao'           => 'atualizar',
				'comentario'	 => 'Alteração dos riscos de paciente',
				'id_usuario'     => Auth::user()->id
			]);
			
		return redirect()->action('PacienteController@show', $request->id_paciente);
		
    }

}
