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
           		$j("#imgservicio").val(file.name);
       		} 			
			
		});
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Servicio</legend>
		<dl>
        	<dt><label for="tiposervicio">Tipo Servicio:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tiposervicio",0,true); ?>
				<label class="err" id="lista_tiposervicio-error" style="float:right"> Campo Obligatorio </label>
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
        	<dt><label id="lprecio" for="precio">Precio 1:</label></dt>
            <dd>
            	<input type="text" id="precio"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio2" for="preci2o">Precio 2:</label></dt>
            <dd>
            	<input type="text" id="precio2"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio3" for="precio3">Precio 3:</label></dt>
            <dd>
            	<input type="text" id="precio3"  class="fornom" onkeyup="comaXpunto(this);" size="45" />
				<label class="err" id="precio3-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="limagen" for="imagen">Imagen:</label></dt>
            <dd>
            	<input  type="file" name="imagen" id="imagen" />
				<input  type="hidden" name="imgservicio" id="imgservicio" />
				<label class="err" id="imgservicio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		<dl>
        	<dt><label id="ldesc" for="desc">Descripcion:</label></dt>
            <dd>
            	<textarea id="desc" cols="45" rows="5" ></textarea>
				<label class="err" id="desc-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaPla('servicio','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
		
    </fieldset>
     
</form>
   
