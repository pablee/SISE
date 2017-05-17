<?php
include_once "database.php";
include_once "proceso_tipo.php";
include_once "persona.php";

class Proceso	{
				private $nombre_campo=array("cod_proceso","proceso","cod_proceso_tipo","observaciones","usr_ult_modif","fec_ult_modif");
				private $proceso;
				private $cod_proceso_tipo;
				private $observaciones;
				private $usr_ult_modif;
				private $fec_ult_modif;		
												
				public function nuevoProceso()
					{
					$persona = new Persona();
					$proceso_tipo=new ProcesoTipo();
					
					echo '<br>';	
					$proceso_tipo->selectProcesoTipo();
						
					echo '<br><button type="button" class="btn btn-link" onclick="buscarPersonaProceso()"> Agregar persona <span class="glyphicon glyphicon-plus"></span> </button>';	
					echo '<div id="buscarPersonaProceso"></div>';
						  
					//$persona->agregarPersonaProceso();
					
					echo '<br><label for="proceso"> Proceso </label>
						  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso"></input>';	
					
					echo '<br><div id="detalleTipo">
					
						  </div>';
					
					echo '<br><label for="observaciones"> Observaciones </label>
						  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';	
						  
					echo '<br><input type = "button" class = "btn btn-info" value = "Guardar" onclick="guardarProceso()"></input>';
					}		
				
				public function ingresarProceso($proceso, $cod_proceso_tipo, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{	
					$db=new database();
					$db->conectar();
					
					echo $proceso;
					echo $cod_proceso_tipo;
					echo $observaciones;
					echo $usr_ult_modif;
					echo $fec_ult_modif;
					
					$consulta="INSERT INTO bsd_proceso (cod_proceso, proceso, cod_proceso_tipo, observaciones, usr_ult_modif, fec_ult_modif)
												VALUES (NULL, '$proceso', '$cod_proceso_tipo', '$observaciones', '$usr_ult_modif', '$fec_ult_modif');";
													
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudo ingresar el proceso.");
						
					$db->close();
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