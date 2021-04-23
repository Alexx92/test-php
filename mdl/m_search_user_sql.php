<?php
$sql  = "select USU_NM_ID, USU_TX_USUARIO, USU_TX_NOMBRE, BOG_NM_ID, USU_TX_ACTIVO";
$sql .= " from USUARIOS where USU_TX_RUT ='".$rut."'";

$stmt = $conn_ajax->query($sql);   
?>