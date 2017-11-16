@extends('layouts.master')

	@section('titulo')
		Sugestão
	@endsection

@section('content')
	
	<!-- Row -->
	<div class="row">
	
		{!! Form::open(array('action' => array('SugestaoController@store'), 'method' => 'POST' )) !!}
			
			<div class="col-sm-10 col-sm-offset-1">
				<div class="panel panel-primary card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-light">Ticket</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_1" class="table table-hover display  pb-30" >
										<thead>
											<tr>
												<th>id</th>
												<th>Tipo</th>
												<th>Comentario</th>
												<th>Status</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>id</th>
												<th>Tipo</th>
												<th>Comentario</th>
												<th>Status</th>
												<th>Ações</th>
											</tr>
										</tfoot>
										<tbody>
										
											@foreach ($tickets as $ticket)
												<tr style="cursor: pointer;", onclick="window.location='{{ route('sugestao.mostrar_ticket', ['id' => $ticket->id]) }}';">
													<td>{{ $ticket->id }}</td>
													<td>
														{{ $ticket->tipo }} 
													</td>
													<td>{{ $ticket->comentario }}</td>
													<td>
														@if($ticket->status == "aberto")
															<i class="fa fa-circle-o"></i> &nbsp;
														@elseif($ticket->status == "Em andamento")
															<i class="fa fa-circle text-warning"></i> &nbsp;
														@else
															<i class="fa fa-circle text-success"></i> &nbsp;
														@endif

														{{ $ticket->status }}

													</td>
													<td>
														@if($ticket->status == "aberto")
															<i class="fa fa-flag-checkered"></i> &nbsp;
														@elseif($ticket->status == "Em andamento")
															<i class="fa fa-check text-warning"></i> &nbsp;
														@else
															<i class="fa fa-check-square-o text-success"></i> &nbsp;
														@endif
													</td>
												</tr>
											@endforeach
											
										</tbody>
									</table>

									@if($tickets)
									{{ $tickets->render() }}
									@endif

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			
		{!! Form::close() !!}
		
	</div>
	
@endsection
