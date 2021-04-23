<?php
$sql  = "select distinct  isnull(c1.cdg_tx_legible,' - ')  as nivel";
$sql .= " from ori_origenes";
$sql .= " left join cdg_codigos as c1 on ori_fk_nivel_cdg = c1.cdg_id";
$sql .= " where ori_fk_faena_cdg = ".$id_mina;
$sql .= " and ori_ck_vigente = 1";
$sql .= " order by nivel";
//echo 'sql: '.$sql.'</br>';
$stmt_niv = $conn_ajax_VOM->query($sql);
?>