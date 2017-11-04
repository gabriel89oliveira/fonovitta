﻿@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action'=>'ObjetivoController@store')) !!}
			
			<div class="col-sm-6">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Cadastrar Objetivo</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<div class="form-group">
									{{ Form::label('id_paciente', 'Paciente') }}
									{{ Form::select('id_paciente', $paciente, null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('objetivo', 'Objetivo') }}
									{{ Form::select('objetivo', [
											'Retirada de VAA' 						=> 'Retirada de VAA', 
											'Progressão de dieta' 					=> 'Progressão de dieta',
											'Manter dieta liberada' 				=> 'Manter dieta liberada',
											'Sistematizar a deglutição de saliva' 	=> 'Sistematizar a deglutição de saliva',
											'Iniciar treino via oral' 				=> 'Iniciar treino via oral',
											'Liberar treino via oral' 				=> 'Liberar treino via oral',
											'Liberar dieta' 						=> 'Liberar dieta',
											'Alta fonoaudiologica' 					=> 'Alta fonoaudiologica'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('prazo', 'Prazo') }}
									{{ Form::date('prazo', '', ['class' => 'form-control']) }}
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














