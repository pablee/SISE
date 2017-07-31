<?php
session_start();
include "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}

$buscar = $_GET["cod_persona"];

$persona = new Persona();	
$persona->buscarPersona($buscar);
	
?>