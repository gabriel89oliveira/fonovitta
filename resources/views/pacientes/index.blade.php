@extends('layouts.master')

@section('titulo')
Pacientes
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
											<th>Nome</th>
											<th>Idade</th>
											<th>Diagnóstico</th>
											<th>Cuidador</th>
											<th>Contato</th>
											<th>Telefone</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nome</th>
											<th>Idade</th>
											<th>Diagnóstico</th>
											<th>Cuidador</th>
											<th>Contato</th>
											<th>Telefone</th>
										</tr>
									</tfoot>
									<tbody>
									
										@foreach ($pacientes as $paciente)
											<tr>
												<td><a href=' {{ route('pacientes.show', ['id' => $paciente->id]) }} ' >{{ $paciente->nome }}</a></td>
												<td>{{ \Carbon\Carbon::parse($paciente->nascimento)->age }}</td>
												<td>{{ $paciente->diagnostico_1 }}</td>
												<td>{{ $paciente->cuidador }}</td>
												<td>{{ $paciente->nome_1 }}</td>
												<td>{{ $paciente->telefone_1 }}</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>

								@if($pacientes)
								{{ $pacientes->render() }}
								@endif

							</div>
						</div>
					</div>
				</div>
				
			</div>	
		</div>
		
	</div>
	
@endsection













