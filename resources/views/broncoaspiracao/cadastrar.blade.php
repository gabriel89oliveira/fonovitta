@extends('layouts.master')

	@section('titulo')
		<a href=" {{ route('pacientes.show', ['id' => $paciente->id]) }} "> {{ $paciente->nome }} </a>
	@endsection

@section('content')

	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('TerapiaController@store', $paciente->id), 'method' => 'POST' )) !!}
			
			
			<div class="col-sm-10 col-sm-offset-1">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Evento de broncoaspiração</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="form-wrap">
								
								<h4 class="mb-10"> Descrição do evento </h4>

								<div class="col-sm-12">

									<div class="row">
										<div class="col-sm-3">
										
											<div class="form-group">
												{{ Form::label('data_evento', 'Data do evento') }}
												{{ Form::date('data_evento', \Carbon\Carbon::now(), ['class' => 'form-control'] ) }}
											</div>

										</div>
									</div>
								</div>

								<div class="col-sm-12">

									<div class="form-group">
										{{ Form::label('o_que', 'O que aconteceu') }}
										{{ Form::textarea('o_que', null, ['class' => 'form-control', 'rows' => '2']) }}
									</div>

									<div class="form-group">
										{{ Form::label('por_que', 'Por que aconteceu') }}
										{{ Form::textarea('por_que', null, ['class' => 'form-control', 'rows' => '2']) }}
									</div>

								</div>

								<h4 class="mb-10"> Plano de ação </h4>
								
								<div class="col-sm-5">
									
									<div class="form-group">
										{{ Form::label('acao', 'Ação') }}
										{{ Form::text('acao', null, ['class' => 'form-control']) }}
									</div>
									
								</div>

								<div class="col-sm-4">
									
									<div class="form-group">
										{{ Form::label('responsavel', 'Responsável') }}
											{{ Form::select('responsavel', [
													'Estímulo de deglutição de saliva' 	=> 'Estímulo de deglutição de saliva', 
													'Treino via oral'                   => 'Treino via oral',
													'Exercício para deglutição'        	=> 'Exercício para deglutição',
													'Exercício para voz'                => 'Exercício para voz',
													'Exercício para motricidade'        => 'Exercício para motricidade',
													'Exercício para linguagem'          => 'Exercício para linguagem', 
													'Acompanhamento de refeição'        => 'Acompanhamento de refeição',
													'Orientação'                        => 'Orientação',
													'Gerenciamento'						=> 'Gerenciamento'
												], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									</div>
									
								</div>

								<div class="col-sm-3">
								
									<div class="form-group">
										{{ Form::label('prazo', 'Prazo da ação') }}
										{{ Form::date('prazo', \Carbon\Carbon::now(), ['class' => 'form-control'] ) }}
									</div>

								</div>


								@role('Fonoaudiologia_Coordenacao')

									<hr class="light-grey-hr col-sm-10 col-sm-offset-1 mt-30 mb-30">

									<div class="form-group mr-15">
										{{ Form::label('usuario', 'Associar à') }}
										{{ Form::select('usuario', $usuarios, Auth::user()->id, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									</div>

									<div class="form-group">
										{{ Form::label('qualidade_evolucao', 'Qualidade da evolução') }}
										{{ Form::select('qualidade_evolucao', [
												'Bom'   => 'Bom', 
												'Ruim'	=> 'Ruim'
											], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									</div>

									<div class="form-group">
										{{ Form::label('falhas_evolucao', 'Principal problema na evolução') }}
										{{ Form::select('falhas_evolucao', [
												'Erro de digitação'		=> 'Erro de digitação',
												'Falta de informação'   => 'Falta de informação',
												'Informação errada'		=> 'Informação errada',
												'Nenhum'				=> 'Nenhum'
											], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
									</div>

									{{ Form::hidden('qualidade', 'true') }}

								@else

									{{ Form::hidden('usuario', Auth::user()->id) }}
									{{ Form::hidden('qualidade', 'false') }}
									
								@endrole
									

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


@section('scripts')

<!-- 	<script>
	    
		$('#prescricao').on('change', function (e) {

		    if(this.value == 'Não'){
	        	$('#equipe_prescricao').show();
	    		$('label[for=equipe_prescricao], input#equipe_prescricao').show();
	    	}else{
	    		$('#equipe_prescricao').hide();
	    		$('label[for=equipe_prescricao], input#equipe_prescricao').hide();
	    	}

		});


	</script> -->

@endsection