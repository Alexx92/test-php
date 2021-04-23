<?php
$error_upusr = '';
try{ 
    $sql = "delete from USUARIOS_PERFILES";
	$sql .= " where USU_NM_ID = ".$idusr;
	//echo 'sql: '.$sql.'</br>';
    $stmt_upusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_upusr = $e->getMessage(); 
} 
?>