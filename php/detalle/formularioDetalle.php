<?php
session_start();
include_once "../../clases/detalle.php";

$detalle=new Detalle();
$detalle->nuevoDetalle();
?>	