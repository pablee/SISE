<?php
include_once "database.php";

class Paises{
			private $paises = array("Elegir","Alemana","Argentina","Boliviana","Brasilera","Chilena","Colombiana","Ecuatoriana","Española","Francesa","Italiana","Mexicana","Paraguaya","Uruguaya","Venezolana","Otra");

			public function verPaises() 
				{
				$i=1;	
				echo '<label for="cod_nacionalidad"> Nacionalidad </label>
						<select id="cod_nacionalidad" name="cod_nacionalidad" class="form-control">';	
							
				foreach ($this->paises as $pais)
					{
					echo '<option value="'.$i.'">'.$pais.'</option>';
					$i++;
					}
					
				echo 	'</select>';	
				}
				
			public function buscarPais($idPais) 
				{
				$db=new database();
				$db->conectar();
				
				$consulta="SELECT *
						   FROM ref_nacionalidad 
						   WHERE cod_nacionalidad = '$idPais';";
						  
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontro el pais.");	
				$datos = mysqli_fetch_assoc($resultado);
				
				echo '<label for="cod_nacionalidad"> Nacionalidad </label>
						<select id="cod_nacionalidad" name="cod_nacionalidad" class="form-control">';	
				
				echo '<option value="'.$datos["cod_nacionalidad"].'">'.$datos["nacionalidad"].'</option>';
				
				foreach ($this->paises as $pais)
					{
					echo '<option value="'.$i.'">'.$pais.'</option>';
					$i++;
					}
					
				echo 	'</select>';	
				}	
			}		
?>