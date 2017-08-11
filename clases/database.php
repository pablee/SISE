<?php
require "dbconfig.php";

class database	
{
	public $conexion;
	public $validar;
					
	public function __construct(){}
	
	public function conectar() 
	{
		$this->conexion = mysqli_connect(server, user, password, database)
		or die('No se pudo conectar a la base '  . mysqli_error($this->conexion));
		//echo "Conectado a la base";
		$this->conexion->set_charset("utf8");
		mysql_query("SET NAMES 'utf8'");
	}

	public function close()	
	{
		mysqli_close($this->conexion);
	}
}		
?>