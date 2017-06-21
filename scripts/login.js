function login()
	{	
	var usuario=document.getElementById("usuario").value;
	var pass=document.getElementById("password").value;
	
	xhttp = new XMLHttpRequest();			
	xhttp.onreadystatechange = function()	
			{					
			if (this.readyState == 4 && this.status == 200)
				{
				document.getElementById("alert").innerHTML=this.responseText;									
				}						
			};
			
	xhttp.open("GET", "php/validaLogin.php?usuario="+usuario+"&password="+pass, true);
	xhttp.send();	
	}	