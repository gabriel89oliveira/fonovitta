@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('PacienteController@update', $paciente->id), 'method' => 'PUT' )) !!}
			
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
									{{ Form::text('nome', $paciente->nome, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('nascimento', 'Data de nascimento') }}
									{{ Form::date('nascimento', $paciente->nascimento, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('sexo', 'Sexo') }}
									{{ Form::select('sexo', ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'], $paciente->sexo, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('responsavel', 'Nome do responsável') }}
									{{ Form::text('responsavel', $paciente->responsavel, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('relacao', 'Grau de relação') }}
									{{ Form::text('relacao', $paciente->relacao, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('cuidador', 'Nome do cuidador') }}
									{{ Form::text('cuidador', $paciente->cuidador, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('diagnostico_1', 'Diagnóstico 1') }}
									{{ Form::select('diagnostico_1', [
											'Demência'					=> 'Demência',
											'Parkinson' 				=> 'Parkinson', 
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Idade avançada'   			=> 'Idade avançada',
											'Depressão'					=> 'Depressão',
											'Câncer'					=> 'Câncer',
											'ITU'						=> 'ITU',
											'Delirium'					=> 'Delirium',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Outros'					=> 'Outros'
										], $paciente->diagnostico_1, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('diagnostico_2', 'Diagnóstico 2') }}
									{{ Form::select('diagnostico_2', [
											'Demência'					=> 'Demência',
											'Parkinson' 				=> 'Parkinson', 
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Idade avançada'   			=> 'Idade avançada',
											'Depressão'					=> 'Depressão',
											'Câncer'					=> 'Câncer',
											'ITU'						=> 'ITU',
											'Delirium'					=> 'Delirium',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Outros'					=> 'Outros'
										], $paciente->diagnostico_2, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('diagnostico_3', 'Diagnóstico 3') }}
									{{ Form::select('diagnostico_3', [
											'Demência'					=> 'Demência',
											'Parkinson' 				=> 'Parkinson', 
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Idade avançada'   			=> 'Idade avançada',
											'Depressão'					=> 'Depressão',
											'Câncer'					=> 'Câncer',
											'ITU'						=> 'ITU',
											'Delirium'					=> 'Delirium',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Outros'					=> 'Outros'
										], $paciente->diagnostico_3, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
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
									{{ Form::text('nome_contato_1', $paciente->nome_1, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('contato_1', 'Telefone de contato') }}
									{{ Form::text('contato_1', $paciente->telefone_1, ['class' => 'form-control']) }}
								</div>
								<br>
								
								<h6 class="text-center">Contato 2</h6>
								
								<div class="form-group">
									{{ Form::label('nome_contato_2', 'Nome do contato') }}
									{{ Form::text('nome_contato_2', $paciente->nome_2, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('contato_2', 'Telefone de contato') }}
									{{ Form::text('contato_2', $paciente->telefone_2, ['class' => 'form-control']) }}
								</div>
								<br>
								
								<h6 class="text-center">Endereço</h6>
								
								<div class="form-group">
									{{ Form::label('endereco', 'Endereço') }}
									{{ Form::text('endereco', $paciente->endereco, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('bairro', 'Bairro') }}
									{{ Form::text('bairro', $paciente->bairro, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('cidade', 'Cidade') }}
									{{ Form::text('cidade', $paciente->cidade, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::submit('Atualizar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
@endsection


@section('graficos')

	

@endsection















