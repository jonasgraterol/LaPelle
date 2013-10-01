
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "color";
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
		document.getElementById('abrev').disabled=false;
		document.getElementById('codigo').disabled=false;
		
		document.getElementById('botonGuardar').disabled=false;
		document.getElementById('botonDeshacer').disabled=false;
		document.getElementById('botonNuevo').disabled=true;
		document.getElementById('botonEditar').disabled=true;
		document.getElementById('botonEliminar').disabled=true;
	}
	
	function restaurar(){
		document.getElementById('nombre').disabled=true;
		document.getElementById('abrev').disabled=true;
		document.getElementById('codigo').disabled=true;
		
		document.getElementById('botonGuardar').disabled=true;
		document.getElementById('botonDeshacer').disabled=true;
		document.getElementById('botonNuevo').disabled=false;
		document.getElementById('botonEditar').disabled=false;
		document.getElementById('botonEliminar').disabled=false;
	}
</script>

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
    	<legend>Editar Color</legend>
      <dl>
      	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
        <dd>
        	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['nombre']; ?>" disabled="disabled"/>
  				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
        </dd>
  		</dl>
  		<dl>	
  			<dt><label id="labrev" for="abrev">Abreviatura:</label></dt>
        <dd>
        	<input type="text" id="abrev" size="45" value="<?php echo $row['abreviatura']; ?>" disabled="disabled"/>
    			<label class="err" id="abrev-error"> Por favor llene correctamente este campo. </label>
        </dd>
      </dl>
      <dl>
      	<dt><label id="lcodigo" for="codigo">Color:</label></dt>
      	<dd>
      	  <input type="hidden" id="codigo" value="<?php echo $row['codigo']; ?>" disabled="disabled"/>
      		<label class="err" id="codigo-error"> Por seleccione el color. </label>
      	</dd>
      </dl>
		
	</fieldset>	
	<fieldset class="action">
		<input type="button" id="botonNuevo" onClick="javascript: cargarDiv('derecha','administracion/<?php echo $tabla ?>/crear<?php echo $tabla ?>.php');" value="Nuevo" />
    	“<input type="button" id="botonGuardar" onclick="validaColor('<?php echo $tabla ?>','editar',<?php echo $id; ?>);" value="Guardar" disabled="disabled"/>
		<input type="reset" id="botonDeshacer" onClick="restaurar()" value="Deshacer" disabled="disabled"/>
		<input type="button" id="botonEditar" onClick="activarEdicion()"  value="Editar" />
		<input type="button" id="botonEliminar" onClick="validaColor('<?php echo $tabla ?>','eliminar',<?php echo $id; ?>)"  value="Eliminar" />
    </fieldset>
     
</form>						
		
				