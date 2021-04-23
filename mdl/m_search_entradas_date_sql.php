<?php
$error_fae = '';
try{ 
	$sql = "select a.ACC_NM_ID, a.FAE_NM_ID, f.FAE_TX_NOMBRE, a.ORI_NM_ID, a.ACC_NM_STATUS, a.USU_TX_RUT, u.USU_TX_NOMBRE,";
	$sql.= " 		convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105) as fent,";
	$sql.= " 		convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) as hent,";
	$sql.= " 		convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_SALIDA), 105) as fsal,";
	$sql.= " 		convert(varchar, CONVERT(time, a.ACC_TS_FECHA_SALIDA), 8) as hsal,";
	$sql.= " 			a.ACC_TX_NIVEL,";
	$sql.= " CASE";
	$sql.= " 	WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '08:00:00'), 8) AND";
	$sql.= " 		convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) < convert(varchar, CONVERT(time, '20:00:00'), 8) ) ";
	$sql.= " 		THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
	$sql.= " 		ELSE ";
	$sql.= " 			CASE";
	$sql.= " 				WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '20:00:00'), 8) AND";
	$sql.= " 					convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) <= convert(varchar, CONVERT(time, '23:59:59'), 8) )";
	$sql.= " 				THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
	$sql.= " 				ELSE convert(varchar,dateadd(dd, -1, convert(DATE, convert(char(12), a.ACC_TS_FECHA_ENTRADA))), 105)";
	$sql.= " 			END";
	$sql.= " END as fturno";
	$sql.= " from ACCESOS a, USUARIOS u, FAENAS f";
	$sql.= " where a.FAE_NM_ID = ".$fae;
	$sql.= " and a.FAE_NM_ID = f.FAE_NM_ID";
	$sql.= " and u.USU_TX_RUT = a.USU_TX_RUT";
	if($f_des == $f_has){
		$sql.= " AND";
		$sql.= " 	CASE";
		$sql.= " 		WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '08:00:00'), 8) AND";
		$sql.= " 			convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) < convert(varchar, CONVERT(time, '20:00:00'), 8) ) ";
		$sql.= " 			THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 			ELSE ";
		$sql.= " 				CASE";
		$sql.= " 					WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '20:00:00'), 8) AND";
		$sql.= " 						convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) <= convert(varchar, CONVERT(time, '23:59:59'), 8) )";
		$sql.= " 					THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 					ELSE convert(varchar,dateadd(dd, -1, convert(DATE, convert(char(12), a.ACC_TS_FECHA_ENTRADA))), 105)";
		$sql.= " 				END";
		$sql.= " 	END";
		$sql.= " 	= CONVERT(datetime, '".$f_des."')";
	}else{
		$sql.= " AND";
		$sql.= " 	CASE";
		$sql.= " 		WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '08:00:00'), 8) AND";
		$sql.= " 			convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) < convert(varchar, CONVERT(time, '20:00:00'), 8) ) ";
		$sql.= " 			THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 			ELSE ";
		$sql.= " 				CASE";
		$sql.= " 					WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '20:00:00'), 8) AND";
		$sql.= " 						convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) <= convert(varchar, CONVERT(time, '23:59:59'), 8) )";
		$sql.= " 					THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 					ELSE convert(varchar,dateadd(dd, -1, convert(DATE, convert(char(12), a.ACC_TS_FECHA_ENTRADA))), 105)";
		$sql.= " 				END";
		$sql.= " 	END";
		$sql.= " 	>= CONVERT(datetime, '".$f_des."')";
		$sql.= " AND	";
		$sql.= " 	CASE";
		$sql.= " 		WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '08:00:00'), 8) AND";
		$sql.= " 			convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) < convert(varchar, CONVERT(time, '20:00:00'), 8) ) ";
		$sql.= " 			THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 			ELSE ";
		$sql.= " 				CASE";
		$sql.= " 					WHEN (convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) >= convert(varchar, CONVERT(time, '20:00:00'), 8) AND";
		$sql.= " 						convert(varchar, CONVERT(time, a.ACC_TS_FECHA_ENTRADA), 8) <= convert(varchar, CONVERT(time, '23:59:59'), 8) )";
		$sql.= " 					THEN convert(varchar, CONVERT(DATE, a.ACC_TS_FECHA_ENTRADA), 105)";
		$sql.= " 					ELSE convert(varchar,dateadd(dd, -1, convert(DATE, convert(char(12), a.ACC_TS_FECHA_ENTRADA))), 105)";
		$sql.= " 				END";
		$sql.= " 	END";
		$sql.= " 	<= CONVERT(datetime, '".$f_has."')";
	}	
	$sql.= " order by a.ACC_TS_FECHA_ENTRADA asc";
	//echo 'SQL: '.$sql.'</br>';
	$stmt_fae = $conn_ajax->query($sql);  
} catch(Exception $e){ 
    $error_fae = $e->getMessage(); 
}
?>