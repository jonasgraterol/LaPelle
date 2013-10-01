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
	foreach($_POST as $clave => $valor) $$clave = $valor;
	//sleep(3);
	$error = 0;
	
	if(!validaLongitud($nombre, 0, 1, 50)) $error=1;
	if(!validaLongitud($tipoArticulo, 0, 1, 5)) $error=2;
	
	
	$tabla="talla";
	$query = 'select * from '.$tabla.' where nombre = '.$nombre.' and tipo_alimento_id = '.$tipoArticulo.' and status = 1';
  $rs = mysql_query($query);
		
	if ($accion == "guardar")		
	{	
//		if ((($nombreViejo!=$nombre) && buscar_existe_nombre_status($nombre,$tabla,1)) && buscar_existe_campo_status($tipoArticulo,$tabla,'tipo_alimento_id',1) )
  //buscar si existe el mismo tipo de articulo con la misma talla
//  echo mysql_num_rows($rs);
    if (mysql_num_rows($rs) > 0)
		{
			echo "Existe";
		}
		else
		{
			if($error!=0) echo "Error=".$error;
			else 
			{ 
				$sql="INSERT INTO ".$tabla." values(null,'".$nombre."','".$tipoArticulo."',1);";
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
		if (mysql_num_rows($rs) > 0)
		{
			echo "Existe";
		}
		else
		{
			if($error==1) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET nombre = '".$nombre."', tipo_alimento_id = '".$tipoArticulo."' WHERE id = '".$id."'";
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