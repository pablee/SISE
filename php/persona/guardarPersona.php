<?php
session_start();
include "../../clases/persona.php";
include_once "../../clases/direccion.php";

if($_SESSION['login'] == FALSE)
	{
	header("location: ../../index.php");	
	}
	
$nombres=$_GET["nombres"];
$apellidos=$_GET["apellidos"];
$razon_social=$_GET["razon_social"];
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

//Direccion.
$domicilio=$_GET["domicilio"];
$calle=$_GET["calle"];
$numero=$_GET["numero"];
$piso=$_GET["piso"];
$departamento=$_GET["departamento"];
$torre=$_GET["torre"];
$cod_localidad=$_GET["cod_localidad"];
$cod_partido=$_GET["cod_partido"];
$cod_provincia=$_GET["cod_provincia"];
$codigo_postal=$_GET["codigo_postal"];
$observaciones_direccion=$_GET["observaciones_direccion"];

//Define la accion a realizar en el metodo.
$accion=$_GET["accion"];

$persona = new Persona();
$direccion = new Direccion();	

if($accion=="actualizar")
	{
	$accion = "actualizada";
	$persona->actualizarPersona($nombres, $apellidos, $razon_social, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif);
	}
	else if($accion=="nuevo_ingreso")
		{
		$accion = "ingresada";
		$persona->guardarPersona($nombres, $apellidos, $razon_social, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif);
		$direccion->guardarDireccion($domicilio,$calle,$numero,$piso,$departamento,$torre,$cod_localidad,$cod_partido,$cod_provincia,$codigo_postal,$observaciones_direccion,$usr_ult_modif,$fec_ult_modif);
		}

echo '<h2>La persona '.$nombres." ".$apellidos.' fue '.$accion.' con exito</h2>';
echo '
	 <a href="home.php">
		<input type = "button" class = "btn btn-success" value = "Volver">
	 </a>
	 ';		

//echo "<p>".$nombres.$apellidos."</p>";

?>