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
	
	if(!validaLongitud($nomb, 0, 3, 500)) $error =1;
	if(!validaLongitud($tiposervicioId, 0, 1, 5)) $error =2;
	if(!validaLongitud($precio, 0, 1, 10)) $error =3;
	if(!validaLongitud($precio2, 0, 1, 10)) $error =6;
	if(!validaLongitud($precio3, 0, 1, 10)) $error =7;
	if(!validaLongitud($imagen, 1, 1, 200)) $error =4;
	if(!validaLongitud($desc, 1, 3, 500)) $error =5;
	
	
	$tabla="servicio";
	$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
		
	if ($accion == "guardar")		
	{	
		if (($nombreViejo!=$nomb) && buscar_existe_nombre_status($nomb,$tabla,1))
		{
			echo "Existe";
		}
		else
		{
			if($error!=0) echo "Error=".$error;
			else 
			{ 
				$sql="INSERT INTO ".$tabla." values(null,'".$nomb."','".$desc."','".$tiposervicioId."','".$precio."','".$precio2."','".$precio3."','".$imagen."',1);";
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
		if (($nombreViejo!=$nomb) && (buscar_existe_nombre_status($nomb,$tabla,1)))
		{
			echo "Existe";
		}
		else
		{
			if($error==1) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET nombre = '".$nomb."', descripcion = '".$desc."', tipo_servicio_id = '".$tiposervicioId."', precio1 = '".$precio."', precio2 = '".$precio2."', precio3 = '".$precio3."', imagen = '".$imagen."' WHERE id = '".$id."'";
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