<?php
include_once "database.php";
include_once "proceso_tipo.php";

class Proceso	{
				private $nombre_campo=array("cod_proceso","proceso","cantidad_acompaniantes","cod_proceso_tipo","observaciones","usr_ult_modif","fec_ult_modif");
				private $proceso;
				private $cantidad_acompaniantes;
				private $cod_proceso_tipo;
				private $observaciones;
				private $usr_ult_modif;
				private $fec_ult_modif;		
												
				public function ingresarProceso($proceso, $cantidad_acompaniantes, $cod_proceso_tipo, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{	
					$db=new database();
					$db->conectar();
					
					echo $proceso;
					echo $cantidad_acompaniantes;
					echo $cod_proceso_tipo;
					echo $observaciones;
					echo $usr_ult_modif;
					echo $fec_ult_modif;
					
					$consulta="INSERT INTO bsd_proceso (cod_proceso, proceso, cantidad_acompaniantes, cod_proceso_tipo, observaciones, usr_ult_modif, fec_ult_modif)
												VALUES (NULL, '$proceso', '$cantidad_acompaniantes', '$cod_proceso_tipo', '$observaciones', '$usr_ult_modif', '$fec_ult_modif');";
													
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudo ingresar el proceso.");
						
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
						  
					echo '<br><input type = "button" class = "btn btn-info" value = "Guardar" onclick="guardarProceso()"></input>';
					}		
				
				public function verProceso()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT cod_proceso, proceso
							   FROM bsd_proceso;";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
					
					echo '<label for="proceso"> Procesos </label>
							<select id="proceso" name="proceso" class="form-control">';	
								
					while($datos = mysqli_fetch_assoc($resultado))
						{
						echo "<option value=".$datos['cod_proceso'].">".$datos['proceso']."</option>";							
						}
						
					echo 	'</select>';
									
					$db->close();
					}				
				}	
?>