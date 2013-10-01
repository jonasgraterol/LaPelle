<?php 
	session_start();
	include("conexion.php");
	include("funcionesphp.php");
	$usu = $_POST['usuario'];
	$pass = $_POST['clave'];
	$sql = "Select * from usuario where usuario = '".$usu."' and clave = '".$pass."'; ";
	$rs = mysql_query($sql);
	if(mysql_num_rows($rs) != 0)
	{
		$row=mysql_fetch_array($rs);
		$_SESSION['id_usuario_sis'] = $row['id'];
		$_SESSION['usuario_sis'] = $row['usuario'];
		echo "OK-".$row['id']."-".$row['usuario'];
	}
	else
	{
		echo "NO";
	}
	
?>