<?php
$error = '';
try{ 
	$sql = "update OPERACIONES";
	$sql .=	" set OPE_NM_STATUS = 0";
	$sql .= " where OPE_NM_ID = ".$idop;
	//echo 'sql: '.$sql.'</br>';
    $stmt = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error = $e->getMessage(); 
} 
?>