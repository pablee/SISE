<?php
session_start();
include "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$buscar=$_GET["buscar"];

/*
echo"
	<label>Valor ingresado: </label> ".$buscar."<br>
	<a href='home.php'>
		<input type = 'button' class = 'btn btn-success' value = 'Volver'>
	</a>
	";
*/

$persona=new Persona();	
$persona->verPersona($buscar);
	
?>