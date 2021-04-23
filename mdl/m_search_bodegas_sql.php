<?php
$sql  = "select b.BOG_NM_ID, f.FAE_NM_ID, b.BOG_TX_BODEGA, b.BOG_TX_CODIGO";
$sql .= " from BODEGAS b, FAENAS f";
$sql .= " where b.BOG_NM_ID <> 21 ";
$sql .= " and b.MIN_NM_ID = f.MIN_NM_ID";
$sql .= " and b.ESB_NM_ID = 1";
$sql .= " order by b.BOG_NM_ID ASC";
$stmt_bod = $conn_ajax->query($sql);
?>