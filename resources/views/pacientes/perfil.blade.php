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
						<h4 class="panel-title txt-light">
							{{ $paciente->nome }} 
							@if($fono->paliativo == "Sim")
								<span class="label label-warning ml-10">Cuidados Paliativos</span>
							@endif
						<br><small class="txt-light">{{ $idade }} anos</small></h4>
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
									
									@if(!empty($paciente->responsavel))
										<div class="form-group">
											<p>Nome do responsável</p>
											<h6> {{ $paciente->responsavel }} </h6>
										</div>
									@endif

									@if(!empty($paciente->relacao))
										<div class="form-group">
											<p>Grau de relação</p>
											<h6> {{ $paciente->relacao }} </h6>
										</div>
									@endif

									@if(!empty($paciente->cuidador))
										<div class="form-group">
											<p>Nome do cuidador</p>
											<h6> {{ $paciente->cuidador }} </h6>
										</div>
									@endif

									<div class="form-group">
										<p>Antecedentes</p>
										<h6> 
											{{ $paciente->antecedente_1 }} 

											@if($paciente->antecedente_2<>"")
												{{ " / ".$paciente->antecedente_2 }}
											@endif

											@if($paciente->antecedente_3<>"")
												{{ " / ".$paciente->antecedente_3 }}
											@endif
											
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
									
									@if(!empty($fono->diagnostico_1))
									<div class="form-group">
										<p>Diagnóstico</p>
										<h6> 
											{{ $fono->diagnostico_1 }} 

											@if($fono->diagnostico_2<>"")
												{{ " / ".$fono->diagnostico_2 }}
											@endif

											@if($fono->diagnostico_3<>"")
												{{ " / ".$fono->diagnostico_3 }}
											@endif
											
										</h6>
									</div>
									@endif

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

													<span class="block txt-grey font-12 capitalize-font">

														<!-- Deletar -->
														<a href="#" onClick='confirmarDeletar("{{ $terapia_i->id }}");' class="pull-right mr-20 text-danger"><i class="ti ti-trash"></i></a>

														<!-- Editar -->
														<a href="{{ route('terapia.edit', ['id' => $terapia_i->id]) }}" class="pull-right mr-10 text-primary"><i class="ti ti-pencil"></i></a>

													</span>

													<span class="block txt-grey font-12 capitalize-font">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($terapia_i->created_at))->diffForHumans() }}</span>
													
												</div>
											</a>
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
	@if($paciente->fon == 1)

		<!-- /.Frequencia -->
		@include('pacientes.modal.frequencia')
			
		<!-- /.Responsável -->
		@include('pacientes.modal.responsavel')

		<!-- /.Terapia -->
		@include('pacientes.modal.terapia')
	
		<!-- /.Alta -->
		@include('pacientes.js.alta')

	@endif
	
	<!-- /.Deletar -->
	@include('pacientes.js.deletar')

	
@endsection


@section('scripts')

	<!-- /.Aniversario -->
	@include('pacientes.js.aniversario')
	
@endsection















