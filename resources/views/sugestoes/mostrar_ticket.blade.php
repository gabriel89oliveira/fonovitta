@extends('layouts.master')

	@section('titulo')
		Sugestão
	@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
			
			<div class="col-sm-10 col-sm-offset-1">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Ticket - {{ $ticket->tipo }}</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							
							
							@if($ticket->status == "aberto")
								<button onClick='confirmarIniciar("{{ $ticket->id }}");' class="btn btn-default pull-right ml-10">
									{{ $ticket->status }}
								</button>
							@elseif($ticket->status == "Em andamento")
								<button onClick='confirmarFinalizar("{{ $ticket->id }}");' class="btn btn-warning pull-right ml-10"> 
									{{ $ticket->status }} 
								</button>
							@else
								<button class="btn btn-success pull-right ml-10"> {{ $ticket->status }} </button>
							@endif

							<h5 style="text-transform: none"> 	
								{{ $ticket->comentario }} 
								<br>
								<small>Criado por {{ $ticket->nome }}</small> 
							</h5>

						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-10 col-sm-offset-1">
				<div class="panel panel-primary card-view">
					
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							
							<div class="col-sm-10 col-sm-offset-1">

								{!! Form::open(array('action' => array('SugestaoController@comentar'), 'method' => 'POST' )) !!}

									<div class="form-group">
										{{ Form::label('comentario', 'Comentários') }}
										{{ Form::textarea('comentario', null, ['class' => 'form-control', 'rows' => '5']) }}
									</div>
									
									<div class="form-group">
										{{ Form::hidden('id_ticket', $ticket->id) }}
										{{ Form::hidden('id_usuario', $ticket->id_usuario) }}
										{{ Form::submit('Comentar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
									</div>

								{!! Form::close() !!}

							</div>

							<div class="col-sm-10 col-sm-offset-1 mt-20">


								<ul class="timeline">

									<?php $inverted = false; ?>
									@foreach($comentarios as $comentario)

										@if($inverted == false)

											<li>
												<div class="timeline-badge bg-yellow"></div>
												<div class="timeline-panel pa-30">
													<div class="timeline-heading">
														<h6 class="mb-15">
															{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comentario->created_at))->diffForHumans() }}
														</h6>
													</div>
													<div class="timeline-body">
														<h4 class="mb-5"> {{ $comentario->nome }} </h4>
														<p> {{ $comentario->comentario }} </p>
													</div>
												</div>
											</li>

											<?php $inverted = true; ?>
										
										@else

											<li class="timeline-inverted">
												<div class="timeline-badge bg-yellow"></div>
												<div class="timeline-panel pa-30">
													<div class="timeline-heading">
														<h6 class="mb-15">
															{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comentario->created_at))->diffForHumans() }}
														</h6>
													</div>
													<div class="timeline-body">
														<h4 class="mb-5"> {{ $comentario->nome }} </h4>
														<p> {{ $comentario->comentario }} </p>
													</div>
												</div>
											</li>

											<?php $inverted = false; ?>

										@endif
									
									@endforeach
									
									
									<li class="clearfix no-float"></li>
								</ul>



							</div>

						</div>
					</div>

				</div>
			</div>
		
	</div>
	
	@include('sugestoes.js.iniciar')

@endsection
