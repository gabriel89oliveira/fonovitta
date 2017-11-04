@extends('layouts.master')



@section('content')
	
	<!-- Row -->
	<div class="row">
		
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">data Table</h6>
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
											<th>Nome</th>
											<th>Idade</th>
											<th>Equipe</th>
											<th>Cargo</th>
											<th>E-mail</th>
											<th>Telefone</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nome</th>
											<th>Idade</th>
											<th>Equipe</th>
											<th>Cargo</th>
											<th>E-mail</th>
											<th>Telefone</th>
										</tr>
									</tfoot>
									<tbody>
									
										@foreach ($usuarios as $usuario)
											<tr>
												<td><a href=' {{ route('usuarios.show', ['id' => $usuario->id]) }} ' >{{ $usuario->nome }}</a></td>
												<td>{{ \Carbon\Carbon::parse($usuario->nascimento)->age }}</td>
												<td>{{ $usuario->equipe }}</td>
												<td>{{ $usuario->cargo }}</td>
												<td>{{ $usuario->email }}</td>
												<td>{{ $usuario->telefone }}</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
	</div>
	
@endsection


@section('scripts')

	

@endsection















