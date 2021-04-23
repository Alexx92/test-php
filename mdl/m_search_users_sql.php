<?php
$error_usrs = '';
try{
	$sql = "select u.USU_TX_RUT, u.USU_TX_USUARIO, u.USU_TX_NOMBRE,p.PRF_TX_NOMBRE_PERFIL,  b.BOG_TX_BODEGA, e.EMP_TX_NOMBRE, u.USU_TX_ACTIVO";
	$sql .= " from USUARIOS u join USUARIOS_PERFILES up on up.USU_NM_ID = u.USU_NM_ID, PERFILES p, BODEGAS b, EMPRESAS e";
	$sql .= " where up.PRF_NM_ID = p.PRF_NM_ID";
	$sql .= " and u.BOG_NM_ID = b.BOG_NM_ID";
	$sql .= " and u.EMP_NM_ID = e.EMP_NM_ID";
    //echo 'sql: '.$sql.'</br>';
    $stmt_usrs = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error_usrs = $e->getMessage(); 
} 
?>