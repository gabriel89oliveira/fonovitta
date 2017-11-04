

// ------- VALORES PARA TERAPIA -------------------------------------------------------------------------------
		
	function mantida(){
		
		// DIETAS
		var dieta = document.getElementById('inputDieta');
		dieta.style.display = 'none';
		
		var dietaAtual = document.getElementById('dietaAtual');
		dietaAtual.style.display = 'block';
		dietaAtual.value = "Dieta atual";
		
		
		// LIQUIDOS
		var liquido = document.getElementById('inputLiquido');
		liquido.style.display = 'none';
		
		var liquidoAtual = document.getElementById('liquidoAtual');
		liquidoAtual.style.display = 'block';
		liquidoAtual.value = "Liquido atual";
		
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'none';
		
		var comentarioAtual = document.getElementById('comentarioAtual');
		comentarioAtual.style.display = 'block';
		
	}

	function suspenso(){
		
		// DIETAS
		var dieta = document.getElementById('inputDieta');
		dieta.style.display = 'none';
		
		var dietaAtual = document.getElementById('dietaAtual');
		dietaAtual.style.display = 'block';
		dietaAtual.value = "Dieta suspensa";
		
		
		// LIQUIDOS
		var liquido = document.getElementById('inputLiquido');
		liquido.style.display = 'none';
		
		var liquidoAtual = document.getElementById('liquidoAtual');
		liquidoAtual.style.display = 'block';
		liquidoAtual.value = "Liquido suspenso";
		
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'block';
		
		var comentarioAtual = document.getElementById('comentarioAtual');
		comentarioAtual.style.display = 'none';
		
	}
	
	function nova(){
		
		// DIETAS
		var dieta = document.getElementById('inputDieta');
		dieta.style.display = 'block';
		var dietaAtual = document.getElementById('dietaAtual');
		dietaAtual.style.display = 'none';
		
		// LIQUIDOS
		var liquido = document.getElementById('inputLiquido');
		liquido.style.display = 'block';
		var liquidoAtual = document.getElementById('liquidoAtual');
		liquidoAtual.style.display = 'none';
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'block';
		var comentarioAtual = document.getElementById('comentarioAtual');
		comentarioAtual.style.display = 'none';
		
	}
	
	
	function Conduta(){
	
		conduta = document.getElementById("inputConduta").value
		
		if(conduta == "Mantida"){
			mantida();
		}else if(conduta == "Suspensão de dieta via oral"){
			suspenso();
		}else{
			nova();
		}
		
	}
	
	
	
// ------- VALORES PARA AVALIAÇÃO -------------------------------------------------------------------------------
	
	function mantida2(){
		
		// DIETAS
		var dieta = document.getElementById('dieta');
		dieta.style.display = 'none';
		dieta.value = document.getElementById('inputDietaAtual');
		
		
		// LIQUIDOS
		var liquido = document.getElementById('liquido');
		liquido.style.display = 'none';
		liquido.value = document.getElementById('inputLiquidoAtual');
		
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'none';
		
	}

	function suspenso2(){
		
		// DIETAS
		var dieta = document.getElementById('dieta');
		dieta.style.display = 'none';
		
		
		// LIQUIDOS
		var liquido = document.getElementById('liquido');
		liquido.style.display = 'none';
		
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'block';
		
	}
	
	function nova2(){
		
		// DIETAS
		var dieta = document.getElementById('dieta');
		dieta.style.display = 'block';
		
		// LIQUIDOS
		var liquido = document.getElementById('liquido');
		liquido.style.display = 'block';
		
		// COMENTARIO
		var comentario = document.getElementById('inputComentario');
		comentario.style.display = 'block';
		
	}
	
	
	function Conduta2(){
	
		alert('ola');
		conduta = document.getElementById("conduta").value;
		
		if(conduta == "Mantida"){
			mantida2();
		}else if(conduta == "Suspensão de dieta via oral"){
			suspenso2();
		}else{
			nova2();
		}
		
	}