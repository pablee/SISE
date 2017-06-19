<?php
include_once "database.php";

class Paises{			
			public function verPaises() 
				{
				$db=new database();
				$db->conectar();
				
				$consulta = "SELECT * FROM ref_nacionalidad;";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontró el pais.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_nacionalidad"].'">'.$datos["nacionalidad"].'</option>';
					}	
				}
				
			public function buscarPais($idPais) 
				{
				$db=new database();
				$db->conectar();
				
				$consulta = 	"SELECT *
						   		 FROM ref_nacionalidad 
						   		 WHERE cod_nacionalidad = '$idPais';";
						  
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se encontró el pais.");	
				$datos = mysqli_fetch_assoc($resultado);

				echo '<option value="'.$datos["cod_nacionalidad"].'">'.$datos["nacionalidad"].'</option>';
				$this->verPaises();
				}	
			}		
?>