<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>

<?php include("../../funcionesphp.php") ?>

<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Talla</legend>
    	<dl>	
    		<dt><label id="labrev" for="abrev">Tipo de artículo:</label></dt>
    	    <dd>
    	    	<!--<input type="text" id="abrev" size="45" />-->
    	    	<?php buscar_tabla_lista_guardado("tipoarticulo",0,true); ?>
    				<label class="err" id="lista_tipoalimento-error"> Por favor llene correctamente este campo. </label>
    	    </dd>
    	</dl>
        <dl>
        	<dt><label id="lnombre" for="nombre">Talla:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="20" />
      				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
    		</dl>
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaTalla('talla','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
