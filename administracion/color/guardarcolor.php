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
	
	if(!validaLongitud($nombre, 0, 3, 50)) $error=1;
	if(!validaLongitud($codigo, 0, 3, 7)) $error=2;
	if(!validaLongitud($abrev, 0, 1, 5)) $error=3;
	
	$tabla="color";
	$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
		
	if ($accion == "guardar")		
	{	
		if (($nombreViejo!=$nombre) && buscar_existe_nombre_status($nombre,$tabla,1))
		{
			echo "Existe";
		}
		else
		{
			if($error!=0) echo "Error=".$error;
			else 
			{ 
				$sql="INSERT INTO ".$tabla." values(null,'".$nombre."','".$codigo."','".$abrev."',1);";
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
				$sql="UPDATE ".$tabla." SET nombre = '".$nombre."', codigo = '".$codigo."', abreviatura = '".$abrev."' WHERE id = '".$id."'";
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