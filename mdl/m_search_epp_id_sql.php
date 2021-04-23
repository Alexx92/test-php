<?php
$error_epp = '';
try{ 
	$sql  = "select sp.STO_NM_ID, sp.STO_TX_BARRA, sp.PRO_TX_CODIGO,  p.PRO_TX_PRODUCTO, sp.STO_NM_STATUS, sp.BOG_NM_ID, sp.STO_TX_TAG";
	$sql .= " from STOCK_PRODUCTOS sp join PRODUCTOS p on p.PRO_TX_CODIGO = sp.PRO_TX_CODIGO";
	$sql .= " where sp.STO_NM_ID = '". $STO_NM_ID ."'";
    //echo 'sql: '.$sql.'</br>';
    $stmt_epp = $conn_ajax->query($sql);
} catch(Exception $e){ 
    $error_epp = $e->getMessage(); 
}
?>