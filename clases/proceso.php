<?php
include_once "database.php";
include_once "proceso_tipo.php";

class Proceso	{
				private $nombre_campo=array("cod_proceso","proceso","cantidad_acompaniantes","cod_proceso_tipo","observaciones","usr_ult_modif","fecha_ult_modif");
				 
				public function ingresarProceso()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT *
							   FROM ref_proceso_tipo;";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontraron los tipos de proceso.");
					
					echo '<div class="form-group">				
							<br>
							<label for="cod_proceso_tipo"> Tipo de proceso </label>
							<select id="cod_proceso_tipo" name="cod_proceso_tipo" class="form-control">';	
					while($datos = mysqli_fetch_assoc($resultado))
						{
						echo "<option value=".$datos['cod_proceso_tipo'].">".$datos['proceso_tipo']."</option>";							
						}
					echo '	</select>
						</div>';
						
					$db->close();
					}
				
				public function nuevoProceso()
					{
					echo '<br><label for="proceso"> Proceso </label>
						  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso"></input>';	
	
					echo '<br><label for="cantidad_acompaniantes"> Cantidad de Acompaniantes </label>
						  <input id="cantidad_acompaniantes" name="cantidad_acompaniantes" type="text" class="form-control" placeholder="Numero de acompañantes"></input>';		
					
					echo '<br>';	
					$proceso_tipo=new ProcesoTipo();
					$proceso_tipo->selectProcesoTipo();
									
					echo '<br><label for="observaciones"> Observaciones </label>
						  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';	
						  				
					}		
				
				}	
?>