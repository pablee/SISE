<?php
include_once "database.php";
include_once "proceso_tipo.php";
include_once "persona.php";

class Proceso	{
				private $nombre_campo=array("cod_proceso","proceso","cod_proceso_tipo","observaciones","usr_ult_modif","fec_ult_modif");
				private $condiciones = array("elegir","otro","cliente","oponente","empleador");
				private $proceso;
				private $cod_proceso_tipo;
				private $observaciones;
				private $usr_ult_modif;
				private $fec_ult_modif;		
												
				public function nuevoProceso()
					{					
					$persona = new Persona();
					$proceso_tipo=new ProcesoTipo();		
					
					echo '<h3>Agregar una persona al proceso</h3>
						  <br>
						  <div class="form-inline">
							<div class="form-group">
								<label for="agregar">Condicion:</label>	
								<select id="persona_condicion" name="persona_condicion" class="form-control" onchange="habilitarBusqueda()">';
								$i=0;
								foreach($this->condiciones as $condicion)
									{
									echo '<option value="'.$i.'"> '.ucwords($condicion).' </option>';	
									$i++;
									}	
					echo '		</select>	
								<input id="buscarPersonaProceso" name="buscarPersonaProceso" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="buscarPersonaProceso(event)" disabled></input>
								<button type="button" class="btn btn-info" onclick="buscarPersonaProceso(0)"> 
									<span class="glyphicon glyphicon-search"></span> 
								</button>
							</div>
						  </div>
						  <form action="php/detalle/guardarDetalle.php" method="POST">
							<br>							
							<div class="table-responsive">
								<table class="table table-striped" id="personaEncontrada">
									<thead>
										<tr>																									
											<th> Nombres </th>
											<th> Apellidos </th>
											<th> Documento </th>
											<th> Numero </th>
											<th> Condicion </th>
										</tr>
									</thead>
									<tbody> 

									</tbody>
								</table>
							</div>'; 		
					
					echo '<br>';	
					$proceso_tipo->selectProcesoTipo();
					
					echo '<br><label for="proceso"> Proceso </label>
						  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso"></input>';	
					
					echo '<br><div id="detalleTipo">
					
						  </div>';
					
					echo '<br><label for="observaciones"> Observaciones </label>
						  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';	
						  
					echo '<br><input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarProceso()"></input>';
					echo '</form>';
					}		
				
				public function guardarProceso($proceso, $cod_proceso_tipo, $observaciones, $usr_ult_modif, $fec_ult_modif)
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
					$cod_proceso=mysqli_insert_id($db->conexion);
					$db->close();
					return $cod_proceso;
					}
				
				public function verProceso()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT *
							   FROM bsd_proceso;";	   
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
					
					echo '<table class="table table-striped">
							<thead>
								<tr>';																									
							foreach($this->nombre_campo as $campo)
								{
								echo "<th>".$campo."</th>";
								}	
					echo '		</tr>
							</thead>
							<tbody>';
							
					$i=0;
					while($datos=mysqli_fetch_assoc($resultado))
						{
						echo "<tr>";	
						foreach($this->nombre_campo as $campo)
							{
							echo "<td>".$datos["$campo"]."</td>";
							}	
						echo "</tr>";
						$procesos[$i]=$datos;
						$cod_proceso=$datos["cod_proceso"];
						$i++;
						}
						
					echo '	</tbody>
						  </table>';
						  
					$db->close();
					//return $cod_proceso;
					//return $datos;
					return $procesos;
					}			

				public function ultimoProcesoIngresado()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT *
							   FROM bsd_proceso;";
							   
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
					$i=0;
					while($datos=mysqli_fetch_assoc($resultado))
						{
						$procesos[$i]=$datos;
						$cod_proceso=$datos["cod_proceso"];
						$i++;
						}

					$db->close();
					//return $cod_proceso;
					//return $datos;
					return $procesos;
					}				
				
				//Genera el insert en la tabla pers_cond_proc.(guarda la relacion de una o mas personas, clientes u oponentes, con un proceso)
				public function guardarPersCondProc($cod_proceso, $cod_persona, $cod_persona_condicion, $orden, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
					$consulta="INSERT INTO rel_pers_cond_proc (cod_proceso, cod_persona, cod_persona_condicion, orden, observaciones, usr_ult_modif, fec_ult_modif)
													   VALUES ('$cod_proceso', '$cod_persona', '$cod_persona_condicion', '$orden', '$observaciones', '$usr_ult_modif', '$fec_ult_modif');";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudo hacer el insert en la tabla rel_pers_cond_proc.");
					$db->close();
					}
				}	
?>