<input type="hidden" id="desde" value="<?php echo $_GET['d']; ?>" />
<input type="hidden" id="hasta" value="<?php echo $_GET['h']; ?>" />
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Historico de pedidos: Del <?php echo $_GET['d']; ?> al <?php echo $_GET['h']; ?></title>
		<script type="text/javascript" charset="utf-8">
			var modulo = "pedido";
			var oTable;
			$j(document).ready(function() {
				oTable = $j('#consu'+modulo+'_historico').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					"aoColumnDefs": [
                        { "bSearchable": false, "aTargets": [ 0 ] }
						
                    ],
					"sDom": 'T<"clear">lfrtip',
					"iDisplayLength" : -1,
					"oTableTools": {
						"aButtons": [
							"copy",
							"csv",
							"xls",
							{
								"sExtends": "pdf",
								"sPdfOrientation": "landscape",
								"sPdfMessage": "Menu Listado."
							},
							"print"
						]
					},
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "reportes/"+modulo+"/server_"+modulo+"_historico.php?d="+$j("#from").val()+"&h="+$j("#to").val()
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
			//TOTATLIZAR VENTAS
				var tot = 0;
				var i = 0;
				function t()
				{
					$j("#consupedido_historico tbody tr").each(function() {
						if(i != 0)
						{
							var monto =	parseFloat($j(this).children().eq(5).html());
							var st =	$j(this).children().eq(6).children().attr("stat");				
							
							if(st == 2 || st == 100)
							{
								tot = tot + monto;
							}	
							
						}
						i++;
					});	
					
					$j("#tot").html(tot.toFixed(2));
				}
			setTimeout('t();', 3000);
			
		</script>
	</head>
	
	<h3>Historico de pedidos: Del <strong><?php echo $_GET['d']; ?></strong> al <strong><?php echo $_GET['h']; ?></strong></h3>		
			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="consupedido_historico">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th width="20%">Fecha</th>
			<th width="30%">Cliente</th>
			<th width="10%">SubTotal</th>
			<th width="10%">IVA</th>
			<th width="10%">Total</th>
			<th width="15%"></th>
							
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
			<th><input type="text" name="search_engine" value="Buscar Fecha" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Buscar Cliente" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Subtotal" class="search_init" /></th>	
			<th><input type="text" name="search_engine" value="IVA" class="search_init" /></th>
			<th><input type="text" name="search_engine" value="Total" class="search_init" /></th>		
			<th></th>
		</tr>
	</tfoot>
	
		<tr>
			<td colspan="5" style="background-color:#00CC66;  text-align:center;"><strong>Total</strong></td>
			<td id="tot" colspan="2" style="background-color:#00CC66;  text-align:left;"><img src="images/indicator.gif" /> Totalizando...</td>
		</tr>
	
</table>
			
			