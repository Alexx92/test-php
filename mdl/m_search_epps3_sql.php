<?php
$error_epps = '';
try{
	$sql = "select sp.STO_NM_ID, p.PRO_TX_PRODUCTO, sp.STO_TX_BARRA, sp.STO_TX_TAG, sp.STO_NM_STATUS, sp.BOG_NM_ID, b.BOG_TX_BODEGA, m.MIN_NM_ID, m.MIN_TX_MINAS";
	$sql .=	" from STOCK_PRODUCTOS sp, BODEGAS b, PRODUCTOS p, MINAS m";
	$sql .=	" where sp.BOG_NM_ID = b.BOG_NM_ID";
	$sql .=	" and sp.PRO_TX_CODIGO = p.PRO_TX_CODIGO";
	$sql .=	" and b.MIN_NM_ID = m.MIN_NM_ID";
	$sql .=	" and b.MIN_NM_ID = ".$fae;
	if($tipoe != '')
		$sql .=	" and p.PRO_NM_ID = ".$tipoe;
	if($est2 != '')
		$sql .=	" and STO_NM_STATUS = ".$est2;
	else
		$sql .=	" and sp.STO_NM_STATUS != 3";
	$sql .= " order by sp.STO_NM_ID";
    //echo 'sql: '.$sql.'</br>';
    $stmt_epps = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_epps = $e->getMessage(); 
} 
?>