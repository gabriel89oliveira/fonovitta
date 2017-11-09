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
													<a href="javascript:void(0)">
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


								<!-- <div  id="earnings_8" class="tab-pane fade" role="tabpanel">
									
									<div class="row">
										<div class="col-lg-12">
											<form id="example-advanced-form" action="#">
												<div class="table-wrap">
													<div class="table-responsive">
														<table class="table table-striped display product-overview" id="datable_1">
															<thead>
																<tr>
																	<th>Date</th>
																	<th>Item Sales Colunt</th>
																	<th>Earnings</th>
																</tr>
															</thead>
															<tfoot>
																<tr>
																	<th colspan="2">total:</th>
																	<th></th>
																</tr>
															</tfoot>
															<tbody>
																<tr>
																	<td>monday, 12</td>
																	<td>
																	 3
																	</td>
																	<td>$400</td>
																</tr>
																<tr>
																	<td>tuesday, 13</td>
																	<td>
																	 2
																	</td>
																	<td>$400</td>
																</tr>
																<tr>
																	<td>wednesday, 14</td>
																	<td>
																	 3
																	</td>
																	<td>$420</td>
																</tr>
																<tr>
																	<td>thursday, 15</td>
																	<td>
																	 5
																	</td>
																	<td>$500</td>
																</tr>
																<tr>
																	<td>friday, 15</td>
																	<td>
																	 3
																	</td>
																	<td>$400</td>
																</tr>
																<tr>
																	<td>saturday, 16</td>
																	<td>
																	 3
																	</td>
																	<td>$400</td>
																</tr>
																<tr>
																	<td>sunday, 17</td>
																	<td>
																	 3
																	</td>
																	<td>$400</td>
																</tr>
																<tr>
																	<td>monday, 18</td>
																	<td>
																	 3
																	</td>
																	<td>$500</td>
																</tr>
																<tr>
																	<td>tuesday, 19</td>
																	<td>
																	 3
																	</td>
																	<td>$400</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>


								<div  id="settings_8" class="tab-pane fade" role="tabpanel">
									
									<div class="row">
										<div class="col-lg-12">
											<div class="">
												<div class="panel-wrapper collapse in">
													<div class="panel-body pa-0">
														<div class="col-sm-12 col-xs-12">
															<div class="form-wrap">
																<form action="#">
																	<div class="form-body overflow-hide">
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputuname_01">Name</label>
																			<div class="input-group">
																				<div class="input-group-addon"><i class="icon-user"></i></div>
																				<input type="text" class="form-control" id="exampleInputuname_01" placeholder="willard bryant">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
																			<div class="input-group">
																				<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																				<input type="email" class="form-control" id="exampleInputEmail_01" placeholder="xyz@gmail.com">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																			<div class="input-group">
																				<div class="input-group-addon"><i class="icon-phone"></i></div>
																				<input type="email" class="form-control" id="exampleInputContact_01" placeholder="+102 9388333">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
																			<div class="input-group">
																				<div class="input-group-addon"><i class="icon-lock"></i></div>
																				<input type="password" class="form-control" id="exampleInputpwd_01" placeholder="Enter pwd" value="password">
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label mb-10">Gender</label>
																			<div>
																				<div class="radio">
																					<input type="radio" name="radio1" id="radio_01" value="option1" checked="">
																					<label for="radio_01">
																					M
																					</label>
																				</div>
																				<div class="radio">
																					<input type="radio" name="radio1" id="radio_02" value="option2">
																					<label for="radio_02">
																					F
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label mb-10">Country</label>
																			<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
																				<option value="Category 1">USA</option>
																				<option value="Category 2">Austrailia</option>
																				<option value="Category 3">India</option>
																				<option value="Category 4">UK</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-actions mt-10">			
																		<button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
																	</div>				
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> -->

								
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

	<!-- Init JavaScript -->
	@if( $aniversario == 0 )
		
		<script>
			$(document).ready(function() {
				"use strict";
				
				$.toast({
					heading: 'Lembrete de aniversário',
					text: 'É hoje o aniversário de {{ $usuario->nome }}!',
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
					text: 'Falta(m) {{ $aniversario+1 }} dia(s) para o aniversário de {{ $usuario->nome }}.',
					position: 'top-right',
					loaderBg:'#e69a2a',
					icon: 'warning',
					hideAfter: 8000, 
					stack: 6
				});
				
			});
		</script>
		
	@endif
		


@endsection















