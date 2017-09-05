<?php
include_once "database.php";

class Categoria{
				private $tipoPersona = array("fisica","juridica");

//=================================================================================
				public function verCategoria() 
					{
					echo'	
						<label for="cod_categoria"> Categoria </label>
						<select id="cod_categoria" name="cod_categoria" class="form-control">
							<option value=""> Elegir... </option>
						';
					
					$i=1;	
					foreach($this->tipoPersona as $tipo)
						{
						echo '<option value="'.$i.'"> Persona '.ucwords($tipo).' </option>';
						$i++;
						}	
												
					echo '</select>';		
					}

//================================================================================
				public function buscarCategoria($idCategoria) 
					{
					$i=1;
					foreach($this->tipoPersona as $tipo)
						{
						if($idCategoria==$i)
							{
							$campo=$tipo;	
							}
						$i++;	
						}
						
					echo'	
						<label for="cod_categoria"> Código de Categoria </label>
						<select id="cod_categoria" name="cod_categoria" class="form-control">';
					if($idCategoria==0)
						{
						echo'<option value="0"> Elegir </option>';
						}
						else{
							echo'<option value="'.$idCategoria.'"> Persona '.ucwords($campo).' </option>';
							}
					
					
					echo'		
							<option value="1"> Persona Fisica </option>
							<option value="2"> Persona Juridica </option>
						</select>	
						';
					}	
				}		
?>