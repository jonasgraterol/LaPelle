<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Cliente</legend>
		<dl>
        	<dt><label id="lcedrif" for="cedrif">Cedula / Rif:</label></dt>
            <dd>
            	<input type="text" id="cedrif" size="45" />
				<label class="err" id="cedrif-error"> Por favor llene correctamente este campo. </label>
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
        	<dt><label for="tel1">Telefono:</label></dt>
            <dd>
            	<input type="text" id="tel1" size="45" />
				<label class="err" id="tel1-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="twitter">Twitter:</label></dt>
            <dd>
            	<input type="text" id="twitter" size="45" />
				<label class="err" id="twitter-error"> Por favor llene correctamente este campo. </label>
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
		<dl>
        	<dt><label id="lcredimonto" for="credimonto">Limite Credito:</label></dt>
            <dd>
            	<input type="text" id="credimonto" class="fornom" onkeyup="comaXpunto(this);" size="45" value="0" />
				<label class="err" id="credimonto-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lcredidias" for="credidias">Dias de Credito:</label></dt>
            <dd>
            	<input type="text" id="credidias" class="fornom" onkeyup="comaXpunto(this);" size="45" value="0" />
				<label class="err" id="credidias-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaCli('cliente','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
