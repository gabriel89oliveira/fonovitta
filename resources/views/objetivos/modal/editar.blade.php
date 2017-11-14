	
	<!-- /.Editar Objetivo -->
	<div id="editar-modal-{{ $k }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">Alterar objetivo de {{ $objetivo->paciente_nome ." - ". $objetivo->usuario_nome }}</h5>
				</div>
				<div class="modal-body">
					
					{!! Form::open(array('action' => array('ObjetivoController@update', $objetivo->id), 'method' => 'PUT' )) !!}
						
						<div class="form-group">
							{{ Form::label('objetivo', 'Objetivo') }}
							{{ Form::select('objetivo', [
									'Retirada de VAA' 						=> 'Retirada de VAA', 
									'Progressão de dieta' 					=> 'Progressão de dieta',
									'Manter dieta liberada' 				=> 'Manter dieta liberada',
									'Sistematizar a deglutição de saliva' 	=> 'Sistematizar a deglutição de saliva',
									'Iniciar treino via oral' 				=> 'Iniciar treino via oral',
									'Liberar treino via oral' 				=> 'Liberar treino via oral',
									'Liberar dieta' 						=> 'Liberar dieta',
									'Alta fonoaudiologica' 					=> 'Alta fonoaudiologica'
								], $objetivo->objetivo, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
						</div>
						
						<div class="form-group">
							{{ Form::label('progresso', 'Progresso') }}
							{{ Form::select('progresso', [
									'0'  => '0', 
									'10' => '10',
									'20' => '20',
									'30' => '30',
									'40' => '40',
									'50' => '50',
									'60' => '60',
									'70' => '70',
									'80' => '80',
									'90' => '90',
									'100' => '100'
								], $objetivo->progresso, ['placeholder' => 'Escolher', 'class' => 'form-control']) }}
						</div>
						
						<div class="form-group">
							{{ Form::label('status', 'Status') }}
							{{ Form::text('status', $objetivo->status, ['class' => 'form-control']) }}
						</div>

						<div class="form-group">
							{{ Form::label('prazo', 'Prazo') }}
							{{ Form::date('prazo', $objetivo->prazo, ['class' => 'form-control']) }}
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