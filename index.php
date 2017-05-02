<?php
	session_start();		
?>

<html lang="en">

	<head>
		<!-- Latest compiled and minified CSS
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<meta charset="utf-8"> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<style>
			.jumbotron {
				background-color: #fff;
				color: #000;
			}
			
			.col-center{
				float: none;
				margin: 0 auto;
			}
			
			.centrado-porcentual {
				position: absolute;
				left: 50%;
				top: 50%;
				transform: translate(-50%, -50%);
				-webkit-transform: translate(-50%, -50%);
			}
			
		</style>
	</head>

	<body>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4 col-md-4">
				</div>
				
				<div class="col-sm-4 col-md-4">
					<form method = "POST" action = "php/validaLogin.php">
						<div style="margin-top: 50%;">
							<label for="usuario">Usuario</label>
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php 
																																if(isset($_COOKIE['usuario']))
																																	{
																																	echo $_COOKIE['usuario'];
																																	}
																																?>">
							</input>
							<br>
							<label for="pass">Contraseña</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="<?php 
																																if(isset($_COOKIE['password']))
																																	{
																																	echo $_COOKIE['password'];
																																	}
																																?>">
							</input>
							<br>
						</div>
						<div style="float: right">
							<?php 
								if(isset($_COOKIE['usuario']))
									{
									echo '<input type = "checkbox" name = "recordar" value = "no"> No recordarme </input>';
									}
									else{
										echo '<input type = "checkbox" name = "recordar" value = "si"> Recordarme </input>';
										} 							
							?>
							<input type = "submit" class = "btn btn-default" value = "Ingresar"></input>
							<!--
							<a href="home.php">
								<input type = "button" class = "btn btn-success" value = "Aceptar">
							</a>
							-->
						</div>
					</form>
				</div>
				
				<div class="col-sm-4 col-md-4">
				</div>
			</div>			
		</div>
		
		
	</body>

</html>
