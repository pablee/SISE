<?php
session_start();
include_once "../../clases/proceso.php";
include_once "../../clases/filtro.php";
$usr_ult_modif=$_SESSION['cod_usuario'];

$filtro = new Filtro();

echo'<!--Menu: Buscar/Comandos-->
	 <div class="row" id="busqueda">							
		<div class="col-sm-1 col-md-1 col-lg-1">
			
		</div>

		<div class="col-sm-2 col-md-2 col-lg-2">';
			$filtro->filtroDetalleTipoBoolean();
echo'	</div>
		
		<div class="col-sm-2 col-md-2 col-lg-2">';
			$filtro->respuestaBoolean();
echo'	</div>
		
		<div class="col-sm-3 col-md-3 col-lg-3">';
			$filtro->filtroDetalleTipo();
echo'	</div>
				
		<div class="col-sm-2 col-md-2 col-lg-2">';
			$filtro->respuestaTexto();
echo'	</div>
			
		<div class="col-sm-2 col-md-2 col-lg-2">
			<button type="button" class="btn btn-info" onclick="buscarInforme(0)"> 
				<span class="glyphicon glyphicon-search"></span> 
			</button>
		</div>
		
	</div>
	<hr>
	';
	
$proceso = new Proceso();
$proceso->informe($usr_ult_modif);
 
?>          