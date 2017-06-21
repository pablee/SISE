<?php
	session_start();
	include_once "clases/proceso.php";
	include_once "clases/persona.php";
	
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	setlocale (LC_TIME,"spanish");
	$_SESSION['fecha'] = date("Y-m-d H:i:s");
	$fecha2 = strftime("%A %e de %B");

	if($_SESSION['login'] == FALSE)
		{
		header("location: index.php");	
		}
	
	$_SESSION["i"]=0;
	//$_SESSION["personas"]="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SISE</title>
	<!--Bootstrap online
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	-->
	<!--Bootstrap local-->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="jquery/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="scripts/home.js"></script>
	<script type="text/javascript" src="scripts/login.js"></script>
</head>

<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="home.php">SISE</a>
			</div>
			<ul class="nav navbar-nav">
				<li class=""><a href="home.php">Home</a></li>
				<li><a href="#" onclick="cargarFormulario(1)">Persona</a></li>
				<li><a href="#" onclick="cargarFormulario(2)">Proceso</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<p class="navbar-text">	<?php echo $fecha2 ?> </p>
				<li>
					<a href="#"><span class="glyphicon glyphicon-user"></span>
					<?php echo $_SESSION['usuario'] ?>	
					</a>
				</li>
				<li>
					<a href="php/logout.php">
						<span class="glyphicon glyphicon-log-out"></span> 
						Logout 
					</a>
				</li>	
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<!--Menu: Buscar/Comandos-->
		<div class="row">							
			<div class="col-sm-2 col-md-2 col-lg-2">
			
			</div>

			<div class="col-sm-2 col-md-2 col-lg-2" id="busquedas">
				Buscar persona
				<input id="buscarPersona" name="buscarPersona" type="text" class="form-control" placeholder="Ingrese nombre o DNI" onkeypress="buscarPersona(event)"></input>				
			</div>
					
			<div class="col-sm-2 col-md-2 col-lg-2">
				<br>					
				<button type="button" class="btn btn-info" onclick="buscarPersona('0')"> 
					<span class="glyphicon glyphicon-search"></span> 
				</button>			
			</div>
			
			<div class="col-sm-2 col-md-2 col-lg-2">
				
			</div>
		</div>	
		
		
		<!--Contenido-->	
		<div id="contenido" class="row text-left">			
			<div class="col-sm-2 col-md-2 col-lg-2">
			
			</div>
								
			<div class="col-sm-8 col-md-8 col-lg-8">
			<hr>
				<div class="" id="personaProceso">
			
				</div>
				<div class="form-group" id="listado">
					
				</div>	
			</div>
			
			<div class="col-sm-2 col-md-2 col-lg-2"> 	
			</div>	
		</div>
		
		<!--Tablas con los ultimos ingresos-->	
		<div class="row text-left">			
			<div class="col-sm-1 col-md-1 col-lg-1"> 	
			</div>	
			<div class="col-sm-10 col-md-10 col-lg-10">
			<hr>
				
				<div class="form-group" id="ultimosIngresos">
					<?php
					$proceso=new Proceso();
					$proceso->buscarProceso(1);
					$informacion=$proceso->listarProceso();
					
					$persona=new Persona();
					$personas=$persona->listarPersona();
					?>
				</div>	
			</div>
			<div class="col-sm-1 col-md-1 col-lg-1"> 	
			</div>	
		</div>
		
	</div>
</body>
</html>

