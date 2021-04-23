<?php
$error_epps = '';
try{
	$sql = "select PRO_NM_ID, PRO_TX_CODIGO, PRO_TX_PRODUCTO, PRO_TX_DESCRIPCION, PRO_NM_STATUS";
	$sql .= " from PRODUCTOS";
	$sql .= " order by PRO_TX_CODIGO asc";
    //echo 'sql: '.$sql.'</br>';
    $stmt_epps = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_epps = $e->getMessage(); 
} 
?>