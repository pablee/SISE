<?php
session_start();
include "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$buscar=$_GET["buscar"];

$persona=new Persona();	
$persona->buscarPersona($buscar);
	
?>