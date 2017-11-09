<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;


use App\User;
use App\Usuario;
use App\Paciente;
use Auth;
use DB;
use Carbon\Carbon;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class AltaController extends Controller
{
    

    /**
     * Alta fonoaudiológica.
     *
     */
	public function alta($id)
	{
		
		// Busca dados de atendimento de fono
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		// Salva dados no historico de atendimentos de fono
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'id_fonos'		   => $Paciente->id,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Alta Fonoaudiológica',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	           => $Paciente->local,
			'diagnostico_1'	   => $Paciente->diagnostico_1,
			'diagnostico_2'	   => $Paciente->diagnostico_2,
			'diagnostico_3'	   => $Paciente->diagnostico_3,
			'updated_by'       => Auth::user()->id
		]);
		
		// Remove atendimento de fono para paciente
		DB::table('pacientes')
			->where('id', '=', $id)
			->update(['fon' => 0]);
		
		// Exclui paciente dos atendimentos de fono
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();

		// Retorna resposta para AJAX
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}

	
	/**
     * Suspensão do atendimento.
     *
     */
	public function suspensao($id)
	{
		
		// Busca dados de atendimento de fono
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		// Salva dados no historico de atendimentos de fono
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'id_fonos'		   => $Paciente->id,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Suspensão do atendimento',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	          => $Paciente->local,
			'diagnostico_1'	   => $Paciente->diagnostico_1,
			'diagnostico_2'	   => $Paciente->diagnostico_2,
			'diagnostico_3'	   => $Paciente->diagnostico_3,
			'updated_by'       => Auth::user()->id
		]);
		
		// Remove atendimento de fono para paciente
		DB::table('pacientes')
			->where('id', '=', $id)
			->update(['fon' => 0]);
		
		// Exclui paciente dos atendimentos de fono
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();
		
		// Retorna resposta para AJAX
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}
	

	/**
     * Óbito de um paciente.
     *
     */
	public function obito($id)
	{
		
		// Busca dados de atendimento de fono
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		// Salva dados no historico de atendimentos de fono
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'id_fonos'		   => $Paciente->id,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Óbito',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	           => $Paciente->local,
			'diagnostico_1'	   => $Paciente->diagnostico_1,
			'diagnostico_2'	   => $Paciente->diagnostico_2,
			'diagnostico_3'	   => $Paciente->diagnostico_3,
			'updated_by'       => Auth::user()->id
		]);
		
		// Remove atendimento de fono para paciente
		DB::table('pacientes')
			->where('id', '=', $id)
			->update([
				'fon' => 0,
				'status' => 'inativo'
			]);
		
		// Exclui paciente dos atendimentos de fono
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();
		
		// Retorna resposta para AJAX
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}
	
	
}
