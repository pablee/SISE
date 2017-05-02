function buscarPersona(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var buscar = document.getElementById("buscar").value;
		//alert(buscar);
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
				{					
				if (this.readyState == 4 && this.status == 200)
						{
						document.getElementById("personaProceso").innerHTML=this.responseText;
						}						
				};

		xhttp.open("GET", "php/persona/buscarPersona.php?buscar="+buscar, true);								
		xhttp.send();
		}
	}
	
function cargarFormulario(valor)
	{	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
					{
					document.getElementById("listado").innerHTML=this.responseText;					
					}						
			};
	
	switch (valor) 
		{
		case 1:
			xhttp.open("GET", "php/persona/formularioPersona.php", true);
			document.getElementById("personaProceso").innerHTML="";	
			break;
		case 2:
			xhttp.open("GET", "php/proceso/formularioProceso.php", true);	
			break;
		case 3:
			day = "Wednesday";
			break;
		case 4:
			day = "Thursday";
			break;
		case 5:
			day = "Friday";
			break;
		case 6:
			day = "Saturday";
		} 

		
	xhttp.send();	
	}	