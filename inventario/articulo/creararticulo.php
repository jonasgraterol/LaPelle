<?php include("../../conexion.php"); ?>
<?php include("../../funcionesphp.php"); ?>
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
    	<legend>Crear Articulo</legend>
        <dl>
        	<dt><label id="lventa" for="venta">Para la venta:</label></dt>
            <dd>
            	<input type="checkbox" id="venta" checked="checked"  />
				<label class="err" id="venta-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel1">Tipo Articulo:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tipoarticulo",0,true); ?>
				<label class="err" id="lista_tipoarticulo-error" style=" float:right;"> Campo Obligatorio </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel2">Tipo de Unidad:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tipounidad",0,true); ?>
				<label class="err" id="lista_tipounidad-error" style="float:right"> Campo Obligatorio </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" />
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio" for="precio">Precio Venta 1:</label></dt>
            <dd>
            	<input type="text" id="precio"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio2" for="precio2">Precio Venta 2:</label></dt>
            <dd>
            	<input type="text" id="precio2"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio3" for="precio3">Precio Venta 3:</label></dt>
            <dd>
            	<input type="text" id="precio3"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio-error3"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="limagen" for="imagen">Imagen:</label></dt>
            <dd>
            	<input  type="file" name="imagen" id="imagen" />
				<input  type="hidden" name="imgarticulo" id="imgarticulo" />
				<label class="err" id="imgarticulo-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Stock Minimo:</label></dt>
            <dd>
            	<input type="text" id="stockmin" size="45" />
				<label class="err" id="stockmin-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Stock Maximo:</label></dt>
            <dd>
            	<input type="text" id="stockmax" size="45" />
				<label class="err" id="stockmax-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Cantidad:</label></dt>
            <dd>
            	<input type="text" id="cant" size="45" value="0" disabled="disabled" />
				<label class="err" id="cant-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaAli('articulo','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
