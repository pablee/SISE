<?php
session_start();
include_once "../../clases/persona_condicion.php";
if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
		
echo '<div class="alert alert-info alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		<div class="panel-body">
			<div class="col-sm-4 col-md-4 col-lg-4" id="persona'.$_SESSION['count'].'">
				<label for="agregar"> Buscar	</label>	
				<input id="agregar'.$_SESSION['count'].'" name="buscar" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="agregarPersonaProceso(event,'.$_SESSION['count'].')"></input>					
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2">
				<br>					
				<button type="button" class="btn btn-info" onclick="agregarPersonaProceso(0,'.$_SESSION['count'].')"> 
					<span class="glyphicon glyphicon-search"></span> 
				</button>			
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2">';
				$personaCondicion = new PersonaCondicion();	 
				$personaCondicion->verPersonaCondicion();							
echo '		</div>
		</div>
	  </div>';	
	  
$_SESSION['count']++;	  
?>