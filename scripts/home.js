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
						document.getElementById("listado").innerHTML=this.responseText;
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
			xhttp.open("GET", "php/detalle/formularioDetalle.php", true);
			break;
		case 4:
			xhttp.open("GET", "php/persona/buscarPersonaProceso.php", true);
			break;
		case 5:
			day = "Friday";
			break;
		case 6:
			day = "Saturday";
		} 		
	xhttp.send();	
	}	

	
function guardarProceso()
	{
	var proceso = document.getElementById("proceso").value;	
	var cantidad_acompaniantes = document.getElementById("cantidad_acompaniantes").value;	
	var cod_proceso_tipo = document.getElementById("cod_proceso_tipo").value;	
	var observaciones = document.getElementById("observaciones").value;	
	
	//alert(proceso+cantidad_acompaniantes+cod_proceso_tipo+observaciones);
	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
					{
					document.getElementById("listado").innerHTML=this.responseText;
					}						
			};
	xhttp.open("GET", "php/proceso/ingresarProceso.php?proceso="+proceso+"&cantidad_acompaniantes="+cantidad_acompaniantes+"&cod_proceso_tipo="+cod_proceso_tipo+"&observaciones="+observaciones, true);								
	xhttp.send();	
	}	
	

function guardarDetalle()
	{		
	var cod_detalle = document.getElementById("cod_detalle").value;	
	var cod_persona = document.getElementById("persona").value;	
	var cod_proceso = document.getElementById("proceso").value;
	var cod_detalle_tipo = document.getElementById("detalle_tipo").value;
	//var valor = document.getElementById("valor").value;
	var observaciones = document.getElementById("observaciones").value;	
	alert("Guardar Detalle");
	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
					{
					document.getElementById("listado").innerHTML=this.responseText;
					}						
			};
	//xhttp.open("GET", "php/detalle/ingresarDetalle.php?cod_detalle="+cod_detalle+"&cod_persona="+cod_persona+"&cod_proceso="+cod_proceso+"&cod_detalle_tipo="+cod_detalle_tipo+"&valor="+valor+"&observaciones="+observaciones, true);								
	xhttp.open("GET", "php/detalle/ingresarDetalle.php?cod_detalle="+cod_detalle+"&cod_persona="+cod_persona+"&cod_proceso="+cod_proceso+"&cod_detalle_tipo="+cod_detalle_tipo+"&observaciones="+observaciones, true);								
	xhttp.send();	
	}	

	
//Agrega un campo de busqueda para agregar una persona a un proceso
function buscarPersonaProceso()
	{		
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
					{
					document.getElementById("buscarPersonaProceso").innerHTML+=this.responseText;
					}						
			};
	xhttp.open("GET", "php/persona/buscarPersonaProceso.php", true);								
	xhttp.send();	
	}		


//Agrega una persona a un proceso	
function agregarPersonaProceso(event, id)
	{		
	//alert(event+id);			
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{
		var buscarPersona = document.getElementById("agregar"+id).value;	
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("persona"+id).innerHTML=this.response;
				}						
			};
		xhttp.open("GET", "php/persona/agregarPersonaProceso.php?buscarPersona="+buscarPersona, true);								
		xhttp.send();	
		}
	}		
		

//Ver preguntas por proceso
function verPreguntasProceso(tipoProceso, cliente, oponente)
	{				
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("detalleTipo").innerHTML=this.response;
			}						
		};
	xhttp.open("GET", "php/proceso/verPreguntasProceso.php?tipoProceso="+tipoProceso+"&cliente="+cliente+"&oponente="+oponente, true);								
	xhttp.send();		
	}
	
	
	
	
	
	
	