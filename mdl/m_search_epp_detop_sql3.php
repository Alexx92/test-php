<?php
$error_detop = '';
try{ 
	$sql =	"select *";
	$sql .=	" from DETALLES_OPERACIONES";
	$sql .=	" where STO_TX_BARRA = '".$codigo."'";
	$sql .=	" and DET_NM_STATUS = ".$status;
	//echo 'sql: '.$sql.'</br>';
	$stmt_detop = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error_detop = $e->getMessage(); 
}  
?>