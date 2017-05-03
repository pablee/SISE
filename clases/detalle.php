<?php
include_once "database.php";
include_once "persona.php";
include_once "proceso.php";
include_once "detalle_tipo.php";

class Detalle	{				
				private $nombre_campo=array("cod_detalle","cod_persona","cod_proceso","cod_detalle_tipo","valor","observaciones","usr_ult_modif","fec_ult_modif");
													
				public function ingresarDetalle($cod_detalle, $cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
					
					$consulta ="INSERT INTO bsd_detalle (cod_detalle, cod_persona, cod_proceso, cod_detalle_tipo, valor, observaciones, usr_ult_modif, fec_ult_modif)
								VALUES ('$cod_detalle', '$cod_persona', '$cod_proceso', '$cod_detalle_tipo', '$valor', '$observaciones', '$usr_ult_modif', '$fec_ult_modif');";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla persona.");
					
					$db->close();
					}
					
				public function nuevoDetalle()
					{
					echo '<br><label for="cod_detalle"> Codigo de detalle </label>
						  <input id="cod_detalle" name="cod_detalle" type="text" class="form-control"></input>';	
					
					echo '<br>';
					$persona = new Persona();
					$persona->verPersona();
					
					echo '<br>';	
					$proceso = new Proceso();
					$proceso->verProceso();
					
					echo '<br>';	
					$detalle_tipo = new DetalleTipo();
					$detalle_tipo->verDetalleTipo();
					
					echo '<br><label for="observaciones"> Observaciones </label>
						  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';	
						  
					echo '<br><input type = "button" class = "btn btn-info" value = "Guardar" onclick="guardarDetalle()"></input>';
					}	
					
				
				}	
?>