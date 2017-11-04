@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action'=>'UsuarioController@store')) !!}
			
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
									{{ Form::label('name', 'Nome do usuário') }}
									{{ Form::text('name', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('email', 'E-mail') }}
									{{ Form::text('email', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('password', 'Senha') }}
									{{ Form::password('password', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('password-confirm', 'Confirmar senha') }}
									{{ Form::password('password-confirm', ['class' => 'form-control']) }}
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
									{{ Form::label('equipe', 'Equipe') }}
									{{ Form::text('equipe', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('cargo', 'Cargo') }}
									{{ Form::text('cargo', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('telefone', 'Telefone de contato') }}
									{{ Form::text('telefone', '', ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::submit('Cadastrar', ['class' => 'btn btn-primary btn-anim']) }}
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















