<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;
use Carbon\Carbon;
use Lava;

class PacienteEstatisticaController extends Controller
{

	public function estatistica(Request $request){

		// Ajustar data inicial
		if(empty($request->inicio)){
			$inicio = new Carbon('first day of this month');
			$inicio->subYear();
		}else{
			$inicio = new Carbon($request->inicio);
		}

		// Ajustar data final
		if(empty($request->fim)){
			$fim = Carbon::now();
		}else{
			$fim = new Carbon($request->fim);
		}

			// Extrai o mes e ano da data
			$fim_mes = date('m', strtotime($fim));
			$fim_ano = date('Y', strtotime($fim));


		/** 
		 * Tabelas
		 *
		 */

			// Inicio da terapia
			$tabela_inicio_terapia = Lava::DataTable();

			$tabela_inicio_terapia->addDateColumn('Mês')
			            ->addNumberColumn('Novos Pacientes');


			// Fim da terapia
			$tabela_fim_terapia = Lava::DataTable();

			$tabela_fim_terapia->addDateColumn('Mês')
			            ->addNumberColumn('Alta')
			            ->addNumberColumn('Suspensão')
			            ->addNumberColumn('Óbito');


			// Atendimentos
			$tabela_atendimentos = Lava::DataTable();

			$tabela_atendimentos->addDateColumn('Mês')
			            ->addNumberColumn('Atendimentos');




		// Início de terapias por mês
		$i = 0;
		$cont = 0;

		while($cont == 0){

			// Extrai o mes e ano da data
			$periodo_mes = date('m', strtotime($inicio));
			$periodo_ano = date('Y', strtotime($inicio));


			/**
			 * Busca inicio de terapia
			 *
			 */
			$avaliacao = DB::table('fonos')
					->whereRaw('extract(month from data_inicio) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_inicio) = ?', [$periodo_ano]);

			// Caso exista um tipo definido
			$avaliacao = ($request->tipo) ? $avaliacao->where('local', $request->tipo) : $avaliacao ;

			// Caso exista um usuario definido
			$avaliacao = ($request->usuario) ? $avaliacao->where('id_responsavel', $request->usuario) : $avaliacao ;
			
			// Contar
			$total = $avaliacao->count();


			$avaliacao_historico = DB::table('historico_fonos')
					->whereRaw('extract(month from data_inicio) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_inicio) = ?', [$periodo_ano]);

			// Caso exista um tipo definido
			$avaliacao_historico = ($request->tipo) ? $avaliacao_historico->where('local', $request->tipo) : $avaliacao_historico ;

			// Caso exista um usuario definido
			$avaliacao_historico = ($request->usuario) ? $avaliacao_historico->where('id_responsavel', $request->usuario) : $avaliacao_historico ;
			
			// Contar
			$total += $avaliacao_historico->count();

				$tabela_inicio_terapia->addRow([
			      $periodo_ano . '-' . $periodo_mes, $total
			    ]);


			/**
			 * Busca fim de terapia --> Alta
			 *
			 */
			$alta = DB::table('historico_fonos')
					->whereRaw('extract(month from data_termino) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_termino) = ?', [$periodo_ano])
					->where('alta', 'alta');

				// Caso exista um tipo definido
				$alta = ($request->tipo) ? $alta->where('local', $request->tipo) : $alta ;

				// Caso exista um usuario definido
				$alta = ($request->usuario) ? $alta->where('id_responsavel', $request->usuario) : $alta ;
				
				// Contar
				$total_alta = $alta->count();

			$suspensao = DB::table('historico_fonos')
					->whereRaw('extract(month from data_termino) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_termino) = ?', [$periodo_ano])
					->where('alta', 'suspensão');

				// Caso exista um tipo definido
				$suspensao = ($request->tipo) ? $suspensao->where('local', $request->tipo) : $suspensao ;

				// Caso exista um usuario definido
				$suspensao = ($request->usuario) ? $suspensao->where('id_responsavel', $request->usuario) : $suspensao ;
				
				// Contar
				$total_suspensao = $suspensao->count();

			$obito = DB::table('historico_fonos')
					->whereRaw('extract(month from data_termino) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_termino) = ?', [$periodo_ano])
					->where('alta', 'obito');

				// Caso exista um tipo definido
				$obito = ($request->tipo) ? $obito->where('local', $request->tipo) : $obito ;

				// Caso exista um usuario definido
				$obito = ($request->usuario) ? $obito->where('id_responsavel', $request->usuario) : $obito ;
				
				// Contar
				$total_obito = $obito->count();

			$tabela_fim_terapia->addRow([
		      $periodo_ano . '-' . $periodo_mes, $total_alta, $total_suspensao, $total_obito
		    ]);


			/**
			 * Busca atendimentos
			 *
			 */
			$qnt_terapia = DB::table('terapias')
					->whereRaw('extract(month from created_at) = ?', [$periodo_mes])
					->whereRaw('extract(year from created_at) = ?', [$periodo_ano]);

				// Caso exista um tipo definido
				// $qnt_terapia = ($request->tipo) ? $qnt_terapia->where('local', $request->tipo) : $qnt_terapia ;

				// Caso exista um usuario definido
				$qnt_terapia = ($request->usuario) ? $qnt_terapia->where('id_usuario', $request->usuario) : $qnt_terapia ;
				
				// Contar
				$total = $qnt_terapia->count();

			$tabela_atendimentos->addRow([
		      $periodo_ano . '-' . $periodo_mes, $total
		    ]);


			// Adiciona um mes na busca
			$inicio->addMonths(1);
			$i++;

			// Verifica a parada da busca
			if(($fim_mes == $periodo_mes && $fim_ano == $periodo_ano) Or $i>24){
				break;
			}

		}


		/**
		 * Definição dos gráficos
		 *
		 */
		$grafico_inicio_terapia = Lava::LineChart('Inicio_Terapia', $tabela_inicio_terapia, [
									    'title' => 'Avaliações / mês',
									    'hAxis' => [
									    	'format' => 'MMM/yy',
									    	'gridlines' => ['count' => '8']
									    	],
									    'legend' => [
									        'position' => 'bottom'
									    	]
									]);

		$grafico_fim_terapia 	= Lava::LineChart('Fim_Terapia', $tabela_fim_terapia, [
									    'title' => 'Altas / mês',
									    'hAxis' => [
									    	'format' => 'MMM/yy',
									    	'gridlines' => ['count' => '8']
									    	],
									    'legend' => [
									        'position' => 'bottom'
									    	]
									]);

		$grafico_atendimentos 	= Lava::LineChart('Atendimentos', $tabela_atendimentos, [
									    'title' => 'Atendimentos realizados',
									    'hAxis' => [
									    	'format' => 'MMM/yy',
									    	'gridlines' => ['count' => '8']
									    	],
									    'legend' => [
									        'position' => 'bottom'
									    	]
									]);


		$usuarios = DB::table('usuarios')->pluck('nome', 'id');

		return view('pacientes.estatistica')->with(["page" => "", "lava" => $grafico_inicio_terapia, "usuarios" => $usuarios]);

	}


}
