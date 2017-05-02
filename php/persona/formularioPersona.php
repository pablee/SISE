<?php
session_start();
echo '
<form action="php/persona/ingresarPersona.php" method="POST">									
	<br>
	<label for="nombres"> Nombres </label>
	<input id="nombres" name="nombres" type="text" class="form-control" placeholder="Ingrese nombres"></input>
	<br>
	
	<label for="apellidos"> Apellidos </label>
	<input id="apellidos" name="apellidos" type="text" class="form-control" placeholder="Ingrese apellidos"></input>
	<br>
	
	<label for="cod_tipo_dni"> Tipo documento </label>
	<select id="cod_tipo_dni" name="cod_tipo_dni" class="form-control">
		<option value=""> Elegir... </option>
		<option value="1"> Otro </option>										
		<option value="2"> LC </option>
		<option value="3"> LE </option>
		<option value="4"> DNI </option>
	</select>
	<br>
	
	<label for="dni"> Numero documento </label>
	<input id="dni" name="dni" type="text" class="form-control" placeholder="Numero de documento"></input>
	<br>
	
	<label for="cuil"> CUIL </label>
	<input id="cuil" name="cuil" type="text" class="form-control" placeholder="CUIL"></input>
	<br>
	
	<label for="fec_nacimiento"> Fecha de nacimiento </label>
	<input id="fec_nacimiento" name="fec_nacimiento" type="date" class="form-control"></input>
	<br>
	
	<label for="sexo"> Sexo </label>
	<div class="radio">
		<label class="radio-inline">
			<input type="radio" id="sexo" name="sexo" value="m"> Masculino
		</label>
		<label class="radio-inline">
			<input type="radio" id="sexo" name="sexo" value="f"> Femenino
		</label>
	</div>
	<br>
	
	<label for="cod_nacionalidad"> Nacionalidad </label>
	<select id="cod_nacionalidad" name="cod_nacionalidad" class="form-control">
		<option value=""> Elegir... </option>
		<option value="15"> Alemana </option>
		<option value="2"> Argentina </option>
		<option value="6"> Boliviana </option>
		<option value="11"> Brasilera </option>
		<option value="5"> Chilena </option>
		<option value="7"> Colombiana </option>
		<option value="9"> Ecuatoriana </option>
		<option value="12"> Española </option>
		<option value="14"> Francesa </option>
		<option value="13">	Italiana </option>
		<option value="10">	Mexicana </option>
		<option value="4"> Paraguaya </option>
		<option value="3"> Uruguaya </option>
		<option value="8"> Venezolana </option>
		<option value="1"> Otra </option>
	</select>
	<br>
	
	<label for="cod_estado_civil"> Estado Civil</label>
	<select id="cod_estado_civil" name="cod_estado_civil" class="form-control">
		<option value=""> Elegir... </option>
		<option value="1"> Otros </option>
		<option value="2"> Soltero </option>
		<option value="3"> Casado </option>
		<option value="4"> Divorciado </option>
		<option value="5"> Viudo </option>
	</select>
	<br>
	
	<label for="telefono"> Telefono </label>
	<input id="telefono" name="telefono" type="text" class="form-control" placeholder="Ingrese telefono"></input>
	<br>
	
	<label for="codigo_postal"> Codigo Postal </label>
	<input id="codigo_postal" name="codigo_postal" type="text" class="form-control" placeholder="Codigo de persona"></input>
	<br>
	
	<label for="profesion"> Profesion </label>
	<input id="profesion" name="profesion" type="text" class="form-control" placeholder="Profesion"></input>
	<br>
	
	<label for="cod_categoria"> Codigo Categoria </label>
	<select id="cod_categoria" name="cod_categoria" class="form-control">
		<option value=""> Elegir... </option>
		<option value="1"> Persona Fisica </option>
		<option value="2"> Persona Juridica </option>
	</select>
	<br>
	
	<label for="observaciones"> Observaciones </label>
	<textarea id="observaciones" name="observaciones" type="text" class="form-control" rows="5" cols="60"></textarea>
	<br>
	
	<input id="usr_ult_modif" name="usr_ult_modif" type="hidden" value="<?php echo $_SESSION["cod_usuario"] ?></input>
	<input id="fec_ult_modif" name="fec_ult_modif" type="hidden" value="<?php echo $fecha ?>"></input>
		
	<input type = "submit" class = "btn btn-info" value = "Ingresar"></input>
	<br>
	
</form>	
';	
?>				