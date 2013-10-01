<?php 
	include("../../conexion.php");
	include("../../funcionesphp.php");
	
	$ano = $_POST["ano"];
		
	$sql = "select SUM(total) as t, month(fecha) as mes from pedido where (status = 2 or status = 100) and year(fecha) = ".$ano." group by month(fecha);";
	$rs = mysql_query($sql);
	
	$a = array();
	for($n=0; $n<12; $n++)
	{
		$a[$n] = floatval(0);
	}	
	
	if(mysql_num_rows($rs) != 0)
	{
		$arr = array();
		while($row=mysql_fetch_array($rs))
		{
			$arr[] = array(0 => $row['mes'], 1 => floatval($row['t']) );
			$a[$row['mes']-1] = floatval($row['t']); 
		}
		echo json_encode($a);
	}	
	else
	{
		//$arr[] = array(0 => "Sin Ventas", 1 => floatval(0) );
		echo json_encode($a);
	}

?>