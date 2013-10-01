
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php");
	$tabla = "salida_detalle pd, salida p";
	$id=$_GET['id'];
	$sql='SELECT pd.*, p.usuario_id as usu, date_format(p.fecha_salida, "%d/%m/%Y") as fec FROM '.$tabla.' where pd.salida_id="'.$id.'" and p.id ="'.$id.'"; ';
	//echo $sql;
	$rs2 = mysql_query($sql);

	if (mysql_num_rows($rs2)==0){
		echo '<p>Este '.$tabla.' no existe.</p> ';
	} else {
		$row=mysql_fetch_array($rs2);
	}
	
?>
<script type="text/javascript" charset="utf-8">

$j(document).ready(function() {
	NFInit();
});



function actualizar(acc, d)
{
	//alert(acc+" , "+d);
	msj('cargando','Cargando...');
	$j.post("inventario/salida/actualizarsalida.php", { accion : acc , id : d }, function(data) {
		
		if(data = "OK")
		{
			cargarDiv("centro","inventario/salida/administrarsalida.php");
			texto = "<strong>Operacion Exitosa</strong> Se ha actualizado la compra correctamente.";
			msj('valid',texto);
			limpiarDiv('derecha');
		}
		else
		{
			 msj('error','No se pudo actualizar la compra por un error en el servidor.');
		}
	});
}	
</script>

<form id="formulario" class="niceform">  
	<fieldset>
    	<legend>Salida</legend>
		
				<table style="width:100%; text-align:center;">
					<thead>
						<th style="width:15%;">Salida #</th>
						<th style="width:25%;">Usuario</th>
						<th style="width:30%;">Fecha Salida</th>
						
					</thead>
					<tbody>
						<tr>
							<td id="nropedido"><?php echo $id; ?></td>
							<td >
								<?php 
									echo buscar_campo_segun_campo_tabla_status('id',$row['usu'],'usuario','usuario',1); 
									
								?>
								
							</td>
							<td><?php echo $row['fec']; ?></td>
							
						</tr>
					</tbody>
				</table>	
					
					
				<table id="rounded-corner"   >
					<thead>
						<tr>
							<th scope="col" width="60%" class="rounded-company">Articulo</th>
							<th scope="col" width="10%" class="rounded-q4">Cant</th>
						</tr>
					</thead>
					<tbody>
							
							<?php 
								$sql='SELECT pd.*  FROM '.$tabla.' where pd.salida_id="'.$id.'" and p.id ="'.$id.'"; ';
								
								//echo $sql;
								$rs2 = mysql_query($sql);
								if (mysql_num_rows($rs2)==0){
									echo '<p>Ninguna imagen esta asociada a este articulo.</p> ';
								} else {
									while($row2=mysql_fetch_array($rs2))
									{
										echo '<tr class="factu" id="'.$row2['servicio_id'].'">
											<td id="nomb_'.$row2['servicio_id'].'">'.buscar_campo_segun_campo_tabla_status('id',$row2['articulo_id'],'articulo','nombre',1).'</td>
											<td id="cant_'.$row2['servicio_id'].'">'.$row2['cantidad'].'</td>
											
										</tr>';	
									}
								}
							?>
								
							</tbody>
						</table>
						
						
						
					
				
				
</fieldset>	
	<fieldset class="action">
		
		<input type="hidden" id="botonEditar" onClick="actualizar('c',<?php echo $id ?>);"  value="Cancelar" />
		
    </fieldset>
     
</form>	

	  					