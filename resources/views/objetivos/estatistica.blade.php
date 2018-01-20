@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
		
		<div class="col-sm-12">
			<div class="panel card-view">
				<div class="panel-heading">
					
					<div class="pull-left">
						
						{!! Form::open(['action'=>'ObjetivoEstatisticaController@estatistica', 'method' => 'get', 'class' => 'form-inline']) !!}

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

		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Todos objetivos</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						
						<div class="col-lg-6 col-sm-12">
							<div class="panel">
								
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Conclusão dos objetivos</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="panel-wrapper collapse in">
									<div class="panel-body pb-0">
										<div class="row">
											
											<div class="col-sm-4 mb-15 text-center">
												<span id="pie_chart_1" class="easypiechart" data-percent="{{ $tempo_30 }}">
													<span class="percent head-font">{{ $tempo_30 }}</span>
												<canvas height="100" width="100"></canvas></span>
												<p>Objetivos concluídos em até 30 dias</p>
											</div>
											
											<div class="col-sm-4 mb-15 text-center">
												<span id="pie_chart_2" class="easypiechart" data-percent="{{ $tempo_90 }}">
													<span class="percent head-font">{{ $tempo_90 }}</span>
												<canvas height="100" width="100"></canvas></span>
												<p>Objetivos concluídos em até 90 dias</p>
											</div>
											
											<div class="col-sm-4 mb-15 text-center">
												<span id="pie_chart_3" class="easypiechart" data-percent="{{ $tempo_mais }}">
													<span class="percent head-font">{{ $tempo_mais }}</span>
												<canvas height="100" width="100"></canvas></span>
												<p>Objetivos concluídos com mais de 90 dias</p>
											</div>
										</div>	
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>	
		</div>
		
	</div>
	
	
	
@endsection













