<?php
$codigo = $_GET['cod'];
include('../start_ajax.php');
include('../mdl/m_search_epp2_sql.php');
if($row_ce = $stmt_ce->fetch(PDO::FETCH_ASSOC)){	
	$STO_NM_ID = $row_ce['STO_NM_ID'];
	$PRO_NM_ID = $row_ce['PRO_NM_ID'];
	$PRO_TX_PRODUCTO = $row_ce['PRO_TX_PRODUCTO'];
	$STO_TX_BARRA = $row_ce['STO_TX_BARRA'];
	$STO_TX_TAG = $row_ce['STO_TX_TAG'];
	$STO_NM_STATUS = $row_ce['STO_NM_STATUS'];
	$BOG_NM_ID = $row_ce['BOG_NM_ID'];
	$BOG_TX_BODEGA = $row_ce['BOG_TX_BODEGA'];	
	$output = array(
				"status"  => TRUE,
				"STO_NM_ID" => $STO_NM_ID,
				"PRO_NM_ID" => $PRO_NM_ID,
				"PRO_TX_PRODUCTO" => $PRO_TX_PRODUCTO,
				"STO_TX_BARRA" => $STO_TX_BARRA,
				"STO_TX_TAG" => $STO_TX_TAG,
				"STO_NM_STATUS" => $STO_NM_STATUS,
				"BOG_NM_ID" => $BOG_NM_ID,
				"BOG_TX_BODEGA" => $BOG_TX_BODEGA
				);
} else {
	$output = array( 
		"status"  => FALSE,
	);
}
echo json_encode($output);
exit();
?>