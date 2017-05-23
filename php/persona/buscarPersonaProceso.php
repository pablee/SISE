<?php
session_start();
include_once "../../clases/persona.php";

$persona_condicion=$_GET["persona_condicion"];	
$buscarPersonaProceso=$_GET["buscarPersonaProceso"];	
$persona=new Persona();
$persona->buscarPersonaProceso($buscarPersonaProceso,$persona_condicion);
	  
?>