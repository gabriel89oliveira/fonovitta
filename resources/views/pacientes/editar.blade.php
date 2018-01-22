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
									{{ Form::label('antecedente_1', 'Antecedente 1') }}
									{{ Form::select('antecedente_1', [
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Câncer'					=> 'Câncer',
											'Cirrose'					=> 'Cirrose',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Delirium'					=> 'Delirium',
											'Demência'					=> 'Demência',
											'Depressão'					=> 'Depressão',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença meningocócica (DM)' => 'Doença meningocócica (DM)',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Hapatopatia'				=> 'Hapatopatia', 
											'Hipertensão Arterial Sistêmica (HAS)' => 'Hipertensão Arterial Sistêmica (HAS)',
											'Idade avançada'   			=> 'Idade avançada',
											'Insuficiência renal'		=> 'Insuficiência renal',
											'ITU'						=> 'ITU',
											'Parkinson' 				=> 'Parkinson', 
											'Outros'					=> 'Outros'
										], $paciente->antecedente_1, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('antecedente_2', 'Antecedente 2') }}
									{{ Form::select('antecedente_2', [
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Câncer'					=> 'Câncer',
											'Cirrose'					=> 'Cirrose',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Delirium'					=> 'Delirium',
											'Demência'					=> 'Demência',
											'Depressão'					=> 'Depressão',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença meningocócica (DM)' => 'Doença meningocócica (DM)',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Hapatopatia'				=> 'Hapatopatia', 
											'Hipertensão Arterial Sistêmica (HAS)' => 'Hipertensão Arterial Sistêmica (HAS)',
											'Idade avançada'   			=> 'Idade avançada',
											'Insuficiência renal'		=> 'Insuficiência renal',
											'ITU'						=> 'ITU',
											'Parkinson' 				=> 'Parkinson', 
											'Outros'					=> 'Outros'
										], $paciente->antecedente_2, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('antecedente_3', 'Antecedente 3') }}
									{{ Form::select('antecedente_3', [
											'AVCi'						=> 'AVCi',
											'AVCh'						=> 'AVCh',
											'Câncer'					=> 'Câncer',
											'Cirrose'					=> 'Cirrose',
											'Cirurgia de grande porte'	=> 'Cirurgia de grande porte',
											'Delirium'					=> 'Delirium',
											'Demência'					=> 'Demência',
											'Depressão'					=> 'Depressão',
											'Doença cardiológica'		=> 'Doença cardiológica',
											'Doença meningocócica (DM)' => 'Doença meningocócica (DM)',
											'Doença pulmonar'			=> 'Doença pulmonar',
											'Hapatopatia'				=> 'Hapatopatia', 
											'Hipertensão Arterial Sistêmica (HAS)' => 'Hipertensão Arterial Sistêmica (HAS)',
											'Idade avançada'   			=> 'Idade avançada',
											'Insuficiência renal'		=> 'Insuficiência renal',
											'ITU'						=> 'ITU',
											'Parkinson' 				=> 'Parkinson', 
											'Outros'					=> 'Outros'
										], $paciente->antecedente_3, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
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















