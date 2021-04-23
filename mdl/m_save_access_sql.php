<?php
$error_saccs = '';
try{ 
    $sql = "insert into ACCESOS(OPE_NM_ID,ACC_NM_STATUS,USU_TX_RUT,ACC_TS_FECHA_ENTRADA,UBI_NM_ID,FAE_NM_ID,ACC_TX_NIVEL,ORI_NM_ID,USU_NM_ID)";
	$sql .= " values (0,1,'".$rut."',SYSDATETIME(),".$b.",".$fae.",'".$niv."',".$des.",".$idusr_login.")";
	//echo 'sql: '.$sql.'</br>';
    $stmt_saccs = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_saccs = $e->getMessage(); 
} 
?>