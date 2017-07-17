<?php
include_once "database.php";

class Localidad{			
			public function verLocalidad() 
				{
				$db=new database();
				$db->conectar();
				
				$consulta="SELECT * FROM ref_direccion_localidad;";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar las localidades.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_localidad"].'">'.$datos["localidad"].'</option>';
					}	
				}
				
			public function buscarLocalidad($id) 
				{
				$db=new database();
				$db->conectar();
				
				$consulta="SELECT * FROM ref_direccion_localidad WHERE cod_localidad='$id';";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar las localidades.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_localidad"].'">'.$datos["localidad"].'</option>';
					}	
				$this->verLocalidad();
				}	
			}		
?>