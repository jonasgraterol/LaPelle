<link href="css/smart_cart_menu.css" rel="stylesheet" type="text/css">
<style>
	.pp {
		position:absolute;
	}
</style>
<script type="text/javascript" src="jquery/smartCart_menu.js"></script>
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
?>
<script type="text/javascript">
function obtenerValorSeleccionadoRadio(nombreRadio)
{
    for(i=0;i<nombreRadio.length;i++)
        if(nombreRadio[i].checked) return nombreRadio[i].value;
}
function refre(p)
{
	switch(p) {
		case 'P1':
			$j('.P2, .P3').hide();
			$j('.P1').show();
		break	
		case 'P2':
			$j('.P1, .P3').hide();
			$j('.P2').show();
		break	
		case 'P3':
			$j('.P1, .P2').hide();
			$j('.P3').show();
		break
	}	
}   
    $j(document).ready(function(){
    	// Call Smart Cart    	
		$j('#SmartCart').smartCart();
		
		$j( "#radios" ).buttonset();
		
		$j('.P2, .P3').hide();
		$j('.precios').click(function() {
			refre($j(this).val());	
		});	
		$j('.scTxtSearch').keyup(function() {
			var pp = obtenerValorSeleccionadoRadio($j("[name='precios']"));
			refre(pp);	
		});	
		$j('.scSelCategory').click(function() {
			var pp = obtenerValorSeleccionadoRadio($j("[name='precios']"));
			refre(pp);	
		});
	});
</script>

<form style="text-align:center; margin:2px;">
	<div id="radios">
		<input type="radio" class="precios" name="precios" id="P1" value="P1" checked="checked" /><label for="P1">Precios 1 (P1)</label>
		<input type="radio" class="precios" name="precios" id="P2" value="P2"  /><label for="P2">Precios 2 (P2)</label>
		<input type="radio" class="precios" name="precios" id="P3" value="P3"  /><label for="P3">Precios 3 (P3)</label>
		
	</div>
</form>
<!--
<div id="divradios" style="width:100%; text-align:justify">
Precios 1 (P1)<input type="radio" class="precios" name="precios" id="P1" value="P1" checked="checked" />
Precios 2 (P2)<input type="radio" class="precios" name="precios" id="P2" value="P2" />
Precios 3 (P3)<input type="radio" class="precios" name="precios" id="P3" value="P3" />
</div>
-->
<form id="formulario" onsubmit="validaPed('pedido','guardar',0); return false;" method="post" >
				

<!-- Smart Cart HTML Starts -->
	<div id="SmartCart" class="scMain">
  	<?php
		$sql = "SELECT *
				FROM((SELECT id, 'P1' as clase, nombre, precio1 as precio, imagen, tipo_servicio_id
					  from servicio
					  where status = 1 and (precio1 is not null or precio1 = '' or precio1 = 0))
					  UNION
					 (SELECT id, 'P2' as clase, nombre, precio2 as precio, imagen, tipo_servicio_id
					   from servicio
					   where status = 1 and (precio2 is not null or precio2 = '' or precio2 = 0))
					  UNION
					 (SELECT id, 'P3' as clase, nombre, precio3 as precio, imagen, tipo_servicio_id
					 from servicio
					 where status = 1 and (precio3 is not null or precio3 = '' or precio3 = 0)))A
				order by A.NOMBRE ASC;";
		$rs = mysql_query($sql);
		if ($rs == 0)
		{
			echo "Ningun servicio encontrado";
		}
		else
		{
			while($row=mysql_fetch_array($rs))
			{
				if ($row['imagen'] == "") { $imagen = "noimage.jpg"; }
				else { $imagen = $row['imagen']; }			
				
				echo '<input type="hidden" id="ali_'.$row['id'].'"
				pimage="uploads/'.$imagen.'"
				pprice="'.$row['precio'].'" 
				pclase="'.$row['clase'].'"
				pcategory="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_servicio_id'],"tiposervicio","nombre",1).'" 
				pname="'.$row['nombre'].'" 
				pid="'.$row['id'].'">';
			}
		}
		//CARGANDO ARTICULOS SELECT * from articulo where status = 1 order by tipo_articulo_id ASC;
		$sql = "SELECT *
				FROM((SELECT id, 'P1' as clase, nombre, precio1 as precio, imagen, tipo_articulo_id
					  from articulo
					  where status = 1 and venta = 1 and (precio1 is not null or precio1 = '' or precio1 = 0))
					  UNION
					 (SELECT id, 'P2' as clase, nombre, precio2 as precio, imagen, tipo_articulo_id
					   from articulo
					   where status = 1 and venta = 1 and (precio2 is not null or precio2 = '' or precio2 = 0))
					  UNION
					 (SELECT id, 'P3' as clase, nombre, precio3 as precio, imagen, tipo_articulo_id
					 from articulo
					 where status = 1 and venta = 1 and (precio3 is not null or precio3 = '' or precio3 = 0)))A
				order by A.NOMBRE ASC" ;
		$rs = mysql_query($sql);
		if ($rs == 0)
		{
			echo "Ningun servicio encontrado";
		}
		else
		{
			while($row=mysql_fetch_array($rs))
			{
				if ($row['imagen'] == "") { $imagen = "noimage.jpg"; }
				else { $imagen = $row['imagen']; }	
			
				echo '<input type="hidden" id="ali_'.$row['id'].'"
				pimage="uploads/'.$imagen.'"
				pprice="'.$row['precio'].'" 
				pclase="'.$row['clase'].'" 
				pcategory="'.buscar_campo_segun_campo_tabla_status("id",$row['tipo_articulo_id'],"tipoarticulo","nombre",1).'" 
				pname="'.$row['nombre'].'" 
				pid="art-'.$row['id'].'">';
			}
		}
  	?>
	</div>
<!-- Smart Cart HTML Ends -->
</form>  		
			