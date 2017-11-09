
<script type="text/javascript">
		
	function confirmarDeletar(id)
	{
		
		swal({
			title: 'Confirmar?',
			text: 'Deseja deletar essa terapia? Você não poderá mais recuperá-la!',
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
					url: "{{ url('terapia/deletar') }}"+"/"+id,
					type: 'delete',
					dataType: "JSON",
					data: {
						"id": id
					},
					success: function ()
					{
						swal({
							text: 'Feito! Terapia excluída!',
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