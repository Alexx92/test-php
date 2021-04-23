<?php
$sql  = "select *";
$sql .= " from USUARIOS_PERFILES where USU_NM_ID ='".$id."'";
$stmt_prf = $conn_ajax->query($sql);   
?>