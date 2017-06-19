<?php
session_start();
include "../../clases/persona.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$nombres=$_GET["nombres"];
$apellidos=$_GET["apellidos"];
$cod_tipo_dni =$_GET["cod_tipo_dni"];
$dni=$_GET["dni"];
$cuil=$_GET["cuil"];
$fec_nacimiento=$_GET["fec_nacimiento"];
$sexo=$_GET["sexo"];
$cod_nacionalidad=$_GET["cod_nacionalidad"];
$cod_estado_civil=$_GET["cod_estado_civil"];
$telefono=$_GET["telefono"];
$codigo_postal=$_GET["codigo_postal"];
$profesion=$_GET["profesion"];
$cod_categoria=$_GET["cod_categoria"];
$observaciones=$_GET["observaciones"];
$usr_ult_modif=$_SESSION['cod_usuario'];
$fec_ult_modif=$_SESSION['fecha'];
if(isset($_POST["accion"]))
	{
	$accion=$_POST["accion"];
	}
	else{
		$accion="nuevo_ingreso";
		}
	 
$persona = new Persona();	
if($accion=="actualizar")
	{
	$persona->actualizarPersona($nombres, $apellidos, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_GETal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif);
	}
	else if($accion=="nuevo_ingreso")
		{
		$persona->ingresarPersona($nombres, $apellidos, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif);
		}

echo '<h2>La persona '.$nombres." ".$apellidos.' fue ingresada con exito</h2>';
echo '
	 <a href="home.php">
		<input type = "button" class = "btn btn-success" value = "Volver">
	 </a>
	 ';		

//echo "<p>".$nombres.$apellidos."</p>";

?>