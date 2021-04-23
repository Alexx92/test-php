<?php
$error_op = '';
try{ 
	$sql =	"select TOP 1 o.OPE_NM_ID, dt.DET_NM_ID, o.OPE_TX_RUT, o.OPE_TX_NOMBRE,";
	$sql .=	" convert(varchar, CONVERT(DATE, o.OPE_TS_FECHA_ENTREGA), 105) as fent,";
	$sql .=	" convert(varchar, CONVERT(time, o.OPE_TS_FECHA_ENTREGA), 8) as hent";
	$sql .=	" from DETALLES_OPERACIONES dt, OPERACIONES o";
	$sql .=	" where dt.OPE_NM_ID = o.OPE_NM_ID";
	$sql .=	" and dt.STO_NM_ID = ".$STO_NM_ID;
	$sql .=	" and dt.DET_NM_STATUS = 1";
	$sql .=	" and o.OPE_TS_FECHA_RETORNO is null";
	$sql .=	" order by OPE_NM_ID desc";
    //echo 'sql: '.$sql.'</br>';
    $stmt_op = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_op = $e->getMessage(); 
} 
?>