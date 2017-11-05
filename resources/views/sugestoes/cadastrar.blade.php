@extends('layouts.master')

	@section('titulo')
		Sugestão
	@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('SugestaoController@store'), 'method' => 'POST' )) !!}
			
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Ticket</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<div class="form-group">
									{{ Form::label('tipo', 'Tipo de sugestão') }}
									{{ Form::select('tipo', [
											'Problema técnico'    			=> 'Problema técnico', 
											'Problema no banco de dados'    => 'Problema no banco de dados', 
											'Sugestão' 						=> 'Sugestão',
											'Outros' 						=> 'Outros',
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('comentario', 'Comentários') }}
									{{ Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '5']) }}
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


@section('scripts')


@endsection


