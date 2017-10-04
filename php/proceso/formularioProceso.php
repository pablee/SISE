<?php
session_start();
include_once "../../clases/proceso.php";

echo'
	<!--Menu: Buscar/Comandos-->
	<div class="row" id="busqueda">							
		<div class="col-sm-2 col-md-2 col-lg-2">
			
		</div>

		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaApellido" name="buscarPersonaApellido" type="text" class="form-control" placeholder="Buscar por apellido" onkeypress="buscarProceso(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaNombre" name="buscarPersonaNombre" type="text" class="form-control" placeholder="Buscar nombre o razon social" onkeypress="buscarProceso(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<input id="buscarPersonaDNI" name="buscarPersonaDNI" type="text" class="form-control" placeholder="Buscar por DNI" onkeypress="buscarProceso(event)"></input>
		</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">
			<button type="button" class="btn btn-info" onclick="buscarProceso(0)"> 
				<span class="glyphicon glyphicon-search"></span> 
			</button>
		</div>
	</div>
	<hr>
	';
	
$proceso = new Proceso();
$proceso->nuevoProceso();
?>				