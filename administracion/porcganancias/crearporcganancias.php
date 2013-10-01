<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "porc_ganancia";
	$id=$_GET['id'];
	$sql='SELECT * FROM '.$tabla.' where id="1";';
	$rs2 = mysql_query($sql);

	if (mysql_num_rows($rs2)==0){
		echo '<p>Este '.$tabla.' no existe.</p> ';
	} else {
		$row=mysql_fetch_array($rs2);
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
			}
		});
		$j( "#porc1" ).val( $j( "#slider1" ).slider( "value" ) );	
		$j("#porc1").blur(function() {
			$j( "#slider1" ).val($j(this).val());
		});
		
		$j( "#slider2" ).slider({
			value:$j( "#porc2" ).val(),
			min: 0,
			max: 200,
			step: 0.1,
			slide: function( event, ui ) {
				$j( "#porc2" ).val( ui.value );
			}
		});
		$j("#porc2").val( $j( "#slider2" ).slider( "value" ) );	
		$j("#porc2").blur(function() {
			$j( "#slider2" ).val($j(this).val());
		});
		
		$j( "#slider3" ).slider({
			value:$j( "#porc3" ).val(),
			min: 0,
			max: 200,
			step: 0.1,
			slide: function( event, ui ) {
				$j( "#porc3" ).val( ui.value );
			}
		});
		$j( "#porc3" ).val( $j( "#slider3" ).slider( "value" ) );	
		$j("#porc3").blur(function() {
			$j( "#slider3" ).val($j(this).val());
		});
		
	});		
		
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Definir % de Ganancias</legend>
		<dl>
        	<label id="lventa" for="venta">Ajustar precio de venta Automaticamente en cada compra:</label>

				<input  type="checkbox" id="automatico" <?php if($row['ajuste_automatico']==1) echo 'checked="checked"'; ?> />
				<label class="err" id="venta-error"> Por favor llene correctamente este campo. </label>
            
		</dl>
        <dl>
        	<dt><label id="lporc1" for="porc1">% Precio 1:</label></dt>
            <dd>
            	<input type="text" id="porc1" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row['porc_p1']; ?>" />
				<div style="width:70%; float:left; margin-left:10px; margin-top:3px;" id="slider1" ></div>
				<label class="err" id="porc1-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lporc2" for="porc2">% Precio 2:</label></dt>
            <dd>
            	<input type="text" id="porc2" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row['porc_p2']; ?>" />
				<div style="width:70%; float:left; margin-left:10px; margin-top:3px;" id="slider2" ></div>
				<label class="err" id="porc2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lporc2" for="porc3">% Precio 3:</label></dt>
            <dd>
            	<input type="text" id="porc3" class="fornom" onkeyup="comaXpunto(this);" size="1" value="<?php echo $row['porc_p3']; ?>" />
				<div style="width:70%; float:left; margin-left:10px; margin-top:3px;" id="slider3" ></div>
				<label class="err" id="porc3-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaPorcGan('porcganancias','editar',1);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
