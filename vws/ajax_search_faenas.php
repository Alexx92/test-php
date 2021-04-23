<?php
include('../start_ajax.php');
include('../mdl/m_search_faenas_sql.php');
if($error_fae == ''){
	$selector_fae = '<option value="">Seleccione la Faena</option>';
	while ($row_fae = $stmt_fae->fetch(PDO::FETCH_ASSOC)){
		$MIN_NM_ID = $row_fae['MIN_NM_ID'];
		$MIN_TX_MINAS = $row_fae['MIN_TX_MINAS'];
		$sel = '<option value="'.$MIN_NM_ID.'">'.$MIN_TX_MINAS.'</option>';
		$selector_fae = $selector_fae.$sel;
	}
	$output = array(
		"status"  => TRUE,
		"selector_fae" => $selector_fae
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