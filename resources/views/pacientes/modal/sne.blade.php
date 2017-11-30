	

	<div id="passagen-SNE-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Passagem de SNE</h5>
				</div>
				<div class="modal-body">
					
					{!! Form::open(array('action' => array('SNEController@create'), 'method' => 'PUT' )) !!}
						
						<div class="form-group">
							{{ Form::label('data', 'Data da passagem') }}
							{{ Form::date('data', null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
						</div>
						
				</div>
				<div class="modal-footer">
				
					{{ Form::hidden('id_paciente', $paciente->id) }}
					{{ Form::hidden('id_fonos', $fono->id) }}
					{{ Form::hidden('tipo', 'passagem') }}

					{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
					<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
					
				</div>
				
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>


	<div id="retirada-SNE-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Retirada de SNE</h5>
				</div>
				<div class="modal-body">
					
					{!! Form::open(array('action' => array('SNEController@create'), 'method' => 'PUT' )) !!}
						
						<div class="form-group">
							{{ Form::label('data', 'Data da retirada') }}
							{{ Form::date('data', null, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
						</div>
						
				</div>
				<div class="modal-footer">
				
					{{ Form::hidden('id_paciente', $paciente->id) }}
					{{ Form::hidden('id_fonos', $fono->id) }}
					{{ Form::hidden('tipo', 'retirada') }}

					{{ Form::submit('Salvar', ['class' => 'btn btn-primary btn-anim pull-right']) }}
					<button type="button" class="btn btn-default mr-30" data-dismiss="modal">Cancelar</button>
					
				</div>
				
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>