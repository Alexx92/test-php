<?php
$id_epps = $_GET['id_epps'];
$epps = $_GET['epps'];
$mac_tags = $_GET['mac_tags'];
/*
$id_epps = '179993|109995|134059|';
$epps = 'LAMPCC0006|AUTORC0004|BATTOR4070|';
$mac_tags = '68CC9CCB5CCC|0|0|';
*/
include('../start_ajax.php');
if(substr($epps, -1) == '|'){
	//sacar '|'
	$id_epps = substr($id_epps, 0, strlen($id_epps) -1);
	$epps = substr($epps, 0, strlen($epps) -1);
	$mac_tags = substr($mac_tags, 0, strlen($mac_tags) -1);
	if(substr($epps, -1) == '|'){
		//sacar '|'
		$id_epps = substr($id_epps, 0, strlen($id_epps) -1);
		$epps = substr($epps, 0, strlen($epps) -1);
		$mac_tags = substr($mac_tags, 0, strlen($mac_tags) -2);
	}
}
$arr_id_epps = explode("|", $id_epps);
$count_id_epps = count($arr_id_epps);
$arr_epps = explode("|", $epps);
$count_epps = count($arr_epps);
$arr_mactags = explode("|", $mac_tags);

if($count_id_epps > 0){
	//cambiando estado de EPPs
	$error_epp = 0;
	$list = array();
	$count_list = 0;
	for($i = 0; $i < $count_id_epps ; $i++){
		$id_epp = $arr_id_epps[$i];
		$epp = $arr_epps[$i];
		$mactag = $arr_mactags[$i];
		$codigo = $epp;
		$status_epp = 1;
		include('../mdl/m_search_epp2_sql.php'); //buscar estado epp
		if($error_ce == ''){
			$row = $stmt_ce->fetch(PDO::FETCH_ASSOC);
			$status = $row['STO_NM_STATUS'];
			if($status == 1){//epp ya ocupado.
				$list[] = $codigo;
				$count_list++;
			}
		}else{
			$error_epp++;
		}
	}
	if($error_epp == 0){
		if( $count_list > 0){
			$output = array( 
				"status"  => FALSE,
				"code_error" => 1, 
				"error_msg" => implode(",", $list)
				);
		}else{
			$output = array(
				"status"  => TRUE
				);			
		}
	}else{
		$output = array(
			"status"  => FALSE,
			"error_msg" => 'ERROR: No se pudo realizas consulta de estado EPPs.'
			);
	}
}else{
	$output = array(
		"status"  => FALSE,
		"error_msg" => 'No hay EPPs seleccionados'
		);
}
echo json_encode($output);
exit();
?>