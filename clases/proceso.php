<?php
include_once "database.php";
include_once "proceso_tipo.php";
include_once "persona.php";

class Proceso	{
				private $nombre_campo=array("cod_proceso","proceso","cod_proceso_tipo","observaciones","usr_ult_modif","fec_ult_modif");
				private $condiciones=array("elegir","otro","cliente","oponente","empleador");
				private $rel_pers_cond_proc=array("cod_proceso","cod_persona","cod_persona_condicion","orden","observaciones","usr_ult_modif","fec_ult_modif");
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

				public function listarProceso()
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
				
				//Busca los procesos
				public function buscarProceso($buscar)
					{
					$db=new database();
					$db->conectar();
					
					$consulta= "SELECT PRO.cod_proceso, PRO.proceso, PER.cod_persona, PER.nombres, PER.apellidos, PER.dni 
								FROM `rel_pers_cond_proc` PCP 
								JOIN bsd_persona PER ON PCP.cod_persona = PER.cod_persona 
								JOIN bsd_proceso PRO ON PCP.cod_proceso = PRO.cod_proceso 
								WHERE PER.nombres LIKE '%$buscar%'
								OR PER.dni = '$buscar';";
								
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
					
					echo '<h3>Seleccione un proceso para editar</h3>
						  <br>
						  <div class="table-responsive">
							<table class="table table-striped" id="">
								<thead>
									<tr>
										<th> Codigo Proceso </th>
										<th> Proceso </th>
										<th> Codigo Persona </th>
										<th> Nombres </th>
										<th> Apellidos </th>
										<th> DNI </th>
									</tr>
								</thead>
								<tbody>';
								while($datos=mysqli_fetch_assoc($resultado))
									{	
									echo '<tr>
											<td>'.$datos["cod_proceso"].'</td>
											<td>'.$datos["proceso"].'</td>
											<td>'.$datos["cod_persona"].'</td>
											<td>'.$datos["nombres"].'</td>
											<td>'.$datos["apellidos"].'</td>
											<td>'.$datos["dni"].'</td>
											<td><button type="button" class="btn btn-link" value="'.$datos["cod_persona"].'" onclick="elegirProceso(this.value)">Elegir</button></td>
										  </tr>';
									}
					echo '		</tbody>
						</table>
					  </div>';  
					$db->close();
					}							
				
				public function elegirProceso($cod_persona)
					{
					$db=new database();
					$db->conectar();
					
					$consulta= "SELECT PRO.cod_proceso, PRO.proceso, PRO.cod_proceso_tipo, PRO.observaciones, PRO.usr_ult_modif, PRO.fec_ult_modif, PCP.cod_persona, PCP.cod_persona_condicion, PER.dni 
								FROM rel_pers_cond_proc PCP 
								JOIN bsd_proceso PRO ON PCP.cod_proceso=PRO.cod_proceso 
								JOIN ref_persona_condicion PC ON PCP.cod_persona_condicion=PC.cod_persona_condicion 
								JOIN bsd_persona PER ON PCP.cod_persona=PER.cod_persona 
								WHERE PCP.cod_proceso=(SELECT cod_proceso FROM rel_pers_cond_proc WHERE cod_persona='$cod_persona');";	   
							   
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
					
					$i=0;
					while($datos=mysqli_fetch_assoc($resultado))
						{	
						$procesos[$i]=$datos;
						$i++;
						}
					  
					$db->close();
					return $procesos;
					}			
								
				public function editarProceso($cod_persona)
					{
					$persona = new Persona();
					$proceso_tipo=new ProcesoTipo();		
					$procesos=$this->elegirProceso($cod_persona);
					
					echo '<h3>Personas en proceso</h3>
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
									<tbody>';
									$i=0;
									foreach($procesos as $proceso)
										{
										echo '<tr>';
										$persona->buscarPersonaProceso($procesos[$i]["dni"],$procesos[$i]["cod_persona_condicion"]);
										echo '</tr>';
										$i++;
										}
					echo '			</tbody>
								</table>
							</div>'; 		
					
					echo '<input id="cod_proceso" name="cod_proceso" type="hidden" class="form-control" value="'.$procesos[0]["cod_proceso"].'"></input>';	
					echo '<br>';	
					$proceso_tipo->buscarProcesoTipo($procesos[0]["cod_proceso_tipo"]);
					
					echo '<br><label for="proceso"> Proceso </label>
						  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso" value="'.$procesos[0]["proceso"].'"></input>';	
					
					echo '<br><div id="detalleTipo">
							
						  </div>';
					
					echo '<br><label for="observaciones"> Observaciones </label>
						  <textarea id="observaciones" name="observaciones" type="text" class="form-control" value="'.$procesos[0]["observaciones"].'" rows="5" cols="60"></textarea>';	
						  
					echo '<br><input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarProceso()"></input>';
					echo '</form>';					
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