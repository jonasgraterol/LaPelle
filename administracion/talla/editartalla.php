
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "talla";
	$id=$_GET['id'];
	$sql='SELECT * FROM '.$tabla.' where id="'.$id.'"';
	$rs2 = mysql_query($sql);

	if (mysql_num_rows($rs2)==0){
		echo '<p>Esta '.$tabla.' no existe.</p> ';
	} else {
		$row=mysql_fetch_array($rs2);
	}
?>
<script type="text/javascript" charset="utf-8">
	function activarEdicion(){
		document.getElementById('nombre').disabled=false;
		document.getElementById('lista_tipoarticulo').disabled=false;
		
		document.getElementById('botonGuardar').disabled=false;
		document.getElementById('botonDeshacer').disabled=false;
		document.getElementById('botonNuevo').disabled=true;
		document.getElementById('botonEditar').disabled=true;
		document.getElementById('botonEliminar').disabled=true;
	}
	
	function restaurar(){
		document.getElementById('nombre').disabled=true;
		document.getElementById('lista_tipoalimento').disabled=true;
		
		document.getElementById('botonGuardar').disabled=true;
		document.getElementById('botonDeshacer').disabled=true;
		document.getElementById('botonNuevo').disabled=false;
		document.getElementById('botonEditar').disabled=false;
		document.getElementById('botonEliminar').disabled=false;
	}
</script>
<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});

</script>


<form id="formulario" class="niceform">  
     
	<fieldset>
    	<legend>Crear Talla</legend>
      <dl>
      	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
        <dd>
        	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['nombre']; ?>" disabled="disabled"/>
  				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
        </dd>
  		</dl>
  		<dl>	
  			<dt><label id="labrev" for="abrev">Tipo de Artículo:</label></dt>
        <dd>
          <?php buscar_tabla_lista_guardado("tipoarticulo", $row['tipo_articulo_id'], false); ?>
  				<label class="err" id="lista_tipoarticulo-error"> Por favor llene correctamente este campo. </label>
        </dd>
      </dl>
		
	</fieldset>	
	<fieldset class="action">
		<input type="button" id="botonNuevo" onClick="javascript: cargarDiv('derecha','administracion/<?php echo $tabla ?>/crear<?php echo $tabla ?>.php');" value="Nuevo" />
    	<input type="button" id="botonGuardar" onclick="validaTalla('<?php echo $tabla ?>','editar',<?php echo $id; ?>);" value="Guardar" disabled="disabled"/>
		<input type="reset" id="botonDeshacer" onClick="restaurar()" value="Deshacer" disabled="disabled"/>
		<input type="button" id="botonEditar" onClick="activarEdicion()"  value="Editar" />
		<input type="button" id="botonEliminar" onClick="validaTalla('<?php echo $tabla ?>','eliminar',<?php echo $id; ?>)"  value="Eliminar" />
    </fieldset>
     
</form>						
		
				