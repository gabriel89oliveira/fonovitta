
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