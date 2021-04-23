<?php
$error_detop = '';
try{ 
	$sql = "select *";
	$sql .=	" from DETALLES_OPERACIONES";
	$sql .=	" where OPE_NM_ID = ".$OPE_NM_ID;
	$sql .=	" and DET_NM_STATUS = ".$status;
	//echo 'sql: '.$sql.'</br>';
	$stmt_detop = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error_detop = $e->getMessage(); 
}  
?>