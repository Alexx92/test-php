<?php
$error_pc = '';
try{ 
	$sql =	"select PRO_TX_CODIGO";
	$sql .=	" from PRODUCTOS";
	$sql .=	" where PRO_NM_ID = ".$tipo;
	//echo 'sql: '.$sql.'</br>';
	$stmt_pc = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error_pc = $e->getMessage(); 
}  
?>