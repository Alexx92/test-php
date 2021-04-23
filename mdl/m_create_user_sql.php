<?php
$error_cusr = '';
try{ 
    $sql = "insert into USUARIOS (USU_TX_USUARIO, USU_TX_PASSWORD, USU_TX_RUT, BOG_NM_ID,USU_TX_NOMBRE, USU_TS_FECHA_REGISTRO, USU_TX_ACTIVO, EMP_NM_ID)";
	$sql .= " VALUES ('".$usuario."', 'secreta', '".$rut."', ".$bodega.", '".$nombre."', SYSDATETIME(), '".$est."' , 338)";
	//echo 'sql: '.$sql.'</br>';
    $stmt_cusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_cusr = $e->getMessage(); 
} 
?>