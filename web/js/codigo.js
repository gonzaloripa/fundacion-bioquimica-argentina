
function redirec(pag){

location.href=pag;

} 

	
function mostrar(obj){ 
		
		switch (obj.value) { 
   		
      	 case 'altaMetodo':
		 
		  $(".tablas").hide();
		 
		 $("#me").show();
		 break 
		 case 'altaCalibrador':
		 $(".tablas").hide();
		 
		 
		 $("#ca").show();
		 break 
		 case 'altaPapelFiltro':
		 
		  $(".tablas").hide();
		
		 $("#pf").show();
		 break 
		 case 'altaReactivo':
		 
		  $(".tablas").hide();
		 
		 $("#re").show();
		 break 
		 case 'altaDecision':
		 
		  $(".tablas").hide();
		 
		 $("#de").show();
		 break 
		 case 'altaInterpretacion':
		 
		  $(".tablas").hide();
		 
      	 $("#in").show();
		 break 
   		
		}
}

