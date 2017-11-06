@extends('layouts.master')

	@section('titulo')
		Perfil
	@endsection


@section('content')
	
	<!-- Row -->
	<div class="row">
		
		<div class="col-sm-12">
			<div class="panel panel-primary card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h4 class="panel-title txt-light">{{ $paciente->nome }} <br><small class="txt-light">{{ $idade }} anos</small></h4>
					</div>
					<div class="pull-right">
						<div class="dropdown">
							<!-- Single button -->
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="zmdi zmdi-chevron-down zmdi-hc-lg"></i> &nbsp; Opções &nbsp;
							</button>
							<ul class="dropdown-menu" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							
								@hasanypermission(['Paciente_Editar_Todos', 'Paciente_Editar_Equipe', 'Paciente_Editar_Meu'])
									<li><a href=" {{ route('pacientes.edit', ['id' => $paciente->id]) }} ">Editar perfil</a></li>
									<li class="divider"></li>
								@endcan
								
								<!-- Verificar se esta sendo atendido pela fono -->
								@if($paciente->fon == 0)
									
									<!-- Permissão de acesso -->
									@can('Paciente_Avaliar')
										<li><a href=" {{ route('avaliacao.create', ['id' => $paciente->id]) }} ">Avaliar paciente</a></li>
									@endcan
									
									<!-- Permissão de obito -->
									@can('Paciente_Obito')
										<li class="divider"></li>
										<li><a href="#" data-toggle="modal" data-target="#obito-modal">Óbito</a></li>
									@endcan
									
								@else
									
									@hasanypermission(['Terapia_Todos', 'Terapia_Meu'])
										<li><a href=" {{ route('terapia.create', ['id' => $paciente->id]) }} ">Nova Terapia</a></li>
									@endcan
									
									<li><a href="#" data-toggle="modal" data-target="#frequencia-modal">Frequência do Atendimento</a></li>
									<li><a href="#" data-toggle="modal" data-target="#riscos-modal">Gerenciar Riscos</a></li>
									<li><a href="#" data-toggle="modal" data-target="#responsavel-modal">Alterar Responsável</a></li>
									
									<li class="divider"></li>
									
									<li><a href="#" onClick='confirmarAlta("{{ $paciente->id }}");'>Alta fonoaudiológica</a></li>
									<li><a href="#" onClick='confirmarSuspensao("{{ $paciente->id }}");'>Suspensão do atendimento</a></li>
									<li><a href="#" onClick='confirmarObito("{{ $paciente->id }}");'>Óbito</a></li>
								@endif
								
							</ul>
							
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Dados Pessoais</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">
									
									<div class="form-group">
										<p>Nome do responsável</p>
										<h6> {{ $paciente->responsavel }} </h6>
									</div>
									
									<div class="form-group">
										<p>Grau de relação</p>
										<h6> {{ $paciente->relacao }} </h6>
									</div>
									
									<div class="form-group">
										<p>Nome do cuidador</p>
										<h6> {{ $paciente->cuidador }} </h6>
									</div>
									
									<div class="form-group">
										<p>Diagnóstico</p>
										<h6> 
											{{ $paciente->diagnostico_1 }} 
											
											<?php
											
												if($paciente->diagnostico_2<>""){
													echo " / ".$paciente->diagnostico_2;
												}
												
												if($paciente->diagnostico_3<>""){
													echo " / ".$paciente->diagnostico_3;
												}
											
											?>
											
										</h6>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Dados para contato</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">
									
									@if (!empty($paciente->nome_1))
										<h6 class="text-center">Contato 1</h6>
										<div class="form-group">
											<p>Nome do contato</p>
											<h6> {{ $paciente->nome_1 }} </h6>
										</div>
										
										<div class="form-group">
											<p>Telefone de contato</p>
											<h6> {{ $paciente->telefone_1}} </h6>
										</div>
										<br>
									@else
										<h6 class="text-center">Nenhum contato encontrado.</h6>
									@endif
									
									
									@if (!empty($paciente->nome_2))
										<h6 class="text-center">Contato 2</h6>
										<div class="form-group">
											<p>Nome do contato</p>
											<h6> {{ $paciente->nome_2 }} </h6>
										</div>
										
										<div class="form-group">
											<p>Telefone de contato</p>
											<h6> {{ $paciente->telefone_2 }} </h6>
										</div>
										<br>
									@endif
									
									@if (!empty($paciente->endereco))
										<h6 class="text-center">Endereço</h6>
										<address class="mb-15">
											{{ $paciente->endereco }}<br>
											{{ $paciente->bairro . ', ' . $paciente->cidade }} <br>
										</address>
									@endif
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				
				@if($paciente->fon == 1)
					
				<div class="col-sm-12">
					<div class="panel panel-default card-view">
						<div class="panel-heading">
							<div class="pull-left">
								<h6 class="panel-title txt-dark">Dados da fonoaudiologia</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-wrap">
									
									@if(!empty($dieta->dieta))
										<div class="form-group">
											<p>Dieta</p>
											<h6> {{ $dieta->dieta }} </h6>
										</div>
									@endif

									@if(!empty($dieta->liquido))
										<div class="form-group">
											<p>Líquido</p>
											<h6> {{ $dieta->liquido }} </h6>
										</div>
									@endif

									<div class="form-group">
										<p>Frequência do atendimento</p>
										<h6> {{ $fono->frequencia }} </h6>
									</div>
									
									<div class="form-group">
										<p>Responsável pelo atendimento</p>
										<h6> {{ $fono->nome}} </h6>
									</div>
									
									<div class="form-group">
										<p>Local do atendimento</p>
										<h6> {{ $fono->local}} </h6>
									</div>
									<br>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				@endif
				
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Histórico</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-wrap">
		
		
		
							<div class="pt-20">
								<div class="streamline user-activity">
									
									
									<?php $k = 0; ?>
									@foreach ($terapia as $terapia_i)
										
										<?php $k++; ?>
										
										<div class="sl-item">
											<a href="javascript:void(0)" data-toggle="modal" data-target="#historico-modal-{{ $k }}">
												<div class="sl-avatar avatar avatar-sm avatar-circle">
													<img class="img-responsive img-circle" src="{{ URL::asset('dist/img/avatar/' . $terapia_i->foto) }}" alt="avatar"/>
												</div>
												<div class="sl-content">
													<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">{{ $terapia_i->name }}</span><span>{{ $terapia_i->terapia }}</span></p>
													<span class="block txt-grey font-12 capitalize-font">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($terapia_i->created_at))->diffForHumans() }}</span>
												</div>
											</a>
										</div>
										
										<div id="historico-modal-{{ $k }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" id="myModalLabel">
															{{ $terapia_i->terapia }} 
															<small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($terapia_i->created_at))->diffForHumans() }}</small>
														</h5>
													</div>
													<div class="modal-body">
														<p>{{ $terapia_i->terapia_2 }}</p>
														<br>
														@if(!empty($terapia_i->evolucao))
															<h5>Evolução</h5>
															<p>{{ $terapia_i->evolucao }}</p>
															<br>
														@endif
														
														<h6>
															@if(!empty($terapia_i->aval_dieta))
																Dieta Avaliada. 
															@endif
															@if(!empty($terapia_i->aval_liquido))
																Líquido Avaliado.
															@endif
														</h6>
														@if(!empty($terapia_i->aval_liquido) OR !empty($terapia_i->aval_dieta))
															<br>
														@endif
														
														@if(!empty($terapia_i->comentario))
															<h5>Comentários</h5>
															<p>{{ $terapia_i->comentario }}</p>
															<br>
														@endif
														<h6>Conduta: {{ $terapia_i->conduta }}</h6>
														
													</div>
													<div class="modal-footer">
														<h6 class="pull-left"><small>Atendimento realizado por <b>{{ $terapia_i->name }}</b></small></h6>
														<a href=" {{ route('terapia.edit', ['id' => $terapia_i->id]) }} ">
															<button class="btn btn-primary btn-anim mr-30"><i class="fa fa-pencil"></i><span class="btn-text">Editar</span></button>
														</a>
														<button type="button" class="btn btn-primary btn-anim" data-dismiss="modal"><i class="fa fa-close"></i><span class="btn-text">Fechar</span></button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										
									@endforeach

									@if($terapia)
									{{ $terapia->render() }}
									@endif
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	
	<!-- MODAL PARA MENU -->
	
	<!-- /.Frequencia -->
	@if($paciente->fon == 1)
		
		<div id="frequencia-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h5 class="modal-title">Alterar frequência de atendimento</h5>
					</div>
					<div class="modal-body">
						
						{!! Form::open(array('action' => array('FrequenciaController@update', $fono->id), 'method' => 'PUT' )) !!}
							
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
									], $fono->frequencia, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>
							
					</div>
					<div class="modal-footer">
					
						{{ Form::hidden('id_paciente', $paciente->id) }}
						{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
						<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
						
					</div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	
	@endif
	
	
	<!-- /.Responsável -->
	@if($paciente->fon == 1)
		
		<div id="responsavel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h5 class="modal-title">Alterar responsável por atendimento</h5>
					</div>
					<div class="modal-body">
						
						{!! Form::open(array('action' => array('ResponsavelController@update', $fono->id), 'method' => 'PUT' )) !!}
							
							<div class="form-group">
								
								{{ Form::label('responsavel', 'Responsável pelos atendimentos') }}
								{{ Form::select('responsavel', $equipe, $fono->id_responsavel, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>
							
					</div>
					<div class="modal-footer">
					
						{{ Form::hidden('id_paciente', $paciente->id) }}
						{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
						<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
						
					</div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	
	@endif
	
	<script type="text/javascript">
		
		
		function confirmarAlta(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja dar alta fonoaudiologica para esse paciente? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/alta') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente recebeu alta!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								location.reload();
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}
		
		function confirmarSuspensao(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja suspender o atendimento fonoaudiologico desse paciente? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/suspensao') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente teve o atendimento suspendido!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								location.reload();
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}
		
		function confirmarObito(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'O paciente foi a óbito? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/obito') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente teve o atendimento suspendido!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								window.location.href = "{{URL::to('pacientes')}}";
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}
		
	</script>
	
@endsection


@section('scripts')

	<!-- Init JavaScript -->
	@if( $aniversario == 0 )
		
		<script>
			$(document).ready(function() {
				"use strict";
				
				$.toast({
					heading: 'Lembrete de aniversário',
					text: 'É hoje o aniversário de {{ $paciente->nome }}!',
					position: 'top-right',
					loaderBg:'#469408',
					icon: 'success',
					hideAfter: 8000, 
					stack: 6
				});
				
			});
		</script>
		
	@elseif($aniversario>=0 && $aniversario<=10)
		
		<script>
			$(document).ready(function() {
				"use strict";
				
				$.toast({
					heading: 'Lembrete de aniversário',
					text: 'Falta(m) {{ $aniversario+1 }} dia(s) para o aniversário de {{ $paciente->nome }}.',
					position: 'top-right',
					loaderBg:'#e69a2a',
					icon: 'warning',
					hideAfter: 8000, 
					stack: 6
				});
				
			});
		</script>
		
	@endif
	
	
	<script src="{{ URL::asset('dist/js/init.js') }}"></script>


@endsection















