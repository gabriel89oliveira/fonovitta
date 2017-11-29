@extends('layouts.master')

	@section('titulo')
		Perfil
	@endsection


@section('content')
	
	<!-- Row -->
	<div class="row">
		<div class="col-lg-3 col-xs-12">
			<div class="panel panel-default card-view  pa-0">
				<div class="panel-wrapper collapse in">
					<div class="panel-body  pa-0">
						<div class="profile-box">
						
							<div class="profile-cover-pic">
								<div class="fileupload btn btn-default">
									<a href=' {{ route('usuarios.edit', ['id' => $usuario->id]) }} '>
									<span class="btn-text">Editar perfil</span>
									</a>
								</div>
								<div class="profile-image-overlay"></div>
							</div>
							
							<div class="profile-info text-center">
								<div class="profile-img-wrap">
									<img class="inline-block mb-10" src="{{ URL::asset('dist/img/avatar/'.$usuario->foto) }}" alt="user"/>
									<div class="fileupload btn btn-default">
										<span class="btn-text">Editar</span>
										
										{!! Form::open(array('action' => array('UsuarioController@foto', $usuario->id), 'method' => 'PUT', 'files' => true )) !!}
											
											{{Form::file('user_photo', ['class' => 'upload', 'onchange' => 'form.submit();'])}}

										{!! Form::close() !!}
										
										
									</div>
								</div>	
								<h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">{{ $usuario->nome }}</h5>
								<h6 class="block capitalize-font pb-20">{{ $usuario->cargo }}</h6>
								<p class="block capitalize-font ">{{ $usuario->email }}</p>
								<p class="block capitalize-font pb-20">{{ $usuario->telefone }}</p>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-xs-12">
			<div class="panel panel-default card-view pa-0">
				<div class="panel-wrapper collapse in">
					<div  class="panel-body pb-0">
						<div  class="tab-struct custom-tab-1">
						
							<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
								<li class="active" role="presentation"><a  data-toggle="tab" id="atividades_tab" role="tab" href="#atividades_tab_" aria-expanded="false"><span>Atividades</span></a></li>
								<li role="presentation" class="next"><a aria-expanded="true" data-toggle="tab" role="tab" id="internacao_tab" href="#internacao_tab_"><span>Internação</span></a></li>
								<li role="presentation" class=""><a  data-toggle="tab" id="domiciliar_tab" role="tab" href="#domiciliar_tab_" aria-expanded="false"><span>Domiciliar</span></a></li>
								
								<!-- <li role="presentation" class=""><a  data-toggle="tab" id="earning_tab_8" role="tab" href="#earnings_8" aria-expanded="false"><span>earnings</span></a></li>
								<li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>settings</span></a></li>
								<li class="dropdown" role="presentation">
									<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
									<ul id="myTabDrop_7_contents"  class="dropdown-menu">
										<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
										<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Followings</a></li>
										<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Likes</a></li>
										<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
									</ul>
								</li> -->
								
							</ul>
							
							<div class="tab-content" id="myTabContent_8">
								
								<div id="atividades_tab_" class="tab-pane fade active in" role="tabpanel">
									<div class="col-md-12">
										<div class="pt-20">
											<div class="streamline user-activity">
											
												@forelse($terapias as $terapia)
												
												<div class="sl-item">
													<a href=" {{ route('pacientes.show', ['id' => $terapia->id_paciente]) }} ">
														<div class="sl-avatar avatar avatar-sm avatar-circle">
															<img class="img-responsive img-circle" src="{{ URL::asset('dist/img/avatar/' . $usuario->foto) }}" alt="avatar"/>
														</div>
														<div class="sl-content">
															<p class="inline-block"><span class="capitalize-font txt-success mr-5 weight-500">{{ $terapia->nome }}</span><span>{{ $terapia->conduta }}</span></p>
															<div class="activity-thumbnail">
																{{ isset($terapia->evolucao) ? $terapia->evolucao : "Nenhuma evolução" }}
															</div>
															<span class="block txt-grey font-12 capitalize-font">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($terapia->created_at))->diffForHumans() }}</span>
														</div>
													</a>	
												</div>

												@empty
												
													<span class="name block capitalize-font mb-15">Nenhuma atividade</span>
													
												@endforelse

												@if($terapias)
												{{ $terapias->render() }}
												@endif
												
											</div>
										</div>
									</div>
								</div>
								
								<div  id="internacao_tab_" class="tab-pane fade" role="tabpanel">
									<div class="row">
										<div class="col-lg-12">
											<div class="followers-wrap">
												<ul class="followers-list-wrap">
													<li class="follow-list">
														<div class="follo-body">
														
															@forelse($internacao as $paciente)
															
																<a href=' {{ route('pacientes.show', ['id' => $paciente->id_paciente]) }} '>
																<div class="follo-data">
																	<img class="user-img img-circle"  src="{{ URL::asset('dist/img/avatar/' . $usuario->foto) }}" alt="user"/>
																	<div class="user-data">
																		<span class="name block capitalize-font">{{ $paciente->nome }}</span>
																		<span class="time block truncate txt-grey">{{ $paciente->antecedente_1 }}</span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																</a>
															
															@empty
																
																<div class="follo-data">
																	<div class="user-data">
																		<span class="name block capitalize-font">Nenhum paciente</span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																
															@endforelse
															
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div  id="domiciliar_tab_" class="tab-pane fade" role="tabpanel">
									<div class="row">
										<div class="col-lg-12">
											<div class="followers-wrap">
												<ul class="followers-list-wrap">
													<li class="follow-list">
														<div class="follo-body">
														
															@forelse($domiciliar as $paciente)
															
																
																<a href=' {{ route('pacientes.show', ['id' => $paciente->id_paciente]) }} '>
																<div class="follo-data">
																	<img class="user-img img-circle"  src="{{ URL::asset('dist/img/avatar/' . $usuario->foto) }}" alt="user"/>
																	<div class="user-data">
																		<span class="name block capitalize-font">{{ $paciente->nome }}</span>
																		<span class="time block truncate txt-grey">{{ $paciente->antecedente_1 }}</span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																</a>
															
															@empty
																
																<div class="follo-data">
																	<div class="user-data">
																		<span class="name block capitalize-font">Nenhum paciente</span>
																	</div>
																	<div class="clearfix"></div>
																</div>
																
															@endforelse
															
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>

								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- /Row -->
	
@endsection


@section('scripts')
	
	<!-- /.Aniversario -->
	@include('usuarios.js.aniversario')

@endsection















