<?php
session_start();
include_once "../../clases/persona.php";

$cod_persona = $_GET["cod_persona"];
$persona_condicion = $_GET["persona_condicion"];	

$persona = new Persona();
$persona->agregarPersonaProceso($cod_persona,$persona_condicion);

//Array que almacena la persona buscada (DNI) y la condicion (cliente, oponente...).
if($cod_persona!=0)
	{
	$_SESSION["personas"][$_SESSION["i"]] = array(array($cod_persona,$persona_condicion));
	$_SESSION["i"]++;
	}

?>