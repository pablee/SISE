<?php
session_start();
include "../../clases/proceso.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$cod_persona=$_GET["cod_persona"];

$proceso=new Proceso();	
$proceso->editarProceso($cod_persona);
	
?>