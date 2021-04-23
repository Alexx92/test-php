<?php
$error_ue = '';
try{ 
	$sql .= "update STOCK_PRODUCTOS";
	$sql .= " set PRO_TX_CODIGO = '".$PRO_TX_CODIGO."', STO_NM_STATUS = '".$est."', BOG_NM_ID = ".$bodega.", STO_TX_TAG = '".$mactag."'";
	$sql .= " where STO_NM_ID = ".$idepp ;
	//echo 'sql: '.$sql.'</br>';
    $stmt_ue = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_ue = $e->getMessage(); 
} 
?>