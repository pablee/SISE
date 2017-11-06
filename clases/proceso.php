<?php
include_once "database.php";
include_once "proceso_tipo.php";
include_once "persona.php";
include_once "detalle_tipo.php";
include_once "observaciones.php";
include_once "usuario.php";

class Proceso	
{
	private $encabezados = array(
								"Tipo de proceso",
								"Carátula",
								"Tipo",
								"Observaciones",
								"ultimas novedades",
								"usuario de creacion",
								"usuario de cooperacion",
								"Modifica",
								"Fecha"
								);

	private $nombre_campo = array(
								"cod_proceso",
								"proceso",
								"cod_proceso_tipo",
								"observaciones",
								"ultimas_novedades",
								"usr_creacion",
								"usr_cooperacion",
								"usr_ult_modif",
								"fec_ult_modif"
								);

	private $condiciones = array(
								"elegir",
								"otro",
								"cliente",
								"oponente",
								"empleador"
								);

	private $rel_pers_cond_proc = array(
									"cod_proceso",
									"cod_persona",
									"cod_persona_condicion",
									"orden",
									"observaciones",
									"usr_ult_modif",
									"fec_ult_modif"
									);
									
/*=================================================================================================*/
	public function nuevoProceso()
	{					
		$cod_proceso = 0;
		$persona = new Persona();
		$proceso_tipo = new ProcesoTipo();		
		$usuario = new usuario();


		echo '<h3>Agregar una persona al proceso</h3>
			  <br>
			  <div class="form-inline">
				<div class="form-group">
					<label for="agregar">Condición:</label>	
					<select id="persona_condicion" name="persona_condicion" class="form-control" onchange="habilitarBusqueda()">';
					$i = 0;
					foreach($this->condiciones as $condicion)
					{
						echo '<option value="'.$i.'"> '.ucwords($condicion).' </option>';	
						$i++;
					}							
		echo '		</select>	
		
					<input id="buscarPersonaProcesoApellido" name="buscarPersonaProcesoApellido" type="text" class="form-control" placeholder="Buscar por apellido" onkeypress="buscarPersonaProceso(event)" disabled></input>
					<input id="buscarPersonaProcesoNombre" name="buscarPersonaProcesoNombre" type="text" class="form-control" placeholder="Buscar por nombre o razon social" onkeypress="buscarPersonaProceso(event)" disabled></input>
					<input id="buscarPersonaProcesoDNI" name="buscarPersonaProcesoDNI" type="text" class="form-control" placeholder="Buscar por DNI" onkeypress="buscarPersonaProceso(event)" disabled></input>
					<button type="button" class="btn btn-info" onclick="buscarPersonaProceso(0)"> 
						<span class="glyphicon glyphicon-search"></span> 
					</button>
				</div>
			  </div>
			  <form action="php/detalle/guardarDetalle.php" method="POST">
				<br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th> Nombres/Razón Social </th>
								<th> Apellidos </th>
								<th> Tipo de Documento </th>
								<th> Número de documento </th>
								<th> Condición </th>
							</tr>
						</thead>
						<tbody  id="personaEncontrada"> 

						</tbody>
						<tbody  id="personaElegida"> 

						</tbody>
					</table>
				</div>'; 		
		
		echo '<br>';

		$proceso_tipo->selectProcesoTipo();
		
		echo '<input id="accion" name="accion" type="hidden" class="form-control" value="guardar"></input>';

		$usuarios = $usuario->listar();

        echo '<h3>Agregar un colaborador al proceso</h3>
			  <br>
			  
			  <label for="agregar">Colaborador:</label>	
			  <select id="id_colaborador" name="id_colaborador" class="form-control">';
              foreach($usuarios as $user)
              {
                  echo '<option value="'.$user["cod_usuario"].'"> '.ucwords($user["usuario"]).' </option>';
              }
        echo '</select>';


		echo '<br><label for="proceso"> Carátula </label>
			  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso"></input>';	
		
		echo '<br><div id="detalleTipo">
		
			  </div>';
		
		echo '<br><label for="observaciones"> Observaciones </label>
			  <textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>';

		echo '<br><label for="ultimas_novedades"> Ultimas novedades </label>
			  <textarea id="ultimas_novedades" name="ultimas_novedades" type="text" class="form-control" rows="5" cols="60"></textarea>';

		echo '<br><input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarProceso('.$cod_proceso.')"></input>';
		echo '</form>';
	}

	
/*=================================================================================================*/
	public function guardarProceso($proceso, $cod_proceso_tipo, $observaciones, $ultimas_novedades, $usr_ult_modif, $fec_ult_modif, $id_colaborador)
	{	
		$db = new database();
		$db->conectar();

		$consulta = "INSERT INTO bsd_proceso (
						cod_proceso
						, proceso
						, cod_proceso_tipo
						, observaciones
						, ultimas_novedades
						, usr_creacion
						, usr_cooperacion
						, usr_ult_modif
						, fec_ult_modif
					) VALUES (
						NULL
						, '$proceso'
						, '$cod_proceso_tipo'
						, '$observaciones'
						, '$ultimas_novedades'
						, '$usr_ult_modif'
						, '$id_colaborador'
						, '$usr_ult_modif'
						, '$fec_ult_modif'
					);";
		
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pudo ingresar el proceso.");
		$cod_proceso = mysqli_insert_id($db->conexion);
		$db->close();
		return $cod_proceso;
	}

	
/*=================================================================================================*/
	public function listarProceso()
		{
		$db = new database();
		$db->conectar();
		$user = $_SESSION['cod_usuario'];

		$consulta = "SELECT 
						PRO.cod_proceso
						, PRO.proceso
						, RPT.proceso_tipo
						, PRO.observaciones
						, PRO.usr_creacion
						, PRO.usr_cooperacion
						, U.usuario
						, PRO.fec_ult_modif
				   FROM bsd_proceso PRO
				   JOIN ref_proceso_tipo RPT ON PRO.cod_proceso_tipo = RPT.cod_proceso_tipo
				   JOIN bsd_usuario U ON PRO.usr_ult_modif = U.cod_usuario
				   WHERE PRO.usr_creacion='$user'
				      OR PRO.usr_cooperacion='$user';";

		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se pueden cargar los procesos.");
		
		echo '<h3>Últimos procesos ingresados</h3>
			  <br>
			  <div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>';
							foreach($this->encabezados as $campo)
							{
								echo "<th>".$campo."</th>";
							}	
		echo '			</tr>
					</thead>
					<tbody>';
				
		$i = 0;
		while($datos = mysqli_fetch_assoc($resultado))
		{
			echo "<tr>";	
				echo "<td>".$datos["cod_proceso"]."</td>";
				echo "<td>".$datos["proceso"]."</td>";
				echo "<td>".$datos["proceso_tipo"]."</td>";
				echo "<td>".$datos["observaciones"]."</td>";
				echo "<td>".$datos["ultimas_novedades"]."</td>";
				echo "<td>".$datos["usuario"]."</td>";
				echo "<td>".$datos["fec_ult_modif"]."</td>";							
			echo "</tr>";
			$procesos[$i]=$datos;
			$cod_proceso=$datos["cod_proceso"];
			$i++;
		}
			
		echo '		</tbody>
				</table>
			  </div>';
			  
		$db->close();
		//return $cod_proceso;
		//return $datos;
		if ($datos = mysqli_fetch_assoc($resultado)) 
		{
			return $procesos;
		}
	}

	
/*=================================================================================================*/
	public function buscarProceso($buscar)
	{
		$db = new database();
		$db->conectar();
		
		if (empty($buscar) == true)
		{
			$buscar = '';
		}
		
		$buscarPersonaNombre = $buscar[0];
		$buscarPersonaApellido = $buscar[1];
		$buscarPersonaDNI = $buscar[2];
		$user = $_SESSION['cod_usuario'];

		//En caso de que buscar sea un array va a buscar por nombre, apellido o dni, de lo contrario proviene de la funcion "elegirPersona(cod_persona)"
		if(is_array($buscar))
			{
			$buscarPersonaNombre = $buscar[0];
			$buscarPersonaApellido = $buscar[1];
			$buscarPersonaDNI = $buscar[2];
			
			//Variables de alerta para saber que campo de busqueda fue ingresado
			$buscarAp=false;
			$buscarNom=false;
			$buscarDNI=false;
			
			$consulta = "SELECT PRO.cod_proceso, 
							PRO.proceso, 
							PER.cod_persona, 
							PER.nombres, 
							PER.razon_social, 
							PER.apellidos, 
							PER.dni 
						FROM rel_pers_cond_proc PCP 
						JOIN bsd_persona PER ON PCP.cod_persona = PER.cod_persona 
						JOIN bsd_proceso PRO ON PCP.cod_proceso = PRO.cod_proceso 
						WHERE ";
			
			//Averiguo por que campos esta buscando
			if($buscarPersonaApellido!="")
				{
				$buscarPorApellido="PER.apellidos LIKE '%$buscarPersonaApellido%'";
				$buscarAp=true;
				}
			if($buscarPersonaNombre!="")
				{
				$buscarPorNombre="PER.nombres LIKE '%$buscarPersonaNombre%' OR razon_social LIKE '%$buscarPersonaNombre%'";
				$buscarNom=true;
				}
			if($buscarPersonaDNI!="")
				{
				$buscarPorDNI="PER.dni = '$buscarPersonaDNI'";
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
				$consulta ="SELECT 	PRO.cod_proceso, 
									PRO.proceso, 
									PER.cod_persona, 
									PER.nombres, 
									PER.razon_social, 
									PER.apellidos, 
									PER.dni 
							FROM rel_pers_cond_proc PCP 
							JOIN bsd_persona PER ON PCP.cod_persona = PER.cod_persona 
							JOIN bsd_proceso PRO ON PCP.cod_proceso = PRO.cod_proceso 
							WHERE PER.nombres LIKE '%$buscarPersonaNombre%' 
								OR PER.razon_social LIKE '%$buscarPersonaNombre%' 
								OR PER.apellidos LIKE '%$buscarPersonaApellido%'
								OR PER.dni = '$buscarPersonaDNI';";
				}
		
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pueden cargar los procesos.");
		
		echo '<h3>Seleccione un proceso para editar</h3>
			  <br>
			  <div class="table-responsive">
				<table class="table table-striped" id="">
					<thead>
						<tr>
							<!--<th> Cód. Proc. </th>-->
							<th> Carátula </th>
							<!--<th> Cód. Pers. </th>-->
							<th> Nombres/Razón Social </th>
							<th> Apellidos </th>
							<th> Núm. de Doc. </th>
							<th> Opción </th>
						</tr>
					</thead>
					<tbody>';
					while($datos = mysqli_fetch_assoc($resultado))
					{	
						echo '<tr>
								<!--<td>'.$datos["cod_proceso"].'</td>-->
								<td>'.$datos["proceso"].'</td>
								<!--<td>'.$datos["cod_persona"].'</td>-->
								<td>'.$datos["nombres"].$datos["razon_social"].'</td>
								<td>'.$datos["apellidos"].'</td>
								<td>'.$datos["dni"].'</td>
								<td><button type="button" class="btn btn-link" onclick="elegirProceso(\''.$datos["cod_persona"].'\',\''.$datos["cod_proceso"].'\')">Elegir</button></td>
							  </tr>';
					}
						// echo '<a href=# onclick="return ReAssign(\'' + $valuationId + '\',\'' + $user + '\')">Re-Assign</a>';

		echo '		</tbody>
			</table>
		  </div>';  
		$db->close();
	}							

	
/*=================================================================================================*/
	public function elegirProceso($cod_persona, $cod_proceso)
	{
		$db = new database();
		$db->conectar();
		
		$consulta = "SELECT 
						PRO.cod_proceso, 
						PRO.proceso, 
						PRO.cod_proceso_tipo, 
						PRO.observaciones, 
						PRO.ultimas_novedades, 
						PRO.usr_creacion,
						PRO.usr_cooperacion,
						PRO.usr_ult_modif, 
						PRO.fec_ult_modif, 
						PCP.cod_persona, 
						PCP.cod_persona_condicion, 
						PER.dni 
					FROM rel_pers_cond_proc PCP 
					JOIN bsd_proceso PRO ON PCP.cod_proceso=PRO.cod_proceso 
					JOIN ref_persona_condicion PC ON PCP.cod_persona_condicion=PC.cod_persona_condicion 
					JOIN bsd_persona PER ON PCP.cod_persona=PER.cod_persona 
					WHERE PCP.cod_proceso=(	SELECT cod_proceso 
											FROM rel_pers_cond_proc 
											WHERE cod_persona='$cod_persona'
											AND cod_proceso='$cod_proceso');";	   
		// echo $consulta;	   
		$resultado = mysqli_query($db->conexion, $consulta) or die ("Elegir Proceso: No se pueden cargar los procesos.");
		
		$i = 0;
		while($datos = mysqli_fetch_assoc($resultado))
		{	
			$procesos[$i] = $datos;
			$i++;
		}
		  
		$db->close();
		return $procesos;
	}			

	
/*=================================================================================================*/
	public function editarProceso($cod_persona,$cod_proceso)
	{
		$persona = new Persona();
		$proceso_tipo = new ProcesoTipo();		
		$detalleTipo = new DetalleTipo();	
		$procesos = $this->elegirProceso($cod_persona,$cod_proceso);
        $usuario = new usuario();
		
		echo '<h3>Personas en proceso</h3>
			  <form action="php/detalle/guardarDetalle.php" method="POST">
				<br>							
				<div class="table-responsive">
					<table class="table table-striped" id="personaEncontrada">
						<thead>
							<tr>																									
								<th> Nombres/Razón Social </th>
								<th> Apellidos </th>
								<th> Tipo de Doc. </th>
								<th> Número de doc. </th>
								<th> Condición </th>
							</tr>
						</thead>
						<tbody>';
						$i = 0;
						foreach($procesos as $proceso)
							{
							echo '<tr>';
							$persona->buscarPersonaProceso($procesos[$i]["cod_persona"],$procesos[$i]["cod_persona_condicion"]);
							echo '</tr>';
							$i++;
							}
		echo '			</tbody>
					</table>
				</div>'; 		
		
		echo '<input id="accion" name="accion" type="hidden" class="form-control" value="actualizar"></input>';	
		echo '<input id="cod_persona" name="cod_persona" type="hidden" class="form-control" value="'.$cod_persona.'"></input>';	
		echo '<input id="cod_proceso" name="cod_proceso" type="hidden" class="form-control" value="'.$procesos[0]["cod_proceso"].'"></input>';	
		
		echo '<br>';

		$proceso_tipo->buscarProcesoTipo($procesos[0]["cod_proceso_tipo"]);

        $usuarios = $usuario->listar();
        $usuario_colaborador = $usuario->buscar($procesos[0]["usr_cooperacion"]);

        echo '<h3>Agregar un colaborador al proceso</h3>
			  <br>
			  
			  <label for="agregar">Colaborador:</label>	
			  <select id="id_colaborador" name="id_colaborador" class="form-control">';
        echo '<option value="'.$usuario_colaborador["cod_usuario"].'"> '.ucwords($usuario_colaborador["usuario"]).' </option>';
        foreach($usuarios as $user)
        {
            echo '<option value="'.$user["cod_usuario"].'"> '.ucwords($user["usuario"]).' </option>';
        }
        echo '</select>';

		echo '<br><label for="proceso"> Carátula </label>
			  <input id="proceso" name="proceso" type="text" class="form-control" placeholder="Descripcion del proceso" value="'.$procesos[0]["proceso"].'"></input>';	
		
		echo '<br>
			  <div id="detalleTipo">
			  </div>';
		
		$observaciones = new Observacion();
		$observaciones->buscarObservacionNovedadProceso($cod_proceso);
		/*
		echo '<br><label for="observaciones"> Observaciones </label>
			  <textarea id="observaciones" name="observaciones" type="text" class="form-control" value="'.$procesos[0]["observaciones"].'" rows="5" cols="60"></textarea>';	

		echo '<br><label for="ultimas_novedades"> Ultimas novedades </label>
			  <textarea id="ultimas_novedades" name="ultimas_novedades" type="text" class="form-control" value="'.$procesos[0]["ultimas_novedades"].'" rows="5" cols="60"></textarea>';	
		*/
		//Buscar las preguntas y respuestas para la persona buscada en el proceso elegido.
		echo '<br>';

		$cod_proceso = $procesos[0]["cod_proceso"];
		$detalleTipo->buscarDetalleTipo($cod_persona,$cod_proceso);

		echo '<br><input type = "submit" class = "btn btn-info" value = "Guardar" onclick="guardarProceso('.$cod_proceso.')"></input>';
		echo '</form>';					
		}

		
/*=================================================================================================*/
	public function actualizarProceso($cod_proceso, $proceso, $cod_proceso_tipo, $observaciones, $ultimas_novedades, $usr_ult_modif, $fec_ult_modif, $id_colaborador)
	{	
		$db = new database();
		$db->conectar();
		
		if($observaciones!="")
			{
			$observaciones="<br>".$observaciones;
			}
		/*
		if($ultimas_novedades!="")
			{
			$ultimas_novedades="<br>".$ultimas_novedades;
			}
		*/
		//ultimas_novedades=CONCAT(ultimas_novedades, '$ultimas_novedades')
		$consulta = "UPDATE bsd_proceso 
					SET 
						proceso='$proceso', 
						cod_proceso_tipo='$cod_proceso_tipo', 						
						observaciones=CONCAT(observaciones, '$observaciones'),					
						ultimas_novedades='$ultimas_novedades',						
						usr_cooperacion='$id_colaborador',
						usr_ult_modif='$usr_ult_modif', 
						fec_ult_modif='$fec_ult_modif'
					WHERE cod_proceso='$cod_proceso';";
		//echo $consulta;

		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pudo actualizar el proceso.");
		$cod_proceso = mysqli_insert_id($db->conexion);
		$db->close();
		return $cod_proceso;
		}

		
/*=================================================================================================*/
	public function ultimoProcesoIngresado()
	{
		$db = new database();
		$db->conectar();
		
		$consulta = "	SELECT *
				   		FROM bsd_proceso;";
				   
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pueden cargar los procesos.");

		$i = 0;
		while($datos = mysqli_fetch_assoc($resultado))
		{
			$procesos[$i] = $datos;
			$cod_proceso = $datos["cod_proceso"];
			$i++;
		}

		$db->close();
		//return $cod_proceso;
		//return $datos;
		return $procesos;
	}				

	
/*=================================================================================================*/
//Genera el insert en la tabla pers_cond_proc.(guarda la relacion de una o mas personas, clientes u oponentes, con un proceso)
	public function guardarPersCondProc($cod_proceso, $cod_persona, $cod_persona_condicion, $orden, $observaciones, $usr_ult_modif, $fec_ult_modif)
	{
		$db = new database();
		$db->conectar();

		$consulta = "INSERT INTO rel_pers_cond_proc (
						cod_proceso, 
						cod_persona, 
						cod_persona_condicion, 
						orden, 
						observaciones, 
						usr_ult_modif, 
						fec_ult_modif) 
					VALUES (
						'$cod_proceso', 
						'$cod_persona', 
						'$cod_persona_condicion', 
						'$orden', 
						'$observaciones', 
						'$usr_ult_modif', 
						'$fec_ult_modif');";
		echo $consulta;

		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pudo hacer el insert en la tabla rel_pers_cond_proc.");

		$db->close();
	}
	
	
/*=================================================================================================*/
	public function informe($usr_ult_modif)
	{
        $informe_ant="";
		$db = new database();
		$db->conectar();
					
		$consulta = "SELECT PRO.cod_proceso, PRO.proceso, PRO.observaciones, PRO.ultimas_novedades, PRO.cod_proceso_tipo, PRO_T.proceso_tipo
							, PCP_CLI.cod_persona AS cod_persona_cliente
                            , PER_CLI.nombres AS cliente_nombre
                            , PER_CLI.apellidos AS cliente_apellido
                            , PER_CLI.razon_social AS cliente_rs
                            , PER_CLI.dni AS cliente_dni
                            , PER_CLI.celular AS cliente_celular
                            , PCP_CLI.cod_persona_condicion AS cliente_cod_persona_condicion
                            , COND_CLI.persona_condicion AS cliente_persona_condicion
							, PCP_OPO.cod_persona AS oponente_cod_persona
							, PER_OPO.nombres AS oponente_nombres
                            , PER_OPO.apellidos AS oponente_apellidos
                            , PER_OPO.razon_social AS oponente_rs
                            , PER_OPO.dni AS oponente_dni
                            , PER_OPO.celular AS oponente_celular
							, PCP_OPO.cod_persona_condicion AS oponente_cod_persona_condicion
                            , COND_OPO.persona_condicion AS oponente_persona_condicion
						FROM bsd_proceso AS PRO 
						LEFT JOIN rel_pers_cond_proc AS PCP_CLI 
							ON (PRO.cod_proceso = PCP_CLI.cod_proceso AND PCP_CLI.cod_persona_condicion = 2)
						LEFT JOIN rel_pers_cond_proc AS PCP_OPO 
							ON (PRO.cod_proceso = PCP_OPO.cod_proceso AND (PCP_OPO.cod_persona_condicion = 3 OR PCP_OPO.cod_persona_condicion = 4))
						LEFT JOIN bsd_persona AS PER_CLI 
							ON (PCP_CLI.cod_persona = PER_CLI.cod_persona)
						LEFT JOIN bsd_persona AS PER_OPO
							ON (PCP_OPO.cod_persona = PER_OPO.cod_persona)
						LEFT JOIN ref_persona_condicion AS COND_CLI
							ON (PCP_CLI.cod_persona_condicion = COND_CLI.cod_persona_condicion)
						LEFT JOIN ref_persona_condicion AS COND_OPO
							ON (PCP_OPO.cod_persona_condicion = COND_OPO.cod_persona_condicion)
								, ref_proceso_tipo AS PRO_T
						WHERE PRO.cod_proceso_tipo = PRO_T.cod_proceso_tipo
						AND (PRO.usr_creacion=$usr_ult_modif
						  OR PRO.usr_cooperacion=$usr_ult_modif);";			
						
		
		$resultado = mysqli_query($db->conexion, $consulta) 
		or die ("No se pueden cargar los datos del informe.");

		$i=0;
		while($datos = mysqli_fetch_assoc($resultado))
		{
		    $informes[$i]=$datos;
		    $i++;
        }

        foreach($informes as $informe)
        {
            if($informe_ant=="")
            {
                $informe_ant=$informe;
            }
            else if($informe_ant["cod_proceso"]!=$informe["cod_proceso"])
                {
                    echo '	 
                        <div class="row"> 
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="caratula">Carátula:<button type="button" class="btn btn-link btn-lg" onclick="elegirProceso(\''.$informe_ant["cod_persona_cliente"].'\',\''.$informe_ant["cod_proceso"].'\')">'.$informe_ant["proceso"].'</button></span>					
                                    <br>
                                    <b>Tipo de proceso: '.$informe_ant["proceso_tipo"].'</b>						
                                </div>
                                <div class="panel-body">
                                    <h4>'.$informe_ant["cliente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["cliente_apellido"].' '.$informe_ant["cliente_nombre"].'</p>
                                    <p>'.$informe_ant["cliente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["cliente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["cliente_celular"].'</p>									
                                </div>					
                                <div class="panel-body">
                                    <h4>'.$informe_ant["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["oponente_apellidos"].' '.$informe_ant["oponente_nombres"].'</p>
                                    <p>'.$informe_ant["oponente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["oponente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["oponente_celular"].'</p>
                                </div>					
                                <div class="panel-body">
                                    '.$informe_ant["observaciones"].'
                                    <br>
                                    '.$informe_ant["ultimas_novedades"].'
                                </div>
                           </div>
                        </div>
                        ';
                    $informe_ant=$informe;
                }
                else
                    {
                        echo '	 
                        <div class="row"> 
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="caratula">Carátula:<button type="button" class="btn btn-link btn-lg" onclick="elegirProceso(\''.$informe["cod_persona_cliente"].'\',\''.$informe["cod_proceso"].'\')">'.$informe["proceso"].'</button></span>					
                                    <br>
                                    <b>Tipo de proceso: '.$informe["proceso_tipo"].'</b>						
                                </div>
                                <div class="panel-body">
                                    <h4>'.$informe["cliente_persona_condicion"].'</h4>
                                    <p>'.$informe["cliente_apellido"].' '.$informe["cliente_nombre"].'</p>
                                    <p>'.$informe["cliente_rs"].'</p>
                                    <p>Documento: '.$informe["cliente_dni"].'</p>
                                    <p>Celular: '.$informe["cliente_celular"].'</p>									
                                </div>					
                                <div class="panel-body">
                                    <h4>'.$informe["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe["oponente_apellidos"].' '.$informe["oponente_nombres"].'</p>
                                    <p>'.$informe["oponente_rs"].'</p>
                                    <p>Documento: '.$informe["oponente_dni"].'</p>
                                    <p>Celular: '.$informe["oponente_celular"].'</p>
                                </div>	
                                <div class="panel-body">
                                    <h4>'.$informe_ant["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["oponente_apellidos"].' '.$informe_ant["oponente_nombres"].'</p>
                                    <p>'.$informe_ant["oponente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["oponente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["oponente_celular"].'</p>
                                </div>						
                                <div class="panel-body">
                                    '.$informe["observaciones"].'
                                    <br>
                                    '.$informe["ultimas_novedades"].'
                                </div>
                           </div>
                        </div>
                        ';
                        $informe_ant=$informe;
                    }
        }
		
		$db->close();
	}			
	
	
/*=================================================================================================*/
	public function buscarInforme($buscar)
	{	
		$filtroDetalleTipoBoolean = $buscar[0];
		$respuestaBoolean = $buscar[1];
		$filtroDetalleTipo = $buscar[2];
		$respuestaTexto = $buscar[3];
        $informe_ant="";
        $i=0;

		$db = new database();
		$db->conectar();
		
		////////////////////////////////////////////////////////
		///// ACA VA LA CONSULTA PARA FILTRAR LOS INFORMES /////
		////////////////////////////////////////////////////////
		$consulta = "SELECT PRO.cod_proceso, PRO.proceso, PRO.observaciones, PRO.ultimas_novedades, PRO.cod_proceso_tipo, PRO_T.proceso_tipo
							, PCP_CLI.cod_persona AS cod_persona_cliente
                            , PER_CLI.nombres AS cliente_nombre
                            , PER_CLI.apellidos AS cliente_apellido
                            , PER_CLI.razon_social AS cliente_rs
                            , PER_CLI.dni AS cliente_dni
                            , PER_CLI.celular AS cliente_celular
                            , PCP_CLI.cod_persona_condicion AS cliente_cod_persona_condicion
                            , COND_CLI.persona_condicion AS cliente_persona_condicion
							, PCP_OPO.cod_persona AS oponente_cod_persona
							, PER_OPO.nombres AS oponente_nombres
                            , PER_OPO.apellidos AS oponente_apellidos
                            , PER_OPO.razon_social AS oponente_rs
                            , PER_OPO.dni AS oponente_dni
                            , PER_OPO.celular AS oponente_celular
							, PCP_OPO.cod_persona_condicion AS oponente_cod_persona_condicion
                            , COND_OPO.persona_condicion AS oponente_persona_condicion
						FROM bsd_proceso AS PRO 
						LEFT JOIN rel_pers_cond_proc AS PCP_CLI 
							ON (PRO.cod_proceso = PCP_CLI.cod_proceso AND PCP_CLI.cod_persona_condicion = 2)
						LEFT JOIN rel_pers_cond_proc AS PCP_OPO 
							ON (PRO.cod_proceso = PCP_OPO.cod_proceso AND (PCP_OPO.cod_persona_condicion = 3 OR PCP_OPO.cod_persona_condicion = 4))
						LEFT JOIN bsd_persona AS PER_CLI 
							ON (PCP_CLI.cod_persona = PER_CLI.cod_persona)
						LEFT JOIN bsd_persona AS PER_OPO
							ON (PCP_OPO.cod_persona = PER_OPO.cod_persona)
						LEFT JOIN ref_persona_condicion AS COND_CLI
							ON (PCP_CLI.cod_persona_condicion = COND_CLI.cod_persona_condicion)
						LEFT JOIN ref_persona_condicion AS COND_OPO
							ON (PCP_OPO.cod_persona_condicion = COND_OPO.cod_persona_condicion)
								, ref_proceso_tipo AS PRO_T
						WHERE PRO.cod_proceso_tipo = PRO_T.cod_proceso_tipo
						AND (PRO.cod_proceso IN 
												(
												SELECT cod_proceso
												FROM bsd_detalle
												WHERE 	(	
														cod_detalle_tipo = '$filtroDetalleTipoBoolean'
														AND 
						                                valor = '$respuestaBoolean'
						                                )
												   OR 	(
														cod_detalle_tipo = '$filtroDetalleTipo'
						                                AND
						                                valor = '$respuestaTexto'
						                                )
												)
						
						);";
						//Tuve que sacar esto porque al tener campos del filtro en blanco rompe la consulta					
						/*
						OR ($filtroDetalleTipoBoolean = null)
						OR ($filtroDetalleTipo = null)
						*/

		$resultado = mysqli_query($db->conexion, $consulta) or die ("No se pueden filtrar los datos del informe.");

        while($datos = mysqli_fetch_assoc($resultado))
        {
            $informes[$i]=$datos;
            $i++;
        }

        foreach($informes as $informe)
        {
            if($informe_ant=="")
            {
                $informe_ant=$informe;
            }
            else if($informe_ant["cod_proceso"]!=$informe["cod_proceso"])
            {
                echo '	 
                        <div class="row"> 
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="caratula">Carátula:<button type="button" class="btn btn-link btn-lg" onclick="elegirProceso(\''.$informe_ant["cod_persona_cliente"].'\',\''.$informe_ant["cod_proceso"].'\')">'.$informe_ant["proceso"].'</button></span>					
                                    <br>
                                    <b>Tipo de proceso: '.$informe_ant["proceso_tipo"].'</b>						
                                </div>
                                <div class="panel-body">
                                    <h4>'.$informe_ant["cliente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["cliente_apellido"].' '.$informe_ant["cliente_nombre"].'</p>
                                    <p>'.$informe_ant["cliente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["cliente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["cliente_celular"].'</p>									
                                </div>					
                                <div class="panel-body">
                                    <h4>'.$informe_ant["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["oponente_apellidos"].' '.$informe_ant["oponente_nombres"].'</p>
                                    <p>'.$informe_ant["oponente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["oponente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["oponente_celular"].'</p>
                                </div>					
                                <div class="panel-body">
                                    '.$informe_ant["observaciones"].'
                                    <br>
                                    '.$informe_ant["ultimas_novedades"].'
                                </div>
                           </div>
                        </div>
                        ';
                $informe_ant=$informe;
            }
            else
            {
                echo '	 
                        <div class="row"> 
                           <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="caratula">Carátula:<button type="button" class="btn btn-link btn-lg" onclick="elegirProceso(\''.$informe["cod_persona_cliente"].'\',\''.$informe["cod_proceso"].'\')">'.$informe["proceso"].'</button></span>					
                                    <br>
                                    <b>Tipo de proceso: '.$informe["proceso_tipo"].'</b>						
                                </div>
                                <div class="panel-body">
                                    <h4>'.$informe["cliente_persona_condicion"].'</h4>
                                    <p>'.$informe["cliente_apellido"].' '.$informe["cliente_nombre"].'</p>
                                    <p>'.$informe["cliente_rs"].'</p>
                                    <p>Documento: '.$informe["cliente_dni"].'</p>
                                    <p>Celular: '.$informe["cliente_celular"].'</p>									
                                </div>					
                                <div class="panel-body">
                                    <h4>'.$informe["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe["oponente_apellidos"].' '.$informe["oponente_nombres"].'</p>
                                    <p>'.$informe["oponente_rs"].'</p>
                                    <p>Documento: '.$informe["oponente_dni"].'</p>
                                    <p>Celular: '.$informe["oponente_celular"].'</p>
                                </div>	
                                <div class="panel-body">
                                    <h4>'.$informe_ant["oponente_persona_condicion"].'</h4>
                                    <p>'.$informe_ant["oponente_apellidos"].' '.$informe_ant["oponente_nombres"].'</p>
                                    <p>'.$informe_ant["oponente_rs"].'</p>
                                    <p>Documento: '.$informe_ant["oponente_dni"].'</p>
                                    <p>Celular: '.$informe_ant["oponente_celular"].'</p>
                                </div>						
                                <div class="panel-body">
                                    '.$informe["observaciones"].'
                                    <br>
                                    '.$informe["ultimas_novedades"].'
                                </div>
                           </div>
                        </div>
                        ';
                $informe_ant=$informe;
            }
        }
		$db->close();
	}			
}
?>