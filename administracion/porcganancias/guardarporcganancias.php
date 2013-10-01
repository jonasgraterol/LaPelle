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
	
	if(!validaLongitud($porc1, 0, 1, 10)) $error =3;
	if(!validaLongitud($porc2, 0, 1, 10)) $error =6;
	if(!validaLongitud($porc3, 0, 1, 10)) $error =7;
	
	$tabla="porc_ganancia";
	
		
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
				$sql="INSERT INTO ".$tabla." values(null,'".$nombre."','".$abrev."',1);";
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
		if($error==1) echo "Error";
			else 
			{
				//$id= $_GET['id'];
				$sql="UPDATE ".$tabla." SET porc_p1 = ".$porc1.", porc_p2 = ".$porc2.", porc_p3 = ".$porc3.", ajuste_automatico = ".$automatico." WHERE id = '".$id."'";
				$edito_bien = mysql_query($sql);
				
				if ($edito_bien) echo "Editado";
				else 
				{
					echo $sql;
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