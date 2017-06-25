<?php
include_once "database.php";
include_once "persona.php";
include_once "proceso.php";
include_once "detalle_tipo.php";

class Detalle	{				
				private $nombre_campo=array("cod_detalle","cod_persona","cod_proceso","cod_detalle_tipo","valor","observaciones","usr_ult_modif","fec_ult_modif");
													
				public function ingresarDetalle($cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					echo "ESTOY EN GUARDAR DETALLE INICIO";
					$db=new database();
					$db->conectar();
					
					$consulta = "INSERT INTO bsd_detalle (
										cod_persona, 
										cod_proceso, 
										cod_detalle_tipo, 
										valor, observaciones, 
										usr_ult_modif, 
										fec_ult_modif
								) VALUES (
										'$cod_persona', 
										'$cod_proceso', 
										'$cod_detalle_tipo', 
										'$valor', 
										'$observaciones', 
										'$usr_ult_modif', 
										'$fec_ult_modif'
								);";
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla bsd_detalle.");
					
					$db->close();
					echo "ESTOY EN GUARDAR DETALLE FIN";
					}
				
				
				public function actualizarDetalle($cod_persona, $cod_proceso, $cod_detalle_tipo, $valor, $observaciones, $usr_ult_modif, $fec_ult_modif)
					{
					$db=new database();
					$db->conectar();
				
					$consulta= "UPDATE bsd_detalle 
								SET valor='$valor', usr_ult_modif='$usr_ult_modif', fec_ult_modif='$fec_ult_modif'
								WHERE  cod_detalle_tipo='$cod_detalle_tipo'
								  AND cod_persona = '$cod_persona' 
								  AND cod_proceso='$cod_proceso';";
								
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudo actualizar las respuestas de la tabla detalle.");		
					$db->close();		
					}
						
				}	
?>