<?php
session_start();
include_once "../../clases/persona.php";

$buscarPersonaProcesoNombre = $_GET["buscarPersonaProcesoNombre"];
$buscarPersonaProcesoApellido = $_GET["buscarPersonaProcesoApellido"];
$buscarPersonaProcesoDNI = $_GET["buscarPersonaProcesoDNI"];
$persona_condicion = $_GET["persona_condicion"];	

$buscarPersonaProceso = array($buscarPersonaProcesoNombre, $buscarPersonaProcesoApellido, $buscarPersonaProcesoDNI);

$persona = new Persona();
$cod_persona = $persona->buscarPersonaProceso($buscarPersonaProceso,$persona_condicion);

?>