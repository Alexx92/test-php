<?php
$error_sysid = '';
try{ 
	$sql  = "select * ";
	$sql .= " from Person";
	$sql .= " where corp_id = '".$mactag."'";
	//echo 'sql: '.$sql.'</br>';
	$stmt_sysid = pg_query($conn_ajax_Postgre, $sql);
} catch(Exception $e){ 
    $error_sysid = $e->getMessage(); 
}
?>