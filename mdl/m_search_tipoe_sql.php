<?php
$error_te = '';
try{ 
	$sql =	"select PRO_NM_ID, PRO_TX_PRODUCTO";
	$sql .=	" from PRODUCTOS";
	$sql .=	" order by PRO_TX_PRODUCTO asc";
    //echo 'sql: '.$sql.'</br>';
    $stmt_te = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_te = $e->getMessage(); 
} 
?>