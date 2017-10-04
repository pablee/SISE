<?php
session_start();
include_once "../../clases/proceso.php";

//Guardar proceso.
$cod_proceso = $_GET["cod_proceso"];
$proceso = $_GET["proceso"];
$cod_proceso_tipo = $_GET["cod_proceso_tipo"];
$observaciones = $_GET["observaciones"];
$ultimas_novedades = $_GET["ultimas_novedades"];
$usr_ult_modif = $_SESSION['cod_usuario'];
$fec_ult_modif = $_SESSION['fecha'];

//Se guardan los datos del proceso y la funcion devuelve el id del ultimo ingreso(el cod_proceso es usado en otras tablas).
$nuevoProceso = new Proceso();
if($cod_proceso==0)
	{
	echo "guardo el proceso";
	$cod_proceso = $nuevoProceso->guardarProceso($proceso, $cod_proceso_tipo, $observaciones, $ultimas_novedades, $usr_ult_modif, $fec_ult_modif);
	}
	else
		{
		echo "actualizo el proceso";
		$cod_proceso = $nuevoProceso->actualizarProceso($cod_proceso, $proceso, $cod_proceso_tipo, $observaciones, $ultimas_novedades, $usr_ult_modif, $fec_ult_modif);
		}
		
$_SESSION["cod_proceso"] = $cod_proceso;	

?>				