@extends('layouts.app2')

@section('content')

	<div class="mb-30">
		<h3 class="text-center txt-dark mb-10">Acessar o Portal Fonovitta</h3>
		<h6 class="text-center nonecase-font txt-grey">Insira seus dados abaixo</h6>
	</div>
	
	<div class="form-wrap">
	
		<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
			
			{{ csrf_field() }}
			
			
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
				<a class="txt-primary block mb-10 pull-right font-12" href="{{ url('/password/reset') }}">Esqueceu a senha?</a>
				<input id="password" type="password" class="form-control" name="password">
					
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				
			</div>
			
			<div class="form-group">
				<div class="checkbox checkbox-primary pr-10 pull-left">
					<input type="checkbox" name="remember">
					<label for="checkbox"> Manter logado</label>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary btn-rounded">Entrar</button>
				</div>
			</div>
			
		</form>
	</div>

@endsection
