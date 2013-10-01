<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" charset="utf-8">
			var modulo = "pedido";
			var giRedraw = false;
			var oTableAli;
			$j(document).ready(function() {
				oTableAli = $j('#admin'+modulo).dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					"aoColumnDefs": [
                        { "bSearchable": false, "bVisible": false, "aTargets": [ 4, 5 ] }
						
                    ],
					
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "facturacion/"+modulo+"/server_"+modulo+"_facturado.php"
				} );
				
				
				// CARGAR DIV PARA EDITAR LOS REGISTROS SEGUN EL QUE SEA SELECCIONADO EN LA TABLA ADMINISTRAR
				$j("#admin"+modulo+" tbody").click(function(event) {
					var aData = oTableAli.fnGetData( event.target.parentNode );
					var iId = aData[1];
					cargarDiv('derecha','facturacion/'+modulo+'/editar'+modulo+'facturado.php?id='+iId);
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
					oTableAli.fnFilter( this.value, $j("tfoot input").index(this)+1 );
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

	<h3>Facturas Impresas / Pedidos Facturados</h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="adminpedido">
	<thead>
		<tr>
			<th width="5%" title="Nro Factura">#Fact</th>
			<th width="5%" title="Nro Pedido">#Ped</th>
			<th width="20%">Fecha</th>
			<th width="30%">Cliente</th>
			<th width="15%">SubTotal</th>
			<th width="10%">IVA</th>
			<th width="15%">Total</th>
			
						
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3" class="dataTables_empty">Cargando datos del servidor</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th title="Nro Factura" style="font-style:oblique;"><input type="text" name="search_engine" value="Buscar # Factura" class="search_init" /></th>
			<th title="Nro Pedido"><input type="text" name="search_engine" value="Buscar Id" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Fecha" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Cliente" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Subtotal" class="search_init" /></th>	
			<th><input type="text" name="search_engine" value="IVA" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Total" class="search_init" /></th>	
			
			
		</tr>
	</tfoot>
</table>
			
			