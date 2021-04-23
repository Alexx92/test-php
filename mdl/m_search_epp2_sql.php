<?php
$error_ce = '';
try{ 
	$sql = "select sp.STO_NM_ID, p.PRO_NM_ID, p.PRO_TX_PRODUCTO, sp.STO_TX_BARRA, sp.STO_TX_TAG, sp.STO_NM_STATUS,b.BOG_NM_ID, b.BOG_TX_BODEGA";
	$sql .=	" from STOCK_PRODUCTOS sp, BODEGAS b, PRODUCTOS p";
	$sql .=	" where sp.BOG_NM_ID = b.BOG_NM_ID";
	$sql .=	" and sp.PRO_TX_CODIGO = p.PRO_TX_CODIGO";
	$sql .=	" and sp.STO_TX_BARRA = '".$codigo."'";
    //echo 'sql: '.$sql.'</br>';
    $stmt_ce = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_ce = $e->getMessage(); 
} 
?>