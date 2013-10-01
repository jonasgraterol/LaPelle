<?php
include ("../../conexion.php");
include ("../../funcionesphp.php");


// MAIN	


	$tabla="pedido";
	$accion = $_POST['accion'];
	$id = $_POST['id'];
	
	$cedrif = $_POST['cedrif'];
	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$dir = $_POST['dir'];
	//echo $accion." - ".$id;
	
	if ($accion == "c")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = 0  WHERE id = '".$id."'";
		$elimino_bien = mysql_query($sql);
		
		if ($elimino_bien) echo "OK";
		else 
		{
			echo "No";
		}
	} //IF ELIMINAR
	
	//DESPACHAR
	if ($accion == "p")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = 2  WHERE id = '".$id."'";
		$elimino_bien = mysql_query($sql);
		
		if ($elimino_bien)
		{
			echo "OK";
			$sql_detalle = "SELECT * from pedido_detalle where pedido_id = ".$id." and articulo_id is not null;";
			$rs_detalle=mysql_query($sql_detalle);
			if (mysql_num_rows($rs_detalle)!=0){
				while($row_detalle=mysql_fetch_array($rs_detalle))
				{
					$sql_actualizar="UPDATE articulo SET cantidad = cantidad-".$row_detalle['cant']." WHERE id = '".$row_detalle['articulo_id']."'";
					$actualizo_bien = mysql_query($sql_actualizar);	
				}
			}
			else
			{
			
			}	
			if($cedrif != "")
			{
				if(!buscar_existe_campo_status($cedrif,'cliente','cedrif',1))
				{
					$sql="INSERT INTO cliente values(null,'".$nombre."','".$cedrif."','".$dir."','".$telefono."','','',1);";
					$guardo_bien = mysql_query($sql);
					if(!$guardo_bien) echo " ! ".$sql;
				}
				
				$clienteID = buscar_campo_segun_campo_tabla_status('cedrif',$cedrif,'cliente','id',1);
				
				$sql3="UPDATE pedido SET cliente_id = ".$clienteID." WHERE id = '".$id."';";
				$elimino_bien3 = mysql_query($sql3);
				if(!$elimino_bien3) echo " ! ".$sql3;
			}
			else
			{
				$clienteID = "";
			}
			
		}	
		else 
		{
			echo "No";
		}
	} //IF DESPACHAR
	
	//FACTURAR
	if ($accion == "f")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = 100  WHERE id = '".$id."'";
		$elimino_bien = mysql_query($sql);
		
		$sf="INSERT INTO factura values(null,'".$id."');";
		$guardo_bien_fact = mysql_query($sf);
		
		if ($elimino_bien && $guardo_bien_fact)
		{
			
			echo "OK";
			$sql_detalle = "SELECT * from pedido_detalle where pedido_id = ".$id." and articulo_id is not null;";
			$rs_detalle=mysql_query($sql_detalle);
			if (mysql_num_rows($rs_detalle)!=0){
				while($row_detalle=mysql_fetch_array($rs_detalle))
				{
					$sql_actualizar="UPDATE articulo SET cantidad = cantidad-".$row_detalle['cant']." WHERE id = '".$row_detalle['articulo_id']."'";
					$actualizo_bien = mysql_query($sql_actualizar);	
				}
			}
			else
			{
			
			}	
			if($cedrif != "")
			{
				if(!buscar_existe_campo_status($cedrif,'cliente','cedrif',1))
				{
					$sql="INSERT INTO cliente values(null,'".$nombre."','".$cedrif."','".$dir."','".$telefono."','','',1);";
					$guardo_bien = mysql_query($sql);
					if(!$guardo_bien) echo " ! ".$sql;
				}
				
				$clienteID = buscar_campo_segun_campo_tabla_status('cedrif',$cedrif,'cliente','id',1);
				
				$sql3="UPDATE pedido SET cliente_id = ".$clienteID." WHERE id = '".$id."';";
				$elimino_bien3 = mysql_query($sql3);
				if(!$elimino_bien3) echo " ! ".$sql3;
			}
			else
			{
				$clienteID = "";
			}
			
		}	
		else 
		{
			echo "No";
		}
	} //IF FACTURAR
	
	
	mysql_close();

?>