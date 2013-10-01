<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Tipo de Unidad</legend>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" />
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>	
			<dt><label id="labrev" for="abrev">Abreviatura:</label></dt>
            <dd>
            	<input type="text" id="abrev" size="45" />
				<label class="err" id="abrev-error"> Por favor llene correctamente este campo. </label>
            </dd>
        </dl>
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaTipoUni('tipounidad','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
