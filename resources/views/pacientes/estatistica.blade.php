@extends('layouts.master')

	@section('titulo')
		Estatistica
	@endsection


@section('content')
	
	<!-- Row -->
	<div class="row">
	
		<div class="col-sm-12">
			<div class="panel card-view">
				<div class="panel-heading">
					
					<div class="pull-left">
						
						{!! Form::open(['action'=>'PacienteEstatisticaController@estatistica', 'method' => 'get', 'class' => 'form-inline']) !!}

							<div class="form-group mr-15">
								{{ Form::label('inicio', 'De') }}
								{{ Form::date('inicio', '', ['class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::label('fim', 'Até') }}
								{{ Form::date('fim', '', ['class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::label('tipo', 'Departamento') }}
								{{ Form::select('tipo', ['Domiciliar' => 'Domiciliar', 'Internação' => 'Internação'], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::label('usuario', 'Usuário') }}
								{{ Form::select('usuario', $usuarios, null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::submit('Filtrar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
							</div>

						{!! Form::close() !!}

					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	
		
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Dados Pessoais</h6>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">

									<div id="grafico-inicio_terapia"></div>
									<div id="grafico-fim_terapia"></div>
									<div id="grafico-atendimentos"></div>
									<div id="grafico-reinternacao"></div>

								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>

		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Objetivos</h6>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">

									<div id="grafico-objetivos"></div>
									<p>
										Porcentagem do tempo extrapolado comparado com o tempo planejado. <br> Fórmula: (Tempo Real - Tempo Planejado) / Tempo Planejado
									</p>

								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">SNE</h6>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">

									<p>
										Tempo entre passagem e retirada de SNE. O período considerado é de quando foi feita a passagem da sonda, ou seja, a data da retirada não está necessariamente dentro do período de pesquisa. <br>
										(Mín: {{ $SNE['min'] }} dias, Máx: {{ $SNE['max'] }} dias, Média: {{ $SNE['avg'] }} dias, População: {{ $SNE['qnt'] }})
									</p>
									<div id="grafico-SNE"></div>

								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Tempo de terapia</h6>
							</div>
							<div class="clearfix"></div>
						</div>

						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">

									<p>
										Tempo de acompanhamento fonoaudiológico por paciente. O período considerado é de quando foi feita a avaliação, ou seja, a data de alta/obito não está necessariamente dentro do período de pesquisa. <br>
										(Mín: {{ $tempo_terapia['min'] }} dias, Máx: {{ $tempo_terapia['max'] }} dias, Média: {{ $tempo_terapia['avg'] }} dias, População: {{ $tempo_terapia['qnt'] }})
									</p>
									<div id="grafico-tempo_terapia"></div>

								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
		
		
	</div>
	
	<!-- MODAL PARA MENU -->
	

	
@endsection


@section('scripts')

   
    @linechart('Inicio_Terapia', 'grafico-inicio_terapia')
	@linechart('Fim_Terapia', 'grafico-fim_terapia')
	@linechart('Atendimentos', 'grafico-atendimentos')
	@barchart('Objetivos', 'grafico-objetivos')
	@columnchart('Tempo com SNE', 'grafico-SNE')
	@columnchart('Tempo de terapia', 'grafico-tempo_terapia')
	@columnchart('Taxa de reinternação', 'grafico-reinternacao')

@endsection















