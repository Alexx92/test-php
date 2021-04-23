<?php
$error = '';
try{ 
    $sql = "insert into OPERACIONES(OPE_NM_STATUS ,OPE_TS_FECHA_ENTREGA,OPE_TX_RUT,OPE_TX_VALORES, USU_NM_ID,BOG_NM_ID_ENTREGA ,OPE_TX_NOMBRE) ";
	$sql .= " values(3,SYSDATETIME(),'".$rutusr."','".$codigo."',".$idusr.",".$bodega.",'".$nmusr."')";
	//echo 'sql: '.$sql.'</br>';
    $stmt = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error = $e->getMessage(); 
} 
?>