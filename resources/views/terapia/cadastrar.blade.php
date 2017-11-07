@extends('layouts.master')

	@section('titulo')
		<a href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> {{ $paciente->nome }} </a>
	@endsection

@section('content')

	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('TerapiaController@store', $paciente->id), 'method' => 'POST' )) !!}
			
			
			<div class="col-sm-8 col-sm-offset-2">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Atendimento fonoaudiológico</h6>
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
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('comentario_treino_anterior', 'Comentários sobre treino VO anterior') }}
									{{ Form::textarea('comentario_treino_anterior', null, ['class' => 'form-control', 'rows' => '2']) }}
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
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>

								<div class="form-group">
									{{ Form::label('comentario_dieta_anterior', 'Comentários sobre dieta anterior') }}
									{{ Form::textarea('comentario_dieta_anterior', null, ['class' => 'form-control', 'rows' => '2']) }}
								</div>

								<h4 class="mb-10"> Terapia atual </h4>
								
								<div class="form-group">
									
									<div class="row">
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('prescricao', 'Sim') }}
												{{ Form::label('prescricao', 'Houve prescrição médica') }}
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
													'Orientação'                        => 'Orientação'
												], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											{{ Form::label('data_terapia', 'Data da terapia') }}
											{{ Form::date('data_terapia', \Carbon\Carbon::now(), ['class' => 'form-control'] ) }}
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
										</div>
										
										<div class="col-sm-6">
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
									</div>
									
								</div>
								
								<div class="form-group">
									
									<div class="row">
										<div class="col-sm-12">
											<label class="control-label text-left">Foi acompanhado</label>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('acomp_refeicao', '1') }}
												{{ Form::label('acomp_refeicao', 'Refeição') }}
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="checkbox checkbox-primary">
												{{ Form::checkbox('acomp_liquido', '1') }}
												{{ Form::label('acomp_liquido', 'Líquido') }}
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="form-group">
									{{ Form::label('evolucao', 'Evolução') }}
									{{ Form::textarea('evolucao', null, ['class' => 'form-control', 'rows' => '5']) }}
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
											'Gerenciamento' 	            => 'Gerenciamento'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('dieta', 'Consistência da dieta') }}
									{{ Form::select('dieta', [
											'Mantida' 	            => 'Mantida', 
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
											'Mantida' 	        => 'Mantida', 
											'Líquido fino'    	=> 'Líquido fino', 
											'Líquido néctar' 	=> 'Líquido néctar',
											'Líquido mel'     	=> 'Líquido mel',
											'Líquido pudim'   	=> 'Líquido pudim',
											'Suspenso'         	=> 'Suspenso'
										], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
								</div>
								
								<div class="form-group">
									{{ Form::label('comentario', 'Comentários') }}
									{{ Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '5']) }}
								</div>
									

								<div class="form-group">
									{{ Form::hidden('id_paciente', $paciente->id) }}
									{{ Form::submit('Cadastrar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
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



