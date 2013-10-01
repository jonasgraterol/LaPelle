<?php 
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$cedrif = $_POST["cedula"];
	$fec = $_POST['fec'];
	$ced = buscar_existe_campo_status($cedrif,"cliente",'cedrif',1);
	if($ced==1)
	{
		$nombre = buscar_campo_segun_campo_tabla_status("cedrif",$cedrif,"cliente","nombre",1);
		$dire = buscar_campo_segun_campo_tabla_status("cedrif",$cedrif,"cliente","direccion",1);
		$tel = buscar_campo_segun_campo_tabla_status("cedrif",$cedrif,"cliente","telefono",1);
		$dias = buscar_campo_segun_campo_tabla_status("cedrif",$cedrif,"cliente","credito_dias",1);
		$fvence = fechasalida(sumaDiafechaentrada(fechaentrada($fec),$dias));
		echo "OK***".$nombre."***".$dire."***".$tel."***".$fvence;
	}
	else
	{
		echo "NO***NO***NO***NO";
	}


?>