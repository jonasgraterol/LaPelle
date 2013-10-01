<?php
	include ("../../TfhkaPHP.php");
	include ("../../conexion.php");
	include ("../../funcionesphp.php");
	import_request_variables("gP","F");
	
	$pedido = $_POST["nropedido"];
	$cedrif = $_POST["cedrif"];
	$cliente = $_POST["cliente"];
	$telefono = $_POST["telefono"];
	$dir = $_POST["dir"];
	$dir2 = $_POST["dir2"];
	$pago = $_POST["pago"];
	$n = $_POST["n"];
	
	$id_ali = $_POST["ids"];
	$nomb = $_POST["nombres"];
	$cant = $_POST["cants"];
	$prec = $_POST["precios"];
	$sub = $_POST["subs"];
	
	$itObj = new Tfhka(); 
	
	$checkeo = $itObj->CheckFprinter();
	
	//echo "CK:".$checkeo;
	
	if($checkeo)
	{
	
		 $archivo = 'C:\wamp\www\inventario\facturas\#'.$pedido.'.txt';
		 $fp = fopen($archivo, "w");
		$string = "";
		$write = fputs($fp, $string);
		
		if($cedrif != "" && $cliente !== "")
		{
			$string = "i01Nombre: ".$cliente."\r\n";
			$write = fputs($fp, $string);
			$string = "i02CI/RIF: ".$cedrif."\r\n";
			$write = fputs($fp, $string);
			if($dir != "")
			{
				$string = "i03Direccion: ".$dir."\r\n";
				$write = fputs($fp, $string);
				if($dir2 != "")
				{
					$string = "i04 ".$dir2."\r\n";
					$write = fputs($fp, $string);
					
					$dir = $dir." ".$dir2;
				}
			}
			if($telefono != "")
			{
				$string = "i04Telefono: ".$telefono."\r\n";
				$write = fputs($fp, $string);
			}	
				
			
		
		}
		
		 for ($i = 0; $i < $n; $i++)
		 {
		 	$prec[$i] = round($prec[$i]/1.12,2);
			$p = str_pad(number_format($prec[$i], 2, '', ''), 10, '0', STR_PAD_LEFT);
			$c = str_pad(number_format($cant[$i], 3, '', ''), 8, '0', STR_PAD_LEFT);
			$string = "!".$p.$c.$nomb[$i]."\r\n";
			$write = fputs($fp, $string);
		}	
			
			$string = "101";
			$write = fputs($fp, $string);
			fclose($fp); 
			
			$lineas = $itObj->SendFileCmd($archivo);
					
			if($lineas)
			{
				echo "OK";
				if($cedrif != "")
				{
					$clienteID = buscar_campo_segun_campo_tabla_status('cedrif',$cedrif,'cliente','id',1);
				}
				else
				{
					$clienteID = "";
				}	
				//$sql2="UPDATE pedido SET status = 10 AND cliente_id = ".$clienteID."  WHERE id = ".$pedido.";";
				$sql2="UPDATE pedido SET status = 100 WHERE id = '".$pedido."'";
				//echo $clienteID."SQL->".$sql2;
				$elimino_bien2 = mysql_query($sql2);
				$sql3="UPDATE pedido SET cliente_id = ".$clienteID." WHERE id = '".$pedido."';";
				//echo $clienteID."SQL->".$sql2;
				$elimino_bien3 = mysql_query($sql3);
				if(!buscar_existe_campo_status($cedrif,'cliente','cedrif',1))
				{
					$sql="INSERT INTO cliente values(null,'".$cliente."','".$cedrif."','".$dir."','".$telefono."','','',1);";
					$guardo_bien = mysql_query($sql);
				}
			}
			else
			{
				echo "NO";
			}
			
	}
	else
	{
		echo "CONEXION";
	}		
	mysql_close();		
	 
?>