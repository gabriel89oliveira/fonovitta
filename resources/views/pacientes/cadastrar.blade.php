@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action'=>'PacienteController@store')) !!}
			
			<div class="col-sm-6">
				<div class="panel panel-primary card-view">
					
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Dados Pessoais</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<div class="form-group">
									{{ Form::label('nome', 'Nome do paciente') }}
									{{ Form::text('nome', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('nascimento', 'Data de nascimento') }}
									{{ Form::date('nascimento', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('sexo', 'Sexo') }}
									{{ Form::select('sexo', ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('responsavel', 'Nome do responsável') }}
									{{ Form::text('responsavel', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('relacao', 'Grau de relação') }}
									{{ Form::text('relacao', '', ['placeholder' => 'Ex.: Filho, Neto, Esposa, etc.', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('cuidador', 'Nome do cuidador') }}
									{{ Form::text('cuidador', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('diagnostico_1', 'Diagnóstico 1') }}
									{{ Form::text('diagnostico_1', '', ['placeholder' => 'Ex.: Parkinson', 'class' => 'form-control']) }}
								</div>
								<div class="form-group">
									{{ Form::label('diagnostico_2', 'Diagnóstico 2') }}
									{{ Form::text('diagnostico_2', '', ['class' => 'form-control']) }}
								</div>
								<div class="form-group">
									{{ Form::label('diagnostico_3', 'Diagnóstico 3') }}
									{{ Form::text('diagnostico_3', '', ['class' => 'form-control']) }}
								</div>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="panel panel-primary card-view">
					
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Dados para contato</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<h6 class="text-center">Contato 1</h6>
								<div class="form-group">
									{{ Form::label('nome_contato_1', 'Nome do contato') }}
									{{ Form::text('nome_contato_1', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('contato_1', 'Telefone de contato') }}
									{{ Form::text('contato_1', '', ['placeholder' => 'Ex.: (19) 9 8765-4321', 'class' => 'form-control']) }}
								</div>
								<br>
								
								<h6 class="text-center">Contato 2</h6>
								
								<div class="form-group">
									{{ Form::label('nome_contato_2', 'Nome do contato') }}
									{{ Form::text('nome_contato_2', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('contato_2', 'Telefone de contato') }}
									{{ Form::text('contato_2', '', ['placeholder' => 'Ex.: (19) 9 8765-4321', 'class' => 'form-control']) }}
								</div>
								<br>
								
								<h6 class="text-center">Endereço</h6>
								
								<div class="form-group">
									{{ Form::label('endereco', 'Endereço') }}
									{{ Form::text('endereco', '', ['placeholder' => 'Ex.: Rua José Paulino, 123', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('bairro', 'Bairro') }}
									{{ Form::text('bairro', '', ['placeholder' => 'Ex.: Centro', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('cidade', 'Cidade') }}
									{{ Form::text('cidade', '', ['placeholder' => 'Ex.: Campinas', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::submit('Cadastrar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
								</div>
								
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
@endsection







