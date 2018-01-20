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

		/** 
		 * Parametros de entrada
		 *
		 */

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
		 * Tabelas de dados
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
			            ->addNumberColumn('Alta Fonoaudiológica')
			            ->addNumberColumn('Suspensão')
			            ->addNumberColumn('Óbito');

			// Atendimentos
			$tabela_atendimentos = Lava::DataTable();
			$tabela_atendimentos->addDateColumn('Mês')
			            ->addNumberColumn('Atendimentos');

			// Objetivos
			$tabela_objetivos = Lava::DataTable();
			$tabela_objetivos->addStringColumn('Objetivo')
     					->addNumberColumn('Atraso');

     		// SNE
     		$tabela_SNE = Lava::DataTable();
     		$tabela_SNE->addStringColumn('Tempo de retirada');
     		$tabela_SNE->addNumberColumn('Porcentagem');

     		// Tempo da terapia
     		$tabela_tempo_terapia = Lava::DataTable();
     		$tabela_tempo_terapia->addStringColumn('Tempo de terapia');
     		$tabela_tempo_terapia->addNumberColumn('Porcentagem');

     		// Taxa de reinternação
     		$tabela_taxa_reinternacao = Lava::DataTable();
     		$tabela_taxa_reinternacao->addStringColumn('Taxa de reinternação');
     		$tabela_taxa_reinternacao->addNumberColumn('Quantidade');


     	// Taxa de reinternação

	     	$reinternacao[0] = 0;
	     	$reinternacao[1] = 0;
	     	$reinternacao[2] = 0;
	     	$reinternacao[3] = 0;
	     	$reinternacao[4] = 0;
	     	$reinternacao[5] = 0;

     		
     		$inters = DB::table('historico_fonos')
     					->select(DB::raw('count(*) as total, id_paciente'))
     					->where('data_inicio', '>=', $inicio)
						->where('data_inicio', '<=', $fim);

			// Caso exista um tipo definido
			$inters = ($request->tipo) ? $inters->where('local', $request->tipo) : $inters ;

			// Caso exista um usuario definido
			$inters = ($request->usuario) ? $inters->where('id_usuario', $request->usuario) : $inters ;

			$inters = $inters->groupBy('id_paciente')->get();

			foreach ($inters as $inter) {

				$total = $inter->total;
				$total += DB::table('fonos')->where('id_paciente', $inter->id_paciente)->count();

				switch ($total) {
					case '1':
						break;
					
					case '2':
						$reinternacao[1] += 1;
						break;
					
					case '3':
						$reinternacao[2] += 1;
						break;
					
					case '4':
						$reinternacao[3] += 1;
						break;
					
					case '5':
						$reinternacao[4] += 1;
						break;
					
					default:
						$reinternacao[5] += 1;
						break;
				}

			}

			// Passar valores para tabela de grafico
			$i = 0;
			foreach ($reinternacao as $e) {
				
				if($e>0){
					$i==1 ? $texto = ' reinternação' : $texto = ' reinternações';
					$tabela_taxa_reinternacao->addRow([$i . $texto, $e]);
				}

				$i++;

			}



		// Objetivos Plano/Real

			/**
			 * Busca objetivos planejados
			 *
			 */

			$objetivo = DB::table('historico_objetivos')
					->join('fonos', 'historico_objetivos.id_fonos', '=', 'fonos.id')
					->where('historico_objetivos.id_fonos', '<>', 0)
					->where('historico_objetivos.data', '>=', $inicio)
					->where('historico_objetivos.data', '<=', $fim);
					// ->get();
					// ->whereRaw("DATEDIFF('historico_objetivos.prazo', 'historico_objetivos.data') >= 0");

			$objetivo_h = DB::table('historico_objetivos')
					->join('historico_fonos', 'historico_objetivos.id_fonos', '=', 'historico_fonos.id_fonos')
					->where('historico_objetivos.id_fonos', '<>', 0)
					->where('historico_objetivos.data', '>=', $inicio)
					->where('historico_objetivos.data', '<=', $fim);

			// Caso exista um tipo definido
			$objetivo = ($request->tipo) ? $objetivo->where('fonos.local', $request->tipo) : $objetivo ;
			$objetivo_h = ($request->tipo) ? $objetivo_h->where('historico_fonos.local', $request->tipo) : $objetivo_h ;

			// Caso exista um usuario definido
			$objetivo = ($request->usuario) ? $objetivo->where('historico_objetivos.id_usuario', $request->usuario) : $objetivo ;
			$objetivo_h = ($request->usuario) ? $objetivo_h->where('historico_objetivos.id_usuario', $request->usuario) : $objetivo_h ;
			
			// Contar
			$objetivo = $objetivo->get();
			$objetivo_h = $objetivo_h->get();

			$estat = [];

			// Buscar dados de atendimentos atuais
			foreach ($objetivo as $obj) {
				
				// Ajuste das datas
				$data 		= new Carbon($obj->data);
				$conclusao 	= new Carbon($obj->conclusao);
				$prazo 		= new Carbon($obj->prazo);

				// Diferença do planejado em %
				$delta = ($data->diffInDays($prazo, false) != 0) ? ($prazo->diffInDays($conclusao, false) / $data->diffInDays($prazo, false)) : $prazo->diffInDays($conclusao, false);

				// Guarda valores em array
				$estat[$obj->objetivo]['tipo'] 	= $obj->objetivo;
				$estat[$obj->objetivo]['valor'] = $delta;
				$estat[$obj->objetivo]['qnt'] 	= isset($estat[$obj->objetivo]['qnt']) ? $estat[$obj->objetivo]['qnt'] + 1 : 1 ;

				// echo "Data: " . $data . " / Prazo: " . $prazo . " / Conclusao: " . $data->diffInDays($prazo, false) . " / Delta: " . $prazo->diffInDays($conclusao, false) . "<br>";

			}

			// Buscar dados de atendimentos historicos
			foreach ($objetivo_h as $obj) {
				
				// Ajuste das datas
				$data 		= new Carbon($obj->data);
				$conclusao 	= new Carbon($obj->conclusao);
				$prazo 		= new Carbon($obj->prazo);

				// Diferença do planejado em %
				$delta = ($data->diffInDays($prazo, false) != 0) ? ($prazo->diffInDays($conclusao, false) / $data->diffInDays($prazo, false)) : $prazo->diffInDays($conclusao, false);

				// Guarda valores em array
				$estat[$obj->objetivo]['tipo'] 	= $obj->objetivo;
				$estat[$obj->objetivo]['valor'] = $delta;
				$estat[$obj->objetivo]['qnt'] 	= isset($estat[$obj->objetivo]['qnt']) ? $estat[$obj->objetivo]['qnt'] + 1 : 1 ;
				
			}

			// Passar valores para tabela de grafico
			foreach ($estat as $e) {
				$tabela_objetivos->addRow([$e['tipo'], $e['valor']]);
			}


		// Tempo com SNE

		$dia_1 		= 0;
		$dia_2 		= 0;
		$dia_3 		= 0;
		$semana_1 	= 0;
		$semana_2 	= 0;
		$mes_1 		= 0;
		$mes_varios = 0;
		$qnt 		= 0;
		$SNE['min']	= 999999;
		$SNE['max']	= 0;
		$SNE['avg']	= 0;

		// Buscar todas as passagens
		$passagens 	 = DB::table('sne')
						->join('fonos', 'sne.id_fonos', '=', 'fonos.id')
						->where('sne.tipo', 'passagem')
						->where('sne.data', '>=', $inicio)
						->where('sne.data', '<=', $fim);

		$passagens_h = DB::table('sne')
						->join('historico_fonos', 'sne.id_fonos', '=', 'historico_fonos.id_fonos')
						->where('sne.tipo', 'passagem')
						->where('sne.data', '>=', $inicio)
						->where('sne.data', '<=', $fim);


		// Caso exista um tipo definido
		$passagens = ($request->tipo) ? $passagens->where('fonos.local', $request->tipo) : $passagens ;
		$passagens_h = ($request->tipo) ? $passagens_h->where('historico_fonos.local', $request->tipo) : $passagens_h ;

		// Caso exista um usuario definido
		$passagens = ($request->usuario) ? $passagens->where('fonos.id_responsavel', $request->usuario) : $passagens ;
		$passagens_h = ($request->usuario) ? $passagens_h->where('historico_fonos.id_responsavel', $request->usuario) : $passagens_h ;

		// Realiza a busca
		$passagens 	 = $passagens->orderBy('data', 'asc')->get();
		$passagens_h = $passagens_h->orderBy('data', 'asc')->get();


		foreach ($passagens as $passagem) {
			
			// Busca a retirada de SNE correspondente
			$retirada = DB::table('sne')
							->where('tipo', 'retirada')
							->where('id_fonos', $passagem->id_fonos)
							->where('data', '>=', $passagem->data)
							->orderBy('data', 'asc')
							->first();

			// Verifica se houve a retirada da SNE
			if ($retirada) {

				// Converter datas para Carbon
				$data_passagem = new Carbon($passagem->data);
				$data_retirada = new Carbon($retirada->data);

				// Diferença em dias
				$delta = $data_passagem->diffInDays($data_retirada, false);

				// Contagem
				$qnt++;

				if ($delta == 1) {
					$dia_1++;
				}elseif ($delta == 2) {
					$dia_2++;
				}elseif ($delta == 3) {
					$dia_3++;
				}elseif($delta <= 7){
					$semana_1++;
				}elseif ($delta <= 14) {
					$semana_2++;
				}elseif ($delta <= 30) {
					$mes_1++;
				}else{
					$mes_varios++;
				}

				$SNE['min'] = ($delta < $SNE['min']) ? $SNE['min'] = $delta : $SNE['min'] ;
				$SNE['max'] = ($delta > $SNE['max']) ? $SNE['max'] = $delta : $SNE['max'] ;
				$SNE['avg'] += $delta;

			}

		}

		foreach ($passagens_h as $passagem) {
			
			// Busca a retirada de SNE correspondente
			$retirada = DB::table('sne')
							->where('tipo', 'retirada')
							->where('id_fonos', $passagem->id_fonos)
							->where('data', '>=', $passagem->data)
							->orderBy('data', 'asc')
							->first();

			// Verifica se houve a retirada da SNE
			if ($retirada) {

				// Converter datas para Carbon
				$data_passagem = new Carbon($passagem->data);
				$data_retirada = new Carbon($retirada->data);

				// Diferença em dias
				$delta = $data_passagem->diffInDays($data_retirada, false);

				// Contagem
				$qnt++;

				if ($delta == 1) {
					$dia_1++;
				}elseif ($delta == 2) {
					$dia_2++;
				}elseif ($delta == 3) {
					$dia_3++;
				}elseif($delta <= 7){
					$semana_1++;
				}elseif ($delta <= 14) {
					$semana_2++;
				}elseif ($delta <= 30) {
					$mes_1++;
				}else{
					$mes_varios++;
				}

				$SNE['min'] = ($delta < $SNE['min']) ? $SNE['min'] = $delta : $SNE['min'] ;
				$SNE['max'] = ($delta > $SNE['max']) ? $SNE['max'] = $delta : $SNE['max'] ;
				$SNE['avg'] += $delta;

			}

		}

		if($qnt > 0){

			$tabela_SNE->addRow(['1 dia', 			$dia_1 / $qnt]);
			$tabela_SNE->addRow(['2 dias', 			$dia_2 / $qnt]);
			$tabela_SNE->addRow(['3 dias', 			$dia_3 / $qnt]);
			$tabela_SNE->addRow(['1 semana', 		$semana_1 / $qnt]);
			$tabela_SNE->addRow(['2 semanas', 		$semana_2 / $qnt]);
			$tabela_SNE->addRow(['1 mês', 			$mes_1 / $qnt]);
			$tabela_SNE->addRow(['Mais de 1 mês', 	$mes_varios / $qnt]);

			$SNE['avg'] = round($SNE['avg'] / $qnt, 1);
			$SNE['qnt'] = $qnt;

		}else{
			
			$tabela_SNE->addRow(['1 dia', 			0]);
			$tabela_SNE->addRow(['2 dias', 			0]);
			$tabela_SNE->addRow(['3 dias', 			0]);
			$tabela_SNE->addRow(['1 semana', 		0]);
			$tabela_SNE->addRow(['2 semanas', 		0]);
			$tabela_SNE->addRow(['1 mês', 			0]);
			$tabela_SNE->addRow(['Mais de 1 mês', 	0]);

			$SNE['min'] = "N/A";
			$SNE['max'] = "N/A";
			$SNE['avg'] = "N/A";
			$SNE['qnt'] = $qnt;
			
		}



		// Tempo de terapia

		$dia_1 		= 0;
		$dia_2 		= 0;
		$dia_3 		= 0;
		$semana_1 	= 0;
		$semana_2 	= 0;
		$mes_1 		= 0;
		$mes_varios = 0;
		$qnt 		= 0;
		$tempo_terapia['min']	= 999999;
		$tempo_terapia['max']	= 0;
		$tempo_terapia['avg']	= 0;

		// Buscar todas as terapias historicas
		$fonos = DB::table('historico_fonos')
					->where('data_inicio', '>=', $inicio)
					->where('data_inicio', '<=', $fim);
		
		// Caso exista um tipo definido
		$fonos = ($request->tipo) ? $fonos->where('local', $request->tipo) : $fonos ;

		// Caso exista um usuario definido
		$fonos = ($request->usuario) ? $fonos->where('id_responsavel', $request->usuario) : $fonos ;

		// Realiza a busca
		$fonos = $fonos->get();

		foreach ($fonos as $fono) {

			// Converter datas para Carbon
			$data_inicio 	= new Carbon($fono->data_inicio);
			$data_termino 	= new Carbon($fono->data_termino);

			// Diferença em dias
			$delta = $data_inicio->diffInDays($data_termino, false);

			// Contagem
			$qnt++;

			if ($delta == 1) {
				$dia_1++;
			}elseif ($delta == 2) {
				$dia_2++;
			}elseif ($delta == 3) {
				$dia_3++;
			}elseif($delta <= 7){
				$semana_1++;
			}elseif ($delta <= 14) {
				$semana_2++;
			}elseif ($delta <= 30) {
				$mes_1++;
			}else{
				$mes_varios++;
			}

			$tempo_terapia['min'] = ($delta < $tempo_terapia['min']) ? $tempo_terapia['min'] = $delta : $tempo_terapia['min'] ;
			$tempo_terapia['max'] = ($delta > $tempo_terapia['max']) ? $tempo_terapia['max'] = $delta : $tempo_terapia['max'] ;
			$tempo_terapia['avg'] += $delta;

		}

		if($qnt > 0){

			$tabela_tempo_terapia->addRow(['1 dia', 			$dia_1 / $qnt]);
			$tabela_tempo_terapia->addRow(['2 dias', 			$dia_2 / $qnt]);
			$tabela_tempo_terapia->addRow(['3 dias', 			$dia_3 / $qnt]);
			$tabela_tempo_terapia->addRow(['1 semana', 			$semana_1 / $qnt]);
			$tabela_tempo_terapia->addRow(['2 semanas', 		$semana_2 / $qnt]);
			$tabela_tempo_terapia->addRow(['1 mês', 			$mes_1 / $qnt]);
			$tabela_tempo_terapia->addRow(['Mais de 1 mês', 	$mes_varios / $qnt]);

			$tempo_terapia['avg'] = round($tempo_terapia['avg'] / $qnt, 1);
			$tempo_terapia['qnt'] = $qnt;

		}else{
			
			$tabela_tempo_terapia->addRow(['1 dia', 			0]);
			$tabela_tempo_terapia->addRow(['2 dias', 			0]);
			$tabela_tempo_terapia->addRow(['3 dias', 			0]);
			$tabela_tempo_terapia->addRow(['1 semana', 			0]);
			$tabela_tempo_terapia->addRow(['2 semanas', 		0]);
			$tabela_tempo_terapia->addRow(['1 mês', 			0]);
			$tabela_tempo_terapia->addRow(['Mais de 1 mês', 	0]);

			$tempo_terapia['min'] = "N/A";
			$tempo_terapia['max'] = "N/A";
			$tempo_terapia['avg'] = "N/A";
			$tempo_terapia['qnt'] = $qnt;
			
		}



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

			$alta_fono = DB::table('historico_fonos')
					->whereRaw('extract(month from data_termino) = ?', [$periodo_mes])
					->whereRaw('extract(year from data_termino) = ?', [$periodo_ano])
					->where('alta', 'Alta Fonoaudiol');

				// Caso exista um tipo definido
				$alta_fono = ($request->tipo) ? $alta_fono->where('local', $request->tipo) : $alta_fono ;

				// Caso exista um usuario definido
				$alta_fono = ($request->usuario) ? $alta_fono->where('id_responsavel', $request->usuario) : $alta_fono ;
				
				// Contar
				$total_alta_fono = $alta_fono->count();

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
		      $periodo_ano . '-' . $periodo_mes, $total_alta, $total_alta_fono, $total_suspensao, $total_obito
		    ]);


			/**
			 * Busca atendimentos
			 *
			 */
			$qnt_terapia_1 = DB::table('terapias')
					->join('fonos', 'terapias.id_fonos', '=', 'fonos.id')
					->whereRaw('extract(month from terapias.created_at) = ?', [$periodo_mes])
					->whereRaw('extract(year from terapias.created_at) = ?', [$periodo_ano]);

			$qnt_terapia_2 = DB::table('terapias')
					->join('historico_fonos', 'terapias.id_fonos', '=', 'historico_fonos.id_fonos')
					->where('terapias.id_fonos', '!=', '0')
					->whereRaw('extract(month from terapias.created_at) = ?', [$periodo_mes])
					->whereRaw('extract(year from terapias.created_at) = ?', [$periodo_ano]);

				// Caso exista um tipo definido
				$qnt_terapia_1 = ($request->tipo) ? $qnt_terapia_1->where('fonos.local', $request->tipo) : $qnt_terapia_1 ;
				$qnt_terapia_2 = ($request->tipo) ? $qnt_terapia_2->where('historico_fonos.local', $request->tipo) : $qnt_terapia_2 ;

				// Caso exista um usuario definido
				$qnt_terapia_1 = ($request->usuario) ? $qnt_terapia_1->where('terapias.id_usuario', $request->usuario) : $qnt_terapia_1 ;
				$qnt_terapia_2 = ($request->usuario) ? $qnt_terapia_2->where('terapias.id_usuario', $request->usuario) : $qnt_terapia_2 ;
				
				// Contar
				$total_1 = $qnt_terapia_1->count();
				$total_2 = $qnt_terapia_2->count();
				$total = $total_1 + $total_2;

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

		$grafico_objetivos		= Lava::BarChart('Objetivos', $tabela_objetivos, [
									    'title' => 'Objetivos (Plano/Real)',
									    // 'chartArea' => ['top' => '10%', 'height' => '60%'], 
									    // 'height' => '400',
									    'vAxis' => [
									    	'slantedText' => 'true', 
									    	// 'slantedTextAngle' => '90'
									    ],
									    'hAxis' => [
									    	'format' => '%'
									    	// 'gridlines' => ['count' => '8']
									    	],
									    'legend' => [
									        'position' => 'bottom'
									    	]
									]);

		$grafico_SNE			= Lava::ColumnChart('Tempo com SNE', $tabela_SNE, [
									    'title' => 'Tempo com SNE',
									    'vAxis' => [
									    	'format' => '%'
									    	// 'gridlines' => ['count' => '8']
									    	],
									    'hAxis' => [
									    	'slantedText' => 'true', 
									    	// 'slantedTextAngle' => '90'
									    ],
									    'legend' => [
									        'position' => 'none'
									    	]
									]);

		$grafico_tempo_terapia	= Lava::ColumnChart('Tempo de terapia', $tabela_tempo_terapia, [
									    'title' => 'Tempo de terapia',
									    'vAxis' => [
									    	'format' => '%'
									    	// 'gridlines' => ['count' => '8']
									    	],
									    'hAxis' => [
									    	'slantedText' => 'true', 
									    	// 'slantedTextAngle' => '90'
									    ],
									    'legend' => [
									        'position' => 'none'
									    	]
									]);

		$grafico_taxa_reinternacao	= Lava::ColumnChart('Taxa de reinternação', $tabela_taxa_reinternacao, [
									    'title' => 'Taxa de reinternação',
									    'vAxis' => [
									    	// 'format' => '%'
									    	// 'gridlines' => ['count' => '8']
									    	],
									    'hAxis' => [
									    	'slantedText' => 'true', 
									    	// 'slantedTextAngle' => '90'
									    ],
									    'legend' => [
									        'position' => 'none'
									    	]
									]);


		$usuarios = DB::table('usuarios')->pluck('nome', 'id');

		return view('pacientes.estatistica')->with(["page" => "", "lava" => $grafico_inicio_terapia, "usuarios" => $usuarios, "SNE" => $SNE, "tempo_terapia" => $tempo_terapia]);

	}


}
