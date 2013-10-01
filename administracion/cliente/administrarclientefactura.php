<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" charset="utf-8">
			var moduloc = "cliente";
			$j(document).ready(function() {
				var oTable = $j('#adminclientefactura').dataTable( {
					"aoColumnDefs": [
                       
						
                    ],
					"bRetrieve": true,
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "administracion/"+moduloc+"/server_"+moduloc+".php"
				} );
				
				// CARGAR DIV PARA EDITAR LOS REGISTROS SEGUN EL QUE SEA SELECCIONADO EN LA TABLA ADMINISTRAR
				$j("#adminclientefactura tbody").click(function(event) {
					var aData = oTable.fnGetData( event.target.parentNode );
					var iId = aData[0];
					//cargarDiv('derecha','administracion/'+moduloc+'/editar'+moduloc+'.php?id='+iId);
					$j("#cedrif").val(aData[1]);
					buscarCedula($j("#cedrif").val());
					//	CAMBIAR COLOR A LA FILA SELECCIONADA
					$j(oTable.fnSettings().aoData).each(function (){
						$j(this.nTr).removeClass('row_selected');
					});
					$j(event.target.parentNode).addClass('row_selected');
					
				} );
		
				// BUSQUEDA POR COLUMNAS
				$j("#adminclientefactura tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					//SUMO 1 A $j("tfoot input").index(this) PORQUE COMO HAY UN CAMPO OCULTO NO CORRESPONDE AL NRO DE LA COLUMNA
					oTable.fnFilter( this.value, $j("#adminclientefactura tfoot input").index(this) );
				} );
							
				/*
				 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
				 * the footer
				 */
				 var arreglo = new Array();
				$j("#adminclientefactura tfoot input").each( function (i) {
					arreglo[i] = this.value;
				} );
				
				$j("#adminclientefactura tfoot input").focus( function () {
					if ( this.className == "search_init" )
					{
						this.className = "";
						this.value = "";
					}
				} );
				
				$j("#adminclientefactura tfoot input").blur( function (i) {
					if ( this.value == "" )
					{
						this.className = "search_init";
						this.value = arreglo[$j("#adminclientefactura tfoot input").index(this)];
					}
				} );
				
			} );
		</script>
	</head>

	<h3>Listado Clientes para Factura</h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="adminclientefactura">
	<thead>
		<tr>
			<th width="5%">Id</th>
			<th width="30%">Ced/Rif</th>
			<th width="50%">Nombre</th>
			<th width="15%">Tel.</th>
			
			
			
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
			<th><input type="text" name="search_engine" value="Cedula o Rif" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Nombre" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Tel 1" class="search_init" /></th>	
			
	
		</tr>
	</tfoot>
</table>
			
			