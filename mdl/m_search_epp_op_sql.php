<?php
$error_op = '';
try{ 
	$sql = "select *";
	$sql .=	" from OPERACIONES";
	$sql .=	" where OPE_NM_STATUS = 1";
	$sql .=	" and OPE_TX_RUT = '".$rut."'";
	$sql .=	" and OPE_TS_FECHA_ENTREGA is not null";
    //echo 'sql: '.$sql.'</br>';
    $stmt_op = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_op = $e->getMessage(); 
} 
?>