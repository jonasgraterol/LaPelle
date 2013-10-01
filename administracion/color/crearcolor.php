<link rel="stylesheet" type="text/css" href="css/spectrum.css">
<script type="text/javascript" src="jquery/spectrum.js"></script>

<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
		$j("#codigo").spectrum({
		  showButtons: false,
	    showInput: true,
	    move: function(c) {
  	            $j("#codigo").val(c.toHexString());
    	        }
		});
	});
</script>

<form id="formulario" class="niceform">  
     
	<fieldset>
  	<legend>Crear Color</legend>
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
		<dl>
  		<dt><label id="lcodigo" for="codigo">Color:</label></dt>
  		<dd>
  		  <input type="hidden" id="codigo" value="ffffff" />
  			<label class="err" id="codigo-error"> Por seleccione el color. </label>
  		</dd>
		</dl>
	</fieldset>	
	<fieldset class="action">
    	<input type="button" name="guardar" id="guardar" onclick="validaColor('color','guardar',0);" value="Guardar" />
		<input type="reset" name="limpiar" id="limpiar" value="Limpiar" />
    </fieldset>
     
</form>
   
