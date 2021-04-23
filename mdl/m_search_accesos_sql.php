<?php
$error_accs = '';
try{
	$sql  = "select *";
	$sql .= " from ACCESOS";
	$sql .= " WHERE USU_TX_RUT = '".$rut."'";
	$sql .= " and ACC_NM_STATUS = 1";
	$sql .= " and ACC_TS_FECHA_SALIDA is null";
    //echo 'sql: '.$sql.'</br>';
    $stmt_accs = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_accs = $e->getMessage(); 
} 
?>