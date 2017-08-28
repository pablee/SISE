<?php
session_start();
include "../../clases/proceso.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}

$filtroDetalleTipoBoolean = $_GET["filtroDetalleTipoBoolean"];
$respuestaBoolean = $_GET["respuestaBoolean"];
$filtroDetalleTipo = $_GET["filtroDetalleTipo"];
$respuestaTexto = $_GET["respuestaTexto"];

$buscar = array($filtroDetalleTipoBoolean, $respuestaBoolean, $filtroDetalleTipo, $respuestaTexto);

$proceso = new Proceso();	
$proceso->buscarInforme($buscar);
	
?>