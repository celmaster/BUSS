/* Biblioteca de funcoes javascript
 *
 * Marcelo Barbosa,
 * setembro, 2016.
 */
 
  
 // variaveis globais 
var counter = 2;
var limit = -1;
var mainThread = null;
var carouselImageListId = "imageList";
  
 // declaracao de funcoes
 function exist(id)
 {
	 // verifica se um elemento existe
	 // declaracao de variaveis
	 var status = false;
	 
	 if(document.getElementById(id))
	 {
		 status = true;
	 }
	 
	 // retorno de valor
	 return status;
 }
 
 function setLimit(id)
 {
	 if(exist(id))
	 {
		 var obj = document.getElementById(id);
		 var array = obj.getElementsByTagName("li");
		 limit = array.length;
	 }
 }
 
 function toggleImage(index)
 {
	 // oculta uma imagem e torna visivel a proxima imagem
	 var id = "slide";
	 if(exist(id+index))
	 {
		var priorIndex = index - 1;
		var isnFirst = priorIndex > 0;
		var prior = null;
		var last = null;		
		
		var obj = document.getElementById(id+index);
		obj.setAttribute("class","show");
		 
		if(counter == limit)
		{
			counter = 1;			
		}else
			{
				counter++; 
			}		 		 
			
		if(isnFirst)
		{
			prior = document.getElementById(id+priorIndex);
			prior.setAttribute("class","hide");
		}else
			{
				last = document.getElementById(id+limit);
				last.setAttribute("class","hide");
			}
		
	 }
 }
 
 function carouselPlay(index)
 {	 	
	 // inicia a animacao do carrassel
	 if(limit == -1)
	 {
		 setLimit(carouselImageListId);
	 }else if(limit == 0)
			{
				clearInterval(mainThread);				
			}else
				{
					toggleImage(index);
				}
		
 }
 
 mainThread = window.setInterval(function (){carouselPlay(counter);}, 8000);
