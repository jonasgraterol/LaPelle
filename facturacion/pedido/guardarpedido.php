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
	
	$id_usu = 1;
		
	$mal = false;	
		
	$tabla="pedido";
	//$nombreViejo = buscar_campo_segun_campo_tabla_status("id",$id,$tabla,"nombre",1);
	
	
	$subtotal = round(($totalTotal/1.12),2);
	$iva = round(($subtotal*0.12),2);
	
	if ($accion == "guardar")		
	{	
		if($error!=0) echo "Error=".$error;
		else 
		{ 
			$sql = "INSERT INTO ".$tabla." values(null,null,'".$subtotal."','".$iva."','".$totalTotal."',NOW(),1);";
			$guardo_bien = mysql_query($sql);
			$pedido_id=mysql_insert_id();
					
			if ($guardo_bien)
			{
				$id_ali = explode(",",$ids);
				$cant = explode(",",$cants);
				$prec = explode(",",$precios);
				$sub = explode(",",$subs);
				
								
				for ($i = 0; $i < $n; $i++)
				{
					//$cantidad_actual = buscar_campo_tabla_status($id_ali[$i],"articulo","cantidad",1);
					//$nueva_cantidad = $cantidad_actual + $cant[$i];
					
					//$subtotal = $servicio_servicio_cantidad[$i] * $servicio_servicio_precio[$i];
					
					$pro_id = 'null';
					$art_id = 'null';
					
					$qes = explode("-",$id_ali[$i]);
					if($qes[0] == "art") 
					{	
						$art_id=$qes[1];
					}
					else	
					{
						$pro_id=$qes[0];
					}
					
					
									
					$sql_detalle="INSERT INTO pedido_detalle values('".$pedido_id."',null,".$pro_id.",".$art_id.",'".$cant[$i]."','".$prec[$i]."','".$sub[$i]."',1);";
					$guardo_bien_detalle = mysql_query($sql_detalle);
									
					if (!$guardo_bien_detalle)
					{
						$mal_detalle = true;
						$sql_mal = $sql_detalle;
						$vuelta = $i;
						
					}
					
				}
			}
			else
			{
				$mal_pedido = true;
				echo "ERROR: ".$sql;
			}
			
			if(!$mal_pedido && !$mal_detalle)
			{
				echo "OK-".$pedido_id;
			}
			else
			{
				if($mal_detalle)
				{
					echo "ERROR Detalle: ".$sql_detalle;
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
	if ($accion == "despachar")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = 2  WHERE id = '".$id."'";
		$despacho_bien = mysql_query($sql);
		
		if ($descpacho_bien) echo "OK";
		else 
		{
			echo "No";
		}
	} //IF ELIMINAR
	mysql_close();
}
?>