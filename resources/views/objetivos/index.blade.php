@extends('layouts.master')

@section('titulo')
Objetivos
@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
		
		<div class="col-sm-12">
			<div class="panel card-view">
				<div class="panel-heading">
					
					<div class="pull-left">
						
						{!! Form::open(['action'=>'ObjetivoController@index', 'method' => 'get', 'class' => 'form-inline']) !!}

							<div class="form-group mr-15">
								{{ Form::label('status', 'Status') }}
								{{ Form::select('status', ['Atrasado' => 'Atrasado', 'Proximo' => 'Próximo', 'No prazo' => 'No prazo'], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::label('local', 'Departamento') }}
								{{ Form::select('local', ['Domiciliar' => 'Domiciliar', 'Internação' => 'Internação'], null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::label('usuario', 'Usuário') }}
								{{ Form::select('usuario', $usuarios, null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
							</div>

							<div class="form-group mr-15">
								{{ Form::submit('Filtrar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
							</div>

						{!! Form::close() !!}

					</div>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

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
															
															@can('Objetivo_Concluir')
															<li>
																<a href="#" data-toggle="modal" data-target="#check-modal-{{ $k }}"><i class="fa fa-check txt-success"></i></a>
															</li>
															@endcan

															@can('Objetivo_Editar')
															<li>
																<a href="#" data-toggle="modal" data-target="#editar-modal-{{ $k }}"><i class="fa fa-pencil txt-primary"></i></a>
															</li>
															@endcan

															@can('Objetivo_Excluir')
															<li>
																<a href="#" onClick='confirmarDeletar("{{ $objetivo->id }}");'><i class="zmdi zmdi-delete txt-danger"></i></a>
															</li>
															@endcan
															
														</ul>
														
													</div>
												</td>
											</tr>
											

											<!-- /.Editar Objetivo -->
											@include('objetivos.modal.editar')
											
											<!-- /.Concluir Objetivo -->
											@include('objetivos.modal.concluir')

											
										@endforeach
										
									</tbody>
								</table>

								@if($objetivos)
								{{ $objetivos->appends(\Request::except('page'))->render() }}
								@endif

							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
	</div>
	

	@include('objetivos.js.deletar')
	
	
@endsection













