<?php
include_once "database.php";

class ProcesoTipo	
	{
	private $nombre_campo = array(
								"cod_proceso_tipo",
								"proceso_tipo",
								"observaciones",
								"usr_ult_modif",
								"fecha_ult_modif"
								);

//====================================================================================================
	public function selectProcesoTipo()
		{
		$db = new database();
		$db->conectar();
		
		$consulta = "SELECT *
				   	FROM ref_proceso_tipo;";
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se encontraron los tipos de carátula.");
		
		echo '<label for="cod_proceso_tipo"> Tipo de proceso </label>
			  <select id="cod_proceso_tipo" name="cod_proceso_tipo" class="form-control" onchange="verPreguntasProceso(this.value)">';	
		while($datos = mysqli_fetch_assoc($resultado))
			{
			echo "<option value=".$datos['cod_proceso_tipo'].">".$datos['proceso_tipo']."</option>";							
			}
			
		echo '</select>';
			
		$db->close();
		}

//====================================================================================================
	public function buscarProcesoTipo($proceso_tipo) 
		{
		$db = new database();
		$db->conectar();
		
		$consulta = 	"SELECT *
				   		 FROM ref_proceso_tipo
				   		 WHERE cod_proceso_tipo = '$proceso_tipo';";
				  
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se encontraron los tipos de carátulas.");
		$datos = mysqli_fetch_assoc($resultado);
		
		echo '<label for="cod_proceso_tipo"> Tipo de proceso </label>
			  <select id="cod_proceso_tipo" name="cod_proceso_tipo" class="form-control" onchange="verPreguntasProceso(this.value)" disabled>';	
				
		echo '<option value="'.$datos["cod_proceso_tipo"].'">'.$datos["proceso_tipo"].'</option>';
		
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se encontraron los tipos de carátula.");
		while($datos = mysqli_fetch_assoc($resultado))
			{
			echo "<option value=".$datos['cod_proceso_tipo'].">".$datos['proceso_tipo']."</option>";							
			}
			
		echo '</select>';
			
		$db->close();
		}	
			
	}	
?>