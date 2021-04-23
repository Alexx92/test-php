<?php
$error_fae = '';
try{ 
	$sql = "select a.ACC_NM_ID, a.FAE_NM_ID, f.FAE_TX_NOMBRE, a.ORI_NM_ID, a.ACC_NM_STATUS, a.USU_TX_RUT, u.USU_TX_NOMBRE,";
	$sql.= " convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105) as fent,";
	$sql.= " convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) as hent,";
	$sql.= " a.ACC_TX_NIVEL";
	$sql.= " from ACCESOS a, USUARIOS u, FAENAS f";
	if($fae == '')
		$sql.= " where a.FAE_NM_ID IN (select MIN_NM_ID from MINAS)";
	else
		$sql.= " where a.FAE_NM_ID = ".$fae;
	$sql.= " and a.FAE_NM_ID = f.FAE_NM_ID";
	$sql.= " and u.USU_TX_RUT=a.USU_TX_RUT";
	$sql.= " and a.ACC_NM_STATUS = 1";
	$sql.= " order by a.ACC_TS_FECHA_ENTRADA desc";
	//echo 'sql: '.$sql.'</br>';
	$stmt_fae = $conn_ajax->query($sql);  
} catch(Exception $e){ 
    $error_fae = $e->getMessage(); 
}
?>