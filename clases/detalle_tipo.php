<?php
include_once "database.php";

class DetalleTipo	{				
					public function verDetalleTipo()
						{
						$db=new database();
						$db->conectar();
						
						$consulta="SELECT cod_detalle_tipo, detalle_tipo
								   FROM ref_detalle_tipo;";
						$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los tipos de detalle.");
						
						echo '<label for="detalle_tipo"> Tipo de detalle </label>
								<select id="detalle_tipo" name="detalle_tipo" class="form-control">';	
									
						while($datos = mysqli_fetch_assoc($resultado))
							{
							echo "<option value=".$datos['cod_detalle_tipo'].">".$datos['detalle_tipo']."</option>";							
							}
							
						echo 	'</select>';
										
						$db->close();									
						}			
					}	
?>