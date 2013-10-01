<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Proveedor</legend>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" />
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel1">Telefono 1:</label></dt>
            <dd>
            	<input type="text" id="tel1" size="45" />
				<label class="err" id="tel1-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel2">Telefono 2:</label></dt>
            <dd>
            	<input type="text" id="tel2" size="45" />
				<label class="err" id="tel2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Correo:</label></dt>
            <dd>
            	<input type="text" id="correo" size="45" />
				<label class="err" id="correo-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>	
			<dt><label id="ldire" for="dire">Direccion:</label></dt>
            <dd>
            	<textarea  id="dire" rows="5" cols="45" ></textarea>
				<label class="err" id="dire-error"> Por favor llene correctamente este campo. </label>
            </dd>
        </dl>
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaPro('proveedor','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
