<?php
include('../start_ajax.php');
include('../mdl/m_search_tipoe_sql.php');
if($stmt_te){
	$selector_te = '<option value="">Seleccione el Tipo</option>';
	while ($row_te = $stmt_te->fetch(PDO::FETCH_ASSOC)){
		$PRO_NM_ID = $row_te['PRO_NM_ID'];
		$PRO_TX_PRODUCTO = $row_te['PRO_TX_PRODUCTO'];
		$sel = '<option value="'.$PRO_NM_ID.'">'.$PRO_TX_PRODUCTO.'</option>';
		$selector_te = $selector_te.$sel;
	}
	$output = array(
			"status"  => TRUE,
			"selector_te" => $selector_te
		);
}else{
	$output = array(
			"status"  => FALSE,
			"error_code" => 2,
			"error_msg" => 'ERROR 2:'
		);
}
echo json_encode($output);
exit();
?>