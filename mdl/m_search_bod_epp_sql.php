<?php
$sql  = "select sp.STO_NM_ID, sp.STO_TX_BARRA, sp.PRO_TX_CODIGO,  p.PRO_TX_PRODUCTO, sp.STO_NM_STATUS, sp.BOG_NM_ID, b.BOG_TX_BODEGA, sp.STO_TX_TAG";
$sql .= " from STOCK_PRODUCTOS sp join PRODUCTOS p on p.PRO_TX_CODIGO = sp.PRO_TX_CODIGO, BODEGAS b";
$sql .= " where sp.STO_TX_BARRA = '". $cb ."'";
$sql .= " and sp.BOG_NM_ID = b.BOG_NM_ID";
$sql .= " and ESB_NM_ID = 1";
$sql .= " order by sp.STO_NM_ID ASC";

$stmt2 = $conn_ajax->query($sql);   
?>