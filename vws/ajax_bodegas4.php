<?php
include('../start_ajax.php');
include('../mdl/m_search_bodegas_sql.php');
if($stmt_bod){
	$selector_bod = '<option value="21">Seleccione la Bodega</option>';
	while ($row_bod = $stmt_bod->fetch(PDO::FETCH_ASSOC)){
		$BOG_NM_ID = $row_bod['BOG_NM_ID'];
		$BOG_TX_BODEGA = $row_bod['BOG_TX_BODEGA'];
		$sel = '<option value="'.$BOG_NM_ID.'">'.$BOG_TX_BODEGA.'</option>';
		$selector_bod = $selector_bod.$sel;
	}
	$output = array(
			"status"  => TRUE,
			"selector_bod" => $selector_bod
		);
}else{
	$output = array(
			"status"  => FALSE,
			"error_code" => 1,
			"error_msg" => 'ERROR 1: No se encuentran Bodegas'
		);
}
echo json_encode($output);
exit();
?>