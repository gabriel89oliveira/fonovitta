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

class ObjetivoEstatisticaController extends Controller
{
    
	public function estatistica()
    {
        
		$id = Auth::user()->id;
		$usuario = DB::table('usuarios')->where('id', $id)->first();
		
		$objetivos = DB::table('historico_objetivos')->get(); //Get role specified by id
		
		$i               = 0;
		$tempo_real      = 0;
		$tempo_planejado = 0;
		$tempo_30        = 0;
		$tempo_90        = 0;
		$tempo_mais      = 0;
		
		foreach($objetivos as $objetivo){
			
			$inicio = date_create($objetivo->data);
			$fim    = date_create($objetivo->conclusao);
			$prazo  = date_create($objetivo->prazo);
			
			$tempo_real_i 		= date_diff($inicio, $fim)->days;
			$tempo_planejado_i 	= date_diff($inicio, $prazo)->days;
			
			$tempo_real 	 += $tempo_real_i;
			$tempo_planejado += $tempo_planejado_i;
			
			if($tempo_real_i <= 30){
				$tempo_30++;
			}elseif($tempo_real_i <= 90){
				$tempo_90++;
			}else{
				$tempo_mais++;
			}
			
			$i++;
			
		}
		
		$num_objetivos   = $i;
		$tempo_real      = 100 * $tempo_real / $num_objetivos;
		$tempo_planejado = 100 * $tempo_planejado / $num_objetivos;
		
		$tempo_30 = 100 * $tempo_30 / $num_objetivos;
		$tempo_90 = 100 * $tempo_90 / $num_objetivos;
		$tempo_mais = 100 * $tempo_mais / $num_objetivos;
		

		$usuarios = DB::table('usuarios')->pluck('nome', 'id');

       	return view('objetivos/estatistica', ['usuario' => $usuario, 'qnt' => $i, 'estimado' => $tempo_planejado, 'real' => $tempo_real, 'tempo_30' => $tempo_30, 'tempo_90' => $tempo_90, 'tempo_mais' => $tempo_mais, 'page' => 'estatisticas_objetivos', 'usuarios' => $usuarios]);
		
    }
	
}
