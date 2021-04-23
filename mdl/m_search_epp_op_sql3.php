<?php
$error_op = '';
try{ 
	$sql  =	"select o.OPE_NM_ID, dt.DET_NM_ID";
	$sql .=	" from OPERACIONES o, DETALLES_OPERACIONES dt";
	$sql .=	" where o.OPE_NM_STATUS = 1";
	$sql .=	" and o.OPE_TS_FECHA_ENTREGA is not null";
	$sql .=	" and o.OPE_NM_ID = dt.OPE_NM_ID";
	$sql .=	" and dt.DET_NM_STATUS = 1";
	$sql .=	" and dt.STO_TX_BARRA = '".$codigo."'";
	//echo 'sql: '.$sql.'</br>';
    $stmt_op = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_op = $e->getMessage(); 
} 
?>