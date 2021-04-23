<?php
$fae = $_GET['fae'];
$fae_int = (int)$fae;
$id_mina = 152 + $fae_int;
$niv = $_GET['niv'];
$niv_int = (int)$niv;
include('../start_ajax2.php');
include('../mdl/m_search_destinos_sql.php');
if($stmt_des){
	$selector_des = '<option value="">Seleccione el Destino</option>';
	while ($row_des = $stmt_des->fetch(PDO::FETCH_ASSOC)){
		$ori_id = $row_des['ori_id'];
		$origen = $row_des['origen'];
		$sel = '<option value="'.$ori_id.'">'.$origen.'</option>';
		$selector_des = $selector_des.$sel;
	}
	$output = array(
			"status"  => TRUE,
			"selector_des" => $selector_des
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