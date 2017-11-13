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

@endsection















