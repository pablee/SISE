<?php
include_once "database.php";

class Filtro
{			
public function filtroDetalleTipoBoolean() 
	{
	$db=new database();
	$db->conectar();
	
	$consulta="SELECT * 
			   FROM ref_detalle_tipo AS DET_T
			   WHERE DET_T.cod_tipo_dato IN (1);";
			   
	$resultado=mysqli_query($db->conexion, $consulta) or die ("No se puede mostrar el detalle para el filtro.");	

	echo '<label for="filtroDetalleTipoBoolean">Buscar por:</label>';
	echo '<select id="filtroDetalleTipoBoolean" name="filtroDetalleTipoBoolean" class="form-control">';
		echo '<option value="">  </option>';
	while($datos = mysqli_fetch_assoc($resultado))
		{
		echo '<option value="'.$datos["cod_detalle_tipo"].'">'.$datos["detalle_tipo"].'</option>';
		}	
	echo '</select>';	
	}
	
public function respuestaBoolean() 
	{
	echo '<label for="respuestaBoolean">Elegir respuesta</label>';
	echo '<select id="respuestaBoolean" name="respuestaBoolean" class="form-control">';	
	 echo '<option value="">  </option>';		
	 echo '<option value="si"> Si </option>';		
	 echo '<option value="no"> No </option>';		
	echo '</select>';
	}	
	
public function filtroDetalleTipo() 
	{
	$db=new database();
	$db->conectar();
	
	$consulta="SELECT * 
			   FROM ref_detalle_tipo AS DET_T
			   WHERE DET_T.cod_tipo_dato IN (2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 20, 21, 22, 23, 24);";
			   
	$resultado=mysqli_query($db->conexion, $consulta) or die ("No se puede mostrar el detalle para el filtro.");	

	echo '<label for="filtroDetalleTipo">Buscar por:</label>';
	echo '<select id="filtroDetalleTipo" name="filtroDetalleTipo" class="form-control">';
	echo '    <option value="">  </option>';		
	while($datos = mysqli_fetch_assoc($resultado))
		{
		echo '<option value="'.$datos["cod_detalle_tipo"].'">'.$datos["detalle_tipo"].'</option>';
		}	
	echo '</select>';	
	}
	
public function respuestaTexto() 
	{
	echo '<label for="filtroDetalleTipo">Respuesta buscada:</label>';
	echo '<input id="respuestaTexto" name="respuestaTexto" type="text" class="form-control"></input>';
	}	
}		
?>