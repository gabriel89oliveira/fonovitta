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
    //
	public function alta($id)
	{
		
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Alta Fonoaudiológica',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	          => $Paciente->local,
			'updated_by'       => Auth::user()->id
		]);
		
		DB::table('pacientes')
			->where('id', '=', $id)
			->update(['fon' => 0]);
		
		
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();
		
		// return Response::json([
			// 'success' => 'Record has been deleted successfully!'
		// ]);
		
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}
	
	
	public function suspensao($id)
	{
		
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Suspensão do atendimento',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	          => $Paciente->local,
			'updated_by'       => Auth::user()->id
		]);
		
		DB::table('pacientes')
			->where('id', '=', $id)
			->update(['fon' => 0]);
		
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();
		
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}
	
	public function obito($id)
	{
		
		$Paciente = DB::table('fonos')
			->where('id_paciente', '=', $id)
			->first();
		
		$Historico = DB::table('historico_fonos')->insertGetId([
			'id_paciente'      => $Paciente->id_paciente,
			'id_responsavel'   => $Paciente->id_responsavel,
			'data_inicio'      => $Paciente->data_inicio,
			'data_termino'     => Carbon::now(),
			'alta'             => 'Óbito',
			'frequencia'       => $Paciente->frequencia,
			'dieta_inicial'    => $Paciente->dieta_inicial,
			'liquido_inicial'  => $Paciente->liquido_inicial,
			'motivo_avaliacao' => $Paciente->motivo_avaliacao,
			'comentario'       => $Paciente->comentario,
			'local'	          => $Paciente->local,
			'updated_by'       => Auth::user()->id
		]);
		
		DB::table('pacientes')
			->where('id', '=', $id)
			->update([
				'fon' => 0,
				'status' => 'inativo'
			]);
		
		DB::table('fonos')
			->where('id_paciente', '=', $id)
			->delete();
		
		return response()->json([
			'success' => 'Record has been deleted successfully!'
		]);
		
	}
	
}
