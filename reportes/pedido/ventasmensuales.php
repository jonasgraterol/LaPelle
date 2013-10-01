<?php include("../../conexion.php"); ?>
<?php include("../../funcionesphp.php"); ?>
<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});
	
	
	
	$j("#ano").change(function() {
		cargarDiv('resul', 'reportes/pedido/vendidoshistorico.php?d='+$j("#from").val()+'&h='+$j("#to").val()+'&taid='+$j("#lista_tiposervicio").val());
	});

</script>


     
	<fieldset>
    	<legend>Seleccione el año</legend>
			
		<select id="ano" >
			<option value="2012" selected="selected">2012</option>
			<option value="2013" selected="selected">2013</option>
			<option value="2014" selected="selected">2014</option>
			<option value="2015" selected="selected">2015</option>
			<option value="2016" selected="selected">2016</option>
			<option value="2017" selected="selected">2017</option>
			<option value="2018" selected="selected">2018</option>
			<option value="2019" selected="selected">2019</option>
			<option value="2020" selected="selected">2020</option>
		</select>	
		
     </fieldset>
   
<div id="resul">

</div>