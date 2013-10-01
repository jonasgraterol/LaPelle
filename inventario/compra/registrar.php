<link href="css/smart_cart_compras.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery/smartCart_compras.js"></script>
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
?>
<script type="text/javascript">
   
    $j(document).ready(function(){
    	
		NFInit();
		
		// Call Smart Cart    	
		$j('#SmartCart').smartCart();
		
		$j(".prec").keyup(function() {
			//alert($j(this).attr("id"));
			var id = $j(this).attr("id");
			var numid = id.split("_");
			//alert($j("#prec_"+numid[1]).html());
			$j("#ali_"+numid[1]).attr("pprice",$j(this).val());
		});
		$j(function() {
			$j("#fecha").datepicker({ minDate: "-6M", maxDate: 0 });
		});
	});
</script>
<form id="formulario" onsubmit="validaCom('compra','guardar',0); return false;" method="post" class="niceform">
<fieldset>
    	<legend>Registrar Compra</legend>
        
		<dl>
        	<dt><label for="tel1">Proveedor:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("proveedor",0,true); ?>
				<label class="err" id="lista_proveedor-error" style=" float:right;"> Campo Obligatorio </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="fact">Nro Factura:</label></dt>
            <dd>
            	<input type="text" id="fact" size="45" />
				<label class="err" id="fact-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="fecha">Fecha Compra:</label></dt>
            <dd>
            	<input type="text" id="fecha" size="45" />
				<label class="err" id="fecha-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>	
			<dt><label id="ldesc" for="desc">Descripcion:</label></dt>
            <dd>
            	<input  id="desc" size="45" />
				<label class="err" id="desc-error"> Por favor llene correctamente este campo. </label>
            </dd>
        </dl>
</fieldset>					

<!-- Smart Cart HTML Starts -->
	<div id="SmartCart" class="scMain">
  	<?php
		$sql = "SELECT * from articulo where status = 1; ";
		$rs = mysql_query($sql);
		if ($rs == 0)
		{
			echo "Ningun servicio encontrado";
		}
		else
		{
			while($row=mysql_fetch_array($rs))
			{
				echo '<input type="hidden" id="ali_'.$row['id'].'"
				punidad="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_unidad_id'],"tipounidad","abreviatura",1).'" 
				pprice="0" 
				pcategory="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_articulo_id'],"tipoarticulo","nombre",1).'" 
				pname="'.$row['nombre'].'" 
				pid="'.$row['id'].'">';
			}
		}
  	?>
	</div>
<!-- Smart Cart HTML Ends -->
</form>  		
			