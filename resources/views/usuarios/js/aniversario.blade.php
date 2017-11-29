<!-- Init JavaScript -->
@if( $aniversario == 365 OR $aniversario == 0 )
	
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
	
@elseif($aniversario>1 && $aniversario<=10)
	
	<script>
		$(document).ready(function() {
			"use strict";
			
			$.toast({
				heading: 'Lembrete de aniversário',
				text: 'Faltam {{ $aniversario }} dias para o aniversário de {{ $usuario->nome }}.',
				position: 'top-right',
				loaderBg:'#e69a2a',
				icon: 'warning',
				hideAfter: 8000, 
				stack: 6
			});
			
		});
	</script>
	
@elseif($aniversario==1)
	
	<script>
		$(document).ready(function() {
			"use strict";
			
			$.toast({
				heading: 'Lembrete de aniversário',
				text: 'O aniversário de {{ $usuario->nome }} é amanhã!',
				position: 'top-right',
				loaderBg:'#e69a2a',
				icon: 'warning',
				hideAfter: 8000, 
				stack: 6
			});
			
		});
	</script>
	
@endif


@foreach($aniversario_pacientes as $niver)
	
	@if( substr($niver->nascimento, strrpos($niver->nascimento, '-') + 1) == date('d') )

		<script>
		$.toast({
			heading: 'Lembrete de aniversário',
			text: 'O aniversário de {{ $niver->nome }} é hoje! Não esqueça de dar os parabéns. ',
			position: 'top-right',
			loaderBg:'transparent',
			icon: 'success',
			hideAfter: 8000, 
			stack: 6
		});
		</script>

	@else

		<script>
		$.toast({
			heading: 'Lembrete de aniversário',
			text: 'O aniversário de {{ $niver->nome }} está chegando! É dia {{ date("d/m", strtotime($niver->nascimento)) }} ',
			position: 'top-right',
			loaderBg:'transparent',
			icon: 'warning',
			hideAfter: 8000, 
			stack: 6
		});
		</script>

	@endif

@endforeach