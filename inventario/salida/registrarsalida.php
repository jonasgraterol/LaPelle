<link href="css/smart_cart_salidas.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery/smartCart_salidas.js"></script>
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
<form id="formulario" onsubmit="validaSal('salida','guardar',0); return false;" method="post" class="niceform">
<fieldset>
    	<legend>Registrar Salida</legend>
        
		
		<dl>
        	<dt><label for="fecha">Fecha Salida:</label></dt>
            <dd>
            	<input type="text" id="fecha" size="45" />
				<label class="err" id="fecha-error"> Por favor llene correctamente este campo. </label>
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
				$sq = "select precio_unitario from compra_detalle where articulo_id = ".$row['id']." order by compra_id desc limit 1;";
				$r = mysql_query($sq);
				if ($r == 0) { $p = 0; } else { $row2 = mysql_fetch_array($r); $p = $row2['precio_unitario'];  }
				echo '<input type="hidden" id="ali_'.$row['id'].'"
				punidad="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_unidad_id'],"tipounidad","abreviatura",1).'" 
				pprice="'.$p.'" 
				pcategory="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_articulo_id'],"tipoarticulo","nombre",1).'" 
				pname="'.$row['nombre'].'" 
				pid="'.$row['id'].'">';
			}
		}
  	?>
	</div>
<!-- Smart Cart HTML Ends -->
</form>  		
			