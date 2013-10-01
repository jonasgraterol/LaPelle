<?php
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 't.id',
	'date_format(fecha, "%h:%i%p %d/%m/%Y") as fec',
    '(select c.nombre from cliente c where c.id = t.cliente_id) as nombreTipoServicio',
	't.subtotal', 't.iva', 't.total', 't.status'
  );
	//ARREGLO GEMELO DE $aColumns PERO QUE CONTIENE LOS NOMBRES DE LOS CAMPOS EN LA BASE DE DATOS PARA PODER MOSTRAR LOS DATOS
	$aColumnsCopia = array( 'id', 'fec', 'nombreTipoServicio' , 'subtotal' , 'iva', 'total', 'status' );
	//ARREGLO GEMELO DE $aColumns PERO QUE CONTIENE LOS SELECT PARA CADA CAMPO DE CADA TABLA QUE NO SEA LA PRINCIPAL DE LA CONSULTA
	//PARA PODER FILTRAR EN TODA LA TABLA
	$aColumnsCopiaSelect = array( 'id', 'date_format(fecha, "%h:%i%p %d/%m/%Y")', '(select c.nombre from cliente c where c.id = t.cliente_id)', 'subtotal', 'iva', 'total', 'status');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "t.id";
	
	/* DB table to use */
	$sTable = "pedido t";
	
		include("../conex.php");
		include("../../funcionesphp.php");
	
	/* Database connection information */
	//$gaSql['user']       = "root";
	//$gaSql['password']   = "";
	//$gaSql['db']         = "cuanto_cuesta";
	//$gaSql['server']     = "localhost";
	
	/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
	//include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	//$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		//die( 'No se pudo abrir la conexion con el servidor' );
	
	//mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		//die( 'No se pudo seleccionar la BD '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumnsCopiaSelect[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "AND (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumnsCopiaSelect[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
		
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = " AND ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			//ESTE IF LO INCLUYO PARA PODER BUSCAR POR nombreRenglon YA QUE $aColumns[3] = 'r.nombre as nombreRenglon' Y NO PUEDE FILTRAR ESTA CONLUMNA CON ESE VALOR
			if ($i == 1 || $i == 2  )
			{
				if ($i == 1)
				{
					$sWhere .= "date_format(fecha, '%h:%i%p %d/%m/%Y') LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
				if ($i == 2)
				{
					$sWhere .= "(select c.nombre from cliente c where c.id = t.cliente_id) LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				}
				
				
				
			}
			else
			{
				$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}	
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	 $d = fechaentrada($_GET['d']);
	 $h = fechaentrada($_GET['h']);
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable WHERE t.fecha >= '".$d."' and t.fecha <= '".$h." 23:59:59' 
		$sWhere
		$sOrder
		$sLimit
	";
	
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable WHERE t.status = 1  
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	//echo $sQuery;
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumnsCopia[$i] == "status" )
			{
				/* Special output formatting for 'version' column */
				if($aRow[ $aColumnsCopia[$i] ] == "1")
				{
					$row[] = '<img class="imgt" stat="1" align="middle" src="images/help.png" alt="Pendiente" />';
				}
				if($aRow[ $aColumnsCopia[$i] ] == "0")
				{
					$row[] = '<img class="imgt" stat="0" align="middle" src="images/images_table/no.png" alt="Cancelado" />';
				}
				if($aRow[ $aColumnsCopia[$i] ] == "2")
				{
					$row[] = '<img class="imgt" stat="2" align="middle" src="images/images_table/listo.png" alt="Despachado" />';
				}	
				if($aRow[ $aColumnsCopia[$i] ] == "100")
				{
					$row[] = '<img class="imgt" stat="100" align="middle" src="images/facturado.png" alt="Facturado" />';
				}
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumnsCopia[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>
