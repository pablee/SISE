<?php
include_once "database.php";

class EstadoCivil
{
	private $estados = array("Otros","Soltero","Casado","Divorciado","Viudo");

//====================================================================================================
	public function verEstado() 
	{
		$i=1;	
		echo '<label for="cod_estado_civil"> Estado Civil </label>
				<select id="cod_estado_civil" name="cod_estado_civil" class="form-control">';	
					
		foreach ($this->estados as $estado)
		{
			echo '<option value="'.$i.'">'.$estado.'</option>';
			$i++;
		}
			
		echo 	'</select>';	
	}

//====================================================================================================
	public function buscarEstado($idEstado) 
	{
		$db=new database();
		$db->conectar();
		
		$consulta="SELECT *
				   FROM ref_estado_civil 
				   WHERE cod_estado_civil = '$idEstado';";
				  
		$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontró el estado civil.");	
		$datos = mysqli_fetch_assoc($resultado);
		
		echo '<label for="cod_estado_civil"> Estado Civil </label>
				<select id="cod_estado_civil" name="cod_estado_civil" class="form-control">';	
					
		echo '<option value="'.$datos["cod_estado_civil"].'">'.$datos["estado_civil"].'</option>';
		
		foreach ($this->estados as $estado)
		{
			echo '<option value="'.$i.'">'.$estado.'</option>';
			$i++;
		}
			
		echo 	'</select>';	
	}	
}
?>