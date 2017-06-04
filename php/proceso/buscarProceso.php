<?php
session_start();
include "../../clases/proceso.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$buscar=$_GET["buscar"];

$proceso=new Proceso();	
$proceso->buscarProceso($buscar);
	
?>