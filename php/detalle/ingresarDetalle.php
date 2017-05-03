<?php
session_start();
include_once "../../clases/detalle.php";

echo $cod_detalle=$_GET["cod_detalle"];
echo $cod_persona=$_GET["cod_persona"];
echo $cod_proceso=$_GET["cod_proceso"];
echo $cod_detalle_tipo=$_GET["cod_detalle_tipo"];
//$valor=$_GET["valor"];
$valor="1";
echo $observaciones=$_GET["observaciones"];
echo $usr_ult_modif=$_SESSION['cod_usuario'];
echo $fec_ult_modif=$_SESSION['fecha'];

$detalle=new Detalle();
$detalle->ingresarDetalle($cod_detalle, $cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif);

?>		