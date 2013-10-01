
<input type="hidden" id="desde" value="<?php echo $_GET['d'] ?>" />
<input type="hidden" id="hasta" value="<?php echo $_GET['h'] ?>" />
<input type="hidden" id="taid" value="<?php echo $_GET['taid'] ?>" />
<?php
	include("../../conexion.php");
	include("../../funcionesphp.php"); 
	$d = $_GET['d'];
	$h = $_GET['h'];
	$f = "(".buscar_campo_segun_campo_tabla_status('id',$_GET['taid'],'tiposervicio','nombre',1).")";
	if($f == "(No encontrado)")
	{
		$f = "";
	}	
?>
<script type="text/javascript">
	
	

    var chart;
	
	function buscarventas()
	{
		$j.post("reportes/pedido/buscarventasmensuales.php", { "ano" : $j('#ano').val()},
		function(datos) {
				
				//alert(datos);
				vvv = datos;
				
		}, 'json');	
	}
	
    $j("#ano").change(function() {	
		buscarventas();
		//alert(vvv);
		setTimeout('generar();', 1500);
	});	
		
	function generar()
	{
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Ventas Mensuales '+$j("#ano").val(),
                x: -20 //center
            },
            subtitle: {
                text: 'Bolivares totalizados por mes.',
                x: -20
            },
            xAxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
            },
            yAxis: {
                title: {
                    text: 'Ventas Bs'
                },
				min: 0,
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' Bs';
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Ventas',
                data: vvv
            }]
        });
    }
   // 
   
   $j(document).ready(function() {
   		buscarventas();
		setTimeout('generar();', 1500);
   });

		</script>
	</head>
	<body>

<fieldset>
    	<legend>Seleccione el a&ntilde;o</legend>
			
		<select id="ano" >
			<option value="2012" >2012</option>
			<option value="2013" selected="selected">2013</option>
			<option value="2014" >2014</option>
			<option value="2015" >2015</option>
			<option value="2016" >2016</option>
			<option value="2017" >2017</option>
			<option value="2018" >2018</option>
			<option value="2019" >2019</option>
			<option value="2020" >2020</option>
		</select>	
		
     </fieldset>

<div id="container" style="width: 100%; height: 450px; "><img src="images/indicator.gif" /></div>

