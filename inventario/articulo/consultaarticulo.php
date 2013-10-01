<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Listado de Articulos</title>
		<script type="text/javascript" charset="utf-8">
			var modulo = "articulo";
			var oTable;
			$j(document).ready(function() {
				oTable = $j('#consu'+modulo).dataTable( {
					"aoColumnDefs": [
                       
						
                    ],
					"sDom": 'T<"clear">lfrtip',
					"oTableTools": {
						"aButtons": [
							"copy",
							"csv",
							"xls",
							{
								"sExtends": "pdf",
								"sPdfOrientation": "landscape",
								"sPdfMessage": "Listado de Articulos."
							},
							"print"
						]
					},
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "inventario/"+modulo+"/server_"+modulo+".php"
				} );
				
				/*
				// CARGAR DIV PARA EDITAR LOS REGISTROS SEGUN EL QUE SEA SELECCIONADO EN LA TABLA ADMINISTRAR
				$j("#consutipoarticulo tbody").click(function(event) {
					var aData = oTable.fnGetData( event.target.parentNode );
					var iId = aData[0];
					cargarDiv('left','modulos/renglon/editartipoarticulo.php?id='+iId);
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
			//PINTAR ALErTAS DE STOCKS
				$j("#consuarticulo tbody tr").live('mouseover', function() {
				
					var aData = oTable.fnGetData( this );
					var iId = aData[0];
					var a = parseInt(aData[6]);
					var b = parseInt(aData[7]); 
					var c = true;
					
					if (a < b){
						$j(this).addClass('gradeX');
					}else{
						$j(this).addClass('gradeA');
					}
				});	
		</script>
	</head>

	<h3>Listado de Articulos</h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="consuarticulo">
	<thead>
		<tr>
			<th width="5%">Id</th>
			<th width="20%"></th>
			<th width="20%">Nombre</th>
			<th title="Precio de Venta 1" width="10%">P1</th>
			<th title="Precio de Venta 2" width="10%">P2</th>
			<th title="Precio de Venta 3" width="10%">P3</th>
			<th width="10%">Cant.</th>
			<th width="10%">Stock Min.</th>
			<th width="10%">Stock Max.</th>
			<th width="15%">Tipo</th>
			<th width="10%">Unidad</th>
			<th width="20%">Ult. Compra</th>
			<th width="20%">En Venta</th>
						
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="8" class="dataTables_empty">Cargando datos del servidor</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th><input type="text" name="search_engine" value="Buscar Id" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Nombre" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio1" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio2" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio3" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Cantidad" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Stock Minimo" class="search_init" /></th>	
			<th><input type="text" name="search_engine" value="Stock Maximo" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Tio de Articulo" class="search_init" /></th>	
			<th><input type="text" name="search_engine" value="Unidad" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Fecha de ultima compra" class="search_init" /></th>	
			<th></th>
			
		</tr>
	</tfoot>
</table>
			
			