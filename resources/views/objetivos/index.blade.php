@extends('layouts.master')

@section('titulo')
Objetivos
@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
		
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="table-wrap">
							<div class="table-responsive">
								<table id="datable_1" class="table table-hover display  pb-30" >
									<thead>
										<tr>
											<th>Paciente</th>
											<th>Responsável</th>
											<th>Objetivo</th>
											<th>Progresso</th>
											<th>Status</th>
											<th>Prazo</th>
											<th>Ação</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Paciente</th>
											<th>Responsável</th>
											<th>Objetivo</th>
											<th>Progresso</th>
											<th>Status</th>
											<th>Prazo</th>
											<th>Ação</th>
										</tr>
									</tfoot>
									<tbody>


										<?php $k = 0; ?>
										@foreach ($objetivos as $objetivo)
										
											<?php $k++; ?>
											
											<tr>
												<td><a href=' {{ route('pacientes.show', ['id' => $objetivo->id_paciente]) }} ' >{{ $objetivo->paciente_nome }}</a></td>
												<td>
													{{ $objetivo->usuario_nome }}<br>
													<small>{{ \Carbon\Carbon::parse($objetivo->data)->diffForHumans() }}</small>
												</td>
												<td>
													{{ $objetivo->objetivo }}
													<small>{{ $objetivo->status }}</small>
												</td>
												<td>
													<div class="progress">
														<div class="progress-bar progress-bar-primary" style="width: {{ $objetivo->progresso }}%;" role="progressbar">
															<span class="sr-only">{{ $objetivo->progresso }}% Completo</span>
														</div>
													</div>
												</td>
												<td>
													@if( $objetivo->prazo < \Carbon\Carbon::now() )
														<span class="label label-danger">Atrasado</span>
													@elseif( $objetivo->prazo < \Carbon\Carbon::now()->addDays(10) )
														<span class="label label-warning">Próximo</span>
													@else
														<span class="label label-success">No prazo</span>
													@endif
													
												</td>
												<td>{{ \Carbon\Carbon::parse($objetivo->prazo)->diffForHumans() }}</td>
												<td>
													<div class="btn-group mt-15 mr-10">
														
														<ul class="list-inline">
															<li>
																<a href="#" data-toggle="modal" data-target="#check-modal-{{ $k }}"><i class="fa fa-check txt-success"></i></a>
															</li>
															<li>
																<a href="#" data-toggle="modal" data-target="#editar-modal-{{ $k }}"><i class="fa fa-pencil txt-primary"></i></a>
															</li>
															<li>
																<a href="#" onClick='confirmarDeletar("{{ $objetivo->id }}");'><i class="zmdi zmdi-delete txt-danger"></i></a>
															</li>
														</ul>
														
													</div>
												</td>
											</tr>
											
											<!-- /.Editar Objetivo -->
											<div id="editar-modal-{{ $k }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title">Alterar objetivo de {{ $objetivo->id ." - ". $objetivo->usuario_nome }}</h5>
														</div>
														<div class="modal-body">
															
															{!! Form::open(array('action' => array('ObjetivoController@update', $objetivo->id), 'method' => 'PUT' )) !!}
																
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
																		], $objetivo->objetivo, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
																</div>
																
																<div class="form-group">
																	{{ Form::label('progresso', 'Progresso') }}
																	{{ Form::select('progresso', [
																			'0'  => '0', 
																			'10' => '10',
																			'20' => '20',
																			'30' => '30',
																			'40' => '40',
																			'50' => '50',
																			'60' => '60',
																			'70' => '70',
																			'80' => '80',
																			'90' => '90',
																			'100' => '100'
																		], $objetivo->progresso, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
																</div>
																
																<div class="form-group">
																	{{ Form::label('status', 'Status') }}
																	{{ Form::text('status', $objetivo->status, ['class' => 'form-control']) }}
																</div>

																<div class="form-group">
																	{{ Form::label('prazo', 'Prazo') }}
																	{{ Form::date('prazo', $objetivo->prazo, ['class' => 'form-control']) }}
																</div>
																
														</div>
														<div class="modal-footer">
														
															{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
															<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
															
														</div>
														
														{!! Form::close() !!}
														
													</div>
												</div>
											</div>
											
											<!-- /.Concluir Objetivo -->
											<div id="check-modal-{{ $k }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															<h5 class="modal-title">Concluir objetivo de <b>{{ $objetivo->paciente_nome }}</b></h5>
														</div>
														<div class="modal-body">
															
															{!! Form::open(array('action' => array('ObjetivoController@conclude', $objetivo->id), 'method' => 'PUT' )) !!}
																
																<div class="form-group">
																	{{ Form::label('data', 'Data de conclusão') }}
																	{{ Form::date('data', null, ['class' => 'form-control']) }}
																</div>
																
														</div>
														<div class="modal-footer">
														
															{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
															<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
															
														</div>
														
														{!! Form::close() !!}
														
													</div>
												</div>
											</div>
											
										@endforeach
										
									</tbody>
								</table>

								@if($objetivos)
								{{ $objetivos->render() }}
								@endif

							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
	</div>
	
	<script type="text/javascript">
		
		
		function confirmarDeletar(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja deletar esse objetivo? Você não poderá mais recuperá-lo!',
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
						url: "{{ url('objetivos/deletar') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Objetivo excluído!',
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
		
	</script>
	
	
@endsection













