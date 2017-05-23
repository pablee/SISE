<?php
session_start();
include_once "../../clases/detalle.php";

$i=0;
$j=0;

echo $_SESSION["personas"][$i][$j];

/*
$detalle=new Detalle();
$cod_detalle=$_POST["cod_detalle"];
$cod_persona=$_POST["cod_persona"];
$cod_proceso=$_POST["cod_proceso"];
$observaciones=$_POST["observaciones"];
$usr_ult_modif=$_SESSION['cod_usuario'];
$fec_ult_modif=$_SESSION['fecha'];

for($i=1;$i<60;$i++)
	{
	if(isset($_POST["$i"]))
		{	
		echo $_POST[$i];
		$cod_detalle_tipo=$i;	//Pregunta
		$valor=$_POST[$i];	//Respuesta
		$detalle->ingresarDetalle($cod_detalle, $cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif);
		}
	}
*/		
?>