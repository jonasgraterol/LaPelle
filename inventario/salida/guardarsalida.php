<?php
session_start();
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
	
	if(!validaLongitud($fecha, 0, 8, 12)) $error =3;
	
	
	$id_usu = $_SESSION['id_usuario_sis'];
		
	$mal = false;	
		
	$tabla="salida";
	//$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
		
	if ($accion == "guardar")		
	{	
		if($error!=0) echo "Error=".$error;
		else 
		{ 
			$sql = "INSERT INTO ".$tabla." values(null,'".$id_usu."','".fechaentrada($fecha)."',1);";
			$guardo_bien = mysql_query($sql);
			$salida_id=mysql_insert_id();
					
			if ($guardo_bien)
			{
				$id_ali = explode(",",$ids);
				$cant = explode(",",$cants);
				$prec = explode(",",$precios);
				$sub = explode(",",$subs);
				
								
				for ($i = 0; $i < $n; $i++)
				{
					$cantidad_actual = buscar_campo_tabla_status($id_ali[$i],"articulo","cantidad",1);
					$nueva_cantidad = $cantidad_actual - $cant[$i];
					
					//$subtotal = $servicio_servicio_cantidad[$i] * $servicio_servicio_precio[$i];
									
					$sql_detalle="INSERT INTO salida_detalle values('".$salida_id."','".$id_ali[$i]."','".$cant[$i]."',1);";
					$guardo_bien_detalle = mysql_query($sql_detalle);
									
					if (!$guardo_bien_detalle)
					{
						$mal_detalle = true;
						$sql_mal = $sql_detalle;
						$vuelta = $i;
						
					}
					else
					{
						$sql_cantidad = "UPDATE articulo set cantidad =".$nueva_cantidad." where id =".$id_ali[$i];
						$guardo_bien_cantidad = mysql_query($sql_cantidad);
						if (!$guardo_bien_cantidad)
						{
							$mal_cantidad = true;
							$sql_mal = $sql_cantidad;
						}	
					}
				}
			}
			else
			{
				$mal_salida = true;
				echo "ERROR: ".$sql;
			}
			
			if(!$mal_salida && !$mal_detalle && !$mal_salida)
			{
				echo "OK";
			}
			else
			{
				if($mal_detalle)
				{
					echo "ERROR Detalle: ".$sql_detalle;
				}
				if($mal_cantidad)
				{
					echo "ERROR Actu. Cantidad: ".$sql_detalle;
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
				$sql="UPDATE ".$tabla." SET nombre = '".$nombre."', stock_minimo = '".$stockmin."', stock_maximo = '".$stockmax."', tipo_articulo_id= '".$tipoarticuloId."', tipo_unidad_id = '".$tipounidadId."' WHERE id = '".$id."'";
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