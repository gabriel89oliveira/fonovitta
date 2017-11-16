	<script type="text/javascript">
			
		
		function confirmarFinalizar(id)
		{
			
			swal({
				title: 'Confirmar?',
				text: 'Deseja finalizar esse ticket?',
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
						url: "{{ url('sugestoes/finalizar') }}"+"/"+id,
						type: 'delete',
						dataType: "JSON",
						data: {
							"id": id
						},
						success: function ()
						{
							swal({
								text: 'Feito! Ticket finalizado!',
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
		
	</script>