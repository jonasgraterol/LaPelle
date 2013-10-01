
<input type="hidden" id="desde" value="<?php echo $_GET['d'] ?>" />
<input type="hidden" id="hasta" value="<?php echo $_GET['h'] ?>" />
<input type="hidden" id="taid" value="<?php echo $_GET['taid'] ?>" />
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php"); 
	$d = $_GET['d'];
	$h = $_GET['h'];
	$f = buscar_campo_segun_campo_tabla_status('id',$_GET['taid'],'tiposervicio','nombre',1);
	if($f == "No encontrado")
	{
		$f = "";
	}	
?>
<script type="text/javascript">
	
	var jon = new Array();
	var i = 0;

    var chart;
	
    	
		$j.post("reportes/pedido/buscarserviciovendido.php", { "desde" : $j('#desde').val(), "hasta" : $j('#hasta').val(), "taid" : $j('#taid').val()},
		function(datasss) {
				
				//alert(datasss);
				ddd = datasss;
				
		}, 'json');	
		
		
	function generar()
	{
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Servicios vendidos'
            },
			subtitle: {
                text: ' <?php echo $f; ?><br />Del <?php echo $d; ?> al <?php echo $h; ?>',
                x: -20
            },
            tooltip: {
        	    pointFormat: '{series.name} : <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y ;
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje de Ventas',
                data: ddd,
				
            }]
        });
    }
    setTimeout('generar()', 1500);

		</script>
	</head>
	<body>


<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"><img src="images/indicator.gif" /></div>

