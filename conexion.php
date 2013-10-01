<?php
/*
$idConn = mysql_connect('localhost','root','sa123');
   if (!$idConn){
   die("No se conecto al servidor:" . mysql_error());
   }
   $dbSelect = mysql_select_db('veroyca',$idConn);
*/


$idConn = mysql_connect('localhost','zapateria','zapateria');
   if (!$idConn){
   die("No se conecto al servidor:" . mysql_error());
   }
   mysql_query("SET NAMES 'utf8'");
   $dbSelect = mysql_select_db('zapateria',$idConn);
   
   
   //DATOS ESTABLES
   //$dbSelect = mysql_select_db('hoa_prueba',$idConn);
   if (!$dbSelect) {
   	die('No se pudo seleccionar la BD: ' . mysql_error()); 
   }

?>
