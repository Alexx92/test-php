<?php
$sql  = "select *";
$sql .= " from BODEGAS";
$sql .= " where MIN_NM_ID = ".$fae;
$sql .= " and BOG_NM_ID <> 21";
$sql .= " order by BOG_NM_ID ASC";
$stmt_bod = $conn_ajax->query($sql);   
?>