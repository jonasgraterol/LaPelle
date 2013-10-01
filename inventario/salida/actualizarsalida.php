<?php
include ("../../conexion.php");
include ("../../funcionesphp.php");


// MAIN	


	$tabla="compra";
	$accion = $_POST['accion'];
	$id = $_POST['id'];
	
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
	
	if ($accion == "p")
	{
		//$id= $_GET['id'];
		$sql="UPDATE ".$tabla." SET status = 2  WHERE id = '".$id."'";
		$elimino_bien = mysql_query($sql);
		
		if ($elimino_bien) echo "OK";
		else 
		{
			echo "No";
		}
	} //IF ELIMINAR
	mysql_close();

?>