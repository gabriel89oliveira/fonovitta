@extends('layouts.app')

@section('content')

	<div class="mb-30">
		<h3 class="text-center txt-dark mb-10">Cadastrar no Portal Fonovitta</h3>
		<h6 class="text-center nonecase-font txt-grey">Insira seus dados abaixo</h6>
	</div>
	
	<div class="form-wrap">
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="control-label mb-10">Nome</label>
				<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
				
					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="control-label mb-10">Email</label>
				<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
				
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password" class="control-label mb-10">Senha</label>
				<input id="password" type="password" class="form-control" name="password">
				
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				
			</div>

			<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<label for="password-confirm" class="control-label mb-10">Confirmar Senha</label>
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation">
				
					@if ($errors->has('password_confirmation'))
						<span class="help-block">
							<strong>{{ $errors->first('password_confirmation') }}</strong>
						</span>
					@endif
				
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary btn-rounded">Cadastrar</button>
				</div>
			</div>
		</form>
	</div>





@endsection
