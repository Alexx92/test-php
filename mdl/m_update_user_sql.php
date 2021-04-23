<?php
$error_uusr = '';
try{ 
	$sql  = "update USUARIOS";
	$sql .= " set BOG_NM_ID = ".$bodega;
	$sql .= " where USU_NM_ID = ".$idusr;
	//echo 'sql: '.$sql.'</br>';
    $stmt_uusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_uusr = $e->getMessage(); 
} 
?>