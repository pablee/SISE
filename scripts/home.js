function ingresarPersona()
	{	
	var nombres=document.getElementById("nombres").value;
	var apellidos=document.getElementById("apellidos").value;
	var cod_tipo_dni=document.getElementById("cod_tipo_dni").value;
	var dni=document.getElementById("dni").value;
	var cuil=document.getElementById("cuil").value;
	var fec_nacimiento=document.getElementById("fec_nacimiento").value;
	var sexo=document.getElementById("sexo").value;
	var cod_nacionalidad=document.getElementById("cod_nacionalidad").value;
	var cod_estado_civil=document.getElementById("cod_estado_civil").value;
	var telefono=document.getElementById("telefono").value;
	var codigo_postal=document.getElementById("codigo_postal").value;
	var profesion=document.getElementById("profesion").value;
	var cod_categoria=document.getElementById("cod_categoria").value;
	var observaciones=document.getElementById("observaciones").value;
	
	xhttp = new XMLHttpRequest();	
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("listado").innerHTML=this.responseText;
			document.getElementById("buscar").value="";
			}						
		};
	
	xhttp.open("GET", "php/persona/ingresarPersona.php?nombres="+nombres+"&apellidos="+apellidos+"&cod_tipo_dni="+cod_tipo_dni+"&dni="+dni+"&cuil="+cuil+"&fec_nacimiento="+fec_nacimiento+"&sexo="+sexo+"&cod_nacionalidad="+cod_nacionalidad+"&cod_estado_civil="+cod_estado_civil+"&telefono="+telefono+"&codigo_postal="+codigo_postal+"&profesion="+profesion+"&cod_categoria="+cod_categoria+"&observaciones="+observaciones, true);								
	xhttp.send();
	
	alert(nombres);
	}


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
						document.getElementById("buscar").value="";
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
					document.getElementById("buscar").value="";
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
	xhttp.open("GET", "php/proceso/guardarProceso.php?proceso="+proceso+"&cod_proceso_tipo="+cod_proceso_tipo+"&observaciones="+observaciones, true);								
	xhttp.send();	
	}	


//Habilita el boton de busqueda de persona en el proceso
function habilitarBusqueda()
	{
	document.getElementById("buscarPersonaProceso").disabled=false;	
	}
	
	
//Busca una persona y devuelve el listado de personas encontradas
function buscarPersonaProceso(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{
		var persona_condicion = document.getElementById("persona_condicion").value;		
		var buscarPersonaProceso = document.getElementById("buscarPersonaProceso").value;	
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				var persona=this.responseText;
				var tabla = document.getElementById("personaEncontrada");
				var fila = tabla.insertRow(-1);
				fila.innerHTML=persona;
				}						
			};
		xhttp.open("GET", "php/persona/buscarPersonaProceso.php?buscarPersonaProceso="+buscarPersonaProceso+"&persona_condicion="+persona_condicion, true);
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
	

	
	
	