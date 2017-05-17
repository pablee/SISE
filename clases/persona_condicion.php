<?php
include_once "database.php";

class PersonaCondicion{
				private $condiciones = array("otro","cliente","oponente","empleador");
					
				public function verPersonaCondicion() 
					{
					echo '<label for="persona_condicion"> Condicion </label>
						  <select id="persona_condicion" name="persona_condicion" class="form-control">';
					
					$i=1;
					foreach($this->condiciones as $condicion)
						{
						echo '<option value="'.$i.'"> '.ucwords($condicion).' </option>';	
						}
						
					$i++;
					echo '</select>';
					}	
				}		
?>