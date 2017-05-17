<?php
session_start();
include_once "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
		
echo 'HOLAAAAAAAAAAAAAA';
	  
?>