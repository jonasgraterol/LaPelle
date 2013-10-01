<?php
/*
$idConn = mysql_connect('localhost','root','sa123');
   if (!$idConn){
   die("No se conecto al servidor:" . mysql_error());
   }
   $dbSelect = mysql_select_db('veroyca',$idConn);
*/


/* Database connection information */
	$gaSql['user']       = "zapateria";
	$gaSql['password']   = "zapateria";
	$gaSql['db']         = "zapateria";
	$gaSql['server']     = "localhost";
	
	/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
	//include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'No se pudo abrir la conexion con el servidor' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'No se pudo seleccionar la BD '. $gaSql['db'] );
		
		


?>
