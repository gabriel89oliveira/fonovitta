	

	<div id="frequencia-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Alterar frequência de atendimento</h5>
				</div>
				<div class="modal-body">
					
					{!! Form::open(array('action' => array('FrequenciaController@update', $fono->id), 'method' => 'PUT' )) !!}
						
						<div class="form-group">
							{{ Form::label('frequencia', 'Frequência dos atendimentos') }}
							{{ Form::select('frequencia', [
									'1x por semana'        	=> '1x por semana', 
									'2x por semana'        	=> '2x por semana',
									'3x por semana'        	=> '3x por semana',
									'4x por semana' 		=> '4x por semana',
									'Diário'       			=> 'Diário',
									'1x por mês'          	=> '1x por mês', 
									'2x por mês'          	=> '2x por mês',
									'3x por mês'          	=> '3x por mês',
									'1x a cada dois meses' 	=> '1x a cada dois meses'
								], $fono->frequencia, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
						</div>
						
				</div>
				<div class="modal-footer">
				
					{{ Form::hidden('id_paciente', $paciente->id) }}
					{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
					<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
					
				</div>
				
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>