<?php
include_once "database.php";

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
												<tr>
									';				
				private $table_close='			</tr>												
											</tbody>
										</table>
									</div> 		
									';			
									
				public function ingresarPersona($nombres, $apellidos, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $codigo_postal, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
					
					$consulta ="INSERT INTO bsd_persona (cod_persona, nombres, apellidos, cod_tipo_dni, dni, cuil, fec_nacimiento, sexo, cod_nacionalidad, cod_estado_civil, telefono, codigo_postal, profesion, cod_categoria, observaciones, usr_ult_modif, fec_ult_modif)
								VALUES (NULL,'$nombres','$apellidos','$cod_tipo_dni','$dni','$cuil','$fec_nacimiento','$sexo','$cod_nacionalidad','$cod_estado_civil','$telefono','$codigo_postal','$profesion','$cod_categoria','$observaciones','$usr_ult_modif','$fec_ult_modif');";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla persona.");
					
					$db->close();
					}
				
				public function verPersona($buscar)
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT *
							   FROM bsd_persona 
							   WHERE dni = '$buscar';";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro la persona.");
					
					
					echo $this->table_head;
					
					foreach($this->th as $campo)
						{
						echo "<th>".$campo."</th>";
						}
						
					echo $this->table_middle;
					
					/* 
					while($datos = mysqli_fetch_assoc($resultado))
						{
						echo "<td>".$datos."</td>";
						}
					*/
					
					$datos = mysqli_fetch_assoc($resultado);
					
					foreach($this->nombre_campo as $campo)
						{
						echo "<td>".$datos[$campo]."</td>";
						}
						
					echo $this->table_close;
					
					echo '<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="'.$datos["cod_persona"].'">';
					$db->close();
					}
						
				}	
?>