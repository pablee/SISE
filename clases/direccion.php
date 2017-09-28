<?php
include_once "database.php";
include_once "localidad.php";
include_once "partido.php";
include_once "provincia.php";

class Direccion
	{
	private $campos_tabla=array("cod_direccion",
								//"domicilio",
								"calle",
								"numero",
								"piso",
								"departamento",
								"torre",
								"cod_provincia ",
								"cod_partido",
								"cod_localidad",
								"codigo_postal ",								
								"usr_ult_modif",
								"fec_ult_modif");
								
	private $campos_input=array(//"domicilio",
								"calle",
								"numero",
								"piso",
								"departamento",
								"torre",
								"cod_provincia",
								"cod_partido",
								"cod_localidad",
								"codigo_postal");

//====================================================================================================
	public function formularioDireccion()
		{
		$localidad = new Localidad();
		$partido = new Partido();
		$provincia = new Provincia();
		
		foreach($this->campos_input as $campo)
			{
			echo '<br>';						
			switch ($campo) 
				{
				case "domicilio":					
					break;
					
				case "cod_provincia":
					echo '<label for="cod_provincia"> Provincia </label>
					  <select id="cod_provincia" name="cod_provincia" class="form-control">';	
					  $provincia->verProvincia();	
					echo '</select>';
					break;	
				
				case "cod_partido":
					echo '<label for="cod_partido"> Partido </label>
					  <select id="cod_partido" name="cod_partido" class="form-control">';	
					  $partido->verPartido();	
					echo '</select>';
					break;
					
				case "cod_localidad":
					echo '<label for="cod_localidad"> Localidad </label>
					  <select id="cod_localidad" name="cod_localidad" class="form-control">';	
					  $localidad->verLocalidad();	
					echo '</select>';
					break;
				
				default:
				echo '<label for="'.$campo.'">'.ucwords(str_replace("_"," ",$campo)).'</label>';
				echo '<input type="text" class="form-control" id="'.$campo.'"></input>';			
				}
			}	
		}

		
//====================================================================================================
	/*En esta función corresponde guardar la información de la dirección de una persona cargada en el 
	formulario de persona. 
	1-Es necesario obtener el código de la persona a la que corresponde el domicilio. 
	2-Es necesario almacenar la dirección. 
	3-Se requiere guardar el registro que relaciona la dirección guardada con la persona correspondiente.*/
	public function guardarDireccion($cod_persona,$dni,$calle,$numero,$piso,$departamento,$torre,$cod_localidad,$cod_partido,$cod_provincia,$codigo_postal,$usr_ult_modif,$fec_ult_modif)
		{
		$db = new database();
		$db->conectar();
		
		//1-Es necesario obtener el código de la persona a la que corresponde el domicilio.
		//-----MEJORAR-----Lo mejor sería que haya un objeto y sus métodos, pero bueno, a falta de eso lo hacemos directo.
		/*
		$consulta = "SELECT cod_persona
					 FROM bsd_persona
					 WHERE dni = '$dni';";
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pudieron obtener los datos de la persona.\n");
		
		if (mysqli_num_rows($resultado) == 1) 
			{
			$datos = mysqli_fetch_assoc($resultado);
			$cod_persona = $datos['cod_persona'];
			//Sería necesario buscar los nombres de las localidades, partidos y provincias y agregar en domicilio.
			
		*/
		//2-Es necesario almacenar la dirección.
			$domicilio=$calle." ".$numero." ".$piso." ".$departamento." ".$torre;
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
							,'$usr_ult_modif'
							,'$fec_ult_modif');";
			
			//echo $consulta . "<br>";
			$resultado = mysqli_query($db->conexion, $consulta) 
			or die ("No se pudieron guardar los datos en la tabla direccion.\n");
			
			$id_insertado = mysqli_insert_id($db->conexion);
			//echo $id_insertado;

		//3-Se requiere guardar el registro que relaciona la dirección guardada con la persona correspondiente
			$consulta = "	INSERT INTO rel_persona_direccion(
								  cod_persona
								, cod_direccion								
								, usr_ult_modif
								, fec_ult_modif)
							VALUES (
								  '$cod_persona'
								, '$id_insertado'								
								, '$usr_ult_modif'
								, '$fec_ult_modif');";
			//echo $consulta . "<br>";
			
			$resultado = mysqli_query($db->conexion, $consulta) 
			or die ("No se pudieron guardar los datos de la relación entre direccion y la persona.");
			//}
		$db->close();
		}
	

//====================================================================================================
	public function buscarDireccion($datos)
		{
		$db = new database();
		$localidad=new Localidad();
		$partido=new Partido();
		$provincia=new Provincia();
		$cod_direccion=$datos["cod_direccion"];
		
		$db->conectar();
		$consulta="SELECT * 
				   bsd_direccion DIR 
				   WHERE cod_direccion = '$cod_direccion';";
				
		foreach($this->campos_input as $campo)
			{
			echo '<br>';						
			switch ($campo) 
				{
				case "usr_ult_modif":
					break;

				case "fec_ult_modif":
					break;		
				
				case "domicilio":
					echo '<label for="domicilio"> Domicilio </label>';
					echo '<p>'.$datos["calle"]." ".$datos["numero"].'</p>';
					break;
				
				case "cod_localidad":							
					echo '<label for="cod_localidad"> Localidad </label>
						  <select id="cod_localidad" name="cod_localidad" class="form-control">';	
						  $localidad->buscarLocalidad($datos["cod_localidad"]);
					echo '</select>';
					break;		
				
				case "cod_partido":					
					echo '<label for="cod_partido"> Partido </label>
						  <select id="cod_partido" name="cod_partido" class="form-control">';	
						  $partido->buscarPartido($datos["cod_partido"]);
					echo '</select>';
					break;		
				
				case "cod_provincia":					
					echo '<label for="cod_provincia"> Provincia </label>
						  <select id="cod_provincia" name="cod_provincia" class="form-control">';	
						  $provincia->buscarProvincia($datos["cod_provincia"]);
					echo '</select>';
					break;						
					
				default:
					echo '<label for="'.$campo.'"> '.ucwords(str_replace("_"," ",$campo)).' </label>';
					echo '<input id="'.$campo.'" name="'.$campo.'" type="text" class="form-control" value="'.$datos[$campo].'"></input>';
				}				
			}		
		}
	
	
//====================================================================================================
	public function actualizarDireccion($cod_persona,$dni,$calle,$numero,$piso,$departamento,$torre,$cod_localidad,$cod_partido,$cod_provincia,$codigo_postal,$usr_ult_modif,$fec_ult_modif)
		{
		$domicilio=$calle." ".$numero;
		$db = new database();
		$db->conectar();
		/*
		$consulta="SELECT *
				   FROM bsd_persona
				   WHERE dni='$dni';";
		$persona=mysqli_query($db->conexion, $consulta) 
		or die ("No se encontro la persona en la actualizacion de la direccion.\n");
		
		$datos_persona=mysqli_fetch_assoc($persona);
		$cod_persona=$datos_persona["cod_persona"];
		*/
		$consulta="SELECT *
				   FROM rel_persona_direccion
				   WHERE cod_persona='$cod_persona';";
		$direccion=mysqli_query($db->conexion, $consulta) 
		or die ("No se encontro la relacion entre la persona y la direccion.\n");
		$datos_direccion=mysqli_fetch_assoc($direccion);
		$cod_direccion=$datos_direccion["cod_direccion"];
		
		$consulta = "UPDATE bsd_direccion 
					 SET domicilio='$domicilio'
						,calle='$calle'
						,numero='$numero'
						,piso='$piso'
						,departamento='$departamento'
						,torre='$torre'
						,cod_localidad='$cod_localidad'
						,cod_partido='$cod_partido'
						,cod_provincia='$cod_provincia'
						,codigo_postal='$codigo_postal'
						,usr_ult_modif='$usr_ult_modif'
						,fec_ult_modif='$fec_ult_modif'
					 WHERE cod_direccion='$cod_direccion';";
			
			//echo $consulta . "<br>";
			$resultado = mysqli_query($db->conexion, $consulta) 
			or die ("No se pudieron guardar los datos en la tabla direccion.\n");
			
		$db->close();
		}
	
	}

?>