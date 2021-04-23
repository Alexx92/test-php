<?php
include('../start_ajax2.php');
include('../mdl/m_search_destinos2_sql.php');
if($stmt_des){
	$row_des = $stmt_des->fetch(PDO::FETCH_ASSOC);
	$origen = $row_des['origen'];	
	$output = array(
			"status"  => TRUE,
			"selector_des" => $origen
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