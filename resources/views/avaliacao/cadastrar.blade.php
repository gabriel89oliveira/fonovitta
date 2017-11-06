﻿@extends('layouts.master')

	@section('titulo')
		<a href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> {{ $paciente->nome }} </a>
	@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('AvaliacaoController@store', $paciente->id), 'method' => 'POST' )) !!}
			
			<div class="col-sm-6">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Avaliação</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<div class="form-group">
									
									<div class="row">
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('prescricao', '1') }}
												{{ Form::label('prescricao', 'Houve prescrição médica') }}
											</div>
										</div>
									</div>
									
								</div>

								<div class="form-group">
									{{ Form::label('dieta_inicial', 'Consistência da dieta atual') }}
									{{ Form::select('dieta_inicial', [
											'Líquida'				=> 'Líquida',
											'Pastosa heterogênea'   => 'Pastosa heterogênea', 
											'Pastosa homogênea'     => 'Pastosa homogênea (papa ou leve batida)', 
											'Pastosa (semissólida)' => 'Pastosa (semissólida)', 
											'Branda'                => 'Branda', 
											'Geral'                 => 'Geral', 
											'Suspenso'              => 'Suspenso'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('liquido_inicial', 'Consistência de líquidos') }}
									{{ Form::select('liquido_inicial', [
											'Líquido fino'    	=> 'Líquido fino', 
											'Líquido néctar' 	=> 'Líquido néctar',
											'Líquido mel'     	=> 'Líquido mel',
											'Líquido pudim'   	=> 'Líquido pudim',
											'Suspenso'         	=> 'Suspenso'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('motivo_avaliacao', 'Motivo da avaliação') }}
									{{ Form::textarea('motivo_avaliacao', null, ['class' => 'form-control', 'rows' => '5']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('comentario', 'Comentários') }}
									{{ Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '5']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('frequencia', 'Frequência dos atendimentos') }}
									{{ Form::select('frequencia', [
											'1x por semana'        	=> '1x por semana', 
											'2x por semana'        	=> '2x por semana',
											'3x por semana'        	=> '3x por semana',
											'4x por semana' 		=> '4x por semana',
											'Diário'       			=> 'Diário',
											'1x por mês'          	=> '1x por mês', 
											'2x por mês'          	=> '2x por mês',
											'3x por mês'          	=> '3x por mês',
											'1x a cada dois meses' 	=> '1x a cada dois meses'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('local', 'Local de atendimento') }}
									{{ Form::select('local', [
											'Internação'        	=> 'Internação', 
											'Domiciliar'        	=> 'Domiciliar'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
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
							<h6 class="panel-title txt-light">Terapia</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<div class="form-group">
									{{ Form::label('terapia', 'Terapia principal') }}
									{{ Form::select('terapia', [
											'Estímulo de deglutição de saliva' 	=> 'Estímulo de deglutição de saliva', 
											'Treino via oral'                   => 'Treino via oral',
											'Exercício para deglutição'        	=> 'Exercício para deglutição',
											'Exercício para voz'                => 'Exercício para voz',
											'Exercício para motricidade'        => 'Exercício para motricidade',
											'Exercício para linguagem'          => 'Exercício para linguagem', 
											'Acompanhamento de refeição'        => 'Acompanhamento de refeição',
											'Orientação'                        => 'Orientação'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group mb-30">
									<label class="control-label text-left">Terapias adicionais</label>
									
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_1', 'Estímulo de deglutição de saliva') }}
										{{ Form::label('adicional_1', 'Estímulo de deglutição de saliva') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_2', 'Treino via oral') }}
										{{ Form::label('adicional_2', 'Treino via oral') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_3', 'Exercício para deglutição') }}
										{{ Form::label('adicional_3', 'Exercício para deglutição') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_4', 'Exercício para voz') }}
										{{ Form::label('adicional_4', 'Exercício para voz') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_5', 'Exercício para motricidade') }}
										{{ Form::label('adicional_5', 'Exercício para motricidade') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_6', 'Exercício para linguagem') }}
										{{ Form::label('adicional_6', 'Exercício para linguagem') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_7', 'Acompanhamento de refeição') }}
										{{ Form::label('adicional_7', 'Acompanhamento de refeição') }}
									</div>
									<div class="checkbox checkbox-primary">
										{{ Form::checkbox('adicional_8', 'Orientação') }}
										{{ Form::label('adicional_8', 'Orientação') }}
									</div>
									
								</div>
								
								<div class="form-group">
									{{ Form::label('conduta', 'Conduta') }}
									{{ Form::select('conduta', [
											'Mantida' 	                    => 'Mantida', 
											'Sugestão de SNE'				=> 'Sugestão de SNE',
											'Sugestão de PEG'				=> 'Sugestão de PEG',
											'Suspensão de dieta via oral'   => 'Suspensão de dieta via oral',
											'Início de treino VO'			=> 'Início de treino VO',
											'Treino VO com maior volume'	=> 'Treino VO com maior volume',
											'Liberação de pequeno volume'   => 'Liberação de pequeno volume',
											'Liberação de dieta'            => 'Liberação de dieta',
											'Liberação de dieta por prazer' => 'Liberação de dieta por prazer',
											'Evolução de consistência' 	  	=> 'Evolução de consistência', 
											'Regressão de consistência' 	=> 'Regressão de consistência', 
											'Uso de espessante' 	        => 'Uso de espessante', 
											'Gerenciamento' 	            => 'Gerenciamento'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('dieta', 'Consistência da dieta') }}
									{{ Form::select('dieta', [
											'Líquida'				=> 'Líquida',
											'Pastosa heterogênea'   => 'Pastosa heterogênea', 
											'Pastosa homogênea'     => 'Pastosa homogênea (papa ou leve batida)', 
											'Pastosa (semissólida)' => 'Pastosa (semissólida)', 
											'Branda'                => 'Branda', 
											'Geral'                 => 'Geral', 
											'Suspenso'              => 'Suspenso'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('liquido', 'Consistência de líquidos') }}
									{{ Form::select('liquido', [
											'Líquido fino'    	=> 'Líquido fino', 
											'Líquido néctar' 	=> 'Líquido néctar',
											'Líquido mel'     	=> 'Líquido mel',
											'Líquido pudim'   	=> 'Líquido pudim',
											'Suspenso'         	=> 'Suspenso'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
									
								<div class="form-group">
									{{ Form::hidden('id_paciente', $paciente->id) }}
									{{ Form::submit('Cadastrar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
									<a class="pull-right btn btn-default mr-30" href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> Cancelar </a>
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

	<script src="{{ URL::asset('vendors/personalizado/terapia/asha.js') }}"></script>
	<script src="{{ URL::asset('vendors/personalizado/terapia/inputs.js') }}"></script>

@endsection


