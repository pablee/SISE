<?php
session_start();
include_once "../../clases/proceso.php";

//Guardar proceso.
$proceso=$_GET["proceso"];
$cod_proceso_tipo=$_GET["cod_proceso_tipo"];
$observaciones=$_GET["observaciones"];
$usr_ult_modif=$_SESSION['cod_usuario'];
$fec_ult_modif=$_SESSION['fecha'];

//Se guardan los datos del proceso y la funcion devuelve el id del ultimo ingreso(el cod_proceso es usado en otras tablas).
$nuevoProceso=new Proceso();
$cod_proceso=$nuevoProceso->guardarProceso($proceso, $cod_proceso_tipo, $observaciones, $usr_ult_modif, $fec_ult_modif);
$_SESSION["cod_proceso"]=$cod_proceso;

//Guardar Persona-Condicion-Proceso
//$nuevoProceso->guardarPersCondProc($cod_proceso, $cod_persona, $cod_persona_condicion, $orden, $observaciones, $usr_ult_modif, $fec_ult_modif);

?>				