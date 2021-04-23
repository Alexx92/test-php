<?php
$sql  = "select BOG_NM_ID, BOG_TX_BODEGA, BOG_TX_CODIGO";
$sql .= " from BODEGAS where BOG_NM_ID = ".$perfil_bodega;
$stmt_bod = $conn_ajax->query($sql);   
?>