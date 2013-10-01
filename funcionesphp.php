<?php
//Funciones de busqueda en base de datos

// GRECIA
//Realiza lo mismo que la funcion anterior pero en vez de imprimir el combo retorna el html del combo
function buscar_tabla_lista_guardado_campo_html($tabla,$id,$campo,$numero,$activo)
{
	include ("conexion.php");
	$combo = "";
	$sql= "select * from ".$tabla." where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' >";
		}else{
			$combo .= "<select  name='listanueva' id='lista_".$tabla.$numero."' disabled='true' >";
		}
		
		if ($id != 0){
			$combo .= "<option value='".$id."' selected='selected'>". buscar_campo_tabla_status($id,$tabla,$campo,1) ."</option>";
		}
		else
		{
			$combo .= "<option value='' selected='selected'></option>";
		}
		while($row=mysql_fetch_array($rs)){
				$combo .= "<option value='".$row['id']."'>". $row[$campo]. "</option>";
		}
		$combo .= '</select>';
	}else{
		$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."'  >";
		$combo .= "<option value=''> <font color='#FF0000'> Ningun registro encontrado. </font></option>";
		$combo .= '</select>';
	}
	return $combo;

}

//Funcion que busca una lista de la base de datos donde la consulta es restringida por el estatus y por campos que que se le pasa por parametros  
//donde $campoR es el nombre del campo por donde se va restringir la consulta y $valorCampoR es el valor por el cual se realiza el where de la consulta
//Arreglado para que pueda ser impreso con php desde jquery
function buscar_tabla_lista_guardado_campo_especifico_html($tabla,$id,$campo,$numero,$campoR,$valorCampoR,$activo)
{
	include ("conexion.php");
	$combo = "";
	$sql = "select * from ".$tabla." where ".$campoR." = ".$valorCampoR." and status = 1;";
	$cad .= "-".$sql;
	$rs=mysql_query($sql);
	$cad .= "-".$rs;
	$cad .= "-".mysql_num_rows($rs);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' class='autocomplete'>";
		}else{
			$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' disabled='true' class='autocomplete'>";
		}
		
		if ($id != 0){
			$combo .= "<option value='".$id."' selected='selected'>".buscar_campo_tabla_status($id,$tabla,$campo,1)."</option>";
		}
		else
		{
			$combo .= "<option value='' selected='selected'></option>";
		}
		while($row=mysql_fetch_array($rs)){
				$combo .= "<option value='".$row['id']."'>". $row[$campo]. "</option>";
		}
		$combo .= '</select>';
	}else{
		$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' class='autocomplete'>";
		$combo .= "<option value=''> <font color='#FF0000'> Ningun registro encontrado. </font></option>";
		$combo .= '</select>';
	}
	return $combo;

}

//HACE LO MISMO QUE LA FUNCION ANTERIOR PERO SOLO IMPRIME LOS OPTIONS
//Arreglado para que pueda ser impreso con php desde jquery
function buscar_tabla_lista_guardado_campo_especifico_html_options($tabla,$id,$campo,$numero,$campoR,$valorCampoR,$activo)
{
	include ("conexion.php");
	$combo = "";
	$sql = "select * from ".$tabla." where ".$campoR." = ".$valorCampoR." and status = 1;";
	$cad .= "-".$sql;
	$rs=mysql_query($sql);
	$cad .= "-".$rs;
	$cad .= "-".mysql_num_rows($rs);
	if (mysql_num_rows($rs)!=0){
		/*	
		if ($activo){
			$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' class='autocomplete'>";
		}else{
			$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' disabled='true' class='autocomplete'>";
		}
		*/
		if ($id != 0){
			$combo .= "<option value='".$id."' selected='selected'>".buscar_campo_tabla_status($id,$tabla,$campo,1)."</option>";
		}
		else
		{
			$combo .= "<option value='' selected='selected'></option>";
		}
		while($row=mysql_fetch_array($rs)){
				$combo .= "<option value='".$row['id']."'>". $row[$campo]. "</option>";
		}
		//$combo .= '</select>';
	}else{
		//$combo .= "<select name='listanueva' id='lista_".$tabla.$numero."' class='autocomplete'>";
		$combo .= "<option value=''> <font color='#FF0000'> Ningun registro encontrado. </font></option>";
		//$combo .= '</select>';
	}
	return $combo;

}

//FUNCION QUE DEVUELVE LA FECHA Y HORA EXACTA DEL SISTEMA en un arreglo donde la posicion 0 tiene la fecha en formato 'yyyy-mm-dd' y 
// en la posicion 1 esta la hora actual en formato '23:00:00
function fecha_ahora()
{
	include ("conexion.php");
	$sql= "select sysdate();";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	
	$hoy = explode(" ",$row['sysdate()']);
	return $hoy;
}


/*Buscar todos los items de la tabla "tipo_habitacion" y colocarlos en una lista*/
function buscar_tipo_habitacion_lista()
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_tipo_habitacion" id="lista_t_habitacion">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

function buscar_habitacion_lista_segun_tipo($id_tipo_habitacion)
{
	include ("conexion.php");
	$sql= "select * from habitacion where Tipo_habitacion_id = '".$id_tipo_habitacion."' AND status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_habitacion_segun_tipo" id="lista_habitacion_segun_tipo">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nro_habitacion']. '</option>';
		}
		echo "</select>";
	}
}

//PARAMETROS: $id_tipo_habitacion 
// $num : numero de habitacion a estar primero en la lista
// $activo: true o false para la propiedad disabled del select
// $i: indice para el id de cada lista si se crean varias
function buscar_habitacion_lista_segun_tipo_guardada_i($id_tipo_habitacion,$num,$activo,$i)
{
	include ("conexion.php");
	$sql= "select * from habitacion where Tipo_habitacion_id = '".$id_tipo_habitacion."' AND status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'">';
		}else{
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'" disabled=true>';
		}	
		$sql2 = "SELECT id from habitacion WHERE nro_habitacion = '".$num."' AND status = 1";
		$rs2=mysql_query($sql2);
		$row2=mysql_fetch_array($rs2);
		echo '<option value="'.$row2['id'].'">'. $num .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nro_habitacion']. '</option>';
		}
		echo "</select>";
	}
	else
	{
		if ($activo){
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'">';
		}else{
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'" disabled=true>';
		}
		echo '<option value="">No Disponibles</option>';
		//echo "No hay Habitaciones de este tipo";
	}
}
/////FUNCION QUE SUMA UNA CANTIDAD DE DIAS A UNA FECHA EN FORMATO yyyy-mm-dd
function sumaDiafechaentrada($fecha,$dia)
{	
	list($year,$mon,$day) = explode('-',$fecha);
	return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));		
}
 
/////FUNCION QUE SUMA UNA CANTIDAD DE DIAS A UNA FECHA EN FORMATO dd/mm/yyyy
function sumaDiafechasalida($fecha,$dia)
{	
	list($day,$mon,$year) = explode('/',$fecha);
	return date('d/m/Y',mktime(0,0,0,$mon,$day+$dia,$year));		
} 

//FUNCION QUE CANCELA AUTOMATICAMENTE LAS RESERVAS CUANDO LA DIFERENCIA DE LOS DIAS ENTRE HOY Y EL DIA DE LA RESERVA SEA MAYOR AL 
// NUMERO DE DIAS ESTABLECIDO EN EL REGISTRO ACTIVO DE LA TABLA configuracion_reserva
// configuracion_reserva: almacena los registros creados en el modulo de CONFIGURACION en la opcion CANCELACION AUTOMATICA RESERVA donde solo un registro puede estar activo
// y dependiendo del numero de dias del registro activo se decidara en esta funcion si se cancela la reserva o no
function cancelar_reserva_segun_configuracion_reserva()
{
	include ("conexion.php");
	$sql= "select * from configuracion_reserva where activo = 1 AND status = 1";
	$hoy = fecha_ahora();
	$hoy = $hoy[0];
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	
	$sql_reserva= "select * from reserva order by fecha_llegada asc";
	$rs_reserva=mysql_query($sql_reserva);
	if (mysql_num_rows($rs_reserva)!=0)
	{
		while($row_reserva=mysql_fetch_array($rs_reserva))
		{
			$dif = calcular_cant_dias_entre_fechas(fechasalida($hoy),fechasalida($row_reserva['fecha_llegada'])); //compara_fechas("2010-08-12","2010-08-10");
			
			//echo $hoy." FL:".$row_reserva['fecha_llegada']." ->Dif:(".$dif.") Dias:".$row['nro_dias']. "<br>";
			if ($dif < $row['nro_dias'])
			{
				if (($row_reserva['status'] == 1) && ($row_reserva['status_confirmada'] == 0))
				{
					$sql_actualizar_reserva = "UPDATE reserva SET status = '9' WHERE id = '".$row_reserva['id']."'";
					$actualizo_bien = mysql_query($sql_actualizar_reserva);
					$sql_actualizar_reserva_habitaci = "UPDATE reserva_habitaci SET status = '9' WHERE Reserva_id = '".$row_reserva['id']."'";
					$actualizo_bien_habitaci = mysql_query($sql_actualizar_reserva_habitaci);
					$sql_actualizar_diario="UPDATE diario_reserva_ocupacion SET status = '9'  WHERE Reserva_id = '".$row_reserva['id']."'";
					$actualizo_bien_diario = mysql_query($sql_actualizar_diario);
					//echo $hoy." FL:".$row_reserva['fecha_llegada']." ->Dif:(".$dif.") Dias:".$row['nro_dias']. "CANCELADA <br>";
				}
				//SI LA RESERVA ESTA CONFIRMADA PERO NO SE HIZO CHECK IN EL DIA DE LA FECHA DE ENTRADA (etiqueta: VENCIDA)
				if (($row_reserva['status'] == 1) && ($row_reserva['status_confirmada'] == 1))
				{
					$adentro = false;
					$sql_prueba = "select * from reserva_habitaci where Reserva_id = '".$row_reserva['id']."';";
					$probar = mysql_query($sql_prueba);
					if (mysql_num_rows($probar)!=0)
					{
						while($row_prueba=mysql_fetch_array($probar))
						{
							if ($row_prueba['status'] == 2)
							{
								$adentro = true;
							}
						}
					}
					if (!$adentro)
					{	
						$sql_actualizar_reserva = "UPDATE reserva SET status = '8' WHERE id = '".$row_reserva['id']."'";
						$actualizo_bien = mysql_query($sql_actualizar_reserva);
						$sql_actualizar_reserva_habitaci = "UPDATE reserva_habitaci SET status = '8' WHERE Reserva_id = '".$row_reserva['id']."'";
						$actualizo_bien_habitaci = mysql_query($sql_actualizar_reserva_habitaci);
						$sql_actualizar_diario="UPDATE diario_reserva_ocupacion SET status = '8'  WHERE Reserva_id = '".$row_reserva['id']."'";
						$actualizo_bien_diario = mysql_query($sql_actualizar_diario);
					}
				}
			}
			else
			{
				//echo $hoy." FL:".$row_reserva['fecha_llegada']." ->Dif:(".$dif.") Dias:".$row['nro_dias']. "<br>";
			}
			//LOGICA PARA QUE REACTIVE LA RESERVA SI AUN NO SE CUMPLEN LOS DIAS DE PLAZO segun el registro activo en "CANCELACION AUTOMATICA RESERVA"
			//***hay que chequear si mientras estuvo cancelada la reserva no se realizo una reserva o check in en alguna habitacion de esta reserva (chequear diario_reserva_ocupacion)***
			/*
			else
			{
				$sql_habitaciones = "SELECT * from reserva_habitaci WHERE Reserva_id = ".$row_reserva['id'].";";
				$buscar = mysql_query($sql_habitaciones);
				$row_habitaciones=mysql_fetch_array($buscar);
				while($row_habitaciones=mysql_fetch_array($buscar))
				{
					$sql_habitaciones = "SELECT * from diario_reserva_ocupacion WHERE Reserva_id = ".$row_reserva['id'].";";
					$buscar = mysql_query($sql_habitaciones);
					$row_habitaciones=mysql_fetch_array($buscar);
				}
				
				$sql_actualizar_reserva = "UPDATE reserva SET status = '1' WHERE id = '".$row_reserva['id']."'";
				$actualizo_bien = mysql_query($sql_actualizar_reserva);
				$sql_actualizar_diario="UPDATE diario_reserva_ocupacion SET status = '1'  WHERE Reserva_id = '".$row_reserva['id']."'";
				$actualizo_bien_diario = mysql_query($sql_actualizar_diario);
			}
			*/
		}
	}	
}

//FUNCION QUE BUSCA TODOS LOS ABONOS HECHOS PARA UNA RESERVA Y VERIFICA SI LA SUMA DE ESTOS ES MAYOR A LA MITAD DEL MONTO TOTAL
// DE LA RESERVA Y DE SER ASI CONFIRMA LA RESERVA 
function confirmar_reserva_segun_abonos($id_reserva)
{
	include ("conexion.php");

	$total_reserva = 0;
	$total_abonos = 0;
	$sql= "select * from reserva_habitaci where Reserva_id = '".$id_reserva."' AND status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0)
	{
		while($row=mysql_fetch_array($rs)){
			$total_reserva += $row['subtotal_adultos'] + $row['subtotal_ninos'] + $row['subtotal_infantes'];
		}
	}
	$sql2= "select * from cliente_abono where Reserva_id = '".$id_reserva."' AND status = 1";
	$rs2=mysql_query($sql2);
	if (mysql_num_rows($rs2)!=0)
	{
		while($row2=mysql_fetch_array($rs2)){
			$total_abonos += $row2['total'];
		}
	}
	$mitad = $total_reserva/2;
	//echo "TotalReserva = ".$total_reserva." Abonos = ".$total_abonos." Mitad = ".$mitad;
	if ($total_abonos>=$mitad)
	{
		$sql_confirmar = "UPDATE reserva SET status_confirmada = '1'  WHERE id = '".$id_reserva."'";
		$rs_confirmar=mysql_query($sql_confirmar);
		if ($rs_confirmar) 
		{
			$rs=mysql_query($sql);
			if (mysql_num_rows($rs)!=0)
			{
				while($row=mysql_fetch_array($rs))
				{
					$sql_confirmar_habi = "UPDATE reserva_habitaci SET status_confirmada = '1'  WHERE id = '".$row['id']."'";
					$rs_confirmar_habi = mysql_query($sql_confirmar_habi);
					
					$sql_diario="UPDATE diario_reserva_ocupacion SET estado = '1' WHERE Reserva_id = '".$id_reserva."'";
					$actulizar_diario_bien = mysql_query($sql_diario);
					
				}
			}
		}
	}
	else
	{
		$sql_confirmar = "UPDATE reserva SET status_confirmada = '0'  WHERE id = '".$id_reserva."'";
		$rs_confirmar=mysql_query($sql_confirmar);
		if ($rs_confirmar) 
		{
			$rs=mysql_query($sql);
			if (mysql_num_rows($rs)!=0)
			{
				while($row=mysql_fetch_array($rs))
				{
					$sql_confirmar_habi = "UPDATE reserva_habitaci SET status_confirmada = '0'  WHERE id = '".$row['id']."'";
					$rs_confirmar_habi = mysql_query($sql_confirmar_habi);
					$sql_diario="UPDATE diario_reserva_ocupacion SET estado = '0' WHERE Reserva_id = '".$id_reserva."'";
					$actulizar_diario_bien = mysql_query($sql_diario);
					
				}
			}
		}
	}
	//return $sql_diario;
}

/// BUSCA LA DISPONIBILIDAD EN LAS HABITACIONES SEGUN LA CANTIDAD DE PERSONAS Y EL NUMERO DE NOCHE Y RETORNA
// UN STRING CON LAS HABITACIONES PARA CADA DIA
function buscar_habitacion_disponible_diario($nro_noches,$tipo_habitacion_id,$fecha_llegada,$fecha_salida,$cant_adultos,$cant_ninos)
{
	include ("conexion.php");
	
	if ($tipo_habitacion_id != 0)
	{
		$sql= "select * from habitacion where Tipo_Habitacion_id = '".$tipo_habitacion_id."' AND status = 1";
		$rs=mysql_query($sql);
		if (mysql_num_rows($rs)!=0)
		{
			while($row=mysql_fetch_array($rs))
			{
				$sql_diario= "select * from diario_reserva_ocupacion WHERE Habitacion_id = '".$row['id']."' AND status = 1";
				$rs_diario=mysql_query($sql_diario);
				if (mysql_num_rows($rs_diario)==0)
				{
					$salida = $row['id']."=EstadiaCompleta";
					return $salida;
				}
				else
				{
					while($row_diario=mysql_fetch_array($rs_diario))
					{
						for ($i=0; $i<$nro_noches; $i++)
						{
													
						}
					}
				}
			}
		}
	}
	else
	{
		switch ($cant_adultos)
		{
			case 1:
			
			break;
			case 2:
			
			break;
			case 3:
			
			break;
			case 4:
			
			break;
		}
	}
	
	
	
/*	
	////VIEJO
	$sql= "select * from habitacion where Tipo_habitacion_id = '".$id_tipo_habitacion."' AND status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'">';
		}else{
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'" disabled=true>';
		}	
		$sql2 = "SELECT id from habitacion WHERE nro_habitacion = '".$num."' AND status = 1";
		$rs2=mysql_query($sql2);
		$row2=mysql_fetch_array($rs2);
		echo '<option value="'.$row2['id'].'">'. $num .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nro_habitacion']. '</option>';
		}
		echo "</select>";
	}
	else
	{
		if ($activo){
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'">';
		}else{
			echo '<select name="lista_habitacion_segun_tipo-'.$i.'" id="lista_habitacion_segun_tipo-'.$i.'" disabled=true>';
		}
		echo '<option value="">No Disponibles</option>';
		//echo "No hay Habitaciones de este tipo";
	}
*/	
}

function buscar_habitacion_lista_segun_tipo_guardada($id_tipo_habitacion,$num)
{
	include ("conexion.php");
	$sql= "select * from habitacion where Tipo_habitacion_id = '".$id_tipo_habitacion."' AND status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_habitacion_segun_tipo" id="lista_habitacion_segun_tipo">';
		echo '<option value=0>'. $num .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nro_habitacion']. '</option>';
		}
		echo "</select>";
	}else{echo "No hay Habitaciones de este tipo";}
}

/*Buscar todos los items de la tabla Tipo Habitacion con Multiple y colocarlos en una lista*/
function buscar_tipo_habitacion_lista_multiple()
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where status='1'";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select id="tipoHab" name="tipoHab[]" multiple="multiple">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

function buscar_tipo_habitacion_lista_multiple_habitacion($id,$num)
{
	echo '<option value='.$id.' selected="selected">'. buscar_nombre_tipo_habitacion($id) . '</option>';
	buscar_habitacion_lista_segun_tipo($id);	
}

//CACUA A CANTIDAD DE DIAS ENTRE 2 FECHAS CON FORMATO dd/mm/aaaa 
function calcular_cant_dias_entre_fechas($fechaL,$fechaS)
{
	$dia1 = substr($fechaL, 0, 2);
	$mes1 = substr($fechaL, 3, 2);
	$anno1 = substr($fechaL, 6, 4);
	
	$dia2 = substr($fechaS, 0, 2);
	$mes2 = substr($fechaS, 3, 2);
	$anno2 = substr($fechaS, 6, 4);
	
	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$anno1);
	$timestamp2 = mktime(0,0,0,$mes2,$dia2,$anno2);
	
	$segundos_diferencia = $timestamp1 - $timestamp2;
	
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
	
	$dias_diferencia = abs($dias_diferencia);
	
	$dias_diferencia = floor($dias_diferencia);
	
	if ($timestamp1 > $timestamp2)
	{
		$dias_diferencia = $dias_diferencia*-1;
	}	
	
	return $dias_diferencia;
}


function compara_fechas($fecha1,$fecha2)
 {
            

      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
	  {
	  		list($dia1,$mes1,$año1)=split("/",$fecha1);
		}	
        
		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
        {
			list($dia1,$mes1,$año1)=split("-",$fecha1);
        }
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
        {
			list($dia2,$mes2,$año2)=split("/",$fecha2);
        }    
	      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
          {
		  		list($dia2,$mes2,$año2)=split("-",$fecha2);
			}
				
        $dif1 = mktime(0,0,0,$mes1,$dia1,$año1); 
		$dif2 = mktime(0,0,0, $mes2,$dia2,$año2);
		$dif = $dif1 - $dif2;
        return ($dif);                         
            

}


function buscar_tipo_habitacion_lista_multiple_guardadas($tipo,$hab,$num)
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where status='1'";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select id="tipoHab" name="tipoHab[]" multiple="multiple">';
		while($row=mysql_fetch_array($rs)){
			$si = false;
			for($i=1; $i<$num; $i++)
			{
				if ($row['id'] == $tipo[$i]){		
					echo '<option value="'.$row['id'].'" selected="selected" >'. $row['nombre']. '</option>';
					//buscar_habitacion_lista_segun_tipo_guardada($tipo[$i],$hab[$i]);
					$si = true;
				}/*else{
					echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
				}*/
			}
			if (!$si)
			{
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
				
			}
		}
		echo "</select>";
	}
}

/*Buscar todos los items de la tabla "tipo_unidad" y colocarlos en una lista*/
function buscar_tipo_unidad_lista()
{
	include ("conexion.php");
	$sql= "select * from tipo_unidad where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_tipo_unidad" id="lista_t_unidad">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*Buscar todos los items de la tabla "tipo_articulo" y colocarlos en una lista*/
function buscar_tipo_articulo_lista()
{
	include ("conexion.php");
	$sql= "select * from tipo_articulo where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_tipo_articulo" id="lista_t_articulo">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*FUNCION QUE ORDENA LOS REGITROS DE TIPO HABITACION POR capacidad_personas EN ORDEN DESCEDENTE Y RETORNA
UNA ARREGLO ORDENADO DE TODOS LOS REGISTROS ENCONTRADOS*/
function capacidad_tipo_habitacion_mayor_menor()
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!= 0){
		$i = 0;
		while($row=mysql_fetch_array($rs)){
			$capacidades[$i]=$row['capacidad_personas'];
			$capacidades_id[$i] =$row['id'];
			$i++;
		}
		for ($j=1; $j<mysql_num_rows($rs); $j++){
			if($capacidades[$i-1]<$capacidades[$i]){
				$temp = $capacidades[$i-1];
				$capacidades[$i-1] = $capacidades[$i];
				$capacidades[$i] = $capacidades[$i-1];
				$temp_id = $capacidades_id[$i-1];
				$capacidades_id[$i-1] = $capacidades_id[$i];
				$capacidades_id[$i] = $capacidades_id[$i-1];
				$i=0;
			}
		}
		return $capacidades;
	}
}

/*FUNCION QUE ORDENA LOS REGITROS DE TIPO HABITACION POR capacidad_personas EN ORDEN DESCEDENTE Y RETORNA
UNA ARREGLO con los id ORDENADOS DE TODOS LOS REGISTROS ENCONTRADOS*/
function capacidad_tipo_habitacion_id_mayor_menor()
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!= 0){
		$i = 0;
		while($row=mysql_fetch_array($rs)){
			$capacidades[$i]=$row['capacidad_personas'];
			$capacidades_id[$i] =$row['id'];
			$i++;
		}
		for ($j=1; $j<mysql_num_rows($rs); $j++){
			if($capacidades[$i-1]<$capacidades[$i]){
				$temp = $capacidades[$i-1];
				$capacidades[$i-1] = $capacidades[$i];
				$capacidades[$i] = $capacidades[$i-1];
				$temp_id = $capacidades_id[$i-1];
				$capacidades_id[$i-1] = $capacidades_id[$i];
				$capacidades_id[$i] = $capacidades_id[$i-1];
				$i=0;
			}
		}
		return $capacidades_id;
	}
}

/*Buscar todos los items de la tabla "tipo_reserva" y colocarlos en una lista*/
function buscar_tipo_reserva_lista()
{
	include ("conexion.php");
	$sql= "select * from tipo_reserva where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_tipo_reserva" id="lista_tipo_reserva">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

function buscar_tipo_reserva_lista_guardado($id,$activo)
{
	include ("conexion.php");
	$sql= "select * from tipo_reserva where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="lista_tipo_reserva" id="lista_tipo_reserva">';
		}else{
			echo '<select name="lista_tipo_reserva" id="lista_tipo_reserva" disabled=true>';
		}
		if ($id != 0){
			echo '<option value="'.$id.'">'. buscar_nombre_tipo_reserva($id) .'</option>';
		}
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*Buscar todos los items de la tabla "pais" y colocarlos en una lista
deja de primero en la lista el del el id que recibe
si el id = 0 cagar la lista en el orden que la BD pasa los datos
el estado activo indica si la lista estara disabled o no*/
function buscar_pais_lista_guardado($id,$activo)
{
	include ("conexion.php");
	$sql= "select * from pais";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_paises" class="autocomplete">';
		}else{
			echo '<select name="listanueva" id="lista_paises" disabled="disabled" class="autocomplete">';
		}
		if ($id != 0){
			echo '<option value="'.$id.'">'. buscar_nombre_pais($id) .'</option>';
		}
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*Busca todos los items de la tabla Tipo_Habitacion y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tipo_habitacion_lista_guardado($id,$activo)
{
	include ("conexion.php");
		
	$sql= "select * from tipo_habitacion where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_t_habitacion">';
		}else{
			echo '<select name="listanueva" id="lista_t_habitacion" disabled="disabled">';
		}
		echo '<option value="'.$id.'">'. buscar_nombre_tipo_habitacion($id) .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

function buscar_tipo_habitacion_lista_guardado_i($id,$activo,$i)
{
	include ("conexion.php");
		
	$sql= "select * from tipo_habitacion where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="lista_t_habitacion-'.$i.'" id="lista_t_habitacion-'.$i.'">';
		}else{
			echo '<select name="lista_t_habitacion-'.$i.'" id="lista_t_habitacion-'.$i.'" disabled="disabled">';
		}
		if ($id != 0){
			echo '<option value="'.$id.'"><strong>'. buscar_nombre_tipo_habitacion($id) .'</strong></option>';
		}
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'"><strong>'. $row['nombre']. '</strong></option>';
		}
		echo "</select>";
	}
}

/*Busca todos los items de la tabla Tipo_Unidad y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tipo_unidad_lista_guardado($id,$activo)
{
	include ("conexion.php");
		
	$sql= "select * from tipo_unidad where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_t_unidad">';
		}else{
			echo '<select name="listanueva" id="lista_t_unidad" disabled="disabled">';
		}
		echo '<option value="'.$id.'">'. buscar_nombre_tipo_unidad($id) .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*Busca todos los items de la tabla Tipo_articulo y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tipo_articulo_lista_guardado($id,$activo)
{
	include ("conexion.php");
		
	$sql= "select * from tipo_articulo where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_t_articulo">';
		}else{
			echo '<select name="listanueva" id="lista_t_articulo" disabled="disabled">';
		}
		echo '<option value="'.$id.'">'. buscar_nombre_tipo_articulo($id) .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

//=============================================================================

/*Busca todos los items de la tabla que se le pase y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tabla_lista_guardado($tabla, $id, $activo)
{
	include ("conexion.php");

	$sql = "select * from ".$tabla." where status = 1";
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs) > 0){
		if ($activo){
			echo '<select size="1" name="lista_'.$tabla.'" id="lista_'.$tabla.'" class="autocomplete">';
		}else{
			echo '<select size="1" name="lista_'.$tabla.'" id="lista_'.$tabla.'" disabled="true" class="autocomplete">';
		}
		
//		if ($id != 0){
//			echo '<option value="'.$id.'" selected="selected">'. buscar_nombre_tabla($tabla,$id) .'</option>';
//		}
		
		echo '<option value="" selected="selected"></option>';
		
		while($row = mysql_fetch_array($rs)){
		  if ($id != 0 && $id == $row['id']) {
		    echo '<option value="'.$row['id'].'" selected="selected">'. $row['nombre']. '</option>';
		  }else{
		    echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
	    }
		}
		
		echo "</select>";
	}else{
		echo '<select size="1" name="lista_'.$tabla.'" id="lista_'.$tabla.'" class="autocomplete" >';
		echo '<option value=""> <font color="#FF0000"> Ningun registro encontrado. </font></option>';
		echo "</select>";
	}
}

function buscar_tabla_lista_guardado_campo($tabla,$id,$campo,$numero,$activo)
{
	include ("conexion.php");

	$sql= "select * from ".$tabla." where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_'.$tabla.$numero.'" >';
		}else{
			echo '<select name="listanueva" id="lista_'.$tabla.$numero.'" disabled="true" >';
		}
		
		if ($id != 0){
			echo '<option value="'.$id.'" selected="selected">'. buscar_campo_tabla_status($id,$tabla,$campo,1) .'</option>';
		}
		else
		{
			echo '<option value="" selected="selected"></option>';
		}
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row[$campo]. '</option>';
		}
		echo "</select>";
	}else{
		echo '<select name="listanueva" id="lista_'.$tabla.$numero.'"  >';
		echo '<option value=""> <font color="#FF0000"> Ningun registro encontrado. </font></option>';
		echo "</select>";
	}
	
	
}


/*HACE LA TABLA MULTIPLE SELECCION Busca todos los items de la tabla que se le pase y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tabla_lista_guardado_multiple($tabla,$id,$activo)
{
	include ("conexion.php");

	$sql= "select * from ".$tabla." where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva_'.$tabla.'[]" id="lista_'.$tabla.'" multiple="multiple">';
		}else{
			echo '<select name="listanueva_'.$tabla.'[]" id="lista_'.$tabla.'" disabled="true" multiple="multiple">';
		}
		
		if ($id != 0){
			echo '<option value="'.$id.'" selected="selected">'. buscar_nombre_tabla($tabla,$id) .'</option>';
		}
		
		
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}else{
		echo '<select "listanueva_'.$tabla.'[]" id="lista_'.$tabla.'" multiple="multiple" >';
		echo '<option value=""> <font color="#FF0000"> Ningun registro encontrado. </font></option>';
		echo "</select>";
	}
	
	
}

//FUNCION QUE CARGA LOS DATOS DESDE LA BD DE UNA TABLA RELACION DE UN MAESTRO DEJANDO MULTIPLE SELECCIONADOS LOS REGISTROS DE DICHA TABLA
// campo_relacion y campo_maestro SON LOS RESPECTIVOS CAMPOS PARA LA BUSQUEDA DE LOS REGISTROS QUE SE ENCUENTRAN EN DICHA TABA
function buscar_lista_multiple_guardadas_desplegadas($tabla_maestro,$tabla_relacion,$campo_maestro,$campo_relacion,$id_maestro,$activo)
{
	include ("conexion.php");
	$sql= "select * from ".$tabla_maestro." where status='1'";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva_'.$tabla_maestro.'[]" id="lista_'.$tabla_maestro.'" multiple="multiple">';
		}else{
			echo '<select name="listanueva_'.$tabla_maestro.'[]" id="lista_'.$tabla_maestro.'" disabled="true" multiple="multiple">';
		}
		
		while($row=mysql_fetch_array($rs)){
				 $sql2='SELECT * FROM '.$tabla_relacion.' where '.$campo_relacion.'="'.$id_maestro.'" and '.$campo_maestro.'="'.$row['id'].'"';
				 $rs3 = mysql_query($sql2);
				if (mysql_num_rows($rs3)!=0){		
					echo '<option value="'.$row['id'].'" selected="selected" >'. $row['nombre']. '</option>';
				}else{
					echo '<option value="'.$row['id'].'" >'. $row['nombre']. '</option>';
				}
		}
		echo "</select>";
	}else{
		echo '<select name="listanueva_'.$tabla_maestro.'[]" id="lista_'.$tabla_maestro.'" multiple="multiple">';
		echo '<option value=""> <font color="#FF0000"> Ningun registro encontrado. </font></option>';
		echo "</select>";
	}
}

function buscar_nombre_tabla($tabla,$id)
{
	include ("conexion.php");
	$sql= "select * from ".$tabla." where id ='".$id."'";
	$rs=mysql_query($sql);
	
	
	if (mysql_num_rows($rs)==0){
		return "El o la ".$tabla." no esta registrado";
			
	}else{
		$row=mysql_fetch_array($rs);
		return $row['nombre'];
	}
}

function buscar_nombre_tabla_web($tabla,$id)
{
	include ("conexion-web.php");
	$sql= "select * from ".$tabla." where id ='".$id."'";
	$rs=mysql_query($sql);
	
	
	if (mysql_num_rows($rs)==0){
		return "El o la ".$tabla." no esta registrado";
			
	}else{
		$row=mysql_fetch_array($rs);
		return $row['nombre'];
	}
}

//=============================================================================

/*Buscar el nombre del pais correspondiente al id que recibe la funcion*/
function buscar_nombre_pais($id)
{
	include ("conexion.php");
	$sql= "select * from pais where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El pais no esta registrado";
	}
}

/*Buscar el nombre del Estado_Habitacion correspondiente al id que recibe la funcion*/
function buscar_nombre_estado_habitacion($id)
{
	include ("conexion.php");
	$sql= "select * from estado_habitacion where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El estado de habitacion no esta registrado";
	}
}

/*Busca todos los items de la tabla Estado_Habitacion y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_estado_habitacion_lista_guardado($id,$activo)
{
	include ("conexion.php");
		
	$sql= "select * from estado_habitacion";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_estado_habitacion">';
		}else{
			echo '<select name="listanueva" id="lista_estado_habitacion" disabled="disabled">';
		}
		echo '<option value="'.$id.'">'. buscar_nombre_estado_habitacion($id) .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}

/*Buscar el nombre del Tipo_Habitacion correspondiente al id que recibe la funcion*/
function buscar_nombre_tipo_habitacion($id)
{
	include ("conexion.php");
	$sql= "select * from tipo_habitacion where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El tipo de habitacion no esta registrado";
	}
}

/*Buscar el nombre del Tipo_Unidad correspondiente al id que recibe la funcion*/
function buscar_nombre_tipo_unidad($id)
{
	include ("conexion.php");
	$sql= "select * from tipo_unidad where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El tipo de unidad no esta registrado";
	}
}

/*Buscar el nombre del Tipo_Unidad correspondiente al id que recibe la funcion*/
function buscar_nombre_tipo_articulo($id)
{
	include ("conexion.php");
	$sql= "select * from tipo_articulo where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El tipo de articulo no esta registrado";
	}
}


function buscar_nombre_tipo_reserva($id)
{
	include ("conexion.php");
	$sql= "select * from tipo_reserva where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El tipo de reserva no esta registrado";
	}
}

/* Funcion que recibe como parametros una cadena y el nombre de una tabla y busca en el campo nombre de esa tabla la cadena que se le pasa*/
function buscar_existe_nombre($cadena,$tabla)
{
	include ("conexion.php");
	$buscar = "SELECT nombre FROM ".$tabla." WHERE nombre = '".$cadena."';";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
} 

/* Funcion que recibe como parametros una cadena y el nombre de una tabla y busca en el campo "nombre" de esa tabla la cadena que se le pasa
   ademas de el status de la misma*/
function buscar_existe_nombre_status($cadena,$tabla,$status)
{
	include ("conexion.php");
	$buscar = "SELECT nombre FROM ".$tabla." WHERE nombre = '".$cadena."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

/* Funcion que recibe como parametros una cadena, un campo y el nombre de una tabla y busca en el campo que recibe en la tabla que recibe la cadena que se le pasa
   ademas de el status de la misma*/
function buscar_existe_campo_status($cadena,$tabla,$campo_buscar,$status)
{
	include ("conexion.php");
	$buscar = "SELECT ".$campo_buscar." FROM ".$tabla." WHERE ".$campo_buscar." = '".$cadena."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
} 

// FUNCION QUE RETORNA EL CAMPO BUSCADO DE UNA TABLA SEGUN EL ID QUE RECIBE
function buscar_campo_tabla_status($id,$tabla,$campo_buscar,$status)
{
	include ("conexion.php");
	$buscar = "SELECT * FROM ".$tabla." WHERE id = '".$id."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		$row=mysql_fetch_array($resultado);
		return $row[$campo_buscar];
	}
	else
	{
		return "No encontrado";
	}
}
//FUNCION QUE BUSCA UN CAMPO DE UNA TABLA Y RETORNA OTRO CAMPO QUE ES EL SOLICITADO, 
//EJ: $campo_busqueda = cedula,$valor_busqueda = '16531533',$tabla = cliente,$campo_buscar = nombre, $status = 1.
//RETORNARIA EL CAMPO NOMBRE DEL CLIENTE CON CEDULA 16531533.
function buscar_campo_segun_campo_tabla_status($campo_busqueda,$valor_busqueda,$tabla,$campo_buscar,$status)
{
	include ("conexion.php");
	$buscar = "SELECT * FROM ".$tabla." WHERE ".$campo_busqueda." = '".$valor_busqueda."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		$row=mysql_fetch_array($resultado);
		return $row[$campo_buscar];
	}
	else
	{
		return "No encontrado";
	}
}
 
// FUNCION QUE RETORNA EL CAMPO BUSCADO (desde la BD de la pagina web) DE UNA TABLA SEGUN EL ID QUE RECIBE
function buscar_campo_tabla_status_web($id,$tabla,$campo_buscar,$status)
{
	include ("conexion-web.php");
	$buscar = "SELECT * FROM ".$tabla." WHERE id = '".$id."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		$row=mysql_fetch_array($resultado);
		return $row[$campo_buscar];
	}
	else
	{
		return "No encontrado";
	}
} 
 
//Funcion que recibe una fecha con formato "30/10/2010" y la retorna en formato "2010-10-30"
function fechaentrada($cad2){
	$separar = explode('/',$cad2);
	$dia = $separar[0];
	$mes = $separar[1];
	$ano = $separar[2];
	$convertida = $ano."-".$mes."-".$dia;
	return $convertida;
}

//Funcion que recibe una fecha con formato "2010-10-30" y la retorna en formato "30/10/2010" 
function fechasalida($cad2){

	if ($cad2 == ""){
		return "-";
	}else{	
		$separar = explode('-',$cad2);
		$ano = $separar[0];
		$mes = $separar[1];
		$dia = $separar[2];
		$convertida2 = $dia."/".$mes."/".$ano;
		return $convertida2;
	}	
} 

function buscar_tarifa_status($campo_buscar,$busqueda,$status)
{
	include ("conexion.php");
	$buscar = "SELECT * FROM tarifa_persona WHERE ".$campo_buscar." = '".$busqueda."' AND status = ".$status.";";
	$resultado = mysql_query($buscar);
	if (mysql_num_rows($resultado)!=0)
	{
		$row=mysql_fetch_array($resultado);
		return $row['monto'];
	}
	else
	{
		return 0;
	}
} 

/*---------------------------------------------- HASTA AQUI SON FUNCIONES DE OCEANO AZZURRO -------------------------------------------------------------------*/


/* CREADA POR JOHAN */
/*Busca todos los items de la tabla Tipo_Cliente y los coloca en una lista y ADEMAS deja seleccionado el que se le pasa por parametro y hace la lista
disabled o no segun el 2do parametro que se le pase*/
function buscar_tipo_Cliente_lista_guardado($id,$activo)
{
	include ("conexion.php");
		
	$sql= "select * from tipo_cliente";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		if ($activo){
			echo '<select name="listanueva" id="lista_t_Cliente">';
		}else{
			echo '<select name="listanueva" id="lista_t_Cliente" disabled="disabled">';
		}
		echo '<option value="'.$id.'">'. buscar_nombre_tipo_Cliente($id) .'</option>';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}


/*Buscar el nombre del Tipo_Cliente correspondiente al id que recibe la funcion*/
function buscar_nombre_tipo_Cliente($id)
{
	include ("conexion.php");
	$sql= "select * from tipo_cliente where id ='".$id."'";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "El tipo de cliente no esta registrado";
	}
}



function buscar_habitacion_reservada($hab, $idImg)
{

$si=0;
$n_row=count($hab);
		for ($j=0; $j<$n_row; $j++)
		{
			if ($hab[$j]==$idImg)
			{
				$si=1;
				return true;
			}
			
		}
		
		if ($si==0) return false;	
	
}




/* ESTA FUNCION BUSCA EN LA TABLA AREA_PC A CUAL AREA DEL HOTEL SE ENCUENTRA ASOCIADA CADA PC */

function buscar_area_pc()
{

$nombre_pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);

	include ("conexion.php");
	$sql= "SELECT a.nombre as nombre FROM area_pc p, area a where p.Area_id = a.id and p.pc = '".$nombre_pc."';";
	$rs=mysql_query($sql);
	
	if (mysql_num_rows($rs)!=0){
		$row=mysql_fetch_array($rs);
		return $row['nombre'];	
	}else{
		return "Computadora ".$nombre_pc." no esta registrada";
	}

	
}




/* ********************************************************************************************* */
/* ********************************************************************************************* */
/* ********************************************************************************************* */
/* *********************************  FUNCIONES PRECIOS  *************************************** */




/*Buscar todos los items de la tabla "tipo_reserva" y colocarlos en una lista*/
function buscar_tipo_articulo_lista2()
{
	include ("conexion.php");
	$sql= "select * from tipo_articulo where status = 1";
	$rs=mysql_query($sql);
	if (mysql_num_rows($rs)!=0){
		echo '<select name="lista_tipo_articulo" id="lista_tipo_articulo">';
		while($row=mysql_fetch_array($rs)){
				echo '<option value="'.$row['id'].'">'. $row['nombre']. '</option>';
		}
		echo "</select>";
	}
}
?>
 