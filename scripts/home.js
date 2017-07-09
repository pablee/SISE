
//====================================================================================================
function cargarFormulario(valor)
	{	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("listado").innerHTML = this.responseText;									
				}						
			};
	
	switch (valor) 
		{
		case 1:
			document.getElementById("busquedas").innerHTML='Buscar persona<input id="buscarPersona" name="buscarPersona" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="buscarPersona(event)"></input>';				
			xhttp.open("GET", "php/persona/formularioPersona.php", true);
			document.getElementById("personaProceso").innerHTML="";
			document.getElementById("ultimosIngresos").innerHTML="";
			break;
		case 2:
			document.getElementById("busquedas").innerHTML='Buscar proceso<input id="buscarProceso" name="buscarProceso" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="buscarProceso(event)"></input>';
			document.getElementById("ultimosIngresos").innerHTML="";
			xhttp.open("GET", "php/proceso/formularioProceso.php", true);	
			break;
		case 3:
			//document.getElementById("ultimosIngresos").innerHTML="";
			//xhttp.open("GET", "php/detalle/formularioDetalle.php", true);
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


//====================================================================================================
function guardarPersona()
	{	
	var nombres=document.getElementById("nombres").value;
	var apellidos=document.getElementById("apellidos").value;
	var razon_social=document.getElementById("razon_social").value;
	var cod_tipo_dni=document.getElementById("cod_tipo_dni").value;
	var dni=document.getElementById("dni").value;
	var cuil=document.getElementById("cuil").value;
	var fec_nacimiento=document.getElementById("fec_nacimiento").value;
	var sexo=document.getElementById("sexo").value;
	var cod_nacionalidad=document.getElementById("cod_nacionalidad").value;
	var cod_estado_civil=document.getElementById("cod_estado_civil").value;
	var telefono=document.getElementById("telefono").value;
	var celular=document.getElementById("celular").value;
	var correo_personal_1=document.getElementById("correo_personal_1").value;
	var correo_personal_2=document.getElementById("correo_personal_2").value;
	var correo_laboral_1=document.getElementById("correo_laboral_1").value;
	var correo_laboral_2=document.getElementById("correo_laboral_2").value;
	var profesion=document.getElementById("profesion").value;
	var cod_categoria=document.getElementById("cod_categoria").value;
	var observaciones=document.getElementById("observaciones").value;
	
	//Direccion
	var domicilio=document.getElementById("domicilio").value;
	var calle=document.getElementById("calle").value;
	var numero=document.getElementById("numero").value;
	var piso=document.getElementById("piso").value;
	var departamento=document.getElementById("departamento").value;
	var torre=document.getElementById("torre").value;
	//var cod_localidad=document.getElementById("localidad").value;
	var cod_localidad=1;
	//var cod_partido=document.getElementById("partido").value;
	var cod_partido=1;
	//var cod_provincia=document.getElementById("provincia").value;
	var cod_provincia=1;
	var codigo_postal=document.getElementById("codigo_postal").value;
	var observaciones_direccion=document.getElementById("observaciones_direccion").value;
	
	//Accion (actualizar o guardar)
	var accion = document.getElementById("accion").value;
	
	xhttp = new XMLHttpRequest();	
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("listado").innerHTML = this.responseText;
			document.getElementById("buscar").value = "";
			}						
		};
	
	xhttp.open("GET",	"php/persona/guardarPersona.php?"+
						"nombres="+nombres+
						"&apellidos="+apellidos+
						"&razon_social="+razon_social+
						"&cod_tipo_dni="+cod_tipo_dni+
						"&dni="+dni+
						"&cuil="+cuil+
						"&fec_nacimiento="+fec_nacimiento+
						"&sexo="+sexo+
						"&cod_nacionalidad="+cod_nacionalidad+
						"&cod_estado_civil="+cod_estado_civil+
						"&telefono="+telefono+
						"&celular="+celular+
						"&correo_personal_1="+correo_personal_1+
						"&correo_personal_2="+correo_personal_2+
						"&correo_laboral_1="+correo_laboral_1+
						"&correo_laboral_2="+correo_laboral_2+
						"&profesion="+profesion+
						"&cod_categoria="+cod_categoria+
						"&observaciones="+observaciones+

						"&domicilio="+domicilio+
						"&calle="+calle+
						"&numero="+numero+
						"&piso="+piso+
						"&departamento="+departamento+
						"&torre="+torre+
						"&cod_localidad="+cod_localidad+
						"&cod_partido="+cod_partido+
						"&cod_provincia="+cod_provincia+
						"&codigo_postal="+codigo_postal+
						"&observaciones_direccion="+observaciones_direccion+
						"&accion="+accion, true);								
	xhttp.send();
	}


//====================================================================================================
function buscarPersona(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var buscar = document.getElementById("buscarPersona").value;
		//alert(buscar);
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
				{					
				if (this.readyState == 4 && this.status == 200)
						{
						document.getElementById("listado").innerHTML = this.responseText;
						document.getElementById("buscarPersona").value = "";
						}						
				};

		xhttp.open("GET", "php/persona/buscarPersona.php?buscar="+buscar, true);								
		xhttp.send();
		}
	}

//====================================================================================================
function buscarProceso(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var buscar = document.getElementById("buscarProceso").value;
		//alert(buscar);
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("listado").innerHTML = this.responseText;
				document.getElementById("buscarProceso").value = "";
				}						
			};

		xhttp.open("GET", "php/proceso/buscarProceso.php?buscar="+buscar, true);								
		xhttp.send();
		}
	}


//====================================================================================================
function elegirProceso(cod_persona)
	{	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("listado").innerHTML = this.responseText;
			document.getElementById("buscarProceso").value = "";
			}						
		};

	xhttp.open("GET", "php/proceso/elegirProceso.php?cod_persona="+cod_persona, true);								
	xhttp.send();
	}


//====================================================================================================
function guardarProceso(cod_proceso)
	{
	//alert(cod_proceso);
	var proceso = document.getElementById("proceso").value;	
	var cod_proceso_tipo = document.getElementById("cod_proceso_tipo").value;	
	var observaciones = document.getElementById("observaciones").value;	
	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
					{
					document.getElementById("listado").innerHTML=this.responseText;
					}						
			};
	xhttp.open("GET", "php/proceso/guardarProceso.php?cod_proceso="+cod_proceso+"&proceso="+proceso+"&cod_proceso_tipo="+cod_proceso_tipo+"&observaciones="+observaciones, true);								
	xhttp.send();	
	}	


//====================================================================================================
//Habilita el boton de busqueda de persona en el proceso
function habilitarBusqueda()
	{
	document.getElementById("buscarPersonaProceso").disabled=false;	
	}
	

//====================================================================================================
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
		document.getElementById("persona_condicion").value='';
		document.getElementById("buscarPersonaProceso").value='';
		}
	}		
		

//====================================================================================================
//Ver preguntas por proceso
function verPreguntasProceso(tipoProceso, cliente, oponente)
	{				
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("detalleTipo").innerHTML = this.response;
			}						
		};
	xhttp.open("GET", "php/proceso/verPreguntasProceso.php?tipoProceso="+tipoProceso+"&cliente="+cliente+"&oponente="+oponente, true);								
	xhttp.send();		
	}
	

	
	
	