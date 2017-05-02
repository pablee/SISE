<?php
include_once "database.php";

class ProcesoTipo	{
					private $nombre_campo=array("cod_proceso_tipo","proceso_tipo","observaciones","usr_ult_modif","fecha_ult_modif");
			
					public function selectProcesoTipo()
						{
						$db=new database();
						$db->conectar();
						
						$consulta="SELECT *
								   FROM ref_proceso_tipo;";
						$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontraron los tipos de proceso.");
						
						echo '<label for="cod_proceso_tipo"> Tipo de proceso </label>
							  <select id="cod_proceso_tipo" name="cod_proceso_tipo" class="form-control">';	
								
						while($datos = mysqli_fetch_assoc($resultado))
							{
							echo "<option value=".$datos['cod_proceso_tipo'].">".$datos['proceso_tipo']."</option>";							
							}
							
						echo '</select>';
							
						$db->close();
						}
							
					}	
?>