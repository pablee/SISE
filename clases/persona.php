<?php
include_once "database.php";
include_once "paises.php";
include_once "tipo_dni.php";
include_once "estado_civil.php";
include_once "categoria.php";
include_once "observaciones.php";

class Persona	{
				private $th=array("Nombres","Apellidos","Documento","Numero","Cuil","Fecha de nacimiento","Sexo","Nacionalidad","Estado civil","Telefono","Codigo postal","Profesion","Categoria","Observaciones","Modifica","Fecha");
				private $nombre_campo=array("nombres","apellidos","cod_tipo_dni","dni","cuil","fec_nacimiento","sexo","cod_nacionalidad","cod_estado_civil","telefono","codigo_postal","profesion","cod_categoria","observaciones","usr_ult_modif","fec_ult_modif");
				private $table_head='<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>																									
									';			
				private $table_middle='			</tr>
											</thead>
											<tbody> 
												
									';				
				private $table_close='															
											</tbody>
										</table>
									</div> 		
									';			
				
				//Carga el formulario para ingresar una nueva persona
				public function formularioPersona()
					{
					$nacionalidad=new Paises();
					$tipoDni=new TipoDni();
					$estadoCivil=new EstadoCivil();
					$categoria=new Categoria();
					$observaciones=new Observacion();

					echo '<form action="php/persona/ingresarPersona.php" method="POST">';

					foreach($this->nombre_campo as $campo)
						{
						echo '<br>';						
						switch ($campo) 
							{
							case "cod_tipo_dni":
								$tipoDni->verTipoDNI();
								break;
							
							case "fec_nacimiento":
								echo '
									 <label for="'.$campo.'"> Fecha de nacimiento </label>
									 <input id="'.$campo.'" name="'.$campo.'" type="date"  class="form-control"></input>
									 ';
								break;
						   
						   case "sexo":
								echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';		
								echo '<div class="radio">
										<label class="radio-inline">
											<input type="radio" id="sexo" name="sexo" value="m"> Masculino
										</label>
										<label class="radio-inline">
											<input type="radio" id="sexo" name="sexo" value="f"> Femenino
										</label>
									 </div>';		
								break;
							
							case "cod_nacionalidad":
								$nacionalidad->verPaises();	
								break;
							
							case "cod_estado_civil":
								$estadoCivil->verEstado();
								break;
							
							case "cod_categoria":
								$categoria->verCategoria();
								break;
							
							case "observaciones":
								$observaciones->verObservacion();
								break;
							
							case "usr_ult_modif":
								break;

							case "fec_ult_modif":
								break;		
								
							default:
								echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';
								echo '<input id="'.$campo.'" name="'.$campo.'" type="text" class="form-control" ></input>';
							}
						}

					echo '
							<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
							<input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
								
							<input type = "submit" class = "btn btn-info" value = "Guardar"></input>
							<br>
						</form>	
						';
					}		
				
				//Ingresa la persona cargada en el formulario persona
				public function ingresarPersona($nombres, $apellidos, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
					
					$consulta ="INSERT INTO bsd_persona (cod_persona, nombres, apellidos, cod_tipo_dni, dni, cuil, fec_nacimiento, sexo, cod_nacionalidad, cod_estado_civil, telefono, codigo_postal, profesion, cod_categoria, observaciones, usr_ult_modif, fec_ult_modif)
								VALUES (NULL,'$nombres','$apellidos','$cod_tipo_dni','$dni','$cuil','$fec_nacimiento','$sexo','$cod_nacionalidad','$cod_estado_civil','$telefono','$codigo_postal','$profesion','$cod_categoria','$observaciones','$usr_ult_modif','$fec_ult_modif');";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla persona.");
					
					$db->close();
					}
				
				//Actualiza los datos de la persona 
				public function actualizarPersona($nombres, $apellidos, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
					$observaciones = "<br>".$observaciones;
					$consulta ="UPDATE bsd_persona 
								SET	nombres='$nombres', apellidos='$apellidos', cod_tipo_dni='$cod_tipo_dni', dni='$dni', cuil='$cuil', 
									fec_nacimiento='$fec_nacimiento', sexo='$sexo', cod_nacionalidad='$cod_nacionalidad', cod_estado_civil='$cod_estado_civil',
									telefono='$telefono', codigo_postal='$codigo_postal', profesion='$profesion', cod_categoria='$cod_categoria',
									observaciones=CONCAT(observaciones, '$observaciones'), usr_ult_modif='$usr_ult_modif', fec_ult_modif='$fec_ult_modif'
								WHERE dni='$dni';";
								
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se actualizaron los datos en la tabla persona.");
					
					$db->close();
					}
				
				//Busca una persona en la base de datos y la muestra
				public function buscarPersona($buscar)
					{
					$db=new database();
					$db->conectar();
					
					$nacionalidad=new Paises();
					$tipoDni=new TipoDni();
					$estadoCivil=new EstadoCivil();
					$categoria=new Categoria();
					$observaciones=new Observacion();
					
					$consulta="SELECT *
							   FROM bsd_persona 
							   WHERE dni = '$buscar';";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro la persona.");
															
					echo '<form action="php/persona/ingresarPersona.php" method="POST">';
					
					$datos = mysqli_fetch_assoc($resultado);
					foreach($this->nombre_campo as $campo)
						{
						echo '<br>';						
						switch ($campo) 
							{
							case "cod_tipo_dni":
								$tipoDni->buscarTipoDNI($datos[$campo]);
								break;
							
							case "fec_nacimiento":
								echo '
									 <label for="'.$campo.'"> Fecha de nacimiento </label>
									 <input id="'.$campo.'" name="'.$campo.'" type="date" value="'.$datos[$campo].'" class="form-control"></input>
									 ';
								break;
						   
						   case "sexo":
								echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';	
								if($datos[$campo]=="m")
									{		
									echo '<div class="radio">
											<label class="radio-inline">
												<input type="radio" id="sexo" name="sexo" value="m" checked="checked"> Masculino
											</label>
											<label class="radio-inline">
												<input type="radio" id="sexo" name="sexo" value="f"> Femenino
											</label>
										 </div>';
									}
									else{
										echo '<div class="radio">
												<label class="radio-inline">
													<input type="radio" id="sexo" name="sexo" value="m"> Masculino
												</label>
												<label class="radio-inline">
													<input type="radio" id="sexo" name="sexo" value="f" checked="checked"> Femenino
												</label>
											 </div>';
										}
								break;
							
							case "cod_nacionalidad":
								$nacionalidad->buscarPais($datos[$campo]);	
								break;
							
							case "cod_estado_civil":
								$estadoCivil->buscarEstado($datos[$campo]);
								break;
							
							case "cod_categoria":
								$categoria->buscarCategoria($datos[$campo]);
								break;
							
							case "observaciones":
								$observaciones->buscarObservacion($datos["dni"]);
								break;
							
							case "usr_ult_modif":
								break;

							case "fec_ult_modif":
								break;		
								
							default:
								echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';
								echo '<input id="'.$campo.'" name="'.$campo.'" type="text" class="form-control" value="'.$datos[$campo].'"></input>';
							}
						}
					
					echo '
							<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
							<input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
							<input id="accion" name="accion" type="hidden" value="actualizar"></input>
							
							<input type = "submit" class = "btn btn-info" value = "Guardar"></input>
							<br>
						</form>	
						';
					
					$db->close();
					}
				
				//Agregar persona en proceso
				public function agregarPersonaProceso()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT cod_persona, nombres, apellidos, cod_tipo_dni, dni
							   FROM bsd_persona;";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar las personas.");
					
					echo "<br>".$this->table_head;
					
					echo   '<th> Nombres </th>
							<th> Apellidos </th>
							<th> Documento </th>
							<th> Numero </th>';
					
					echo $this->table_middle;
					while($datos = mysqli_fetch_assoc($resultado))
						{
						echo "<tr id=".$datos['cod_persona'].">
								<td>".$datos['nombres']."</td>
								<td>".$datos['apellidos']."</td>
								<td>".$datos['cod_tipo_dni']."</td>
								<td>".$datos['dni']."</td>
							  <tr>";
						}
						
					echo $this->table_close;
									
					$db->close();
					}			
				
				//Usado en la clase detalle para ver las personas existentes en la base.
				public function verPersona()
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT cod_persona, nombres, apellidos
							   FROM bsd_persona;";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar las personas.");
					
					echo '<label for="persona"> Persona </label>
							<select id="persona" name="persona" class="form-control">';	
								
					while($datos = mysqli_fetch_assoc($resultado))
						{
						echo "<option value=".$datos['cod_persona'].">".$datos['apellidos']." ".$datos['nombres']."</option>";							
						}
						
					echo 	'</select>';
									
					$db->close();
					}						
				}	
?>