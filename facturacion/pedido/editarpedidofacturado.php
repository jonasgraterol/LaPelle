
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "pedido_detalle pd, pedido p";
	$id=$_GET['id'];
	$sql='SELECT pd.*, p.total as tt, p.subtotal as st, p.iva as iv, date_format(p.fecha, "%d/%m/%Y") as fec, p.cliente_id as cli FROM '.$tabla.' where pd.pedido_id="'.$id.'" and p.id ="'.$id.'"; ';
	//echo $sql;
	$rs2 = mysql_query($sql);
	
	if (mysql_num_rows($rs2)==0){
		echo '<p>Este '.$tabla.' no existe.</p> ';
	} else {
		$row=mysql_fetch_array($rs2);
		$tot = $row['tt'];
		$stot = $row['st'];
		$iva = $row['iv'];
	}
	
	//PROXIMA FACTURA
	$s = "select id from factura where pedido_id ='".$id."';";
	$r = mysql_query($s);
	$f = mysql_fetch_array($r);
	$fact = $f['id'];
	//$cli = buscar_campo_segun_campo_tabla_status('id',$row['cliente_id'],'cliente','nombre',1)$row['cli'];
	//echo $cli;
	
?>
<style>
#dialog-link {
		padding: .1em 1em .1em 20px;
		text-decoration: none;
		position: relative;
		margin:0 auto;
		font-size:14px;
		
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
#icons {
		margin: 0;
		padding: 0;
		
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	</style>
	
<!-- MENSAJES -->
<script type="text/javascript" src="jquery/mensajes.js"></script>

	
<script type="text/javascript" charset="utf-8">

$j(document).ready(function() {
	NFInit();

	buscarCedula($j("#cedrif").val());
	
	

	$j("#cedrif").blur(function() {
		$j("#factcirif").html($j("#cedrif").val());
	});	
	$j("#nombre").blur(function() {
		$j("#factnombre").html($j("#nombre").val());
	});
	
	$j("#nombre").keyup(function() {
		$j("#nrocarac_nom").html(31-$j("#nombre").val().length);
	});
	$j("#telefono").keyup(function() {
		$j("#nrocarac_tel").html(29-$j("#telefono").val().length);
	});
	$j("#direccion").keyup(function() {
		$j("#nrocarac_dir").html(28-$j("#direccion").val().length);
	});
	$j("#direccion2").keyup(function() {
		$j("#nrocarac_dir2").html(39-$j("#direccion2").val().length);
	});
	
	// Hover states on the static widgets
		$j( "#dialog-link" ).hover(
			function() {
				$j( this ).addClass( "ui-state-hover" );
			},
			function() {
				$j( this ).removeClass( "ui-state-hover" );
			}
		);
		
	
});

$j(function() {

	$j( "#dialog" ).dialog({
		autoOpen: false,
		width: 550,
		height: 550,
		modal: false,
		position: { my: "left top", at: "left top" },
		buttons: [
			{
				text: "Listo",
				click: function() {
					$j( this ).dialog( "close" );
					
				}
			},
			{
				text: "Cancelar",
				click: function() {
					$j( this ).dialog( "close" );
				}
			}
		]
	});


	$j( "#dialog-link" ).click(function( event ) {
		$j( "#dialog" ).dialog( "open" );
		//event.preventDefault();
	});
});	

function cambiarAcc(acc) {
   document.formulario.action = acc;
}

function obtenerValorSeleccionadoRadio(nombreRadio)
{
    for(i=0;i<nombreRadio.length;i++)
        if(nombreRadio[i].checked) return nombreRadio[i].value;
}

function buscarCedula(campo)
{
	$j('#imgbusqueda').attr('src','images/indicator.gif');
	//alert("["+campo.value+"]");
	$j.post("facturacion/pedido/buscarcliente.php", { "cedula" : campo, "fec" : $j("#fechapedido").html()  }, function(data) {
		data=eliminaEspacios(data);
		var res = data.split("***");
		
		if(res[0] == "OK")
		{
			$j('#direccion2').val("");
			$j('#nombre').val(res[1]);
			
			$j('#telefono').val(res[3]);
			$j('#fechavence').html(res[4]);
			$j('#factfechavence').html(res[4]);
			
			//DATOS PARA IMPRIMIR FACTURA
			$j("#factnombre").html(res[1]);
			$j('#facttelefono').html(res[3]);
			$j('#factdir').html(res[2]);
			$j('#factcirif').html(campo);
			//FIN DATOS PARA IMPRIMIR FACTURA
			if(res[2].length > 28)
			{
				$j('#direccion').val(res[2].substring(0,28));
				$j('#direccion2').val(res[2].substring(28,res[2].length));
			}
			else
			{
				$j('#direccion').val(res[2]);
			}		
						
			$j('#imgbusqueda').attr('src','images/images_table/listo.png');
			
			$j("#nrocarac_nom").html(31-$j("#nombre").val().length);			
			$j("#nrocarac_tel").html(29-$j("#telefono").val().length);
			$j("#nrocarac_dir").html(28-$j("#direccion").val().length);
			$j("#nrocarac_dir2").html(39-$j("#direccion2").val().length);
			
		}
		else
		{
			$j('#nombre').val("");
			$j('#telefono').val("");
			$j('#direccion').val("");
			$j('#direccion2').val("");
			
			$j('#fechavence').html("");
			
			//DATOS PARA IMPRIMIR FACTURA
			$j("#factnombre").html("");
			$j('#facttelefono').html("");
			$j('#factdir').html("");
			$j('#factcirif').html("");
			
			$j('#factfechavence').html("");
			
			//FIN DATOS PARA IMPRIMIR FACTURA
			
			$j('#imgbusqueda').attr('src','images/images_table/question.png');
			
			$j("#nrocarac_nom").html(31-$j("#nombre").val().length);			
			$j("#nrocarac_tel").html(29-$j("#telefono").val().length);
			$j("#nrocarac_dir").html(28-$j("#direccion").val().length);
			$j("#nrocarac_dir2").html(39-$j("#direccion2").val().length);
		}
	});	
}

function preguntar()
{
	 var answer = confirm("Se imprimo la factura correctamente?");
	if (answer){
		actualizar("f",<?php echo $id ?>);
	}
	else{
		msj('warning','Se mantendra el pedido en el listado de pendientes hasta que lo marque como <strong>Despachado</strong>, <strong>Cancelado</strong> o <strong>Pueda imprimir la factura correctamente.</strong> .');
	}
}

function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var izquierda = (screen.width-800)/2;
  var ventimp = window.open(' ', 'popimpr','width=800,height=800,left='+izquierda+'scrollbars=NO');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
  
  var answer = confirm("Se imprimo la factura correctamente?");
	if (answer){
		actualizar("f",<?php echo $id ?>);
	}
	else{
		msj('warning','Se mantendra el pedido en el listado de pendientes hasta que lo marque como <strong>Despachado</strong>, <strong>Cancelado</strong> o <strong>Pueda imprimir la factura correctamente.</strong> .');
	}
 
}

function reimprimir(nombre)
{
  var ficha = document.getElementById(nombre);
  var izquierda = (screen.width-800)/2;
  var ventimp = window.open(' ', 'popimpr','width=800,height=800,left='+izquierda+'scrollbars=NO');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}

function facturar(tipo)
{
	switch(tipo)
	{
	case 'fiscal':
	  //Impresion de factura fiscal
		var paso = true;
		
		if(($j("#cedrif").val().length > 39) || ($j("#nombre").val().length > 31) || ($j("#telefono").val().length > 29) || ($j("#direccion").val().length > 28) || ($j("#direccion2").val().length > 39) ) 
		{
			msj('warning','Por favor verifique que el numero de caracteres no exceda la cantidad permitida en cada campo.');
		}	
		else
		{
			msj('cargando','Imprimiendo...');
			var pago = obtenerValorSeleccionadoRadio($j('input[name="pago"]'));
			//alert(pago);
			var nropedido = parseInt($j("#nropedido").html());
			var cedrif = $j("#cedrif").val();
			var cliente = $j("#nombre").val();
			var telefono = $j("#telefono").val();
			var dir = $j("#direccion").val();
			var dir2 = $j("#direccion2").val();
			
			var ids = new Array();
			var nombres = new Array();
			var precios = new Array();
			var cants = new Array();
			var subs = new Array();
			var n = 0;
			
			$j(".factu").each(function() {
					
					
				ids[n] = $j(this).attr("id");
				nombres[n] = $j("#nomb_"+ids[n]).html();
				precios[n] = parseFloat($j("#pre_"+ids[n]).html());
				cants[n] = parseFloat($j("#cant_"+ids[n]).html());
				subs[n] = parseFloat($j("#sub_"+ids[n]).html());
				//alert("id="+ids[n]+" nombres="+nombres[n]+" Cant="+cants[n]+" Precio="+precios[n]+" SubT="+subs[n]);
				n++;
				
			});
			
			$j.post("facturacion/pedido/facturar.php", 
				{ "nropedido" : nropedido, "n" : n, pago : pago, ids : ids, nombres : nombres, precios : precios, cants : cants, subs :subs, cedrif : cedrif, cliente : cliente, telefono : telefono, dir : dir, dir2 : dir2 }, 
				function(data) {
					data=eliminaEspacios(data);
					switch (data) {
						case "CONEXION":
						   msj('error','Problemas de conexion con la impresora, chequee que este encendida y conectada al puerto de impresion.');
						   break;
						case "OK":
						   msj('valid',"Impresion Correcta.");
						   limpiarDiv("derecha");
						   cargarDiv("centro","facturacion/pedido/administrarpedido.php");
						   break;
						case "NO":
						   msj('warning','No se pudo imprimir la factura correctamente');
						   break;
						default:
						   msj('warning','Respuesta de la impresora desconocida. Chequee que la impresora tenga papel o cualquier circunstancia que impida la impresion.');
					}
		
					//alert(data);
			
			});
		}
	break;
	case 'libre':
		if($j("#cedrif").val() != "" && $j("#nombre").val() != "")
		{
			imprSelec('factura');
		}
		else
		{
			msj('warning','Por favor llene los campos Cedula / RIF y Nombre');
		}
	break;
	case 'reimprimir':
		if($j("#cedrif").val() != "" && $j("#nombre").val() != "")
		{
			reimprimir('factura');
		}
		else
		{
			msj('warning','Por favor llene los campos Cedula / RIF y Nombre');
		}
	break;
	default:
	
	break;	
	}
}

function actualizar(acc, d)
{
	//alert(acc+" , "+d);
	$j.post("facturacion/pedido/actualizarpedido.php", 
	{ accion : acc , id : d, cedrif : $j("#cedrif").val(), nombre : $j("#nombre").val(), telefono : $j("#telefono").val(), dir : $j("#direccion").val()+" "+$j("#direccion2").val() }, function(data) {
		//alert("*"+data+"*");
		if(data == "OK" || data == " OK")
		{
			cargarDiv("centro","facturacion/pedido/administrarpedido.php");
			texto = "<h1>Operacion Exitosa</h1> Se ha actualizado el pedido correctamente.";
			msj('valid',texto);
			limpiarDiv('derecha');
		}
		else
		{
			 msj('error','No se pudo actualizar el pedido por un error en el servidor.');
		}
	});
}	

function calculaVuelto()
{
	
	var monto = parseFloat($j("#efec").val()).toFixed(2)-parseFloat($j("#tt").html()).toFixed(2)
	$j("#vuel").html(monto.toFixed(2));
}
</script>

<form id="formulario" class="niceform">  
	<fieldset>
    	<legend>Pedidos</legend>
		<dl>
			<dt><label for="color">Forma de Pago:</label></dt>
			<dd>
				<input type="radio" name="pago" id="pagoEfectivo" value="efectivo" checked="checked"/><label for="pagoEfectivo" class="opt">Efectivo</label>
				<input type="radio" name="pago" id="pagoDebito" value="debito" /><label for="pagoDebito" class="opt">Debito</label>
				<input type="radio" name="pago" id="pagoCredito" value="credito" /><label for="pagoCredito" class="opt">Credito</label>
				<input type="radio" name="pago" id="pagoCheque" value="cheque" /><label for="pagoCheque" class="opt">Cheque</label>
			</dd>
		</dl>
				<div style="text-align:center"	>
				<a href="#" id="dialog-link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-search"></span>Buscar Clientes</a>
				</div>	
				<table style="width:100%; text-align:center;">
					<thead>
						<th style="width:10%;">Ped #</th>
						<th style="width:10%;">Fact #</th>
						<th style="width:45%;">Cedula / RIF 
			
						</th>
						<th style="width:20%;">Fecha</th>
						<th style="width:20%;">Vencimiento</th>
					</thead>
					<tbody>
						<tr>
							<td id="nropedido"><?php echo $id; ?></td>
							<td id="nrofactura"><strong><?php echo $fact; ?></strong></td>
							<td >
								<?php 
									$cedrif = buscar_campo_segun_campo_tabla_status('id',$row['cli'],'cliente','cedrif',1); 
									if($cedrif == "No encontrado")
									{
										$cedrif = "";
									}
									echo '<input class="val39" type="text" id="cedrif" onkeyup="buscarCedula(this.value)" size="20" value="'.$cedrif.'" />';
								?>
								<img src="" id="imgbusqueda" />
								
							</td>
							<td id="fechapedido"><?php echo $row['fec']; ?></td>
							<td id="fechavence"></td>
						</tr>
					</tbody>
				</table>	
				<table style="width:100%; text-align:center;">
					<thead>
						<th style="width:40%;">Nombre</th>
						<th style="width:60%;">Direccion</th>
						
					</thead>
					<tbody>
						<tr>
							<td><input class="val39" type="text" id="nombre"  /><label id="nrocarac_nom" style="color:#FF3333"> 31</label></td>
							<td><input class="val39" type="text" id="direccion" size="35"  /><label id="nrocarac_dir" style="color:#FF3333"> 28</label></td>
						</tr>
					</tbody>
				</table>
				<table style="width:100%; text-align:center;">
					<thead>
						<th style="width:40%;">Telefono</th>
						<th style="width:60%;">Direccion <code >(Linea 2)</code></th>
						
					</thead>
					<tbody>
						<tr>
							<td><input class="val39" type="text" id="telefono"  /><label id="nrocarac_tel" style="color:#FF3333"> 29</label></td>
							<td><input class="val39" type="text" id="direccion2" size="35"  /><label id="nrocarac_dir2" style="color:#FF3333"> 39</label></td>
						</tr>
					</tbody>
				</table>		
					
				<table id="rounded-corner"   >
					<thead>
						<tr>
							<th scope="col" width="60%" class="rounded-company">Servicio</th>
							<th scope="col" width="10%" class="rounded">Cant</th>
							<th scope="col" width="10%" class="rounded">P/u</th>
							<th scope="col" width="20%" class="rounded-q4">SubTotal</th>
						</tr>
					</thead>
					<tbody>
							
							<?php 
								$sql='SELECT pd.*, date_format(p.fecha, "%d/%m/%Y") as fec FROM '.$tabla.' where pd.pedido_id="'.$id.'" and p.id ="'.$id.'"; ';
								
								//echo $sql;
								$rs2 = mysql_query($sql);
								if (mysql_num_rows($rs2)==0){
									echo '<p>Ninguna imagen esta asociada a este articulo.</p> ';
								} else {
									while($row=mysql_fetch_array($rs2))
									{
										if($row['servicio_id']!="")
										{
											echo '<tr class="factu" id="'.$row['servicio_id'].'">
											<td id="nomb_'.$row['servicio_id'].'">'.buscar_campo_segun_campo_tabla_status('id',$row['servicio_id'],'servicio','nombre',1).'</td>';
											echo '<td id="cant_'.$row['servicio_id'].'">'.$row['cant'].'</td>
											<td id="pre_'.$row['servicio_id'].'">'.round(($row['precio_unitario']/1.12), 2).'</td>
											<td id="sub_'.$row['servicio_id'].'">'.round((($row['precio_unitario']/1.12)*$row['cant']), 2).'</td>
										</tr>';
										}
										else
										{
											echo '<tr class="factu" id="art_'.$row['articulo_id'].'">
											<td id="art_nomb_'.$row['articulo_id'].'">'.buscar_campo_segun_campo_tabla_status('id',$row['articulo_id'],'articulo','nombre',1).'</td>';
											echo '<td id="art_cant_'.$row['articulo_id'].'">'.$row['cant'].'</td>
											<td id="art_pre_'.$row['articulo_id'].'">'.round(($row['precio_unitario']/1.12), 2).'</td>
											<td id="art_sub_'.$row['articulo_id'].'">'.round((($row['precio_unitario']/1.12)*$row['cant']), 2).'</td>
										</tr>';
										}	
											
												
									}
								}
							?>
								
							</tbody>
						</table>

						<table style="margin:0;" width="100%" >
							<thead>
								<tr>
									<th width="80%" bgcolor="#60c8f2">Sub-Total</th>
									<th width="20%" bgcolor="#60c8f2"><?php echo $stot; ?></th>
								</tr>
								<tr>
									<th width="80%" bgcolor="#60c8f2">Iva (12%)</th>
									<th width="20%" bgcolor="#60c8f2"><?php echo $iva; ?></th>
								</tr>
								<tr>
									<th width="80%" bgcolor="#60c8f2">Total</th>
									<th width="20%" id="tt" bgcolor="#60c8f2"><?php echo $tot; ?></th>
								</tr>
								<tr>
									<th width="80%" bgcolor="#66CC66">Efectivo</th>
									<th width="20%" bgcolor="#66CC66"><input type="text" id="efec" size="5" onkeyup="comaXpunto(this); calculaVuelto();" /></th>
								</tr>
								<tr>
									<th width="80%" bgcolor="#66CC66">Vuelto</th>
									<th width="20%" id="vuel" bgcolor="#66CC66"></th>
								</tr>
								
							</thead>
						</table>
						
<div id="factura" style="display:none;" >
	
	<table id="tabcliente" align="left" style="margin:0; margin-top:50px; border:1px dotted #999999" width="70%" >
		<tbody>
			<tr>
				<td width="20%" ><strong>Razon Social:</strong></td>
				<td width="70%" colspan="3" id="factnombre" ></td>
			</tr>
			<tr>
				<td width="20%" ><strong>RIF / CI:</strong></td>
				<td width="30%" id="factcirif" ></td>
				<td width="20%" style="text-align:right" ><strong>Telefono:</strong></td>
				<td width="30%" id="facttelefono" ></td>
			</tr>
			<tr>
				<td width="20%" ><strong>Direccion:</strong></td>
				<td width="70%" colspan="3" id="factdir" ></td>
			</tr>
		</tbody>
	</table>	
	<table id="tabcliente" align="left" style="margin:0; margin-top:50px; border:1px dotted #999999" width="30%" >
		<tbody>
			<tr>
				<td width="60%" ><strong>Factura Nro.:</strong></td>
				<td width="40%" > <?php echo $fact; ?></td>
			</tr>
			<tr>
				<td width="60%" ><strong>Fecha:</strong></td>
				<td width="40%"  ><?php $f=fecha_ahora(); echo fechasalida($f[0]); ?></td>
			</tr>
			<tr>
				<td width="60%" ><strong>Fecha Vencimineto:</strong></td>
				<td width="40%" id="factfechavence" ><?php echo fechasalida(sumaDiafechaentrada($f[0],15)); ?> </td>
			</tr>
		</tbody>
	</table>

	<table id="tabfact" style="margin:0; padding-top:10px; clear:both;" width="100%" >
		<thead>
			<tr>
				<th width="60%" >Descripcion</th>
				<th width="10%" >Cant</th>
				<th width="10%" >Precio</th>
				<th width="20%" >SubTotal</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 
				$sql='SELECT pd.*, date_format(p.fecha, "%d/%m/%Y") as fec FROM '.$tabla.' where pd.pedido_id="'.$id.'" and p.id ="'.$id.'"; ';
								
				//echo $sql;
				$rs2 = mysql_query($sql);
				if (mysql_num_rows($rs2)==0){
					echo '<p>Ninguna imagen esta asociada a este articulo.</p> ';
				} else {
					while($row=mysql_fetch_array($rs2))
					{
						if($row['servicio_id']!="")
						{
							echo '<tr class="factu" id="'.$row['servicio_id'].'">
							<td style="border-bottom: solid 1px #CCCCCC;" id="nomb_'.$row['servicio_id'].'">'.buscar_campo_segun_campo_tabla_status('id',$row['servicio_id'],'servicio','nombre',1).'</td>';
							echo '<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="cant_'.$row['servicio_id'].'">'.$row['cant'].'</td>
							<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="pre_'.$row['servicio_id'].'">'.round(($row['precio_unitario']/1.12), 2).'</td>
							<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="sub_'.$row['servicio_id'].'">'.round((($row['precio_unitario']/1.12)*$row['cant']), 2).'</td>
							</tr>';
						}
						else
						{
							echo '<tr class="factu" id="art_'.$row['articulo_id'].'">
							<td style="border-bottom: solid 1px #CCCCCC;" id="art_nomb_'.$row['articulo_id'].'">'.buscar_campo_segun_campo_tabla_status('id',$row['articulo_id'],'articulo','nombre',1).'</td>';
							echo '<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="art_cant_'.$row['articulo_id'].'">'.$row['cant'].'</td>
							<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="art_pre_'.$row['articulo_id'].'">'.round(($row['precio_unitario']/1.12), 2).'</td>
							<td style="text-align:center; border-bottom: solid 1px #CCCCCC;" id="art_sub_'.$row['articulo_id'].'">'.round((($row['precio_unitario']/1.12)*$row['cant']), 2).'</td>
							</tr>';
						}	
					}
				}
			?>
			</tbody>
	</table>
	<table style="margin:0; " width="100%" >
		<thead>
			<tr >
				<th width="80%" bgcolor="#60c8f2">Sub-Total</th>
				<th width="20%" bgcolor="#60c8f2"><?php echo $stot; ?></th>
			</tr>
			<tr>
				<th width="80%" bgcolor="#60c8f2">Iva (12%)</th>
				<th width="20%" bgcolor="#60c8f2"><?php echo $iva; ?></th>
			</tr>
			<tr>
				<th width="80%" bgcolor="#60c8f2">Total</th>
				<th width="20%" id="tt" bgcolor="#60c8f2"><?php echo $tot; ?></th>
			</tr>
		</thead>
	</table>								
	
</div>						
					
				
				
</fieldset>	
	<fieldset class="action">
		
    	<input type="button" id="botonGuardar" onClick="facturar('reimprimir')" value="Reimprimir Factura" />
		
		
    </fieldset>
     
</form>	

<div id="dialog" title="Listado de Clientes">
	<?php include("../../administracion/cliente/administrarclientefactura.php"); ?>
</div>	  					