
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "proveedor";
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
		document.getElementById('tel1').disabled=false;
		document.getElementById('tel2').disabled=false;
		document.getElementById('correo').disabled=false;
		document.getElementById('dire').disabled=false;

		
		document.getElementById('botonGuardar').disabled=false;
		document.getElementById('botonDeshacer').disabled=false;
		document.getElementById('botonNuevo').disabled=true;
		document.getElementById('botonEditar').disabled=true;
		document.getElementById('botonEliminar').disabled=true;
	}
	
	function restaurar(){
		document.getElementById('nombre').disabled=true;
		document.getElementById('tel1').disabled=true;
		document.getElementById('tel2').disabled=true;
		document.getElementById('correo').disabled=true;
		document.getElementById('dire').disabled=true;

		
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
    	<legend>Editar Proveedor</legend>
        <dl>
        	<dt><label id="lnombre" for="nombre">Nombre:</label></dt>
            <dd>
            	<input type="text" id="nombre" class="fornom" onblur="formateaNombre(this);" size="45" value="<?php echo $row['nombre']; ?>" disabled="disabled"/>
				<label class="err" id="nombre-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel1">Telefono 1:</label></dt>
            <dd>
            	<input type="text" id="tel1" size="45" value="<?php echo $row['telefono1']; ?>" disabled="disabled"/>
				<label class="err" id="tel1-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="tel2">Telefono 2:</label></dt>
            <dd>
            	<input type="text" id="tel2" size="45" value="<?php echo $row['telefono2']; ?>" disabled="disabled"/>
				<label class="err" id="tel2-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>
        	<dt><label for="correo">Correo:</label></dt>
            <dd>
            	<input type="text" id="correo" size="45" value="<?php echo $row['correo']; ?>" disabled="disabled"/>
				<label class="err" id="correo-error"> Por favor llene correctamente este campo. </label>
            </dd>
		</dl>
		<dl>	
			<dt><label id="ldire" for="dire">Direccion:</label></dt>
            <dd>
            	<textarea  id="dire" rows="5" cols="45"  disabled="disabled"><?php echo $row['direccion']; ?></textarea>
				<label class="err" id="dire-error"> Por favor llene correctamente este campo. </label>
            </dd>
        </dl>
		
	</fieldset>	
	<fieldset class="action">
		<input type="button" id="botonNuevo" onClick="javascript: cargarDiv('derecha','administracion/<?php echo $tabla ?>/crear<?php echo $tabla ?>.php');" value="Nuevo" />
    	<input type="button" id="botonGuardar" onclick="validaPro('<?php echo $tabla ?>','editar',<?php echo $id; ?>);" value="Guardar" disabled="disabled"/>
		<input type="reset" id="botonDeshacer" onClick="restaurar()" value="Deshacer" disabled="disabled"/>
		<input type="button" id="botonEditar" onClick="activarEdicion()"  value="Editar" />
		<input type="button" id="botonEliminar" onClick="validaPro('<?php echo $tabla ?>','eliminar',<?php echo $id; ?>)"  value="Eliminar" />
    </fieldset>
     
</form>						
		
				