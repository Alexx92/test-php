<?php
$error_uusr = '';
try{ 
    $sql = "update USUARIOS";
	$sql .= " set USU_TX_USUARIO = '".$usuario."', BOG_NM_ID = ".$bodega.", USU_TX_NOMBRE = '".$nombre."', USU_TX_ACTIVO = '".$est."'";
	$sql .= " where USU_NM_ID = ".$idusr;
	//echo 'sql: '.$sql.'</br>';
    $stmt_uusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_uusr = $e->getMessage(); 
} 
?>