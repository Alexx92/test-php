<?php
$error = '';
try{ 
	$sql  = "update DETALLES_OPERACIONES";
	$sql .= " set DET_NM_STATUS = 0";
	$sql .= " where STO_NM_ID = ".$id_epp;
	$sql .= " and OPE_NM_ID = ".$idop;
	//echo 'sql: '.$sql.'</br>';
	$stmt = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error = $e->getMessage(); 
}  
?>