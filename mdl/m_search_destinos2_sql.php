<?php
$sql  = "select o.ori_id, convert(varchar(10), isnull(o.ori_nm_codigo,'-')) + ' ' + '(' + isnull(c1.cdg_tx_legible,' - ') + '/' + isnull(c2.cdg_tx_legible,' - ') + '/' + isnull(c3.cdg_tx_legible,' - ') + '/' + isnull(c4.cdg_tx_legible,' - ') + ')' as origen";
$sql .= " from  ori_origenes o";
$sql .= " left join cdg_codigos as c2 on ori_fk_caseron_cdg = c2.cdg_id";
$sql .= " left join cdg_codigos as c3 on ori_fk_galeria_cdg = c3.cdg_id";
$sql .= " left join cdg_codigos as c4 on ori_fk_referencia_cdg = c4.cdg_id, cdg_codigos as c1";
$sql .= " where o.ori_fk_nivel_cdg = c1.cdg_id";
$sql .= " and o.ori_id = ".$ORI_NM_ID;
$stmt_des = $conn_ajax_VOM->query($sql);
?>