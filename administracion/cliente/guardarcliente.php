<?php
include ("../../conexion.php");
include ("../../funcionesphp.php");

function validaLongitud($valor, $permiteVacio, $minimo, $maximo)
{
	$cantCar=strlen($valor);
	if(empty($valor))
	{
		if($permiteVacio) return TRUE;
		else return FALSE;
	}
	else
	{
		
		if($cantCar>=$minimo && $cantCar<=$maximo) return TRUE;
		else return FALSE;
	}
}

function validaCorreo($valor)
{
	if(eregi("([a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30})", $valor)) return TRUE;
	else return FALSE;
}

function validaNumero($valor)
{
	if(eregi("([0-9])", $valor)) return TRUE;
	else return FALSE;
}

// MAIN	

if($_POST)
{
	foreach($_POST as $clave => $valor) $$clave=$valor;
	//sleep(3);
	$error = 0;
	
	if(!validaLongitud($cedrif, 0, 3, 12)) $error =6;
	if(!validaLongitud($nombre, 0, 3, 500)) $error =1;
	if(!validaLongitud($tel1, 1, 5, 50)) $error =2;
	if(!validaLongitud($twi, 1, 5, 50)) $error =3;
	if(!validaLongitud($correo, 1, 5, 50)) $error =4;
	if(!validaLongitud($dire, 1, 3, 500)) $error =5;
	
	//if(!validaLongitud($credimonto, 0, 1, 15)) $error =7;
	//if(!validaLongitud($credidias, 0, 1, 3)) $error =8;
	//echo $credidias;
	
	$tabla="cliente";
	$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
		
	if ($accion == "guardar")		
	{	
		if (($nombreViejo!=$nombre) && buscar_existe_campo_status($cedrif,$tabla,'cedrif',1))
		{
			echo "Existe";
		}
		else
		{
			if($error!=0) echo "Error=".$error." -".$credidias."-";
			else 
			{ 
				$sql="INSERT INTO ".$tabla." values(null,'".$nombre."','".$cedrif."','".$dire."','".$tel1."','".$twi."','".$correo."',1,'".$credimonto."','".$credidias."');";
				$guardo_bien = mysql_query($sql);
				
				if ($guardo_bien) echo "OK";
				else 
				{
					echo $sql;
				}
			}
		}
	}//FIN GUARDAR		
	
	if ($accion == "editar")
	{
		if (($nombreViejo!=$nombre) && (buscar_existe_nombre_status($nombre,$tabla,1)))
		{
			echo "Existe";
		}
		else
		{
			if($error==1) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET nombre = '".$nombre."', cedrif = '".$cedrif."', direccion = '".$dire."', telefono = '".$tel1."', twitter= '".$twi."', correo = '".$correo."', credito_monto = '".$credimonto."', credito_dias = '".$credidias."' WHERE id = '".$id."'";
				$edito_bien = mysql_query($sql);
				
				if ($edito_bien) echo "Editado";
				else 
				{
					echo $sql;
				}
			}	
		}	
	}	//IF EDITAR
	if ($accion == "eliminar")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = '0'  WHERE id = '".$id."'";
		$elimino_bien = mysql_query($sql);
		
		if ($elimino_bien) echo "Eliminado";
		else 
		{
			echo "No se pudo Eliminar el registro en la Base de Datos";
		}
	} //IF ELIMINAR
	mysql_close();
}
?>