@extends('layouts.master')

	@section('titulo')
		<a href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> {{ $paciente->nome }} </a>
	@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('TerapiaController@update', $terapia->id), 'method' => 'PUT' )) !!}
			
			
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Editar atendimento fonoaudiológico</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<h4 class="mb-10"> Revisão da terapia anterior </h4>

								<div class="form-group">
									{{ Form::label('treino_anterior', 'Treino VO anterior foi realizado?') }}
									{{ Form::select('treino_anterior', [
											'Não se aplica'							=> 'Não se aplica',
											'Treino VO realizado' 	        		=> 'Treino VO realizado', 
											'Fonoaudiologia não avisou a equipe'	=> 'Fonoaudiologia não avisou a equipe',
											'Nutrição não liberou o treino'   		=> 'Nutrição não liberou o treino',
											'Copa não entregou o treino'			=> 'Copa não entregou o treino',
											'Enfermagem não ofertou o treino'		=> 'Enfermagem não ofertou o treino',
											'Família não realizou a oferta'			=> 'Família não realizou a oferta'
										], $terapia->treino_anterior, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('comentario_treino_anterior', 'Comentários sobre treino VO anterior') }}
									{{ Form::textarea('comentario_treino_anterior', $terapia->comentario_treino_anterior, ['class' => 'form-control', 'rows' => '2']) }}
								</div>

								<div class="form-group">
									{{ Form::label('dieta_anterior', 'A dieta anterior foi seguida?') }}
									{{ Form::select('dieta_anterior', [
											'Não se aplica' 						=> 'Não se aplica',
											'Sim' 	        						=> 'Sim', 
											'Fonoaudiologia não comunicou equipe' 	=> 'Fonoaudiologia não comunicou equipe', 
											'Nutrição não modificou a dieta' 	    => 'Nutrição não modificou a dieta',
											'Médico prescreveu dieta errada' 		=> 'Médico prescreveu dieta errada',
											'Enfermagem não seguiu orientação' 		=> 'Enfermagem não seguiu orientação',
											'Família não seguiu orientação' 		=> 'Família não seguiu orientação'
										], $terapia->dieta_anterior, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('comentario_dieta_anterior', 'Comentários sobre dieta anterior') }}
									{{ Form::textarea('comentario_dieta_anterior', $terapia->comentario_dieta_anterior, ['class' => 'form-control', 'rows' => '2']) }}
								</div>

								<h4 class="mb-10"> Terapia atual </h4>
								
								<!-- CORRIGIR PARA AUTO SELECIONAR -->
								<div class="form-group">
									
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">

												{{ Form::label('prescricao', 'Houve prescrição médica?') }}

												@if(!empty($prescricao->prescricao))
													{{ Form::select('prescricao', [
															'Sim' 				=> 'Sim', 
															'Não' 				=> 'Não'
														], $prescricao->prescricao, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
												@else
													{{ Form::select('prescricao', [
															'Sim' 				=> 'Sim', 
															'Não' 				=> 'Não'
														], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
												@endif

											</div>
										</div>
										<div class="col-sm-8">
											<div class="form-group">
												{{ Form::label('equipe_prescricao', 'Qual equipe (não) prescreveu?') }}

												@if(!empty($prescricao->equipe))
													{{ Form::select('equipe_prescricao', [
															'Clínica médica' 	=> 'Clínica médica', 
															'UTI' 				=> 'UTI', 
															'UCO' 	    		=> 'UCO',
															'Nefrologia' 		=> 'Nefrologia',
															'Neurologia' 		=> 'Neurologia',
															'Pronto-Socorro' 	=> 'Pronto-Socorro'
														], $prescricao->equipe, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
												@else
													{{ Form::select('equipe_prescricao', [
															'Clínica médica' 	=> 'Clínica médica', 
															'UTI' 				=> 'UTI', 
															'UCO' 	    		=> 'UCO',
															'Nefrologia' 		=> 'Nefrologia',
															'Neurologia' 		=> 'Neurologia',
															'Pronto-Socorro' 	=> 'Pronto-Socorro'
														], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
												@endif
											</div>
										</div>
									</div>
									
								</div>
								

								<div class="row">
									<div class="col-sm-8">
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
													'Orientação'                        => 'Orientação',
													'Gerenciamento'						=> 'Gerenciamento'
												], $terapia->terapia, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											{{ Form::label('data_terapia', 'Data da terapia') }}
											{{ Form::date('data_terapia', $terapia->data, ['class' => 'form-control'] ) }}
										</div>
									</div>
								</div>
								
								<div class="form-group">
									
									<div class="row">
										<div class="col-sm-12">
											<label class="control-label text-left">Terapias adicionais</label>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Estímulo de deglutição de saliva') !== false)
													{{ Form::checkbox('adicional_1', 'Estímulo de deglutição de saliva', true) }}
													{{ Form::label('adicional_1', 'Estímulo de deglutição de saliva') }}
												@else
													{{ Form::checkbox('adicional_1', 'Estímulo de deglutição de saliva') }}
													{{ Form::label('adicional_1', 'Estímulo de deglutição de saliva') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Treino via oral') !== false)
													{{ Form::checkbox('adicional_2', 'Treino via oral', true) }}
													{{ Form::label('adicional_2', 'Treino via oral') }}
												@else
													{{ Form::checkbox('adicional_2', 'Treino via oral') }}
													{{ Form::label('adicional_2', 'Treino via oral') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Exercício para deglutição') !== false)
													{{ Form::checkbox('adicional_3', 'Exercício para deglutição', true) }}
													{{ Form::label('adicional_3', 'Exercício para deglutição') }}
												@else
													{{ Form::checkbox('adicional_3', 'Exercício para deglutição') }}
													{{ Form::label('adicional_3', 'Exercício para deglutição') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Exercício para voz') !== false)
													{{ Form::checkbox('adicional_4', 'Exercício para voz', true) }}
													{{ Form::label('adicional_4', 'Exercício para voz') }}
												@else
													{{ Form::checkbox('adicional_4', 'Exercício para voz') }}
													{{ Form::label('adicional_4', 'Exercício para voz') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Exercício para motricidade') !== false)
													{{ Form::checkbox('adicional_5', 'Exercício para motricidade', true) }}
													{{ Form::label('adicional_5', 'Exercício para motricidade') }}
												@else
													{{ Form::checkbox('adicional_5', 'Exercício para motricidade') }}
													{{ Form::label('adicional_5', 'Exercício para motricidade') }}
												@endif
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Exercício para linguagem') !== false)
													{{ Form::checkbox('adicional_6', 'Exercício para linguagem', true) }}
													{{ Form::label('adicional_6', 'Exercício para linguagem') }}
												@else
													{{ Form::checkbox('adicional_6', 'Exercício para linguagem') }}
													{{ Form::label('adicional_6', 'Exercício para linguagem') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Acompanhamento de refeição') !== false)
													{{ Form::checkbox('adicional_7', 'Acompanhamento de refeição', true) }}
													{{ Form::label('adicional_7', 'Acompanhamento de refeição') }}
												@else
													{{ Form::checkbox('adicional_7', 'Acompanhamento de refeição') }}
													{{ Form::label('adicional_7', 'Acompanhamento de refeição') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Orientação') !== false)
													{{ Form::checkbox('adicional_8', 'Orientação', true) }}
													{{ Form::label('adicional_8', 'Orientação') }}
												@else
													{{ Form::checkbox('adicional_8', 'Orientação') }}
													{{ Form::label('adicional_8', 'Orientação') }}
												@endif
											</div>
											<div class="checkbox checkbox-primary">
												@if(strpos($terapia->terapia_2, 'Gerenciamento') !== false)
													{{ Form::checkbox('adicional_9', 'Gerenciamento', true) }}
													{{ Form::label('adicional_9', 'Gerenciamento') }}
												@else
													{{ Form::checkbox('adicional_9', 'Gerenciamento') }}
													{{ Form::label('adicional_9', 'Gerenciamento') }}
												@endif
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-group">
									
									<div class="row">
										<div class="col-sm-12">
											<label class="control-label text-left">Foi acompanhado</label>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('acomp_refeicao', '1', $terapia->aval_dieta) }}
												{{ Form::label('acomp_refeicao', 'Refeição') }}
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('acomp_liquido', '1', $terapia->aval_liquido) }}
												{{ Form::label('acomp_liquido', 'Líquido') }}
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-group">
									{{ Form::label('evolucao', 'Evolução') }}
									{{ Form::textarea('evolucao', $terapia->evolucao, ['class' => 'form-control', 'rows' => '5']) }}
								</div>
								
								
								<h4 class="mb-10"> Conduta </h4>
								
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
											'Manter SNE'					=> 'Manter SNE',
											'Gerenciamento' 	            => 'Gerenciamento'
										], $terapia->conduta, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('dieta', 'Consistência da dieta') }}

									@if(!empty($historico_dietas->dieta))
										{{ Form::select('dieta', [
												'Mantida' 	            => 'Mantida', 
												'Líquida'				=> 'Líquida',
												'Pastosa heterogênea'   => 'Pastosa heterogênea', 
												'Pastosa homogênea'     => 'Pastosa homogênea (papa ou leve batida)', 
												'Pastosa (semissólida)' => 'Pastosa (semissólida)', 
												'Branda'                => 'Branda', 
												'Geral'                 => 'Geral', 
												'Suspenso'              => 'Suspenso',
												'Jejum'					=> 'Jejum'
											], $historico_dietas->dieta, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									@else
										{{ Form::select('dieta', [
												'Mantida' 	            => 'Mantida', 
												'Líquida'				=> 'Líquida',
												'Pastosa heterogênea'   => 'Pastosa heterogênea', 
												'Pastosa homogênea'     => 'Pastosa homogênea (papa ou leve batida)', 
												'Pastosa (semissólida)' => 'Pastosa (semissólida)', 
												'Branda'                => 'Branda', 
												'Geral'                 => 'Geral', 
												'Suspenso'              => 'Suspenso',
												'Jejum'					=> 'Jejum'
											], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									@endif

								</div>
									
								<div class="form-group">
									{{ Form::label('liquido', 'Consistência de líquidos') }}

									@if(!empty($historico_dietas->liquido))
										{{ Form::select('liquido', [
												'Mantida' 	        => 'Mantida', 
												'Líquido fino'    	=> 'Líquido fino', 
												'Líquido néctar' 	=> 'Líquido néctar',
												'Líquido mel'     	=> 'Líquido mel',
												'Líquido pudim'   	=> 'Líquido pudim',
												'Suspenso'         	=> 'Suspenso',
												'Jejum'				=> 'Jejum'
											], $historico_dietas->liquido, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									@else
										{{ Form::select('liquido', [
												'Mantida' 	        => 'Mantida', 
												'Líquido fino'    	=> 'Líquido fino', 
												'Líquido néctar' 	=> 'Líquido néctar',
												'Líquido mel'     	=> 'Líquido mel',
												'Líquido pudim'   	=> 'Líquido pudim',
												'Suspenso'         	=> 'Suspenso',
												'Jejum'				=> 'Jejum'
											], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									@endif

								</div>
								
								<div class="form-group">
									{{ Form::label('comentario', 'Comentários') }}
									{{ Form::textarea('comentario', $terapia->comentario, ['class' => 'form-control', 'rows' => '5']) }}
								</div>
								

								<div class="form-group">
									{{ Form::hidden('id_paciente', $paciente->id) }}
									{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
									<a class="pull-right btn btn-default btn-outline mr-30" href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> Cancelar </a>
								</div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
@endsection



