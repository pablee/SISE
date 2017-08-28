
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
			//document.getElementById("busquedas").innerHTML='Buscar persona<input id="buscarPersona" name="buscarPersona" type="text" class="form-control" placeholder="Buscar por nombre o apellido" onkeypress="buscarPersona(event)"></input>';				
			xhttp.open("GET", "php/persona/formularioPersona.php", true);
			document.getElementById("personaProceso").innerHTML="";
			document.getElementById("ultimosIngresos").innerHTML="";
			break;
		case 2:
			//document.getElementById("busquedas").innerHTML='Buscar proceso<input id="buscarProceso" name="buscarProceso" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="buscarProceso(event)"></input>';
			document.getElementById("ultimosIngresos").innerHTML="";
			xhttp.open("GET", "php/proceso/formularioProceso.php", true);	
			break;
		case 3:
			document.getElementById("ultimosIngresos").innerHTML="";
			xhttp.open("GET", "php/proceso/informe.php", true);
			break;
		case 4:
			xhttp.open("GET", "php/persona/buscarPersonaProceso.php", true);
			break;
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
	//var domicilio=document.getElementById("domicilio").value;
	var calle=document.getElementById("calle").value;
	var numero=document.getElementById("numero").value;
	var piso=document.getElementById("piso").value;
	var departamento=document.getElementById("departamento").value;
	var torre=document.getElementById("torre").value;
	var cod_localidad=document.getElementById("cod_localidad").value;
	var cod_partido=document.getElementById("cod_partido").value;
	var cod_provincia=document.getElementById("cod_provincia").value;
	var codigo_postal=document.getElementById("codigo_postal").value;
	//No se utiliza
	//var observaciones_direccion=document.getElementById("observaciones_direccion").value;
	
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

						//"&domicilio="+domicilio+
						"&calle="+calle+
						"&numero="+numero+
						"&piso="+piso+
						"&departamento="+departamento+
						"&torre="+torre+
						"&cod_localidad="+cod_localidad+
						"&cod_partido="+cod_partido+
						"&cod_provincia="+cod_provincia+
						"&codigo_postal="+codigo_postal+						
						"&accion="+accion, true);								
	xhttp.send();
	}


//====================================================================================================
function buscarPersona(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var buscarPersonaNombre = document.getElementById("buscarPersonaNombre").value;
		var buscarPersonaApellido = document.getElementById("buscarPersonaApellido").value;
		var buscarPersonaDNI = document.getElementById("buscarPersonaDNI").value;
		
		//var buscar = [buscarPersonaNombre, buscarPersonaApellido, buscarPersonaDNI];
		//alert (buscar[0]);
		//alert (buscar[1]);
		//alert (buscar[2]);
		
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
				{					
				if (this.readyState == 4 && this.status == 200)
						{
						document.getElementById("listado").innerHTML = this.responseText;						
						}						
				};

		xhttp.open("GET", "php/persona/buscarPersona.php?buscarPersonaNombre="+buscarPersonaNombre
													+"&buscarPersonaApellido="+buscarPersonaApellido
													+"&buscarPersonaDNI="+buscarPersonaDNI, true);								
		xhttp.send();
		}
	}
	

//====================================================================================================
function elegirPersona(cod_persona)
	{
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("listado").innerHTML = this.responseText;
			}						
		};

	xhttp.open("GET", "php/persona/elegirPersona.php?cod_persona="+cod_persona, true);								
	xhttp.send();
	}
	
	
//====================================================================================================
function buscarProceso(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var buscarPersonaNombre = document.getElementById("buscarPersonaNombre").value;
		var buscarPersonaApellido = document.getElementById("buscarPersonaApellido").value;
		var buscarPersonaDNI = document.getElementById("buscarPersonaDNI").value;
		
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("listado").innerHTML = this.responseText;
				}						
			};

		xhttp.open("GET", "php/proceso/buscarProceso.php?buscarPersonaNombre="+buscarPersonaNombre
													+"&buscarPersonaApellido="+buscarPersonaApellido
													+"&buscarPersonaDNI="+buscarPersonaDNI, true);								
		xhttp.send();
		}
	}

//====================================================================================================
function buscarInforme(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{	
		var filtroDetalleTipoBoolean = document.getElementById("filtroDetalleTipoBoolean").value;
		var respuestaBoolean = document.getElementById("respuestaBoolean").value;
		var filtroDetalleTipo = document.getElementById("filtroDetalleTipo").value;
		var respuestaTexto = document.getElementById("respuestaTexto").value;
		
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("listado").innerHTML = this.responseText;
				}						
			};

		xhttp.open("GET", "php/proceso/buscarInforme.php?filtroDetalleTipoBoolean="+filtroDetalleTipoBoolean
													+"&respuestaBoolean="+respuestaBoolean
													+"&filtroDetalleTipo="+filtroDetalleTipo
													+"&respuestaTexto="+respuestaTexto, true);								
		xhttp.send();
		}
	}
	
	
//====================================================================================================
function elegirProceso(cod_persona,cod_proceso)
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

	xhttp.open("GET", "php/proceso/elegirProceso.php?cod_persona="+cod_persona+"&cod_proceso="+cod_proceso, true);	
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
	document.getElementById("buscarPersonaProcesoApellido").disabled=false;
	document.getElementById("buscarPersonaProcesoNombre").disabled=false;
	document.getElementById("buscarPersonaProcesoDNI").disabled=false;
	}
	

//====================================================================================================
//Busca una persona y devuelve el listado de personas encontradas
function buscarPersonaProceso(event)
	{
	if(event.which == 13 || event.keyCode == 13 || event==0)
		{
		var buscarPersonaProcesoNombre = document.getElementById("buscarPersonaProcesoNombre").value;
		var buscarPersonaProcesoApellido = document.getElementById("buscarPersonaProcesoApellido").value;
		var buscarPersonaProcesoDNI = document.getElementById("buscarPersonaProcesoDNI").value;
		
		xhttp = new XMLHttpRequest();			
		xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("personaEncontrada").innerHTML=this.responseText;
				}						
			};

		xhttp.open("GET", "php/persona/buscarPersonaProceso.php?buscarPersonaProcesoNombre="+buscarPersonaProcesoNombre
											+"&buscarPersonaProcesoApellido="+buscarPersonaProcesoApellido
											+"&buscarPersonaProcesoDNI="+buscarPersonaProcesoDNI	
											+"&persona_condicion="+persona_condicion, true);
		xhttp.send();	
		//document.getElementById("persona_condicion").value='';
		}
	}		
		

function agregarPersonaProceso(cod_persona)
	{
	var persona_condicion = document.getElementById("persona_condicion").value;		
	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
		{					
		if (this.readyState == 4 && this.status == 200)
			{
			document.getElementById("personaEncontrada").innerHTML="";
			var persona=this.responseText;
			var tabla = document.getElementById("personaElegida");
			var fila = tabla.insertRow(-1);
			fila.innerHTML=persona;
			}						
		};

	xhttp.open("GET", "php/persona/agregarPersonaProceso.php?cod_persona="+cod_persona
										+"&persona_condicion="+persona_condicion, true);
	xhttp.send();		
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
	

	
	
	