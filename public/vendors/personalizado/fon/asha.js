	
	function ASHA(){
		
		
		VAA 	= document.getElementById("vaa_ASHA_NOMS").value
		terapia = document.getElementById("inputTerapiaPrincipal").value
		conduta = document.getElementById("conduta").value
		atual 	= document.getElementById("ASHA_atual").value
		
		
		
		if(conduta == "Suspensão de dieta via oral"){
			
			if(terapia == "Treino via oral"){
				ASHA = 2;
			}else{
				ASHA = 1;
			}
			
		}else if(conduta == "Mantida" && atual != ""){
			
			ASHA = atual;
			
		}else if(conduta == "Mantida" && atual == ""){
			
			dieta 	= document.getElementById("dieta_inicial").value;
			liquido = document.getElementById("liquido_inicial").value;
			
			busca_ASHA(dieta,liquido,VAA);
			
		}else{

			dieta 	= document.getElementById("dieta").value;
			liquido = document.getElementById("liquido").value;
			
			busca_ASHA(dieta,liquido,VAA);
			
		}
		
		
		switch (ASHA){
		
			case 1:
				comentario = "O indivíduo não é capaz de deglutir nada por VO, SNE/PEG exclusivas.";
				break;
				
			case 2:
				comentario = "O indivíduo não é capaz de deglutir nada por VO com segurança, porém, pode ingerir alguma consistência VO durante a terapia, uso máximo de pistas, via alternativa de alimentação (VAA) é necessária.";
				break;
				
			case 3:
				comentario = "VAA é necessária uma vez que o paciente ingere menos que 50% de nutrição e hidratação por VO; e/ou a deglutição é segura com o uso moderado de pistas e estratégias compensatórias; e/ou necessita de restrição máxima da dieta.";
				break;
			
			case 4:
				comentario = "A deglutição é segura com o uso moderado de pistas e estratégias compensatórias; e/ou restrições moderadas de dieta; e/ou necessita de alimentação por VAA ou suplemento alimentar.";
				break;
				
			case 5:
				comentario = "A deglutição é segura com restrições mínimas da dieta; e/ou ocasionalmente requer pistas mínimas para uso de estratégias compensatórias. Ocasionalmente pode se auto monitorar. Toda nutrição e hidratação são recebidas pela boca durante a refeição.";
				break;
				
			case 6:
				comentario = "A deglutição é segura e o indivíduo come e bebe independentemente. Raramente necessita de pistas mínimas para uso de estratégias compensatórias. Frequentemente se auto monitora quando ocorrem dificuldades. Pode ser necessário evitar alguns itens específicos de alimentos (ex.: pipoca e amendoim); tempo adicional para alimentação pode ser necessário (devido à disfagia).";
				break;
				
			case 7:
				comentario = "A habilidade do indivíduo em se alimentar independentemente não é limitada pela função de deglutição. A deglutição é segura e eficiente para todas as consistências. Estratégias compensatórias são utilizadas efetivamente quando necessárias.";
				break;
				
			case "":
				comentario = "";
				break;
				
		}

		
		document.getElementById("comentarioASHA").innerHTML = "<h3>" + ASHA + "</h3> <i>" + comentario + "</i>";
		document.getElementById("inputASHA_NOMS").value = ASHA;
		
		
	}
	
	
	function busca_ASHA(dieta,liquido,VAA){
		
		if (dieta == "Pastosa homogênea"){
			
			switch (liquido){
				
				// COMPARAR COM VAA NO CASO DE SER LIQUIDO FINO
				case "Líquido Fino":
					if( VAA == 'SNE' || VAA == 'PEG' || VAA == 'Via mista' ){
						ASHA = 3;						
					}else{
						ASHA = 4;
					}
					break;
					
				case "Líquido Néctar":
					ASHA = 3;
					break;
					
				case "Líquido Mel":
					ASHA = 3;
					break;
					
				case "Líquido Pudim":
					ASHA = 3;
					break;
				
				case "Suspenso":
					ASHA = 3;
					break;
					
			}
			
		}else if(dieta == "Pastosa heterogênea"){
			
			switch (liquido){
				
				case "Líquido Fino":
					ASHA = 4;
					break;
					
				case "Líquido Néctar":
					ASHA = 4;
					break;
					
				case "Líquido Mel":
					ASHA = 3;
					break;
					
				case "Líquido Pudim":
					ASHA = 3;
					break;
				
				case "Suspenso":
					ASHA = 3;
					break;
					
			}
			
		}else if(dieta == "Pastosa (semissólida)"){
			
			switch (liquido){
				
				case "Líquido Fino":
					ASHA = 5;
					break;
					
				case "Líquido Néctar":
					ASHA = 5;
					break;
					
				case "Líquido Mel":
					ASHA = 4;
					break;
					
				case "Líquido Pudim":
					ASHA = 4;
					break;
				
				case "Suspenso":
					ASHA = 3;
					break;
					
			}
			
		}else if(dieta == "Branda"){
			
			switch (liquido){
				
				case "Líquido Fino":
					ASHA = 6;
					break;
					
				case "Líquido Néctar":
					ASHA = 5;
					break;
					
				case "Líquido Mel":
					ASHA = 5;
					break;
					
				case "Líquido Pudim":
					ASHA = 5;
					break;
					
				case "Suspenso":
					ASHA = 3;
					break;
					
			}
			
		}else if(dieta == "Geral"){
			
			switch (liquido){
				
				case "Líquido Fino":
					ASHA = 7;
					break;
					
				case "Líquido Néctar":
					ASHA = 5;
					break;
					
				case "Líquido Mel":
					ASHA = 5;
					break;
					
				case "Líquido Pudim":
					ASHA = 5;
					break;
					
				case "Suspenso":
					ASHA = 3;
					break;
					
			}
			
		}
		
		return ASHA;
		
	}