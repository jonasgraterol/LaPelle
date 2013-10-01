<?php 
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$d = fechaentrada($_POST["desde"]);
	$h = fechaentrada($_POST["hasta"]);
	$taid = $_POST["taid"];
	$q = "";
	
	if($taid != "")
	{
		$q = "and p.tipo_servicio_id = ".$taid;
	}
		
	$sql = "select p.nombre, sum(pd.cant) as canti from pedido_detalle pd, servicio p, pedido pe where (pe.status = 2 or pe.status = 100) and p.id = pd.servicio_id and pe.fecha >= '".$d." 00:00:00' and pe.fecha <= '".$h." 23:59:00' and pe.id = pd.pedido_id ".$q." and pe.id = pd.pedido_id group by pd.servicio_id order by canti desc;";
	$rs = mysql_query($sql);
	//echo "SQL:[".$sql."]";
	if(mysql_num_rows($rs) != 0)
	{
		$arr = array();
		while($row=mysql_fetch_array($rs))
		{
			$arr[] = array(0 => $row['nombre'], 1 => floatval($row['canti']) );
		}
		echo json_encode($arr);
	}	
	else
	{
		$arr[] = array(0 => "Sin Ventas", 1 => floatval(0) );
		echo json_encode($arr);
	}

?>