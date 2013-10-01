<HTML>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<head>
<title>Puerto serie con PHP</title>
</head>
<SCRIPT language="javascript" type="text/javascript">
function cambiarAcc(acc) {
   document.f1.action = acc;
}
function cambiarAcc2(acc) {
   document.f2.action = acc;
}
</SCRIPT>
<BODY>
<div align = "center"><br>
<B>DEMO FISCAL PHP</B><br>
<form  name="f1" method = "post" action  = "repComm.php">
	
		Conectar al puerto:
		
			<select name="Puerto">
				<option value="COM1">COM1
				<option value="COM2">COM2
				<option value="COM3">COM3
				<option value="COM4">COM4
				<option value="COM5">COM5
				<option value="COM6">COM6
				<option value="COM7">COM7
				<option value="COM8">COM8
			</select><BR>
				
		
		<input type = "submit"  value="Asignar" onClick="cambiarAcc('DemoTfhkaPHP.php?operacion=PonerPuerto')">
	
	</form>
	
	<form  name="f2" method = "post" action  = "repComm.php">
	
		
		Enviar Comando:<input type="text" name="Comando" ><BR>
		<input type = "submit"  value="Enviar" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=EnviarComando')">
		<BR><BR>Operaciones Básicas de Pruebas Directas.<BR><BR>
	<input type = "submit"  value="Factura Básica" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=Facturar')">
	<input type = "submit"  value="Devolucion" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=Devolver')">
	<input type = "submit"  value="Imprimir Programación" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=Programar')">
	<input type = "submit"  value="Descuento" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=Descontar')">
	<input type = "submit"  value="Recargo" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=Recargar')"><BR><BR>
	<input type = "submit"  value="Subir S1" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirS1')">
	<input type = "submit"  value="Subir S2" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirS2')">
	<input type = "submit"  value="Subir S3" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirS3')">
	<input type = "submit"  value="Subir S4" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirS4')">
	<input type = "submit"  value="Subir S5" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirS5')">
	<input type = "submit"  value="Subir X" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirX')">
    <input type = "submit"  value="Subir Ultimo Z" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirZ')">  
    <input type = "submit"  value="Estado y Error" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=LeerStEr')"> 	
	<BR><BR>
	<input type = "submit"  value="Reporte X" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=ReportarX')">  
	<input type = "submit"  value="Reporte Z" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=ReportarZ')"><BR><BR>
	Lectura de memoria Fiscal<BR>
	<table align = 'center'>
	<tr>
	<td>
	Por rango de fechas. <BR> Fecha Inicial: <select name="Dia">
				<option value="01">01
				<option value="02">02
				<option value="03">03
				<option value="04">04
				<option value="05">05
				<option value="06">06
				<option value="07">07
				<option value="08">08
				<option value="09">09
				<option value="10">10
				<option value="11">11
				<option value="12">12
				<option value="13">13
				<option value="14">14
				<option value="15">15
				<option value="16">16
				<option value="17">17
				<option value="18">18
				<option value="19">19
				<option value="20">20
				<option value="21">21
				<option value="22">22
				<option value="23">23
				<option value="24">24
				<option value="25">25
				<option value="26">26
				<option value="27">27
				<option value="28">28
				<option value="29">29
				<option value="30">30
				<option value="31">31
			</select> 
			<select name="Mes">
				<option value="01">Enero
				<option value="02">Febrero
				<option value="03">Marzo
				<option value="04">Abrir
				<option value="05">Mayo
				<option value="06">Junio
				<option value="07">Julio
				<option value="08">Agosto
				<option value="09">Septiembre
				<option value="10">Octubre
				<option value="11">Noviembre
				<option value="12">Diciembre
				</select> 
				<select name="Ano">
				<option value="09">2009
				<option value="08">2008
				<option value="07">2007
				</select> 
				 <input type = "submit"  value="Imprimir" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=ImprimirLecFisc')"> 	
				 <BR> Fecha Final: <select name="Dia2">
				<option value="01">01
				<option value="02">02
				<option value="03">03
				<option value="04">04
				<option value="05">05
				<option value="06">06
				<option value="07">07
				<option value="08">08
				<option value="09">09
				<option value="10">10
				<option value="11">11
				<option value="12">12
				<option value="13">13
				<option value="14">14
				<option value="15">15
				<option value="16">16
				<option value="17">17
				<option value="18">18
				<option value="19">19
				<option value="20">20
				<option value="21">21
				<option value="22">22
				<option value="23">23
				<option value="24">24
				<option value="25">25
				<option value="26">26
				<option value="27">27
				<option value="28">28
				<option value="29">29
				<option value="30">30
				<option value="31">31
			</select> 
			<select name="Mes2">
				<option value="01">Enero
				<option value="02">Febrero
				<option value="03">Marzo
				<option value="04">Abrir
				<option value="05">Mayo
				<option value="06">Junio
				<option value="07">Julio
				<option value="08">Agosto
				<option value="09">Septiembre
				<option value="10">Octubre
				<option value="11">Noviembre
				<option value="12">Diciembre
				</select> 
				<select name="Ano2">
				<option value="09">2009
				<option value="08">2008
				<option value="07">2007
				</select> 
				 <input type = "submit"  value="Subir Datos" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirLecFisc')"></td>
				 <td>Por rango de Números. <BR>Z Inicial:<input type="text" name="Zi" value = "0001" size = "4">
				 <input type = "submit"  value="Imprimir" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=ImprimirLecFisc2')"> 
				 <BR>Z Final:<input type="text" name="Zf" value = "0001" size = "4">
				 <input type = "submit"  value="Subir Datos" onClick="cambiarAcc2('DemoTfhkaPHP.php?operacion=SubirLecFisc2')">
				 </td>
				 </tr></table> 
	</form>
<?php
	include ("TfhkaPHP.php");
	import_request_variables("gP","F");
	if (isset($Foperacion)){
	  $itObj = new Tfhka(); 
	  if ($Foperacion == "PonerPuerto") {
		$itObj->SetPort($FPuerto);
	  }
	  if ($Foperacion == "EnviarComando") {
		$rept = $itObj->SenCmd($FComando);
		if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";
	  }	  
	  if ($Foperacion == "Facturar")  {  
		$archivo = 'C:\IntTFHKA\ArchivoFactura.txt';
		$fp = fopen($archivo, "w");
		$string = "";
		$write = fputs($fp, $string);
		$string = " 000000100000001000Harina\r\n";
		$write = fputs($fp, $string);
		$string = "!000000150000001500Jamón\r\n";
		$write = fputs($fp, $string);
		$string = '"'."000000205000003000Patilla\r\n";
		$write = fputs($fp, $string);
		$string =  "#000005000000001000Caja de Wisky\r\n";
		$write = fputs($fp, $string);
		$string = "101";
		$write = fputs($fp, $string);
		fclose($fp); 
		
		$lineas = $itObj->SendFileCmd($archivo);
				
		echo "<div align = 'center'><B><font color = 'blue' size = '9'>Lineas Procesadas: ".$lineas."</font></B></div>";
			
	  }
	  if ($Foperacion == "Programar") {
			$rept = $itObj->SenCmd("D");	
			if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";
	   }
	   if ($Foperacion == "ReportarX") {
			$rept = $itObj->SenCmd("I0X");	
			if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";
	   }
	   if ($Foperacion == "ReportarZ") {
			$rept = $itObj->SenCmd("I0Z");	
			if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";
	   }
	   if ($Foperacion == "Devolver")
	   {
	   $archivo = 'C:\IntTFHKA\ArchivoFactura.txt';
		$fp = fopen($archivo, "w");
		$string = "";
		$write = fputs($fp, $string);
		$string = "i01Nombre: Pablo Moya\r\n";
		$write = fputs($fp, $string);
		$string = "i02Cedula: 14.526.461\r\n";
		$write = fputs($fp, $string);
		$string = "i03Direccion: Ppal de la Urbina\r\n";
		$write = fputs($fp, $string);
		$string = "i04Telefono: (0212) 555-55-55\r\n";
		$write = fputs($fp, $string);
		$string = "d0000000100000001000Harina\r\n";
		$write = fputs($fp, $string);
		$string = "d1000000150000001500Jamón\r\n";
		$write = fputs($fp, $string);
		$string = "d2000000205000003000Patilla\r\n";
		$write = fputs($fp, $string);
		$string =  "d3000005000000001000Caja de Wisky\r\n";
		$write = fputs($fp, $string);
		$string = "f01000000000000";
		$write = fputs($fp, $string);
		fclose($fp); 
		
		$lineas = $itObj->SendFileCmd($archivo);
		
		echo "<div align = 'center'><B><font color = 'blue' size = '9'>Lineas Procesadas: ".$lineas."</font></B></div>";
	   }
	   if ($Foperacion == "Descontar")  {  
		$archivo = 'C:\IntTFHKA\ArchivoFactura.txt';
		$fp = fopen($archivo, "w");
		$string = "";
		$write = fputs($fp, $string);
		$string = " 000000100000001000Harina\r\n";
		$write = fputs($fp, $string);
		$string = "!000000150000001500Jamón\r\n";
		$write = fputs($fp, $string);
		$string = "p-2500\r\n";
		$write = fputs($fp, $string);
		$string = '"'."000000205000003000Patilla\r\n";
		$write = fputs($fp, $string);
		$string =  "#000005000000001000Caja de Wisky\r\n";
		$write = fputs($fp, $string);
		$string = "101";
		$write = fputs($fp, $string);
		fclose($fp); 
		
		$lineas = $itObj->SendFileCmd($archivo);
		
		echo "<div align = 'center'><B><font color = 'blue' size = '9'>Lineas Procesadas: ".$lineas."</font></B></div>";
	  }
	  if ($Foperacion == "Recargar")  {  
		$archivo = 'C:\IntTFHKA\ArchivoFactura.txt';
		$fp = fopen($archivo, "w");
		$string = "";
		$write = fputs($fp, $string);
		$string = " 000000100000001000Harina\r\n";
		$write = fputs($fp, $string);
		$string = "!000000150000001500Jamón\r\n";
		$write = fputs($fp, $string);
		$string = "p+1000\r\n";
		$write = fputs($fp, $string);
		$string = '"'."000000205000003000Patilla\r\n";
		$write = fputs($fp, $string);
		$string =  "#000005000000001000Caja de Wisky\r\n";
		$write = fputs($fp, $string);
		$string = "101";
		$write = fputs($fp, $string);
		fclose($fp); 
		
		$lineas = $itObj->SendFileCmd($archivo);
		
		echo "<div align = 'center'><B><font color = 'blue' size = '9'>Lineas Procesadas: ".$lineas."</font></B></div>";
	  }
	    if ($Foperacion == "SubirX") {
			$trama = $itObj->UploadReportCmd("U0X");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirZ") {
			$trama = $itObj->UploadReportCmd("U0Z");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirS1") {
			$trama = $itObj->UploadStatusCmd("S1");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirS2") {
			$trama = $itObj->UploadStatusCmd("S2");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirS3") {
			$trama = $itObj->UploadStatusCmd("S3");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirS4") {
			$trama = $itObj->UploadStatusCmd("S4");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "SubirS5") {
			$trama = $itObj->UploadStatusCmd("S5");	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "LeerStEr") {
			$trama = $itObj->ReadFpStatus();
           if(substr($itObj->StatusError,0,1) == "T")			
			echo "<div align = 'center'><B><font color = 'green' size = '12'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '12'>".$itObj->StatusError."</font></B></div>";
	   }
	    if ($Foperacion == "ImprimirLecFisc") {
			$rept = $trama = $itObj->SenCmd("I2A".$FDia.$FMes.$FAno.$FDia2.$FMes2.$FAno2);	
			if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";
	   }
	    if ($Foperacion == "SubirLecFisc") {
			$trama = $itObj->UploadReportCmd("U2A".$FDia.$FMes.$FAno.$FDia2.$FMes2.$FAno2);	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	   if ($Foperacion == "ImprimirLecFisc2") {
	        $Zini = $FZi;
			$Zfin = $FZf;
		
			while (strlen($Zini)<6)
			{
			    $Zini = "0".$Zini;
			}
			
			while (6>strlen($Zfin))
			{
			$Zfin = "0".$Zfin;
			}
			
			$rept = $trama = $itObj->SenCmd("I3A".$Zini.$Zfin);	
			if($rept)			
			echo "<div align = 'center'><B><font color = 'green' size = '9'>".$itObj->StatusError."</font></B></div>";
			else
			echo "<div align = 'center'><B><font color = 'red' size = '9'>".$itObj->StatusError."</font></B></div>";  
	   }
	    if ($Foperacion == "SubirLecFisc2") {
		    $Zini = $FZi;
			$Zfin = $FZf;
		
			while (6>strlen($Zini))
			{
			    $Zini = "0".$Zini;
			}
			
			while (6>strlen($Zfin))
			{
			$Zfin = "0".$Zfin;
			}
			$trama = $itObj->UploadReportCmd("U3A".$Zini.$Zfin);	
			echo "<div align = 'center'>".$trama."</div>";
	   }
	}
?>
 </div>

</BODY>
</HTML>
