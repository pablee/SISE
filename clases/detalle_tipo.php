<?php
include_once "database.php";

class DetalleTipo
	{	
	public function verDetalleTipo($cod_proceso_tipo, $cliente, $oponente) 
		{
		$db=new database();
		$db->conectar();
		
		$consulta= "SELECT ref_detalle_tipo.cod_detalle_tipo, ref_detalle_tipo.detalle_tipo, ref_detalle_tipo.cod_tipo_dato, ref_tipo_dato.tipo_dato 
					FROM rel_pers_cond_proc_tipo_deta_tipo, ref_detalle_tipo, ref_tipo_dato 
					WHERE ref_detalle_tipo.cod_detalle_tipo = rel_pers_cond_proc_tipo_deta_tipo.cod_detalle_tipo 
					AND ref_tipo_dato.cod_tipo_dato = ref_detalle_tipo.cod_tipo_dato 
					AND cod_proceso_tipo = '$cod_proceso_tipo' 
					AND (cod_persona_condicion = '$cliente' or cod_persona_condicion = '$oponente');";
		
		$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los tipos de detalle.");		
			
		echo '<table class="table table-striped" id="preguntasProceso">
				<tbody>';
		$i=0;	
		while($datos = mysqli_fetch_assoc($resultado))
			{
			switch ($datos['tipo_dato']) 
				{
				case "BIT":
					echo '<tr>
					    	<td>'.$datos["detalle_tipo"].'</td>
						    <td> 
								<select class="form-control" id="'.$datos["cod_detalle_tipo"].'" name="'.$datos["cod_detalle_tipo"].'">
									<option value=""></option>
									<option value="si">Si</option>
									<option value="no">No</option>
								</select>
							</td>
						  </tr>';					
					break;
					
				case "DATE":
					echo '<tr>
							<td>'.$datos["detalle_tipo"].'</td>
							<td>
								<input type="date" class="form-control" id="'.$datos["cod_detalle_tipo"].'" name="'.$datos["cod_detalle_tipo"].'"></input>
							</td>
						  </tr>';						  
					break;	
				
				case "MEDIUMTEXT":
				case "TEXT":
					echo '<tr>
							<td>'.$datos["detalle_tipo"].'</td>
							<td>
								<textarea id="'.$datos["cod_detalle_tipo"].'" name="'.$datos["cod_detalle_tipo"].'" type="text" class="form-control" rows="5" cols="0"></textarea>
							</td>
						  </tr>';	  
					break;	
					
				default:
					echo '<tr>
							<td>'.$datos["detalle_tipo"].'</td>
							<td><input id="'.$datos["cod_detalle_tipo"].'" name="'.$datos["cod_detalle_tipo"].'" type="text" class="form-control"></input></td>
						  </tr>';
				}
			$i++;		
			}
		
		echo '	</tbody>
		     </table>';
		
		$db->close();		
		}	
	}		
?>