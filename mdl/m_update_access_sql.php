<?php
$error_uaccs = '';
$sql = '';
try{ 
	$sql = "update ACCESOS";
	$sql .= " set ACC_NM_STATUS = 0, ACC_TS_FECHA_SALIDA = SYSDATETIME(), ACC_TX_NIVEL_SALIDA = '".$niv."'";
	$sql .= " where USU_TX_RUT = '".$rut."'";
	$sql .= " and ACC_NM_ID = ".$ACC_NM_ID;
	//echo 'sql: '.$sql.'</br>';
    $stmt_uaccs = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_uaccs = $e->getMessage(); 
} 
?>