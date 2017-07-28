<?php
session_start();
include "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}

$buscarPersonaNombre = $_GET["buscarPersonaNombre"];
$buscarPersonaApellido = $_GET["buscarPersonaApellido"];
$buscarPersonaDNI = $_GET["buscarPersonaDNI"];
$buscar = array($buscarPersonaNombre, $buscarPersonaApellido, $buscarPersonaDNI);

$persona = new Persona();	
$persona->buscarPersona($buscar);
	
?>