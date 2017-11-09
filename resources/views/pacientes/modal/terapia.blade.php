
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