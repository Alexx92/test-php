<?php
$error_pusr = '';
try{ 
    $sql = "insert into USUARIOS_PERFILES (USU_NM_ID, PRF_NM_ID)";
	$sql .= " values (".$USU_NM_ID.", ".$rol.")";
	//echo 'sql: '.$sql.'</br>';
    $stmt_pusr = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_pusr = $e->getMessage(); 
} 
?>