<?php
include_once "database.php";

class TipoDni	{
				private $tipoDni = array("Otros","DNI","LC","LE");

				public function verTipoDNI() 
					{
					echo'	<label for="cod_tipo_dni"> Tipo documento </label>
							<select id="cod_tipo_dni" name="cod_tipo_dni" class="form-control">
								<option value=""> Elegir... </option>';
					$i=1;			
					foreach($this->tipoDni as $tipo)
						{
						echo '<option value="'.$i.'"> '.$tipo.' </option>';										
						$i++;
						}	
						
					echo '	</select>';
					}
				
				public function buscarTipoDNI($idTipo) 
					{
					$db=new database();
					$db->conectar();
					
					$consulta="SELECT *
							   FROM ref_tipo_dni 
							   WHERE cod_tipo_dni = '$idTipo';";
							  
					$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro el tipo de dni.");	
					$datos = mysqli_fetch_assoc($resultado);
					
					echo'
						<label for="cod_tipo_dni"> Tipo documento </label>
						<select id="cod_tipo_dni" name="cod_tipo_dni" class="form-control">
							<option value="'.$datos["cod_tipo_dni"].'">'.$datos["tipo_dni"].'</option>
						';
						
					$i=1;			
					foreach($this->tipoDni as $tipo)
						{
						echo '<option value="'.$i.'"> '.$tipo.' </option>';										
						$i++;
						}	
						
					echo '</select>';	
					
					}
				}		
?>