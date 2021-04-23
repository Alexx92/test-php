<?php
$error = '';
try{ 
	$sql  = "insert into DETALLES_OPERACIONES(OPE_NM_ID,TIP_NM_ID,STO_TX_BARRA,STO_NM_ID,DET_NM_STATUS) values ";
	$sql .= "(".$idope.",0,'".$codigo."','".$idepp."',3) ";
	//echo 'sql: '.$sql.'</br>';
	$stmt = $conn_ajax->query($sql); 
} catch(Exception $e){ 
    $error = $e->getMessage(); 
}  
?>