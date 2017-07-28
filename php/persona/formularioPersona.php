<?php
session_start();
include_once "../../clases/database.php";
include_once "../../clases/persona.php";

echo'
	<!--Menu: Buscar/Comandos-->
	<div class="row" id="busqueda">							
		<div class="col-sm-2 col-md-2 col-lg-2">
			
		</div>

		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaApellido" name="buscarPersonaApellido" type="text" class="form-control" placeholder="Buscar por apellido" onkeypress="buscarPersona(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaNombre" name="buscarPersonaNombre" type="text" class="form-control" placeholder="Buscar por nombre" onkeypress="buscarPersona(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaDNI" name="buscarPersonaDNI" type="text" class="form-control" placeholder="Buscar por DNI" onkeypress="buscarPersona(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<button type="button" class="btn btn-info" onclick="buscarPersona(0)"> 
				<span class="glyphicon glyphicon-search"></span> 
			</button>
		</div>
	</div>
	<hr>
	';
	
$persona = new Persona();
$persona->formularioPersona();

?>				