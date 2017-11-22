	

	<div id="riscos-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Gerenciar riscos do paciente</h5>
				</div>
				<div class="modal-body">
					
					{!! Form::open(array('action' => array('RiscosController@update', $fono->id), 'method' => 'PUT' )) !!}
						
						<div class="form-group">
							{{ Form::label('paliativo', 'Cuidados paliativos') }}
							{{ Form::select('paliativo', [
									'Sim'  	=> 'Sim', 
									'N' 	=> 'Não'
								], $fono->paliativo, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
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