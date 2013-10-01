<?php 
	session_start();

	include("../../conexion.php");
	include("../../funcionesphp.php");

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Osed Online</title>
<meta name="keywords" content="osed, videos de ejercicios, ropa deportiva, calzado deportivo, ejercicio, sports, fitness" />
<meta name="description" content="Osed online store" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link href="css/demo_style.css" rel="stylesheet" type="text/css">

<!-- Smart Cart Files Include -->
<link href="css/smart_cart2.css" rel="stylesheet" type="text/css">

<!-- SESIOn -->
<link href="css/sesion.css" rel="stylesheet" type="text/css">

 <!-- Site JavaScript -->
<script type="text/javascript" src="jquery/jquery-1.7.1.js"></script>
<script type="text/javascript" src="jquery/cargar-div.js"></script>
<script type="text/javascript" src="jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="jquery/jquery.ennui.contentslider.js"></script>
<script type="text/javascript" src="jquery/jquery.smartCart-2.0.js"></script>

<script src="jquery/jquery.chili-2.2.js" type="text/javascript"></script>
<script src="js/chili/recipes.js" type="text/javascript"></script>

<script type="text/javascript">
var $JQ = jQuery.noConflict();
	$JQ(function() {
    	$JQ('#one').ContentSlider({
        	width : '960px',
            height : '250px',
            speed : 400,
            easing : 'easeOutSine'
        });
    });

$JQ(document).ready(function () {	
	
	$JQ("#menu ul li a").click(function() {
		$JQ(".current").removeClass("current");
		$JQ(this).addClass("current");
	});
	
});	
</script>

				
				
<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>
</head>
<body>
<div id="site_title_bar_wrapper">

	<div id="site_title_bar">
    
    	<div id="site_title">
            <h1><a href="http://www.templatemo.com" target="_parent">
                <!--
                Particles
                <span>free css templates</span>
                - ->
                <img src="images/logobluray.png" alt="css templates" /><span>Lo mejor en Peliculas</span>-->
            </a></h1>
        </div>
        <div id="ses" style="margin-top:25px;">
		
		</div>
        <div id="search_box">
            
       </div>
       
	</div> <!-- end of site_title_bar -->        
       
</div> <!-- end of site_title_bar_wrapper -->

<div id="banner_wrapper">
    <div id="banner">
    <div id="banner_slider">
        
     
     <div id="one" class="contentslider">
        <div class="cs_wrapper">
            <div class="cs_slider">
                
				
				<?php 
					$sql = "select * from articulo where status = 1 order by id DESC limit 5;";
					$rs = mysql_query($sql);
					if ($rs == 0)
					{
						echo "Ninguna Pelicula encontrada";
					}
					else
					{
						
						while ($row=mysql_fetch_array($rs))
						{
							echo '<div class="cs_article">';
                    			echo '<div class="slider_content_wrapper">';
	                    			echo '<div class="slider_content">';
                            			echo '<h2>'.$row["nombre"].'</h2>';
                           				echo '<p class="desc">'.$row["descripcion"].'</p>';
                             			echo '<div class="more"><a href="'.$row["trailer"].'" target="_blank">Ver Trailer...</a></div>';
                        			echo '</div>';
                    
                        			echo '<div class="slider_image">';
                           				echo '<img src="uploads/'.buscar_campo_segun_campo_tabla_status("articulo_id",$row['id'],"articulo_imagen","ruta",1).'" alt="Caratula" />';
                        			echo '</div>';
                        
                        			echo '<div class="cleaner"></div>';
                				echo '</div>';
                			echo '</div>';
						}
					}	
				
				?>        
                
                      
                        </div><!-- End cs_slider -->
                    </div><!-- End cs_wrapper -->
                </div><!-- End contentslider -->
                
               
                <div class="cleaner"></div>
      
    
	</div> <!-- end of popular_posts -->
    </div> <!-- end of banner -->
</div> <!-- end of banner_wrapper -->

<div id="menu_wrapper">

    <div id="menu">
    
	    <ul>
            <li><a href="index.php" >Inicio</a></li>
            
        </ul>
    
    </div> <!-- end of menu -->
   
</div> <!-- end of menu_wrapper -->

<div id="content_wrapper">

	<div id="content2">
    					<?php
$_SESSION['usuario_id']=1;				
if ($_SESSION['usuario_id'] != "")
{
// creating product array, can be from database

$sql = "SELECT * from articulo where status = 1;";
		$rs = mysql_query($sql);
		if ($rs == 0)
		{
			echo "Ningun servicio encontrado";
		}
		else
		{
			$a=1;
			while ($row=mysql_fetch_array($rs))
			{
				
				$product_array[$row['id']]['product_id'] = $row['id'];
				$product_array[$row['id']]['product_name'] = $row['nombre'];
				$product_array[$row['id']]['product_desc'] = $row['descripcion'];
				$product_array[$row['id']]['product_price'] = $row['precio'];
				$product_array[$row['id']]['product_img'] = '../peliculasstore/uploads/'.buscar_campo_segun_campo_tabla_status("articulo_id",$row['id'],"articulo_imagen","ruta",1);
				
				$a++;
			}
		}

// get the selected product array
// here we get the selected product_id/quantity combination asa an array
$product_list = $_REQUEST['products_selected'];
$product_list_dos = $_REQUEST['products_selected'];
if(!empty($product_list)) {
	$todo_ok = true;
	$subtotal = 0;
    foreach($product_list as $product){
      $chunks = explode('|',$product);
      $product_id = $chunks[0];
      $product_qty = $chunks[1];
      $product_price = $product_array[$product_id]['product_price'];
      $product_amount = $product_price*$product_qty;
      // calculate the subtotal
      $subtotal = $subtotal + $product_amount;
	} 
	//$subtotal = number_format($subtotal,2);
	$iva = $subtotal*0.12;
	//$iva = number_format($iva,2);
	$total = $subtotal+$iva;
	//$total = number_format($total,2);
	$sql_pedido = "INSERT into pedido values (null,".$_SESSION['usuario_id'].",".$subtotal.",".$iva.",".$total.",NOW(),1);";
	$rs_pedido = mysql_query($sql_pedido);
	if($rs_pedido)
	{
		$pedido_id = mysql_insert_id();
		
		foreach($product_list as $product){
		  $chunks = explode('|',$product);
		  $product_id = $chunks[0];
		  $product_qty = $chunks[1];
		  $product_price = $product_array[$product_id]['product_price'];
		  $product_amount = $product_price*$product_qty;
				  
		  $sql_detalle = "INSERT into pedido_detalle values (".$pedido_id.",".$_SESSION['usuario_id'].",".$product_id.",".$product_qty .",".$product_price.",".$product_amount.",1);";
		  $rs_detalle = mysql_query($sql_detalle);
		  if(!$rs_detalle)
		  {
		  	$todo_ok = false;
			echo "SQL_ERROR: ".$sql_detalle;
		  }
		  
		  
		}
		
	}
	else
	{
		$todo_ok = false;
		echo "SQL_ERROR PEDIDO: ".$sql_pedido;
	}
	
if($todo_ok)
{	
?>         
<div class="scMain">  
<ul class="scMenuBar">
	<div class="scMessageBar2">
		Hemos registrado su pedido.
	</div>
</ul>  
<div class="scCartHeader">
  <label class="scCartTitle scCartTitle1">Servicio</label>
  <label class="scCartTitle scCartTitle2">Precio</label>
  <label class="scCartTitle scCartTitle3">Cantidad</label>
  <label class="scCartTitle scCartTitle4">Total</label>
  <label class="scCartTitle scCartTitle5"></label>
</div>	 
 <div class="scCartList" style="margin-top:0">
<?php  
    $sub_total = 0;
    foreach($product_list as $product){
      $chunks = explode('|',$product);
      $product_id = $chunks[0];
      $product_qty = $chunks[1];
      $product_name = $product_array[$product_id]['product_name'];
      $product_desc = $product_array[$product_id]['product_desc'];
      $product_img = $product_array[$product_id]['product_img'];
      $product_price = $product_array[$product_id]['product_price'];
      $product_amount = $product_price*$product_qty;
      // calculate the subtotal
      $sub_total = $sub_total + $product_amount;
     // echo "Product Id: ".$product_id." Quantity: ".$product_qty."<br>";
?>

   <div id="divCartItem2" class="scCartItem">
      <div class="scCartItemTitle scCartItemTitle1">
        <img src="<?php echo $product_img; ?>" class="scProductImageSmall">
      <div>
        <strong><?php echo $product_name; ?></strong>

      </div>
   </div>
   <label class="scCartItemTitle scCartItemTitle2"><?php echo $product_price; ?></label>
   <label id="lblQuantity2" class="scCartItemTitle scCartItemTitle3"><?php echo $product_qty; ?></label>
   <label id="lblTotal2" class="scCartItemTitle scCartItemTitle4"><?php echo $product_amount; ?></label>
   </div>
   
<?php } ?>
</div>
 
<div style="border:0px;" class="scBottomBar">
<form action="./index.php" method="post">
<?php
    // set the request for continue shopping
    if(isset($product_list)){
      foreach($product_list as $p_list){
        $prod_options .='<input type="hidden" name="products_selected[]" value="'.$p_list.'">';
      }
      echo $prod_options;
    }
?>
<!-- <input style="width:200px;height:32px;float:left;padding-top:0px;" type="submit" class="scCheckoutButton" value="Continue Shopping"> -->
 
</form>
<label class="scLabelSubtotalValue"><?php echo $subtotal; //echo $total; ?></label>
<label class="scLabelSubtotalText">Total: </label>
<!--
<label class="scLabelSubtotalValue"><?php //echo $iva; ?></label>
<label class="scLabelSubtotalText">Iva: </label>
<label class="scLabelSubtotalValue"><?php //echo $subtotal; ?></label>
<label class="scLabelSubtotalText">Sub-Total: </label>
-->
</div> 
<?php    

	//NOTIFICACION DE PEDIDO EXITOSO
		//MAIL CLIENTE
			/*
				$mail = new PHPMailer();
				$mail_empresa = new PHPMailer();
		
				// CAMBIOS PARA ENVIAR CON SMPT
		
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				//$mail->SMTPSecure = "tsl";
				$mail->Host = "mail.globalryc.com";
				//$mail->Port = 587;
				$mail->Username = "ventas@globalryc.com";
				$mail->Password = "ventas1234";
				$mail->IsHTML(true);
				
				$mail->From = "ventas@globalryc.com";
				$mail->FromName = "Ventas Global R&C";
				$mail->Subject = "Hemos registrado su pedido.";
				$mail->AddAddress(buscar_campo_segun_campo_tabla_status("id",$_SESSION['usuario_id'],"cliente","correo",1),$_SESSION['usuario']);
				//$mail->ConfirmReadingTo("jonasgraterol@tecningenius.com");
				//$clave = buscar_campo_segun_campo_tabla_status("correo",$email,$tabla,"clave",1);
				//$usu = buscar_campo_segun_campo_tabla_status("correo",$email,$tabla,"usuario",1);
				//$body  = "<div  style='background-color: #F7F7F7;'><img src='www.globalryc.com/images/logo_head.png' alt=''><br>";
				$body = "Hemos registrado su pedido exitosamente, nos estaremos comunicando con usted a la brevedad posible para informarle las opciones de pago.<br>";
				//$body .= "<br>Usuario: ".$usu;
				//$body .= "<br>Clave: ".$clave;
				//$body .= "<font color='blue'>Tecningenius, C.A</font><br><br>";
				$body .= "<br><a href='www.globalryc.com' alt='Global R&C, C.A'><img src='www.globalryc.com/images/logo_head.png' ></a><br>";
				
				$mail->Body = $body;
				$mail->AltBody = "Hemos registrado su pedido exitosamente, nos estaremos comunicando con usted a la brevedad posible para informarle las opciones de pago.<br>";
				//$mail->AddAttachment("images/logo_head.png", "logo_head.png");
				
				if(!$mail->Send()) 
				{
					//echo "Error: " . $mail->ErrorInfo;
				} 
				else 
				{
					//echo "OK";
				}

			//MAIL EMPRESA
				
				$mail_empresa = new PHPMailer();
		
				// CAMBIOS PARA ENVIAR CON SMPT
		
				$mail_empresa->IsSMTP();
				$mail_empresa->SMTPAuth = true;
				//$mail_empresa->SMTPSecure = "tsl";
				$mail_empresa->Host = "mail.globalryc.com";
				//$mail_empresa->Port = 587;
				$mail_empresa->Username = "ventas@globalryc.com";
				$mail_empresa->Password = "ventas1234";
				$mail_empresa->IsHTML(true);
				
				$mail_empresa->From = "ventas@globalryc.com";
				$mail_empresa->FromName = "Ventas Global R&C";
				$mail_empresa->Subject = "Nuevo pedido desde la Pagina Web.";
				$mail_empresa->AddAddress("ventas@globalryc.com","Ventas");
				//$mail_empresa->ConfirmReadingTo("jonasgraterol@tecningenius.com");
				//$clave = buscar_campo_segun_campo_tabla_status("correo",$email,$tabla,"clave",1);
				//$usu = buscar_campo_segun_campo_tabla_status("correo",$email,$tabla,"usuario",1);
				//$body  = "<div  style='background-color: #F7F7F7;'><img src='www.globalryc.com/images/logo_head.png' alt=''><br>";
				$body = "Se registrado un nuevo pedido del Usuario: <strong>".$_SESSION['usuario']."</strong><br>";
				$body .= "# Pedido: <strong>".$pedido_id."</strong><br>";
				$body .= "Por un Monto Total de: <strong>".$total."</strong><br>";
				//$body .= "<br>Usuario: ".$usu;
				//$body .= "<br>Clave: ".$clave;
				//$body .= "<font color='blue'>Tecningenius, C.A</font><br><br>";
				$body .= "<br>Para revisar el detalle del Pedido haga click en <a href='www.globalryc.com/administracion'>Administracion</a> vaya a la seccion de <strong>Pedidos</strong> y consulte el pedido # <strong>".$pedido_id."</strong><br><img src='www.globalryc.com/images/logo_head.png' >";
				
				$mail_empresa->Body = $body;
				$mail_empresa->AltBody = "Para revisar el detalle del Pedido haga click en <a href='www.globalryc.com/administracion'>Administracion</a> vaya a la seccion de pedidos y consulte el pedido # ".$pedido_id."<br><img src='www.globalryc.com/images/logo_head.png' >";
				$mail_empresa->AddAttachment("images/logo_head.png", "logo_head.png");
				
				if(!$mail_empresa->Send()) 
				{
					//echo "Error: " . $mail_empresa->ErrorInfo;
				} 
				else 
				{
					//echo "OK";
				}
			*/
		

	} else { // IF de if($todo_ok) que indica si se hicieron todos los inserts correctamente en la BD
	?>
		<div class="scMain">  
			<ul class="scMenuBar">
				<div class="scMessageBar2">
					LO SENTIMOS SE PRODUJO UN ERROR EN EL SEVIDOR, INTENTELO NUEVAMENTE.
				</div>
			</ul>
		</div>
	<?php	
	}
} else {	// IF de if(!empty($product_list)) que significa si el carrito esta vacio o no
	//echo "<strong>Cart is Empty</strong>";
	?>
	<div class="scMain">  
			<ul class="scMenuBar">
				<div class="scMessageBar2">
					El carro de compras esta vacio.
				</div>
			</ul>
			<div style="border:0px;" class="scBottomBar">
	<form action="./servicios.php" method="post">
    <input style="width:200px;height:32px;float:right;padding-top:0px;" type="submit" class="scCheckoutButton" value="Volver a Servicios">
	
  </form>
  </div>
		</div>
	
  <?php
}



}
else
{

?>
	<div class="scMain">  
		<ul class="scMenuBar">
			<div class="scMessageBar2">
				Debe iniciar sesion para poder registrar su pedido.
			</div>
		</ul>
	</div>
<?php		
}
?>
		
    </div> <!-- end of content -->
    <div id="content_bottom2"></div>

</div> <!-- end of content_wrapper -->

<div id="footer">

    <div class="section_w240">
        
        <h3>DVD, BluRay...</h3>
        
        <div class="sub_content">
            <p>Le ofrecemos los mejores formatos y con la mejor calidad, los estrenos de la temporada, series, peliculas, conciertos y mucho mas.</p>
        </div>
        
    </div>

    <div class="section_w240">
        
        <h3>Estrenos</h3>
        
        <div class="sub_content">
			<ul class="footer_list">
        <?php 
			$sql = "select * from articulo where status = 1 and renglon_id <> 7 and renglon_id <> 8 order by id DESC limit 5;";
			$rs = mysql_query($sql);
			if ($rs == 0)
			{
				echo "Ninguna Pelicula encontrada";
			}
			else
			{
				while ($row=mysql_fetch_array($rs))
				{
					echo '<li><a href="'.$row['trailer'].'" target="_blank">'.$row['nombre'].'</a></li>';	
				}
			}	
		?>    
        	</ul> 
        </div>
        
    </div>
    
    <div class="section_w240">
        
        <h3>Series</h3>
        
        <div class="sub_content">
        
            <ul class="footer_list">
                <?php 
					$sql = "select * from articulo where status = 1 and renglon_id = 7 order by id DESC limit 5;";
					$rs = mysql_query($sql);
					if ($rs == 0)
					{
						echo "Ninguna Serie encontrada";
					}
					else
					{
						while ($row=mysql_fetch_array($rs))
						{
							echo '<li><a href="'.$row['trailer'].'" target="_blank">'.$row['nombre'].'</a></li>';	
						}
					}	
				?> 
            </ul>
        
        </div>
        
    </div>
    
    <div class="section_w240">
        
        <h3>Conciertos</h3>
        
        <div class="sub_content">
        
            <ul class="footer_list">
                <?php 
					$sql = "select * from articulo where status = 1 and renglon_id = 8 order by id DESC limit 5;";
					$rs = mysql_query($sql);
					if ($rs == 0)
					{
						echo "Ningun Concierto encontrado";
					}
					else
					{
						while ($row=mysql_fetch_array($rs))
						{
							echo '<li><a href="'.$row['trailer'].'" target="_blank">'.$row['nombre'].'</a></li>';	
						}
					}	
				?>    
            </ul>
        </div>
            
    </div>
    
    <div class="cleaner_h40"></div>
    
    <center>
        Copyright © 2013 <a href="#">Tienda de Peiculas</a> | 
        Desarrollado por <a href="http://www.tecninenius.com" target="_blank">Tecningenius, c.a</a>
  </center>
    
</div> <!-- end of footer -->
</body>
</html>