<?php
	include ("TfhkaPHP.php");
	include ("conexion.php");
	include ("funcionesphp.php");
	import_request_variables("gP","F");
	
	$accion = $_POST["acc"];
	
	$itObj = new Tfhka(); 
	
	$checkeo = $itObj->CheckFprinter();
	
	if($checkeo)
	{
	
		if ($accion == "x") {
			$rept = $itObj->SenCmd("I0X");	
			
	   }
	   if ($accion == "z") {
			$rept = $itObj->SenCmd("I0Z");	
			
	   } 
				
			if($rept)
			{
				echo "OK";				
			}
			else
			{
				echo "NO";
			}
			
	}
	else
	{
		echo "CONEXION";
	}		
		
	 
?>