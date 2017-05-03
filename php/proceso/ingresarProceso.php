<?php
session_start();
include_once "../../clases/proceso.php";

$proceso=$_GET["proceso"];
$cantidad_acompaniantes=$_GET["cantidad_acompaniantes"];
$cod_proceso_tipo=$_GET["cod_proceso_tipo"];
$observaciones=$_GET["observaciones"];
$usr_ult_modif=$_SESSION['cod_usuario'];
$fec_ult_modif=$_SESSION['fecha'];

$nuevoProceso=new Proceso();
$nuevoProceso->ingresarProceso($proceso, $cantidad_acompaniantes, $cod_proceso_tipo, $observaciones, $usr_ult_modif, $fec_ult_modif);
?>				