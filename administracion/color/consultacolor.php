<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Listado de marcas</title>
		<script type="text/javascript" charset="utf-8">
			var modulo = "color";
			$j(document).ready(function() {
				var oTable = $j('#consu'+modulo).dataTable( {
					"aoColumnDefs": [
                        { "bSearchable": false, "aTargets": [ 0 ] }
						
                    ],
					"sDom": 'T<"clear">lfrtip',
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "administracion/"+modulo+"/server_"+modulo+".php"
				} );
				
				/*
				// CARGAR DIV PARA EDITAR LOS REGISTROS SEGUN EL QUE SEA SELECCIONADO EN LA TABLA ADMINISTRAR
				$j("#consutipoalimento tbody").click(function(event) {
					var aData = oTable.fnGetData( event.target.parentNode );
					var iId = aData[0];
					cargarDiv('left','modulos/renglon/editartipoalimento.php?id='+iId);
					//	CAMBIAR COLOR A LA FILA SELECCIONADA
					$j(oTable.fnSettings().aoData).each(function (){
						$j(this.nTr).removeClass('row_selected');
					});
					$j(event.target.parentNode).addClass('row_selected');
					
				} );
				*/	
				// BUSQUEDA POR COLUMNAS
				$j("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					//SUMO 1 A $j("tfoot input").index(this) PORQUE COMO HAY UN CAMPO OCULTO NO CORRESPONDE AL NRO DE LA COLUMNA
					oTable.fnFilter( this.value, $j("tfoot input").index(this) );
				} );
							
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				 var arreglo = new Array();
				$j("tfoot input").each( function (i) {
					arreglo[i] = this.value;
				} );
				
				$j("tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$j("tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = arreglo[$j("tfoot input").index(this)];
					}
				} );
				
			} );
		</script>
	</head>

	<h3>Lista de Colores</h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="consucolor">
	<thead>
		<tr>
			<th width="10%">Id</th>
			<th width="40%">Nombre</th>
			<th width="40%">Nombre</th>
			<th width="10%">Abreviatura</th>
			
			
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3" class="dataTables_empty">Cargando datos del servidor</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th><input type="text" name="search_engine" value="Buscar Id" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Nombre" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Código" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Abreviatura" class="search_init" /></th>		
		</tr>
	</tfoot>
</table>
			
			