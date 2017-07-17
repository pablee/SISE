<?php
include_once "database.php";

class Partido{			
			public function verPartido() 
				{
				$db=new database();
				$db->conectar();
				
				$consulta = "SELECT * FROM ref_direccion_partido;";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar los partidos.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_partido"].'">'.$datos["partido"].'</option>';
					}	
				}
				
			public function buscarPartido($id) 
				{
				$db=new database();
				$db->conectar();
				
				$consulta="SELECT * FROM ref_direccion_partido WHERE cod_partido='$id';";
				$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pueden mostrar los partidos.");	
		
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo '<option value="'.$datos["cod_partido"].'">'.$datos["partido"].'</option>';
					}			
				$this->verPartido();
				}	
			}		
?>