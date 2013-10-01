
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery/menu.js"></script>
<script type="text/javascript" src="jquery/jquery.bgpos.js"></script>
<style>
#MainMenu 
{
	height:35px;
	background:#FFF url(images/bmid_092.gif);
	border:0;
	margin:0;
}
#tab 
{
	top:0;
	height:0;
	background:repeat-x top;
	margin:0;
}
#tab ul 
{
	list-style:none;
	float:right;
	margin:0;
	padding:0;
}
#tab li 
{
	display:inline;
	float:left;
	margin:0;
	padding:0;
}
#tab a 
{
	background:#000 url(images/bright_092.gif) no-repeat right top;
	text-decoration:none;
	border:0;
	display:block;
	float:left;
	margin:0;
	padding:0;
}
#tab a span 
{
	display:block;
	background:url(images/bleft_092.gif) no-repeat left top;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#FFF;
	font-weight:700;
	line-height:35px;
	padding:0 15px 0 13px;
}
#tab li.item_active a 
{
	background-position:right bottom;
}
#tab li.item_active a span 
{
	background-position:left bottom;
	color:#FFF;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
}
.dropmenudiv,.dropmenudiv ul,.dropmenudiv li ul 
{
	position:absolute;
	top:0;
	float:left;
	display:block;
	visibility:hidden;
	border:0;
	background:#FFF url(images/bmid_092.gif);
	color:#FFF;
	z-index:100;
	text-decoration:none;
	margin:0;
	padding:0;
}
.dropmenudiv ul 
{
	list-style:none;
	margin:0;
	padding:0;
}
.dropmenudiv li 
{
	list-style:none;
	margin:0;
	padding:0;
}
.dropmenudiv a:link,.dropmenudiv a:visited 
{
	width:180px;
	display:block;
	border:0;
	color:#FFF;
	background:url(images/bleft_092.gif) no-repeat left top;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	margin:0;
	padding:0;
}
.dropmenudiv a span 
{
	display:block;
	line-height:35px;
	background:url(images/bright_092.gif) no-repeat right top;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#FFF;
	float:none;
	padding:0 15px 0 13px;
}
.dropmenudiv a:hover 
{
	border:0;
	background-position:left bottom;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	color:#FFF;
}
.dropmenudiv a:hover span 
{
	background-position:right bottom;
	color:#FFF;
	font-weight:700;
}

</style></head><body>
<div id="MainMenu">
	<div id="tab">
		<ul>
			<li><a id="carta" href="#"><span>Catalogo</span></a></li>
			<li><a id="inven" href="#"><span>Inventario</span></a></li>
			<li><a id="factu" href="#"><span>Facturacion</span></a></li>
			<li><a id="admin" href="#"><span>Administracion</span></a></li>
			<li><a id="repor" href="#"><span>Reportes</span></a></li>
		</ul>
	</div>
</div>

<script type="text/javascript">

$j(document).ready(function() {
	
	$j("#carta").click(function() {	
		$j("#menufacturacion").slideUp();
		$j("#menuadministracion").slideUp();
		$j("#menuinventario").slideUp();
		$j("#menureporte").slideUp();
		limpiar2Div('derecha', 'centro'); 
		cargarDiv('big', 'facturacion/pedido/crearpedido.php');
	});
	$j("#inven").click(function() {	
		$j("#menufacturacion").slideUp();
		$j("#menuadministracion").slideUp();
		$j("#menuinventario").slideDown();
		$j("#menureporte").slideUp();
		limpiar2Div('derecha', 'centro');
		limpiarDiv('big');
	});
	$j("#factu").click(function() {	
		$j("#menufacturacion").slideDown();
		$j("#menuadministracion").slideUp();
		$j("#menuinventario").slideUp();
		$j("#menureporte").slideUp();
		limpiar2Div('derecha', 'centro');
		limpiarDiv('big');
	});
	$j("#admin").click(function() {	
		$j("#menufacturacion").slideUp();
		$j("#menuadministracion").slideDown();
		$j("#menuinventario").slideUp();
		$j("#menureporte").slideUp();
		limpiar2Div('derecha', 'centro');
		limpiarDiv('big');
	});
	$j("#repor").click(function() {	
		$j("#menufacturacion").slideUp();
		$j("#menureporte").slideDown();
		$j("#menuadministracion").slideUp();
		$j("#menuinventario").slideUp();
		limpiar2Div('derecha', 'centro');
		limpiarDiv('big');
	});
});

jQuery(function(){

/*	   
jQuery("#tab a")
	.css( {backgroundPosition: "right 0"} )
	.mouseover(function(){
		jQuery(this).stop().animate({backgroundPosition:"(right -35px)"}, {duration:400})
	})
	.mouseout(function(){
		jQuery(this).stop().animate({backgroundPosition:"(right 0)"}, {duration:400})
	});
	
jQuery("#tab a span")
	.css( {backgroundPosition: "left 0"} )
	.mouseover(function(){
		jQuery(this).stop().animate({backgroundPosition:"(0 -35px)"}, {duration:400})
	})
	.mouseout(function(){
		jQuery(this).stop().animate({backgroundPosition:"(left 0)"}, {duration:400})
	});
*/

	

jQuery("#tab a").click(function() {
	
	jQuery("#tab a").stop().animate({backgroundPosition:"(right 0)"}, {duration:400});
	jQuery("#tab a span").stop().animate({backgroundPosition:"(left 0)"}, {duration:400})
	
	jQuery(this).stop().animate({backgroundPosition:"(right -35px)"}, {duration:400});
	jQuery(this).children().stop().animate({backgroundPosition:"(0 -35px)"}, {duration:400});
	
	
	//jQuery(this).stop().animate({backgroundPosition:"(left 0)"}, {duration:400});
	
	//jQuery(this).siblings().removeClass("item_active");
	//jQuery(this).addClass("item_active");
	
});	

});
</script>

<script type="text/javascript">ddlevelsmenu.setup("1", "topbar","0","0")</script>
</body></html>