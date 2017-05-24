<?php
session_start();
include_once "../../clases/persona.php";

$buscarPersonaProceso=$_GET["buscarPersonaProceso"];
$persona_condicion=$_GET["persona_condicion"];	

$persona=new Persona();
$cod_persona=$persona->buscarPersonaProceso($buscarPersonaProceso,$persona_condicion);

//Array que almacena la persona buscada (DNI) y la condicion (cliente, oponente...)
$_SESSION["personas"][$_SESSION["i"]]=array(array($cod_persona,$persona_condicion));
$_SESSION["i"]++;
?>