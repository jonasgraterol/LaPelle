<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Tipo de Servicio</legend>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" />
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>	
			<dt><label id="ldesc" for="desc">Descripcion:</label></dt>
            <dd>
            	<textarea  id="desc" rows="5" cols="45" ></textarea>
				<label class="err" id="desc-error"> Por favor llene correctamente este campo. </label>
            </dd>
        </dl>
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaTipoPla('tiposervicio','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
