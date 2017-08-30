<?php
include_once "database.php";
include_once "paises.php";
include_once "tipo_dni.php";
include_once "estado_civil.php";
include_once "categoria.php";
include_once "observaciones.php";
include_once "direccion.php";

class Persona	
{	
	//Campos clase persona para los headers de las tablas
	private $th=array(
					"Nombres",
					"Apellidos",
					"Razón social",
#					"Tipo de doc.",
					"Núm. de doc.",
#					"CUIL",
#					"Fecha de nac.",
					"Sexo",
#					"Nacionalidad",
#					"Estado civil",
					"Teléfono",
#					"Código postal",
					"Profesión",
					"Categoría",
					"Observaciones",
					"Usr. última modif.",
					"Fec. última modif."
					);

	//Nombres de los campos de la tabla persona para los input
	private $nombre_campo=array("nombres",
								"apellidos",
								"razon_social",
								"cod_tipo_dni",
								"dni",
								"cuil",
								"fec_nacimiento",
								"sexo",
								"cod_nacionalidad",
								"cod_estado_civil",
								"telefono",
								"celular",
								"correo_personal_1",
								"correo_personal_2",
								"correo_laboral_1",
								"correo_laboral_2",
								"profesion",
								"cod_categoria",
								"observaciones"
								);

//===============================================================================================
	//Carga el formulario para ingresar una nueva persona.
	public function formularioPersona()
		{
		$nacionalidad = new Paises();
		$tipoDni = new TipoDni();
		$estadoCivil = new EstadoCivil();
		$categoria = new Categoria();
		$observaciones = new Observacion();
		$direccion = new Direccion();
		
		foreach($this->nombre_campo as $campo)
			{
			echo '<br>';						
			switch ($campo) 
				{
				case "cod_tipo_dni":
					$tipoDni->verTipoDNI();
					break;
				
				case "fec_nacimiento":
					echo '
						 <label for="'.$campo.'"> Fecha de nacimiento </label>
						 <input id="'.$campo.'" name="'.$campo.'" type="date"  class="form-control"></input>
						 ';
					break;
			   
			   case "sexo":
					echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';		
					echo '<div class="radio">
							<label class="radio-inline">
								<input type="radio" id="m" name="sexo" value="m"> Masculino
							</label>
							<label class="radio-inline">
								<input type="radio" id="f" name="sexo" value="f"> Femenino
							</label>
						 </div>';		
					break;
				
				case "cod_nacionalidad":
					echo '<label for="cod_nacionalidad"> Nacionalidad </label>
						  <select id="cod_nacionalidad" name="cod_nacionalidad" class="form-control">';
						  $nacionalidad->verPaises();	
					echo  '</select>';	
					break;
				
				case "cod_estado_civil":
					$estadoCivil->verEstado();
					break;
				
				case "cod_categoria":
					$categoria->verCategoria();
					break;
				
				case "observaciones":
					$observaciones->verObservacion();
					break;
				
				case "usr_ult_modif":
					break;

				case "fec_ult_modif":
					break;		
					
				default:
					//ucwords($variable) convierte a mayuscula la primer letra del string
					//str_replace(find,replace,string,count)					
					echo '<label for="'.$campo.'"> '.ucwords(str_replace("_"," ",$campo)).' </label>';
					echo '<input id="'.$campo.'" name="'.$campo.'" type="text" class="form-control" ></input>';
				}
			}
		echo "<hr>";
		$direccion->formularioDireccion();

		echo '	<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
				<input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
				<input id="accion" name="accion" type="hidden" value="nuevo_ingreso"></input>
			 ';
		//Boton que guarda el formulario.
		echo '<br>
			  <input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarPersona()"></input>			
			 ';
		}		

//===============================================================================================
	//Ingresa la persona cargada en el formulario persona.
	public function guardarPersona($nombres, $apellidos, $razon_social, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $celular, $correo_personal_1, $correo_personal_2, $correo_laboral_1, $correo_laboral_2, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif)
		{
		$db = new database();
		$db->conectar();
		$validacion = "	SELECT dni 
						FROM bsd_persona 
						WHERE dni = '$dni';";
		$resultado = mysqli_query($db->conexion, $validacion);
		if (mysqli_num_rows($resultado) == 0) 
			{
			$consulta = "INSERT INTO bsd_persona (
						  nombres
						, apellidos
						, razon_social
						, cod_tipo_dni
						, dni
						, cuil
						, fec_nacimiento
						, sexo
						, cod_nacionalidad
						, cod_estado_civil
						, telefono
						, celular
						, correo_personal_1
						, correo_personal_2
						, correo_laboral_1
						, correo_laboral_2
						, profesion
						, cod_categoria
						, observaciones
						, usr_ult_modif
						, fec_ult_modif)
					VALUES (
						  '$nombres'
						, '$apellidos'
						, '$razon_social'
						, '$cod_tipo_dni'
						, '$dni'
						, '$cuil'
						, '$fec_nacimiento'
						, '$sexo'
						, '$cod_nacionalidad'
						, '$cod_estado_civil'
						, '$telefono'
						, '$celular'
						, '$correo_personal_1'
						, '$correo_personal_2'
						, '$correo_laboral_1'
						, '$correo_laboral_2'
						, '$profesion'
						, '$cod_categoria'
						, '$observaciones'
						, '$usr_ult_modif'
						, '$fec_ult_modif');";
			//echo $consulta;
			$resultado = mysqli_query($db->conexion, $consulta) or die ("No se pudieron guardar los datos en la tabla persona.\n");
			}
			else
				{
				echo "Ya existe una persona con el mismo número de documento.\n";
				}
		$db->close();
	}

//===============================================================================================
	//Actualiza los datos de la persona.
	public function actualizarPersona($nombres, $apellidos, $razon_social, $cod_tipo_dni, $dni, $cuil, $fec_nacimiento, $sexo, $cod_nacionalidad, $cod_estado_civil, $telefono, $celular, $correo_personal_1, $correo_personal_2, $correo_laboral_1, $correo_laboral_2, $profesion, $cod_categoria, $observaciones, $usr_ult_modif, $fec_ult_modif)
		{
		$db = new database();
		$db->conectar();
		
		if($observaciones!="")
			{
			$observaciones="<br>".$observaciones;
			}
			
		$consulta = "UPDATE bsd_persona 
					SET	nombres='$nombres', 
						apellidos='$apellidos',
						razon_social='$razon_social',
						cod_tipo_dni='$cod_tipo_dni', 
						dni='$dni', 
						cuil='$cuil', 
						fec_nacimiento='$fec_nacimiento', 
						sexo='$sexo', 
						cod_nacionalidad='$cod_nacionalidad', 
						cod_estado_civil='$cod_estado_civil',
						telefono='$telefono',
						celular='$celular',
						correo_personal_1='$correo_personal_1', 
						correo_personal_2='$correo_personal_2', 
						correo_laboral_1='$correo_laboral_1', 
						correo_laboral_2='$correo_laboral_2',
						profesion='$profesion', 
						cod_categoria='$cod_categoria',
						observaciones=CONCAT(observaciones, '$observaciones'),
						usr_ult_modif='$usr_ult_modif', 
						fec_ult_modif='$fec_ult_modif'
					WHERE dni='$dni';";
		$resultado=mysqli_query($db->conexion, $consulta) or die ("No se actualizaron los datos en la tabla persona.\n");
		$db->close();
		}

//===============================================================================================
	//Busca una persona en la base de datos y la muestra.
	public function buscarPersona($buscar)
		{
		$db = new database();
		$db->conectar();
		$nacionalidad = new Paises();
		$tipoDni = new TipoDni();
		$estadoCivil = new EstadoCivil();
		$categoria = new Categoria();
		$observaciones = new Observacion();
		$direccion = new Direccion();
		$localidad=new Localidad();
		$partido=new Partido();
		$provincia=new Provincia();
		
		//Variables de alerta para saber que campo de busqueda fue ingresado
		$buscarAp=false;
		$buscarNom=false;
		$buscarDNI=false;
		
		//En caso de que buscar sea un array va a buscar por nombre, apellido o dni, de lo contrario proviene de la funcion "elegirPersona(cod_persona)"
		if(is_array($buscar))
			{
			$buscarPersonaNombre = $buscar[0];
			$buscarPersonaApellido = $buscar[1];
			$buscarPersonaDNI = $buscar[2];
		
			$consulta = "SELECT * 
						 FROM bsd_persona PER 
						 JOIN rel_persona_direccion RPD 
						 ON PER.cod_persona = RPD.cod_persona 
						 JOIN bsd_direccion DIR 
						 ON RPD.cod_direccion = DIR.cod_direccion 
						 WHERE ";
			
			//Averiguo por que campos esta buscando
			if($buscarPersonaApellido!="")
				{
				$buscarPorApellido="apellidos LIKE '%$buscarPersonaApellido%'";
				$buscarAp=true;
				}
			if($buscarPersonaNombre!="")
				{
				$buscarPorNombre="nombres LIKE '%$buscarPersonaNombre%'";
				$buscarNom=true;
				}
			if($buscarPersonaDNI!="")
				{
				$buscarPorDNI="dni = '$buscarPersonaDNI'";
				$buscarDNI=true;
				}
			
			//Armo la consulta en base a los campos que se hayan ingresado
			if($buscarAp==true)
				{
				$consulta.= $buscarPorApellido;			
				if($buscarNom==true)
					{
					$consulta.= " OR ".$buscarPorNombre;					
					if($buscarDNI==true)
						{
						$consulta.= " OR ".$buscarPorDNI;	
						}
					}
					else if($buscarDNI==true)
						{
						$consulta.= " OR ".$buscarPorDNI;	
						}
				}
				else if($buscarNom==true)
					{
					$consulta.= $buscarPorNombre;					
					if($buscarDNI==true)
						{
						$consulta.= " OR ".$buscarPorDNI;	
						}
					}	
					else if($buscarDNI==true)
						{
						$consulta.= $buscarPorDNI;	
						}	
			}
			else{
				$consulta = "SELECT * 
							 FROM bsd_persona PER 
							 JOIN rel_persona_direccion RPD 
							 ON PER.cod_persona = RPD.cod_persona 
							 JOIN bsd_direccion DIR 
							 ON RPD.cod_direccion = DIR.cod_direccion 
							 WHERE PER.cod_persona = '$buscar';";				
				}
			//echo $consulta;
			$resultado = mysqli_query($db->conexion, $consulta) or die ("No se encontró la persona.\n");
			
			//En caso de que haya varias personas con el mismo nombre o apellido.
			if (mysqli_num_rows($resultado) > 1) 
				{
				echo '<h3>Personas encontradas</h3>
				<br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>';
							foreach($this->th as $campo)
								{
								echo "<th>".$campo."</th>";
								}	
				echo '		</tr>
						</thead>
						<tbody>';
				
				$i = 0;
				while($datos = mysqli_fetch_assoc($resultado))
					{
					echo "<tr>";
						echo "<td>".$datos["nombres"]."</td>";
						echo "<td>".$datos["apellidos"]."</td>";
						echo "<td>".$datos["razon_social"]."</td>";
						#echo "<td>".$datos["tipo_dni"]."</td>";
						echo "<td>".$datos["dni"]."</td>";
						#echo "<td>".$datos["cuil"]."</td>";
						#echo "<td>".$datos["fec_nacimiento"]."</td>";
						echo "<td>".$datos["sexo"]."</td>";
						#echo "<td>".$datos["nacionalidad"]."</td>";
						#echo "<td>".$datos["estado_civil"]."</td>";
						echo "<td>".$datos["telefono"]."</td>";
						echo "<td>".$datos["profesion"]."</td>";
						echo "<td>".$datos["cod_categoria"]."</td>";
						echo "<td>".$datos["observaciones"]."</td>";
						echo "<td>".$datos["usr_ult_modif"]."</td>";
						echo "<td>".$datos["fec_ult_modif"]."</td>";
						echo '<td><button type="button" class="btn btn-link" value="'.$datos["cod_persona"].'" onclick="elegirPersona(this.value)">Elegir</button></td>';
					echo "</tr>";
					$i++;
					}
					
				echo '	</tbody>
					</table>
				</div>';	
				}//En caso de que solo exista un resultado(una sola persona encontrada).
				else{
					$datos = mysqli_fetch_assoc($resultado);
					foreach($this->nombre_campo as $campo)
						{
						echo '<br>';						
						switch ($campo) 
							{
							case "cod_tipo_dni":
								$tipoDni->buscarTipoDNI($datos[$campo]);
								break;
							
							case "fec_nacimiento":
								echo '
									 <label for="'.$campo.'"> Fecha de nacimiento </label>
									 <input id="'.$campo.'" name="'.$campo.'" type="date" value="'.$datos[$campo].'" class="form-control"></input>
									 ';
								break;
						   
							case "sexo":
								echo '<label for="'.$campo.'"> '.ucwords($campo).' </label>';	
								if($datos[$campo]=="m")
									{		
									echo '<div class="radio">
											<label class="radio-inline">
												<input type="radio" id="m" name="sexo" value="m" checked="checked"> Masculino
											</label>
											<label class="radio-inline">
												<input type="radio" id="f" name="sexo" value="f"> Femenino
											</label>
										 </div>';
									}
									else
										{
										echo '<div class="radio">
												<label class="radio-inline">
													<input type="radio" id="m" name="sexo" value="m"> Masculino
												</label>
												<label class="radio-inline">
													<input type="radio" id="f" name="sexo" value="f" checked="checked"> Femenino
												</label>
											 </div>';
										}
								break;
							
							case "cod_nacionalidad":
								echo '<label for="cod_nacionalidad"> Nacionalidad </label>
										<select id="cod_nacionalidad" name="cod_nacionalidad" class="form-control">';	
										$nacionalidad->buscarPais($datos[$campo]);	
								echo 	'</select>';	
								break;
							
							case "cod_estado_civil":
								$estadoCivil->buscarEstado($datos[$campo]);
								break;
							
							case "cod_categoria":
								$categoria->buscarCategoria($datos[$campo]);
								break;
							
							case "observaciones":
								$observaciones->buscarObservacion($datos["dni"]);
								break;
							
							case "usr_ult_modif":
								break;

							case "fec_ult_modif":
								break;		
								
							default:
								echo '<label for="'.$campo.'"> '.ucwords(str_replace("_"," ",$campo)).' </label>';
								echo '<input id="'.$campo.'" name="'.$campo.'" type="text" class="form-control" value="'.$datos[$campo].'"></input>';
							}				
						}
					//Boton para guardar las observaciones sin tener que ir al final del formulario.
					echo '<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
						  <input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
						  <input id="accion" name="accion" type="hidden" value="actualizar"></input>
						  <input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarPersona()"></input>
						  <br>
						 ';	
				
					$direccion->buscarDireccion($datos);
				
					echo '  <br>
							<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
							<input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
							<input id="accion" name="accion" type="hidden" value="actualizar"></input>
						 ';
					//Boton que guarda el formulario.
					echo '	<input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarPersona()"></input>
							<br>			
						 ';
					$db->close();
					}
		}
//===============================================================================================		
	//Busca personas en un proceso.
	public function buscarPersonaProceso($buscar,$persona_condicion)
		{
		$db=new database();
		$db->conectar();
		
	if(is_array($buscar))
		{
		//Variables de alerta para saber que campo de busqueda fue ingresado
		$buscarAp=false;
		$buscarNom=false;
		$buscarDNI=false;
		$agregarPersona=true;
		
		$buscarPersonaNombre = $buscar[0];
		$buscarPersonaApellido = $buscar[1];
		$buscarPersonaDNI = $buscar[2];
		
		$consulta = "SELECT	P.cod_persona, 
							P.nombres, 
							P.apellidos, 
							TD.tipo_dni, 
							P.dni
					FROM bsd_persona P, 
						ref_tipo_dni TD
					WHERE ( ";
					
		//Averiguo por que campos esta buscando
		if($buscarPersonaApellido!="")
			{
			$buscarPorApellido="apellidos LIKE '%$buscarPersonaApellido%'";
			$buscarAp=true;
			}
		if($buscarPersonaNombre!="")
			{
			$buscarPorNombre="nombres LIKE '%$buscarPersonaNombre%'";
			$buscarNom=true;
			}
		if($buscarPersonaDNI!="")
			{
			$buscarPorDNI="dni = '$buscarPersonaDNI'";
			$buscarDNI=true;
			}
		
		//Armo la consulta en base a los campos que se hayan ingresado
		if($buscarAp==true)
			{
			$consulta.= $buscarPorApellido;			
			if($buscarNom==true)
				{
				$consulta.= " OR ".$buscarPorNombre;					
				if($buscarDNI==true)
					{
					$consulta.= " OR ".$buscarPorDNI;	
					}
				}
				else if($buscarDNI==true)
					{
					$consulta.= " OR ".$buscarPorDNI;	
					}
			}
			else if($buscarNom==true)
				{
				$consulta.= $buscarPorNombre;					
				if($buscarDNI==true)
					{
					$consulta.= " OR ".$buscarPorDNI;	
					}
				}	
				else if($buscarDNI==true)
					{
					$consulta.= $buscarPorDNI;	
					}	
		
		$consulta.=") AND P.cod_tipo_dni = TD.cod_tipo_dni;";
		}
		else{
			$agregarPersona=false;
			$consulta ="SELECT	P.cod_persona, 
							P.nombres, 
							P.apellidos, 
							TD.tipo_dni, 
							P.dni, 
							PC.persona_condicion
					FROM bsd_persona P, 
						 ref_persona_condicion PC,
						 ref_tipo_dni TD
					WHERE P.cod_persona='$buscar'
					AND P.cod_tipo_dni = TD.cod_tipo_dni
					AND PC.cod_persona_condicion='$persona_condicion'";
			}
		
		
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar las personas.");
		if (0!=mysqli_num_rows($resultado))
			{
			while($datos = mysqli_fetch_assoc($resultado))
				{
				echo '<tr>';
				echo   '<td>'.$datos["nombres"].'</td>';
				echo   '<td>'.$datos["apellidos"].'</td>';
				echo   '<td>'.$datos["tipo_dni"].'</td>';
				echo   '<td>'.$datos["dni"].'</td>';
				if($agregarPersona==true)
					{
					echo   '<td><button type="button" class="btn btn-link" onclick="agregarPersonaProceso('.$datos['cod_persona'].')">Agregar persona</button></td>';
					}
					else{
						echo   '<td>'.$datos["persona_condicion"].'</td>';
						}
				echo "</tr>";
				}
			}
			else
				{
				echo "La persona no existe, por favor verifique que los datos ingresados sean el correcto.";
				}
		$db->close();
		}			

		
//===============================================================================================		
	//Busca personas en un proceso.
	public function agregarPersonaProceso($cod_persona,$persona_condicion)
		{
		$db=new database();
		$db->conectar();
				
		$consulta ="SELECT	P.cod_persona, 
							P.nombres, 
							P.apellidos, 
							TD.tipo_dni, 
							P.dni, 
							PC.persona_condicion
					FROM bsd_persona P, 
						 ref_persona_condicion PC,
						 ref_tipo_dni TD
					WHERE P.cod_persona='$cod_persona'
					AND P.cod_tipo_dni = TD.cod_tipo_dni
					AND PC.cod_persona_condicion='$persona_condicion'";
					
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se pudo agregar la persona.");
		
		while($datos = mysqli_fetch_assoc($resultado))
				{
				$cod_persona = $datos['cod_persona'];		
				echo "<tr>";
				echo   "<td>".$datos['nombres']."</td>
						<td>".$datos['apellidos']."</td>
						<td>".$datos['tipo_dni']."</td>
						<td>".$datos['dni']."</td>
						<td>".$datos['persona_condicion']."</td>";						
				echo "</tr>";
				}
				
		$db->close();
		}	

		
//===============================================================================================				
	//Muestra un listado de todas las personas existentes.
	public function listarPersona()
		{
		$db = new database();
		$db->conectar();
		
		$consulta = "SELECT 
						  P.nombres
						, P.apellidos
						, P.razon_social
						#, RTD.tipo_dni
						, P.dni
						#, P.cuil
						#, P.fec_nacimiento
						#, P.sexo
						, CASE P.sexo 
							WHEN 'm' THEN 'Masculino' 
							WHEN 'f' THEN 'Femenino' 
							ELSE '' 
						END AS sexo
						#, RN.nacionalidad
						#, REC.estado_civil
						, P.telefono
						, P.profesion
						, CASE P.cod_categoria
							WHEN 1 THEN 'Persona física'
							WHEN 2 THEN 'Persona jurídica'
							ELSE ''
						END AS categoria
						, P.observaciones
						, U.apellido AS usr_apellido
						, P.fec_ult_modif 
				   FROM bsd_persona P 
				   JOIN ref_tipo_dni RTD 		ON P.cod_tipo_dni = RTD.cod_tipo_dni 
				   JOIN ref_nacionalidad RN 	ON P.cod_nacionalidad = RN.cod_nacionalidad 
				   JOIN ref_estado_civil REC 	ON P.cod_estado_civil = REC.cod_estado_civil 
				   JOIN bsd_usuario U 			ON P.usr_ult_modif = U.cod_usuario;";
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se puede cargar el listado de personas.");
		
		echo '<h3>Últimas personas ingresadas</h3>
			  <br>
			  <div class="table-responsive">
				<table class="table table-striped">
				<thead>
					<tr>';																									
				foreach($this->th as $campo)
					{
					echo "<th>".$campo."</th>";
					}	
		echo '		</tr>
				</thead>
				<tbody>';
							
		$i = 0;
		$personas[$i] = "";
		while($datos = mysqli_fetch_assoc($resultado))
		{
			echo "<tr>";
				echo "<td>".$datos["nombres"]."</td>";
				echo "<td>".$datos["apellidos"]."</td>";
				echo "<td>".$datos["razon_social"]."</td>";
				#echo "<td>".$datos["tipo_dni"]."</td>";
				echo "<td>".$datos["dni"]."</td>";
				#echo "<td>".$datos["cuil"]."</td>";
				#echo "<td>".$datos["fec_nacimiento"]."</td>";
				echo "<td>".$datos["sexo"]."</td>";
				#echo "<td>".$datos["nacionalidad"]."</td>";
				#echo "<td>".$datos["estado_civil"]."</td>";
				echo "<td>".$datos["telefono"]."</td>";
				echo "<td>".$datos["profesion"]."</td>";
				echo "<td>".$datos["categoria"]."</td>";
				echo "<td>".$datos["observaciones"]."</td>";
				echo "<td>".$datos["usr_apellido"]."</td>";
				echo "<td>".$datos["fec_ult_modif"]."</td>";
			echo "</tr>";
			$personas[$i] = $datos;
			//$cod_persona=$datos["cod_persona"];
			$i++;						
		}
			
		echo '	</tbody>
				</table>
			</div>';
		
		$db->close();
		
		return $personas;
		}

//===============================================================================================	
	//Busca el codigo de la persona en la tabla persona(se utiliza en la edicion de proceso).
	public function buscarCodigoPersona($persona)
	{
		$db = new database();
		$db->conectar();
		$consulta = "SELECT *
				    FROM bsd_persona
					WHERE dni = '$persona'
					   OR nombres LIKE '%$persona%'
					   OR apellidos LIKE '%$persona%';";
		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se puede cargar la persona.\n");
		$i=0;
		while($datos = mysqli_fetch_assoc($resultado))
		{
			$personas[$i] = $datos;
			$cod_persona = $datos["cod_persona"];
			$i++;
		}
		$db->close();
		return $cod_persona;
	}			
}	
?>