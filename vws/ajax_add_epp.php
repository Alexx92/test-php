<?php
$b = $_GET['bodega'];
$idusr_login = $_GET['idusr_login'];
$rut = $_GET['rut'];

$idusr = $_GET['idusr'];
$nmusr = $_GET['nmusr'];
$id_epps = $_GET['id_epps'];
$epps = $_GET['epps'];
$mac_tags = $_GET['mac_tags'];
$bod = $b;
/*
$b = 7;
$idusr_login = 1;
$rut = '10275154-k';

$idusr = 2;
$nmusr = 'Cristian.Galvez';
$bod = 7;
$id_epps = '179995|201872||';
$epps = 'LAMPCC0008|RADIOS1895||';
$mac_tags = '68CC9CCB5E55|0|0|';
$op_url = 2;
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
	$no_error_epp = 0;
	$error_lamp = 0;
	$error_lamp2 = 0;
	$error_lamp2_msg = '';
	for($i = 0; $i < $count_id_epps ; $i++){
		$id_epp = $arr_id_epps[$i];
		$epp = $arr_epps[$i];
		$mactag = $arr_mactags[$i];
		$status_epp = 1;
		include('../mdl/m_change_stt_epp_sql.php');
		if($error == '')
			$no_error_epp++;
		$find_lamp   = 'LAMPCC';
		$find_pos = strpos($epp, $find_lamp);
		if ($find_pos !== false && $mactag != '0') {
			include('../start_ajax3.php');
			include('../mdl/m_search_epp_sysid_sql.php');
			if($error_sysid == ''){
				$row_sysid = pg_fetch_assoc($stmt_sysid);
				$sys_id = $row_sysid['sys_id'];
				$onSite = true;
				$curl_arr = [
					"firstName" => $rut,
					"lastName" 	=> $nmusr,
					"onSite"	=> $onSite,
				];
				$curl_json = json_encode($curl_arr);
				$curl_url = 'http://172.17.35.80/api/v1/entity/'.$sys_id;
				include('../mdl/m_curl_assign_epp_ica.php');
				if($error_curl != ''){
					$error_lamp2_msg.= ' '.$error_msg;
					$error_lamp2++;				
				}
			}else{
				$error_lamp++;
			}
		}
		
	}
	if($no_error_epp == $count_id_epps){ //&& $error_lamp == 0 && $error_lamp2 == 0
		include('../mdl/m_assign_epp_op_sql.php');
		if($error == ''){
			include('../mdl/m_scope_identity_epp_op_sql.php');
			if($error == ''){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$idope = $row['OPE_NM_ID'];
				$no_error_det_op = 0;
				for($j = 0; $j < $count_id_epps ; $j++){
					$id_epp = $arr_id_epps[$j];
					$epp = $arr_epps[$j];
					include('../mdl/m_assign_epp_detop_sql.php');
					if($error == '')
						$no_error_det_op++;
				}
				if($no_error_det_op == $count_id_epps){
					$output = array(
						"status"  => TRUE
						);
				}else{
					$output = array( 
						"status"  => FALSE,
						"error_msg" => 'ERROR 1: '.' Error al insertar detalle operacion'
					);
				}
			}else{
				$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 2: '.$error
				);
			}	
		}else{
			$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 3: '.$error
			);
		}
	}else{
		$msg_error_epp = '';
		$msg_error_lamp = '';
		$msg_error_lamp2 = '';
		if($no_error_epp < $count_id_epps){
			$msg_error_epp = 'ERROR 4: '.' Error al cambiar estado EPP';
		}							
		if($error_lamp > 0){
			$msg_error_lamp = 'ERROR 5: '.' Error al consultar sys_id en Postgre';
		}
		if($error_lamp2 > 0){
			$msg_error_lamp2 = 'ERROR 6: '.' Error al consultar API ICA. Code: '.$error_lamp2_msg;
		}
		$error_msg = $msg_error_epp.$msg_error_lamp.$msg_error_lamp2;
		$output = array( 
			"status"  => FALSE,
			"error_msg" => $error_msg
		);
	}
}else{
	$output = array(
		"status"  => FALSE,
		"error_msg" => 'No hay EPPs seleccionados',
		);
}
echo json_encode($output);
exit();
?>