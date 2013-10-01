
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "servicio";
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
		document.getElementById('lista_tiposervicio').disabled=false;
		document.getElementById('precio').disabled=false;
		document.getElementById('imagen').disabled=false;
		document.getElementById('desc').disabled=false;
		
		document.getElementById('botonGuardar').disabled=false;
		document.getElementById('botonDeshacer').disabled=false;
		document.getElementById('botonNuevo').disabled=true;
		document.getElementById('botonEditar').disabled=true;
		document.getElementById('botonEliminar').disabled=true;
	}
	
	function restaurar(){
		document.getElementById('nombre').disabled=true;
		document.getElementById('lista_tiposervicio').disabled=true;
		document.getElementById('precio').disabled=true;
		document.getElementById('imagen').disabled=true;
		document.getElementById('desc').disabled=true;
		
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
    	<legend>Editar Articulo</legend>
        <dl>
        	<dt><label for="tiposervicio">Tipo de Servicio:</label></dt>
            <dd>
            	<?php buscar_tabla_lista_guardado("tiposervicio",$row['tipo_servicio_id'],true); ?>
				<label class="err" id="lista_tiposervicio-error" style="float:right"> Campo Obligatorio </label>
            </dd>
		</dl>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['nombre']; ?>" disabled="disabled"/>
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="lprecio" for="precio">Precio:</label></dt>
            <dd>
            	<input type="text" id="precio" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['precio']; ?>" disabled="disabled"/>
				<label class="err" id="precio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label id="limagen" for="imagen">Imagen:</label></dt>
            <dd>
            	<input  type="file" name="imagen" id="imagen" value="<?php echo $row['imagen']; ?>" disabled="disabled"/>
				<input  type="text" name="imgservicio" id="imgservicio" value="<?php echo $row['imagen']; ?>" disabled="disabled" size="45"/>
				<label class="err" id="imgservicio-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
		<dl>
        	<dt><label id="ldesc" for="desc">Descripcion:</label></dt>
            <dd>
            	<textarea id="desc" cols="45" rows="5" disabled="disabled"><?php echo $row['descripcion']; ?></textarea>
				<label class="err" id="desc-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		
	</fieldset>	
	<fieldset class="action">
		<input type="button" id="botonNuevo" onClick="javascript: cargarDiv('derecha','facturacion/<?php echo $tabla ?>/crear<?php echo $tabla ?>.php');" value="Nuevo" />
    	<input type="button" id="botonGuardar" onclick="validaPla('<?php echo $tabla ?>','editar',<?php echo $id; ?>);" value="Guardar" disabled="disabled"/>
		<input type="reset" id="botonDeshacer" onClick="restaurar()" value="Deshacer" disabled="disabled"/>
		<input type="button" id="botonEditar" onClick="activarEdicion()"  value="Editar" />
		<input type="button" id="botonEliminar" onClick="validaPla('<?php echo $tabla ?>','eliminar',<?php echo $id; ?>)"  value="Eliminar" />
    </fieldset>
     
</form>						
		
				