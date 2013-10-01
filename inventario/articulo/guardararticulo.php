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
	$tabla="articulo";
	
	if($accion!='ajustar')
	{
		if(!validaLongitud($nombre, 0, 3, 500)) $error =1;
		
		if(!validaLongitud($imagen, 1, 1, 200)) $error =4;
		
		if(!validaLongitud($tipoarticuloId, 0, 1, 5)) $error =2;
		if(!validaLongitud($tipounidadId, 0, 1, 5)) $error =3;
		if($stockmin != 0)
		{
			if(!validaLongitud($stockmin, 0, 1, 5)) $error =4;
		}	
		if(!validaLongitud($stockmax, 0, 1, 5)) $error =5;
		
		$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
	}
	
	if(!validaLongitud($precio, 0, 1, 10)) $error =3;
	if(!validaLongitud($precio2, 0, 1, 10)) $error =9;
	if(!validaLongitud($precio3, 0, 1, 10)) $error =8;
			
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
				$sql="INSERT INTO ".$tabla." values(null,'".$nombre."','".$stockmin."','".$stockmax."',0,'".$tipoarticuloId."','".$tipounidadId."',null,'".$precio."','".$precio2."','".$precio3."','".$imagen."',1,'".$venta."');";
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
			if($error!=0) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET nombre = '".$nombre."', stock_minimo = '".$stockmin."', stock_maximo = '".$stockmax."', tipo_articulo_id= '".$tipoarticuloId."', tipo_unidad_id = '".$tipounidadId."', precio1 = '".$precio."', precio2 = '".$precio2."', precio3 = '".$precio3."', imagen = '".$imagen."', venta = '".$venta."'  WHERE id = '".$id."'";
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
	
	//AJUSTES DE PRECIOS
	if ($accion == "ajustar")
	{
		if (($nombreViejo!=$nombre) && (buscar_existe_nombre_status($nombre,$tabla,1)))
		{
			echo "Existe";
		}
		else
		{
			if($error!=0) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET precio1 = '".$precio."', precio2 = '".$precio2."', precio3 = '".$precio3."' WHERE id = '".$id."'";
				$ajusto_bien = mysql_query($sql);
				
				if ($ajusto_bien) echo "Ajustado";
				else 
				{
					echo $sql;
				}
			}	
		}	
	}	//IF AJUSTAR
	mysql_close();
}
?>