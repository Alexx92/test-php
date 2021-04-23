<?php
$error_epps = '';
try{
	$sql = "select sp.STO_NM_ID, p.PRO_TX_PRODUCTO, sp.STO_TX_BARRA, sp.STO_TX_TAG, sp.STO_NM_STATUS, b.BOG_TX_BODEGA";
	$sql .= " from STOCK_PRODUCTOS sp, BODEGAS b, PRODUCTOS p";
	$sql .= " where sp.BOG_NM_ID = b.BOG_NM_ID";
	$sql .= " and sp.PRO_TX_CODIGO = p.PRO_TX_CODIGO";
	$sql .= " and p.PRO_NM_ID = ".$tipoe;
	if($est != '')
		$sql .= " and STO_NM_STATUS = ".$est;
	if($bod != '')
		$sql .= " and b.BOG_NM_ID = ".$bod;
	$sql .= " order by sp.STO_NM_ID";
    //echo 'sql: '.$sql.'</br>';
    $stmt_epps = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_epps = $e->getMessage(); 
} 
?>