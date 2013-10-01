<?php include("../../conexion.php"); ?>
<?php include("../../funcionesphp.php"); ?>
<script type="text/javascript">
	
	$j(document).ready(function() {
		NFInit();
	});
	
	$j(function() {
        $j( "#from" ).datepicker({
            defaultDate: "-1w",
            changeMonth: true,
            numberOfMonths: 3,
			maxDate: "Now",
            onClose: function( selectedDate ) {
                $j( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $j( "#to" ).datepicker({
            defaultDate: "-1w",
            changeMonth: true,
            numberOfMonths: 3,
			maxDate: "Now",
            onClose: function( selectedDate ) {
                $j( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
	
	$j("#buscar").click(function() {
		if($j("#from").val() != "" && $j("#to").val() != "")
		{
			cargarDiv('resul', 'reportes/pedido/vendidoshistorico.php?d='+$j("#from").val()+'&h='+$j("#to").val()+'&taid='+$j("#lista_tiposervicio").val());
		}
		else
		{
			msj("error", "Llene los campos de fecha correctamente");
		}
	});

</script>


     
	<fieldset>
    	<legend>Seleccione rango de fechas</legend>
			
		<label for="from">Desde </label>
		<input type="text" id="from" name="from" size="10" />
		<label for="to">Hasta</label>
		<input type="text" id="to" name="to" size="10" />
		<?php buscar_tabla_lista_guardado("tiposervicio",0,true); ?>
	<a href="#" ><img id="buscar" src="images/search.png" align="right" border="0" /></a>	
		
     </fieldset>
   
<div id="resul">

</div>