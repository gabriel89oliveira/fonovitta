
<script type="text/javascript">

	function confirmarAlta(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja dar alta fonoaudiologica para esse paciente? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/alta') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente recebeu alta!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								location.reload();
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}
		
		function confirmarSuspensao(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja suspender o atendimento fonoaudiologico desse paciente? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/suspensao') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente teve o atendimento suspendido!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								location.reload();
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}
		
		function confirmarObito(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'O paciente foi a óbito? Você não poderá mais recuperá-lo!',
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if(willDelete){
					
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax(
					{
						url: "{{ url('pacientes/obito') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Paciente teve o atendimento suspendido!',
								icon: 'success',
								button: false,
								closeOnClickOutside: false,
							});
							
							setTimeout(function () {
								window.location.href = "{{URL::to('pacientes')}}";
							}, 800);
							
						},
						error: function(xhr) {
							console.log(xhr.responseText); // this line will save you tons of hours while debugging
						}
					});
					
				}
			});
		   
		}

</script>