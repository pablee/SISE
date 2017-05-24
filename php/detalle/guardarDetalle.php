<?php
session_start();
include_once "../../clases/detalle.php";
include_once "../../clases/proceso.php";

$nuevoProceso=new Proceso();
$detalle=new Detalle();
$cod_proceso=$_SESSION["cod_proceso"];
$observaciones="observaciones";
$usr_ult_modif=$_SESSION['cod_usuario'];
$fec_ult_modif=$_SESSION['fecha'];
//$i=0;
/*
foreach ($_SESSION["personas"] as $pers)
	{
	echo "contador(posicion):".$i."/";
	echo "cod_persona:".$pers[0][0];//cod_persona
	echo "condicion de persona:".$pers[0][1];//condicion de persona (cliente, oponente, etc...)
	echo "<br>";
	$i++;
	}
*/
foreach($_SESSION["personas"] as $pers)
	{	
	if($pers[0][1]==2)//condicion de persona (cliente, oponente, etc...) es igual a 2(Cliente)
		{
		$codigo_persona=$pers[0][0];//cod_persona
		}
	echo $cod_persona=$pers[0][0];
	echo $cod_persona_condicion=$pers[0][1];
	$orden="orden";
	//Insert tabla Persona-Condicion-Proceso(guarda la relacion de una o mas personas, clientes u oponentes, con un proceso)
	$nuevoProceso->guardarPersCondProc($cod_proceso, $cod_persona, $cod_persona_condicion, $orden, $observaciones, $usr_ult_modif, $fec_ult_modif);
	$i++;
	}
	
$cod_persona=$codigo_persona;

for($i=1;$i<60;$i++)
	{
	if(isset($_POST["$i"]))
		{	
		echo $_POST[$i];
		echo $cod_detalle_tipo=$i;	//Pregunta
		echo $valor=$_POST[$i];	//Respuesta
		$detalle->ingresarDetalle($cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif);
		}
	}	

session_unset();
header ("location: ../../home.php");
?>