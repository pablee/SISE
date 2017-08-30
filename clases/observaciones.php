<?php
include_once "database.php";

class Observacion	{
					private $tipoPersona = array("física","jurídica");

					public function verObservacion() 
						{
						echo '<label for="observaciones"> Observaciones </label>
							  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';
						}
						
					public function buscarObservacion($dni) 
						{
						$db=new database();
						$db->conectar();
						
						$consulta="SELECT *
								   FROM bsd_persona 
								   WHERE dni = '$dni';";
						
						$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro la observacion.");
						
						echo '<label for="observaciones"> Observaciones </label>';
						echo '<ul class="list-group">';
							
						while($datos = mysqli_fetch_assoc($resultado))
							{
							echo '<li class="list-group-item">'.$datos["observaciones"].'</li>';
							}
							
						echo '
							 <li class="list-group-item">
								<textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>
						     </li>
							 ';
							
						echo '</ul>';	
						}	
						
					public function buscarObservacionNovedadProceso($cod_proceso) 
						{
						$db=new database();
						$db->conectar();
						
						$consulta="SELECT *
								   FROM bsd_proceso
								   WHERE cod_proceso = '$cod_proceso';";
						
						$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro la observacion.");
						//Observaciones
						echo '<label for="observaciones"> Observaciones </label>';
						echo '<ul class="list-group">';							
						$datos = mysqli_fetch_assoc($resultado);
							
						echo '<li class="list-group-item">'.$datos["observaciones"].'</li>';
						echo '
							 <li class="list-group-item">
								<textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>
						     </li>
							 ';							
						echo '</ul>';
						
						//Novedades
						echo '<label for="ultimas_novedades"> Ultimas novedades </label>';
						echo '<ul class="list-group">';							
						echo '<li class="list-group-item">'.$datos["ultimas_novedades"].'</li>';											
						echo '
							 <li class="list-group-item">
								<textarea id="ultimas_novedades" name="ultimas_novedades" type="text" class="form-control" rows="5" cols="60"></textarea>
						     </li>
							 ';							
						echo '</ul>';
						}		
					}		
?>