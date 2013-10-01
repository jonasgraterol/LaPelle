<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Usuario</legend>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" />
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="clave">Clave:</label></dt>
            <dd>
            	<input type="password" id="clave" size="45" />
				<label class="err" id="clave-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="clave2">Repetir Clave:</label></dt>
            <dd>
            	<input type="password" id="clave2" size="45" />
				<label class="err" id="clave2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaUsu('usuario','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
