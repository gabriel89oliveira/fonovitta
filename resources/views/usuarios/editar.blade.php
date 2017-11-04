@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('UsuarioController@update', $usuario->id), 'method' => 'PUT' )) !!}
			
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
									{{ Form::label('name', 'Nome completo') }}
									{{ Form::text('name', $usuario->nome, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('nascimento', 'Data de nascimento') }}
									{{ Form::date('nascimento', $usuario->nascimento, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('sexo', 'Sexo') }}
									{{ Form::select('sexo', ['Masculino' => 'Masculino', 'Feminino' => 'Feminino'], $usuario->sexo, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								@can('Usuario_Cargo_Editar')
									<div class="form-group">
										{{ Form::label('equipe', 'Equipe') }}
										{{ Form::text('equipe', $usuario->equipe, ['class' => 'form-control']) }}
									</div>
									
									<div class="form-group">
										{{ Form::label('cargo', 'Cargo') }}
										{{ Form::text('cargo', $usuario->cargo, ['class' => 'form-control']) }}
									</div>
								@else
										{{ Form::hidden('equipe', $usuario->equipe, ['class' => 'form-control']) }}
										{{ Form::hidden('cargo', $usuario->cargo, ['class' => 'form-control']) }}
								@endcan
								
								<div class="form-group">
									{{ Form::label('email', 'Email') }}
									{{ Form::text('email', $usuario->email, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('teleonfe', 'Telefone de contato') }}
									{{ Form::text('telefone', $usuario->telefone, ['class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::submit('Atualizar', ['class' => 'btn btn-primary btn-anim']) }}
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
		{!! Form::close() !!}
		
		
		@if( Auth::user()->can('Usuario_Senha_Editar') OR Auth::user()->id == $usuario->id  )
			
			{!! Form::open(array('action' => array('UsuarioController@password', $usuario->id), 'method' => 'PUT' )) !!}
				
				<div class="col-sm-6">
					<div class="panel panel-primary card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-light">Alterar senha</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">
									
									<div class="form-group">
										{{ Form::label('password', 'Nova Senha') }}
										{{ Form::password('password', ['class' => 'form-control']) }}
									</div>
									
									<div class="form-group">
										{{ Form::label('password', 'Confirmar Senha') }}
										{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
									</div>
									
									<div class="form-group">
										{{ Form::submit('Atualizar', ['class' => 'btn btn-primary btn-anim']) }}
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
			{!! Form::close() !!}
		
		@endif
		
	</div>
	
@endsection













