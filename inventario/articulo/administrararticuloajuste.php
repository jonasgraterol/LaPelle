<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" charset="utf-8">
			var modulo = "articulo";
			var giRedraw = false;
			var oTableAli;
			$j(document).ready(function() {
				oTableAli = $j('#admin'+modulo).dataTable( {
					"aaSorting": [[ 3, "desc" ]],
					"aoColumnDefs": [
                        { "bSearchable": false, "bVisible": false, "aTargets": [ 0, 1 ] }
						
                    ],
					
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "inventario/"+modulo+"/server_"+modulo+"_ajuste.php"
				} );
				
				
				// CARGAR DIV PARA EDITAR LOS REGISTROS SEGUN EL QUE SEA SELECCIONADO EN LA TABLA ADMINISTRAR
				$j("#admin"+modulo+" tbody").click(function(event) {
					var aData = oTableAli.fnGetData( event.target.parentNode );
					var iId = aData[0];
					cargarDiv('derecha','inventario/'+modulo+'/ajustarprecios.php?id='+iId);
					//	CAMBIAR COLOR A LA FILA SELECCIONADA
					$j(oTableAli.fnSettings().aoData).each(function (){
						$j(this.nTr).removeClass('row_selected');
					});
					$j(event.target.parentNode).addClass('row_selected');
					
				} );
				
				
				
				// BUSQUEDA POR COLUMNAS
				$j("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					//SUMO 1 A $j("tfoot input").index(this) PORQUE COMO HAY UN CAMPO OCULTO NO CORRESPONDE AL NRO DE LA COLUMNA
					oTableAli.fnFilter( this.value, $j("tfoot input").index(this)+2 );
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
			/*
				$j("#adminarticulo tbody tr").live('mouseover', function() {
				
					var aData = oTableAli.fnGetData( this );
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
			*/	
		</script>
	</head>

	<h3>Listado de Articulos</h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="adminarticulo">
	<thead>
		<tr>
			<th width="1%">Id</th>
			<th width="1%"></th>
			<th width="40%">Nombre</th>
			<th width="20%">Ult. Compra</th>
			<th title="Precio de Venta 1" width="10%">P1</th>
			<th title="Precio de Venta 2" width="10%">P2</th>
			<th title="Precio de Venta 3" width="10%">P3</th>
			<th width="8%">En Venta</th>
						
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
			<th></th>
			<th><input type="text" name="search_engine" value="Nombre" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Fecha Compra" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio1" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio2" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Precio3" class="search_init" /></th>
			<th></th>	
			
		</tr>
	</tfoot>
</table>
			
			