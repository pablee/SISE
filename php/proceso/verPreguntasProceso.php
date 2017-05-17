<?php
session_start();
include_once "../../clases/detalle_tipo.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$tipoProceso=$_GET["tipoProceso"];
//$cliente=$_GET["cliente"];
//$oponente=$_GET["oponente"];
$cliente="2";
$oponente="3";
$preguntas = new DetalleTipo();	
$preguntas->verDetalleTipo($tipoProceso, $cliente, $oponente);
	
?>