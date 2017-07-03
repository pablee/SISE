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

//====================================================================================================
	public function formularioDireccion()
	{
		foreach($this->campos_input as $campo)
		{
			echo '<label for="'.$campo.'">'.ucwords(str_replace("_"," ",$campo)).'</label>';
			echo '<input type="text" class="form-control" id="'.$campo.'"></input>';
		}
	}

//====================================================================================================
/*En esta función corresponde guardar la información de la dirección de una persona cargada en el 
formulario de persona. 
1-Es necesario obtener el código de la persona a la que corresponde el domicilio. 
2-Es necesario almacenar la dirección. 
3-Se requiere guardar el registro que relaciona la dirección guardada con la persona correspondiente.*/
	public function guardarDireccion($dni, $domicilio,$calle,$numero,$piso,$departamento,$torre,$cod_localidad,$cod_partido,$cod_provincia,$codigo_postal,$observaciones_direccion,$usr_ult_modif,$fec_ult_modif)
	{
		$db = new database();
		$db->conectar();
		
#1-Es necesario obtener el código de la persona a la que corresponde el domicilio.
#-----MEJORAR-----Lo mejor sería que haya un objeto y sus métodos, pero bueno, a falta de eso lo hacemos directo.
		$consulta = "SELECT cod_persona
					 FROM bsd_persona
					 WHERE dni = '$dni';";
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pudieron obtener los datos de la persona.\n");
		if (mysqli_num_rows($resultado) == 1) 
		{
			$datos = mysqli_fetch_assoc($resultado);
			$cod_persona = $datos['cod_persona'];
#2-Es necesario almacenar la dirección.
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
			echo $consulta . "<br>";
			$resultado = mysqli_query($db->conexion, $consulta) 
			or die ("No se pudieron guardar los datos en la tabla direccion.\n");
			$id_insertado = mysqli_insert_id($db->conexion);
			echo $id_insertado;
#3-Se requiere guardar el registro que relaciona la dirección guardada con la persona correspondiente
			$consulta = "	INSERT INTO `rel_persona_direccion`(
								  `cod_persona`
								, `cod_direccion`
								#, `observaciones`
								, `usr_ult_modif`
								, `fec_ult_modif`)
							VALUES (
								  '$cod_persona'
								, '$id_insertado'
								#, <{observaciones: }>
								, '$usr_ult_modif'
								, '$fec_ult_modif'));";
			echo $consulta . "<br>";
			$resultado = mysqli_query($db->conexion, $consulta) 
			or die ("No se pudieron guardar los datos de la relación entre direccion y la persona.");
		}
		$db->close();
	}
	
//====================================================================================================
	public function actualizarDireccion()
		{
			
		}
	}

?>