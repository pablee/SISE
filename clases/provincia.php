<?php
include_once "database.php";

class Provincia{			
			public function verProvincia() 
				{
				$db=new database();
				$db->conectar();
				
				$consulta = "SELECT * FROM ref_direccion_provincia;";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar las provincias.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_provincia"].'">'.$datos["provincia"].'</option>';
					}	
				}
				
			public function buscarProvincia($id) 
				{
				$db=new database();
				$db->conectar();
				
				$consulta="SELECT * FROM ref_direccion_provincia WHERE cod_provincia='$id';";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar las provincias.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_provincia"].'">'.$datos["provincia"].'</option>';
					}			
				$this->verProvincia();
				}	
			}		
?>