<?php
session_start();
include "../clases/database.php";

if($_SESSION['login'] == FALSE)
		{
		header("location: index.php");	
		}

$usuario = $_POST['usuario'];
$password = $_POST['password'];
if(isset($_POST['recordar']))
	{
	$recordar = $_POST['recordar']; 
	}
$_SESSION['login'] = FALSE;

$db = new database();
$db->conectar();

$consulta = "SELECT * FROM bsd_usuario WHERE usuario = '$usuario' AND password = '$password';";
$resultado = mysqli_query($db->conexion, $consulta) or die ("Fallo la consulta, no se puede validar el usuario");
$datos = mysqli_fetch_assoc($resultado);

if (1 == mysqli_num_rows($resultado))
	{
	if ($recordar == "si")
		{	
		//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("usuario", $usuario, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("password", $password, time() + (86400 * 30), "/"); // 86400 = 1 day
		}
		else if($recordar == "no")
				{
				//set the expiration date to one hour ago
				setcookie("usuario", "", time() - 3600, "/");				
				setcookie("password", "", time() - 3600, "/");
				}
		
	$_SESSION['login'] = TRUE;
	$_SESSION['usuario'] = $datos['usuario'];
	$_SESSION['cod_usuario'] = $datos['cod_usuario'];
	
	header("location: ../home.php");
	$_SESSION["mensaje"]="";
	}
	else{
		$_SESSION["mensaje"]="usuario o contraseña incorrecto";
		header("location: ../index.php");
		}

?>