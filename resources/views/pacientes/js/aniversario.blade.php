<!-- Init JavaScript -->
@if( $aniversario == 365 OR $aniversario == 0 )
	
	<script>
		$(document).ready(function() {
			"use strict";
			
			$.toast({
				heading: 'Lembrete de aniversário',
				text: 'É hoje o aniversário de {{ $paciente->nome }}!',
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
				text: 'Faltam {{ $aniversario }} dias para o aniversário de {{ $paciente->nome }}.',
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
				text: 'O aniversário de {{ $paciente->nome }} é amanhã!',
				position: 'top-right',
				loaderBg:'#e69a2a',
				icon: 'warning',
				hideAfter: 8000, 
				stack: 6
			});
			
		});
	</script>
	
@endif