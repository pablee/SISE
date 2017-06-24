<?php

class Direccion
	{
	private $campos_tabla=array("cod_direccion",
								"domicilio",
								"calle",
								"numero",
								"piso",
								"departamento",
								"torre",
								"cod_localidad",
								"cod_partido",
								"cod_provincia ",
								"codigo_postal ",
								"observaciones",
								"usr_ult_modif",
								"fec_ult_modif");
								
	private $campos_input=array("domicilio",
								"calle",
								"numero",
								"piso",
								"departamento",
								"torre",
								"localidad",
								"partido",
								"provincia",
								"codigo_postal",
								"observaciones_direccion");
										  
	public function formularioDireccion()
		{
		foreach($this->campos_input as $campo)
			{
			echo '<label for="'.$campo.'">'.ucwords(str_replace("_"," ",$campo)).'</label>';
			echo '<input type="text" class="form-control" id="'.$campo.'"></input>';
			}
		}
		
	public function guardarDireccion($domicilio,$calle,$numero,$piso,$departamento,$torre,$cod_localidad,$cod_partido,$cod_provincia,$codigo_postal,$observaciones_direccion,$usr_ult_modif,$fec_ult_modif)
		{
		$db=new database();
		$db->conectar();
		
		$consulta = "INSERT INTO bsd_direccion (
						  domicilio
						, calle
						, numero
						, piso
						, departamento
						, torre
						, cod_localidad
						, cod_partido
						, cod_provincia
						, codigo_postal
						, observaciones
						, usr_ult_modif
						, fec_ult_modif)
					VALUES (
						'$domicilio'
						,'$calle'
						,'$numero'
						,'$piso'
						,'$departamento'
						,'$torre'
						,'$cod_localidad'
						,'$cod_partido'
						,'$cod_provincia'
						,'$codigo_postal'
						,'$observaciones_direccion'
						,'$usr_ult_modif'
						,'$fec_ult_modif');";
		$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla direccion.");
		
		# INSERT en tabla de relación entre persona y domicilios, ya que una persona puede tener varios domicilios o varias personas al mismo domicilio. 
		#¿¿¿¿Como se obtiene el código de dirección recien insertado???????

		$consulta = "	INSERT INTO `rel_persona_direccion`(
							  `cod_persona`
							, `cod_direccion`
							, `observaciones`
							, `usr_ult_modif`
							, `fec_ult_modif`)
						VALUES (
							  <{cod_persona: }>
							, <{cod_direccion: }>
							, <{observaciones: }>
							, <{usr_ult_modif: }>
							, <{fec_ult_modif: CURRENT_TIMESTAMP}>);";
		#$resultado=mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla direccion.");

		$db->close();
		}
	
	public function actualizarDireccion()
		{
			
		}
	}

?>