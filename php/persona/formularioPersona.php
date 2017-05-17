<?php
session_start();
include_once "../../clases/database.php";
include_once "../../clases/persona.php";

$persona=new Persona();	
$persona->formularioPersona();

?>				