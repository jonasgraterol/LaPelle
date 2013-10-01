
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
?>
<script type="text/javascript" charset="utf-8">
	function activarEdicion(){
		document.getElementById('nombre').disabled=false;
		document.getElementById('lista_tipoarticulo').disabled=false;
		document.getElementById('lista_tipounidad').disabled=false;
		
		document.getElementById('venta').disabled=false;
		document.getElementById('precio').disabled=false;
		document.getElementById('precio2').disabled=false;
		document.getElementById('precio3').disabled=false;
		document.getElementById('imagen').disabled=false;
		
		document.getElementById('stockmin').disabled=false;
		document.getElementById('stockmax').disabled=false;
		
		document.getElementById('botonGuardar').disabled=false;
		document.getElementById('botonDeshacer').disabled=false;
		document.getElementById('botonNuevo').disabled=true;
		document.getElementById('botonEditar').disabled=true;
		document.getElementById('botonEliminar').disabled=true;
	}
	
	function restaurar(){
		document.getElementById('nombre').disabled=true;
		document.getElementById('lista_tipoarticulo').disabled=true;
		document.getElementById('lista_tipounidad').disabled=true;
		
		document.getElementById('venta').disabled=true;
		document.getElementById('precio').disabled=true;
		document.getElementById('precio2').disabled=true;
		document.getElementById('precio3').disabled=true;
		document.getElementById('imagen').disabled=true;
		
		document.getElementById('stockmin').disabled=true;
		document.getElementById('stockmax').disabled=true;
		
		document.getElementById('botonGuardar').disabled=true;
		document.getElementById('botonDeshacer').disabled=true;
		document.getElementById('botonNuevo').disabled=false;
		document.getElementById('botonEditar').disabled=false;
		document.getElementById('botonEliminar').disabled=false;
	}
</script>
<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});
	
	$j(function() {
		$j("#imagen").uploadify({
			'auto' : false,
			'multiple' : false,
			'swf'             : 'uploadify/uploadify.swf',
			'uploader'        : 'uploadify/uploadify.php',
			'folder'		  : 'uploads',
			'onSelect' : function(file) {
           		$j("#imgarticulo").val(file.name);
       		} 			
			
		});
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Editar Articulo</legend>
        <dl>
        	<dt><label id="lventa" for="venta">Para la venta:</label></dt>
            <dd>
            	<input  type="checkbox" id="venta" <?php if($row['venta']==1) echo 'checked="checked"'; ?> disabled="disabled" />
				<label class="err" id="venta-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel1">Tipo Articulo:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tipoarticulo",$row['tipo_articulo_id'],false); ?>
				<label class="err" id="lista_tipoarticulo-error" style=" float:right;"> Campo Obligatorio </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel2">Tipo de Unidad:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tipounidad",$row['tipo_unidad_id'],false); ?>
				<label class="err" id="lista_tipounidad-error" style="float:right"> Campo Obligatorio </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['nombre']; ?>" disabled="disabled"/>
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio" for="precio">Precio Venta 1:</label></dt>
            <dd>
            	<input type="text" id="precio" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['precio1']; ?>" disabled="disabled"/>
				<label class="err" id="precio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio2" for="precio2">Precio Venta 2:</label></dt>
            <dd>
            	<input type="text" id="precio2" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['precio2']; ?>" disabled="disabled"/>
				<label class="err" id="precio2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio3" for="precio3">Precio Venta 3:</label></dt>
            <dd>
            	<input type="text" id="precio3" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['precio3']; ?>" disabled="disabled"/>
				<label class="err" id="precio3-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="limagen" for="imagen">Imagen:</label></dt>
            <dd>
            	<input  type="file" name="imagen" id="imagen" value="<?php echo $row['imagen']; ?>" disabled="disabled"/>
				<input  type="text" name="imgarticulo" id="imgarticulo" value="<?php echo $row['imagen']; ?>" disabled="disabled" size="45"/>
				<label class="err" id="imgarticulo-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Stock Minimo:</label></dt>
            <dd>
            	<input type="text" id="stockmin" size="45" value="<?php echo $row['stock_minimo']; ?>" disabled="disabled"/>
				<label class="err" id="stockmin-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Stock Maximo:</label></dt>
            <dd>
            	<input type="text" id="stockmax" size="45" value="<?php echo $row['stock_maximo']; ?>" disabled="disabled"/>
				<label class="err" id="stockmax-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Cantidad:</label></dt>
            <dd>
            	<input type="text" id="cant" size="45" disabled="disabled" value="<?php echo $row['cantidad']; ?>"/>
				<label class="err" id="cant-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
	</fieldset>	
	<fieldset class="action">
		<input type="button" id="botonNuevo" onClick="javascript: cargarDiv('derecha','inventario/<?php echo $tabla ?>/crear<?php echo $tabla ?>.php');" value="Nuevo" />
    	<input type="button" id="botonGuardar" onclick="validaAli('<?php echo $tabla ?>','editar',<?php echo $id; ?>);" value="Guardar" disabled="disabled"/>
		<input type="reset" id="botonDeshacer" onClick="restaurar()" value="Deshacer" disabled="disabled"/>
		<input type="button" id="botonEditar" onClick="activarEdicion()"  value="Editar" />
		<input type="button" id="botonEliminar" onClick="validaAli('<?php echo $tabla ?>','eliminar',<?php echo $id; ?>)"  value="Eliminar" />
    </fieldset>
     
</form>						
		
				