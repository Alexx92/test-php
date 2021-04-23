<?php
$error = '';
try{ 
    $sql  = "update STOCK_PRODUCTOS";
	$sql .= " set STO_NM_STATUS = ".$status_epp." ,BOG_NM_ID = ".$bod;
	$sql .= " where STO_NM_ID = ".$id_epp;
	//echo 'sql: '.$sql.'</br>';
    $stmt = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error = $e->getMessage(); 
}
?>