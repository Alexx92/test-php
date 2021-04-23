<?php
$error_dusr = '';
try{ 
    $sql = "delete from USUARIOS";
	$sql .= " where USU_NM_ID = ".$idusr;
	//echo 'sql: '.$sql.'</br>';
    $stmt_dusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_dusr = $e->getMessage(); 
} 
?>