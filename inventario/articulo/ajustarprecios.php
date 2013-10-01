<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "articulo";
	$id=$_GET['id'];
	$sql='SELECT * FROM '.$tabla.' where id="'.$id.'"';
	$rs2 = mysql_query($sql);
	
	if (mysql_num_rows($rs2)==0){
		echo '<p>Este '.$tabla.' no existe.</p> ';
	} else {
		$row=mysql_fetch_array($rs2);
	}
	
	$sql_porc='SELECT * FROM porc_ganancia where id="1";';
	$rs_porc = mysql_query($sql_porc);

	if (mysql_num_rows($rs_porc)==0){
		echo '<p>Por favor configura el porcentaje de ganancias en el modulo de administracion.</p> ';
	} else {
		$row_porc=mysql_fetch_array($rs_porc);
	}
?>
<script type="text/javascript">
	$j(function() {

		$j( "#slider1" ).slider({
			value:$j( "#porc1" ).val(),
			min: 0,
			max: 200,
			step: 0.1,
			slide: function( event, ui ) {
				$j( "#porc1" ).val( ui.value );
				$j( "#precio" ).val( parseFloat($j("#pu").val()*(1+(ui.value/100))).toFixed(2) );				
			}
		});
		$j( "#porc1" ).val( $j( "#slider1" ).slider( "value" ) );	
		$j("#porc1").blur(function() {
			$j( "#slider1" ).val($j(this).val());
			$j( "#precio" ).val( parseFloat($j("#pu").val()*(1+($j(this).val()/100))).toFixed(2) );
		});
		
		$j( "#slider2" ).slider({
			value:$j( "#porc2" ).val(),
			min: 0,
			max: 200,
			step: 0.1,
			slide: function( event, ui ) {
				$j( "#porc2" ).val( ui.value );
				$j( "#precio2" ).val( parseFloat($j("#pu").val()*(1+(ui.value/100))).toFixed(2) );
			}
		});
		$j("#porc2").val( $j( "#slider2" ).slider( "value" ) );	
		$j("#porc2").blur(function() {
			$j( "#slider2" ).val($j(this).val());
			$j( "#precio2" ).val( parseFloat($j("#pu").val()*(1+($j(this).val()/100))).toFixed(2) );
		});
		
		$j( "#slider3" ).slider({
			value:$j( "#porc3" ).val(),
			min: 0,
			max: 200,
			step: 0.1,
			slide: function( event, ui ) {
				$j( "#porc3" ).val( ui.value );
				$j( "#precio3" ).val( parseFloat($j("#pu").val()*(1+(ui.value/100))).toFixed(2) );
			}
		});
		$j( "#porc3" ).val( $j( "#slider3" ).slider( "value" ) );	
		$j("#porc3").blur(function() {
			$j( "#slider3" ).val($j(this).val());
			$j( "#precio3" ).val( parseFloat($j("#pu").val()*(1+($j(this).val()/100))).toFixed(2) );
		});
		
	});		
		
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Ajuste de Precios</legend>
		<h2><?php echo $row['nombre']; ?></h2>
		<?php
			$sql = "select * from compra_detalle cd, compra c where cd.articulo_id = ".$row['id']." and cd.compra_id = c.id and c.status = 1 order by fecha_compra DESC limit 1;";
			
			$result = mysql_query($sql);
			if(mysql_num_rows($result) != 0)
			{
				$dat=mysql_fetch_array($result);
				
				$fec_utl_compra = fechasalida($dat['fecha_compra']);
				$nro_compra = $dat['compra_id'];
				$precio_unitario = $dat['precio_unitario'];
				$proveedor = buscar_campo_segun_campo_tabla_status('id',$dat['proveedor_id'],'proveedor','nombre',1);
			
		?>
		<table width="100%" style="text-align:center; border:#FFFFFF 3px inset; background-color:#333333; color:#FFFFFF;">
			<thead>
				<tr>
					<th colspan="3">Ultima Compra <small>Compra # <?php echo $nro_compra; ?> </small></th>
				</tr>
				<tr>
					<th width="20%">Fecha</th>
					<th width="50%">Proveedor</th>
					<th width="30%">Precio Unitario</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="background-color:#00FFFF; color:#333333; border:#FFFFFF 3px outset"><?php echo $fec_utl_compra; ?></td>
					<td style="background-color:#00FFFF; color:#333333; border:#FFFFFF 3px outset"><?php echo $proveedor; ?></td>
					<td style="background-color:#00FFFF; color:#333333; border:#FFFFFF 3px outset">
						<?php echo $precio_unitario; ?>
						<input id="pu" type="hidden" value="<?php echo $precio_unitario; ?>" />
					</td>
				</tr>
			</tbody>
		</table>
		<?php
			}
			else
			{
		?>	
				<div style="background-color:#FF9999; text-align:center; border:3px #FFFFFF inset; color:#FFFFFF; width:100%">
					Aun no se registran compras de este Articulo
				</div>
	
		<?php
			}
			
			$p1new = (($row_porc['porc_p1']/100)*$precio_unitario)+$precio_unitario;
			$p2new = (($row_porc['porc_p2']/100)*$precio_unitario)+$precio_unitario;
			$p3new = (($row_porc['porc_p3']/100)*$precio_unitario)+$precio_unitario;
		?>
		<table style="text-align:center;">
			<thead>
				<th width="10%">Tipo</th>
				<th width="20%">Precio Actual</th>
				<th width="15%">%</th>
				<th width="30%">% Ganacia</th>
				<th width="20%">Precio Nuevo</th>
			</thead>
			<tbody>
				<tr>
					<td>P1</td>
					<td><?php echo $row['precio1']; ?></td>
					<td>
						<input type="text" id="porc1" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row_porc['porc_p1']; ?>" />
					</td>
					<td><div style="width:100%; " id="slider1" ></div></td>
					<td><input type="text" id="precio" class="fornom" onkeyup="comaXpunto(this);" size="7" value="<?php echo round($p1new, 2); ?>" /></td>
				</tr>
				<tr>
					<td>P2</td>
					<td><?php echo $row['precio2']; ?></td>
					<td>
						<input type="text" id="porc2" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row_porc['porc_p2']; ?>" />
					</td>
					<td><div style="width:100%; " id="slider2" ></div></td>
					<td><input type="text" id="precio2" class="fornom" onkeyup="comaXpunto(this);" size="7" value="<?php echo round($p2new,2); ?>" /></td>
				</tr>
				<tr>
					<td>P3</td>
					<td><?php echo $row['precio3']; ?></td>
					<td>
						<input type="text" id="porc3" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row_porc['porc_p3']; ?>" />
					</td>
					<td><div style="width:100%; " id="slider3" ></div></td>
					<td><input  type="text" id="precio3" class="fornom" onkeyup="comaXpunto(this);" size="7" value="<?php echo round($p3new,2); ?>" /></td>
				</tr>	
			</tbody>
		</table>
        
		
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaAli('<?php echo $tabla ?>','ajustar',<?php echo $id; ?>);" value="Actualizar Precios" />
		<input type="reset" name="limpiar" id="limpiar" value="Deshacer" />
    </fieldset>
     
</form>
   
