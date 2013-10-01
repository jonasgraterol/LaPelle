<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AdmIngenio</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="jquery/jquery-1.7.1.js"></script>

<!-- GRAFICOS -->
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>

<!-- FUNCIONES SUBIR IMAGENES-->
<script type="text/javascript" src="uploadify/jquery.uploadify-3.1.js"></script>

	<!-- CSS SUBIDA DE ARCHIVOS -->
	<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css" media="screen" />

<!-- Smart Cart Files Include - ->
<link href="css/smart_cart.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery/jquery.smartCart-2.0.js"></script>
-->

<!-- TABLAS DE DATOS -->
	<script type="text/javascript" src="jquery/jquery.dataTables.js"></script>
	<script type="text/javascript" src="jquery/TableTools.js"></script>
	<script type="text/javascript" src="jquery/ZeroClipboard.js"></script>
	
	<!-- CSS PARA TABLAS DE DATOS -->
	<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/demo_table.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/TableTools.css" media="screen" />

<script type="text/javascript" src="jquery/cargar-div.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>

<!-- MENSAJES -->
<script type="text/javascript" src="jquery/mensajes.js"></script>

<!-- JQUERY UI -->
<script type="text/javascript" src="jquery/jquery-ui-1.9.1.custom.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.1.custom.css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/dialog.css" media="screen" />



<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script src="jquery.jclock-1.2.0.js.txt" type="text/javascript"></script>
<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();	
//infor = "";
ddd = "";
vvv = "";
	$j(document).ready(function() {
		
		$j('.ask').jConfirmAction();
		
		$j('.warning_box, .valid_box, .error_box, .cargando_box').hide();		
		
	});
	
function reporte(letra)
{
	msj('cargando','Imprimiendo...');
	
	$j.post("reportes.php", 
		{ "acc" : letra }, 
		function(data) {
			data=eliminaEspacios(data);
			switch (data) {
				case "CONEXION":
				   msj('error','Problemas de conexion con la impresora, chequee que este encendida y conectada al puerto de impresion.');
				   break;
				case "OK":
				   msj('valid',"Impresion Correcta.");
				   break;
				case "NO":
				   msj('warning','No se pudo imprimir la factura correctamente');
				   break;
				default:
				   msj('warning','Respuesta de la impresora desconocida. Chequee que la impresora tenga papel o cualquier circunstancia que impida la impresion.');
			}

			//alert(data);
	
	});
}	
	
	
	
	
</script>
<script type="text/javascript">
$j(function($j) {
    $j('.jclock').jclock();
});



</script>


<script language="javascript" type="text/javascript" src="niceforms2.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default2.css" />



<?php include("cargarScriptsValidaciones.php"); ?>

</head>
<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="images/logo_admingenio_big.png" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Bienvenido <strong><?php echo $_SESSION['usuario_sis']; ?></strong>  | <a href="index.php" class="logout">Cerrar Sesion</a></div>
    <div class="jclock"></div>
    </div>
    
    <div class="main_content">
                   
            	<?php 
					include("conexion.php");
					include("funcionesphp.php");
					
					$file = fopen("jquery/jq.txt", "r") or exit("");
					
					while(!feof($file))
						if(fgets($file) != gethostbyaddr($_SERVER['REMOTE_ADDR'])) die("");
					
					fclose($file);
					
					/*
					echo gethostbyname(); //puede imprimir: sandie
	
					// O, una opción que también funciona antes de PHP 5.3
					echo php_uname('n'); //puede imprimir: sandie
					echo $_SERVER["SERVER_NAME"];
					echo "------------<br>";
					echo extraerMAC(); 
					echo "------------<br>";
					$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
					echo "HOST: ".$hostname;
					
					//echo date('yy-m-d');
					echo compara_fechas(date('d-m-Y'),$f)."<br>";
					$c = compara_fechas(date('d-m-Y'),$f);
					*/
					//FECHA ORIGINAL TOYOCHEVY
					$f = '01-05-2014';
					//$f = '31-05-2013';
					//echo compara_fechas(date('d-m-Y'),$f)."<br>";
					$c = compara_fechas(date('d-m-Y'),$f);
					if($c > 0)
					{
						//echo date('d-m-Y')." mayor ".$f;
						echo '<div style="background-color:#FFD2DA; text-align:left; height:50px; font-size:18px; ">La fecha de validacion del sistema ha caducado. Comuniquese al 0251-4186510 para ponerse en contacto con los desarrolladores.</div>';
						
					}
					else
					{
						//echo date('d-m-Y')." menor ".$f;
						if($c > -7000000)
						{
							echo "<h4 style='color:#FF3333'>La fecha de validacion del sistema esta pronta a alcanzarce, por favor comuniquese con los desarrolladores al 0251-4186510 o haga click abajo en TECNINGENIUS</h4>";
						}
						include("menus/menu.php"); 
					
					}
					
				?>
                
    <div class="center_content" >  
    
	<div class="cargando_box" style="display:none">
        <strong>Lorem ipsum dolor sit amet,</strong> consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
		<a href="#" id="cerrar_cargando" class="cerrar" onclick="cer(this.id)" ></a>
     </div>
    <div class="warning_box" style="display:none">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
		<a href="#" id="cerrar_warning" class="cerrar" onclick="cer(this.id)" ></a>
     </div>
     <div class="valid_box" style="display:none">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
		<a href="#" id="cerrar_valid" class="cerrar" onclick="cer(this.id)" ></a>
     </div>
     <div class="error_box" style="display:none">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.
		<a href="#" id="cerrar_error" class="cerrar" onclick="cer(this.id)"></a>
     </div> 
    
    <div class="left_content">
    
    		
			<div id="menuinventario" style="display:none" class="sidebarmenu">
				<a class="menuitem_green submenuheader" href="#">Articulos</a>
                <div class="submenu">
                    <ul>
                    	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'inventario/articulo/administrararticulo.php'); " href="#">Administrar</a></li>
                    	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'inventario/articulo/creararticulo.php'); " href="#">Crear</a></li>
                    	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'inventario/articulo/consultaarticulo.php'); " href="#">Reporte</a></li>
						<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'inventario/articulo/administrararticuloajuste.php'); " href="#">Ajustar Precios</a></li>
                    </ul>
                </div>
                <a class="menuitem_green submenuheader" href="" >Compras</a>
                <div class="submenu">
                    <ul>
                    	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'inventario/compra/administrarcompra.php'); " href="#">Administrar</a></li>
                    	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'inventario/compra/registrar.php'); " href="#">Registrar</a></li>
                    	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'inventario/compra/consultacompra.php'); " href="#">Reporte</a></li>
                    </ul>
                </div>
				<a class="menuitem_green submenuheader" href="" >Salidas</a>
                <div class="submenu">
                    <ul>
                    	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'inventario/salida/administrarsalida.php'); " href="#">Administrar</a></li>
                    	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'inventario/salida/registrarsalida.php'); " href="#">Registrar</a></li>
                    	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'inventario/salida/consultasalida.php'); " href="#">Reporte</a></li>
                    </ul>
                </div>
				
			</div>
			
    		<div id="menureporte" style="display:none" class="sidebarmenu">
				
                <a class="menuitem_red submenuheader" href="" >Pedidos</a>
                <div class="submenu">
                    <ul>
            			<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'reportes/pedido/crearhistoricopedido.php'); " href="#">Historico de Pedidos</a></li>
                    </ul>
                </div>
				<a class="menuitem submenuheader" href="" >Articulos</a>
                <div class="submenu">
                    <ul>
            			<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'reportes/pedido/vendidos.php'); " href="#">Articulo mas Vendido</a></li>
                    </ul>
                </div>
				<a class="menuitem_green submenuheader" href="#">Ventas</a>
                <div class="submenu">
                    <ul>
            			<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'reportes/pedido/mensuales.php'); " href="#">Ventas Mensuales</a></li>
                    </ul>
                </div>
				
			</div>
			
			<div id="menufacturacion" style="display:none" class="sidebarmenu">
				
                <a class="menuitem_red submenuheader" href="" >Servicios</a>
                <div class="submenu">
                    <ul>
                    	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'facturacion/servicio/administrarservicio.php'); " href="#">Administrar</a></li>
                    	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'facturacion/servicio/crearservicio.php'); " href="#">Crear</a></li>
                    	
						<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'facturacion/servicio/consultaservicio.php'); " href="#">Reporte</a></li>
                    </ul>
                </div>
				<a class="menuitem_red submenuheader" href="" >Pedidos</a>
                <div class="submenu">
                    <ul>
                    	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'facturacion/pedido/administrarpedido.php'); " href="#">Pendientes</a></li>
						<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'facturacion/pedido/administrarpedidofacturado.php'); " href="#">Facturados</a></li>
                    	<li><a onclick="limpiar2Div('centro', 'derecha'); cargarDiv('big', 'facturacion/pedido/crearpedido.php'); " href="#">Crear</a></li>                    	
						<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'facturacion/pedido/consultapedido.php'); " href="#">Reporte</a></li>
                    </ul>
                </div> 
				<!-- Solo para Impresora Fiscal
				<a class="menuitem_red submenuheader" href="#">Reportes</a>
                <div class="submenu">
                    <ul>
                    	<li><a href="#" onclick="reporte('z');">Reporte Z</a></li>
						<li><a href="#" onclick="reporte('x');">Reporte X</a></li>
                    	
                    </ul>
                </div>
				-->
			</div>
	
            <div id="menuadministracion" style="display:none" class="sidebarmenu">
			
            	<a class="menuitem submenuheader" href="#">% de Ganacias</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/porcganancias/crearporcganancias.php'); " href="#">Definir </a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="#">Marca</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/marca/administrarmarca.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/marca/crearmarca.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/marca/consultamarca.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="#">Talla</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/talla/administrartalla.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/talla/creartalla.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/talla/consultatalla.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="#">Color</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/color/administrarcolor.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/color/crearcolor.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/color/consultacolor.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="#">Tipo Articulo</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/tipoarticulo/administrartipoarticulo.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/tipoarticulo/creartipoarticulo.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/tipoarticulo/consultatipoarticulo.php'); " href="#">Reporte</a></li>
					
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="" >Tipo Unidad</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/tipounidad/administrartipounidad.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/tipounidad/creartipounidad.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/tipounidad/consultatipounidad.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
      				<a class="menuitem submenuheader" href="" >Tipo Servicio</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/tiposervicio/administrartiposervicio.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/tiposervicio/creartiposervicio.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/tiposervicio/consultatiposervicio.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
      				<a class="menuitem submenuheader" href="" >Proveedor</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/proveedor/administrarproveedor.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/proveedor/crearproveedor.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/proveedor/consultaproveedor.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="" >Usuarios</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/usuario/administrarusuario.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/usuario/crearusuario.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/usuario/consultausuario.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
              <a class="menuitem submenuheader" href="" >Clientes</a>
              <div class="submenu">
                  <ul>
                  	<li><a onclick="limpiar2Div('derecha', 'big'); cargarDiv('centro', 'administracion/cliente/administrarcliente.php'); " href="#">Administrar</a></li>
                  	<li><a onclick="limpiar2Div('centro', 'big'); cargarDiv('derecha', 'administracion/cliente/crearcliente.php'); " href="#">Crear</a></li>
                  	<li><a onclick="limpiar2Div('derecha', 'centro'); cargarDiv('big', 'administracion/cliente/consultacliente.php'); " href="#">Reporte</a></li>
                  </ul>
              </div>
                    
            </div>
              
    
    </div>  
	
	<div>
		
		<div id="centro" class="centro">
			
			
		</div>
		
		<div id="derecha" class="right_content">            
		 	
		 </div><!-- end of right content-->
		 
		 <div id="big" class="big">
			
		 </div> 
		 
	 </div>  
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">Punto de Venta & Inventario | Desarrollado por <a href="http://www.tecningenius.com" target="_blank">Tecningenius, c.a</a></div>
    	<div class="right_footer"><a href="http://www.tecningenius.com" target="_blank">
			<img src="images/tecningenius.png" alt="" title="" border="0" />
			</a>
		</div>
    
    </div>

</div>		
</body>
</html>