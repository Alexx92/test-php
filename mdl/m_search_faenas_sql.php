<?php
$error_fae = '';
try{
	$sql  = "select *";
	$sql .= " from MINAS";
	$sql .= " order by MIN_NM_ID ASC";
	$stmt_fae = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error_fae = $e->getMessage(); 
}  
?>