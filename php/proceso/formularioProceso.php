<?php
session_start();
include_once "../../clases/proceso.php";

$proceso = new Proceso();
$proceso->nuevoProceso();
?>				