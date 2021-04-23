<?php

$idusr = $_GET['idusr'];
$nmusr = $_GET['nmusr'];
$count_epps_tot = $_GET['neppusr'];
$rut = $_GET['rut'];
$bod = $_GET['bod'];
$id_epps = $_GET['id_epps'];
$epps_sel = $_GET['epps'];
$mac_tags = $_GET['mac_tags'];
$count_epps_sel = $_GET['count_epps_sel'];
$fae = $_GET['fae'];
$niv = $_GET['niv'];
/*
$idusr = 2;
$nmusr = 'Cristian.Galvez';
$count_epps_tot = 3;
$rut = '10275154-k';
$bod = 7;
$id_epps = '201872#246|201873#246|';
$epps_sel = 'RADIOS1895|RADIOS1896|';
$mac_tags = '0|0|';
$count_epps_sel = 2;
$fae = 1;
$niv = 235;
*/
if($niv == '')
	$niv = 'NULL';
if(substr($id_epps, -1) == '|'){
	//sacar '|'
	$id_epps = substr($id_epps, 0, strlen($id_epps) -1);
	$epps_sel = substr($epps_sel, 0, strlen($epps_sel) -1);
	$mac_tags = substr($mac_tags, 0, strlen($mac_tags) -1);
}
$arr_id_epps = explode("|", $id_epps);
$arr_epps = explode("|", $epps_sel);
$count_id_epps = count($arr_id_epps);

$arr_mactags = explode("|", $mac_tags);
include('../start_ajax.php');
$no_error_epp = 0;
$error_lamp = 0;
$error_lamp2 = 0;
$error_lamp2_msg = '';
$arr_id_ops = array();
for($i = 0; $i < $count_epps_sel ; $i++){
	$arr_idepp_idop = explode("#", $arr_id_epps[$i]);
	$id_epp = $arr_idepp_idop[0];
	$idop = $arr_idepp_idop[1];
	$arr_id_ops[] = $idop;
	$status_epp = 0;
	$epp = $arr_epps[$i];
	$mactag = $arr_mactags[$i];
	include('../mdl/m_change_stt_epp_sql.php');
	if($error == '')
		$no_error_epp++;
	$find_lamp   = 'LAMPCC';
	$find_pos = strpos($epp, $find_lamp);
	if ($find_pos !== false) {
		include('../start_ajax3.php');
		include('../mdl/m_search_epp_sysid_sql.php');
		if($error_sysid == ''){
			$row_sysid = pg_fetch_assoc($stmt_sysid);
			$sys_id = $row_sysid['sys_id'];
			$active = $row_sysid['active'];
			$onSite = false;
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
if($no_error_epp == $count_epps_sel){//&& $error_lamp == 0  && $error_lamp2 == 0
	$no_error_epp_detop = 0;
	for($i = 0; $i < $count_epps_sel ; $i++){
		$arr_idepp_idop = explode("#", $arr_id_epps[$i]);
		$id_epp = $arr_idepp_idop[0];
		$idop = $arr_idepp_idop[1];
		include('../mdl/m_update_epp_detop_sql.php');
		if($error == '')
			$no_error_epp_detop++;
	}
	if($no_error_epp_detop == $count_epps_sel){
		include('../mdl/m_return_epp_op_sql.php');
		if($error == ''){
			include('../mdl/m_scope_identity_epp_op_sql.php');
			if($error == ''){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$idope = $row['OPE_NM_ID'];
				$no_error_det_op = 0;
				for($j = 0; $j < $count_epps_sel ; $j++){
					$arr_idepp_idop = explode("#", $arr_id_epps[$j]);
					$id_epp = $arr_idepp_idop[0];
					$idop = $arr_idepp_idop[1];
					$epp = $arr_epps[$j];
					include('../mdl/m_return_epp_detop_sql.php');
					if($error == '')
						$no_error_det_op++;
				}
				if($no_error_det_op == $count_epps_sel){
					//verificar estado de otros epps para actualizar operacion
					$error_update_op = 0;
					for($m = 0; $m < count($arr_id_ops); $m++){
						$OPE_NM_ID = $arr_id_ops[$m];
						$idop = $OPE_NM_ID;
						include('../mdl/m_search_epp_detop_sql2.php');
						$status_epps = 0;
						while ($row_detop = $stmt_detop->fetch(PDO::FETCH_ASSOC)){
							$DET_NM_STATUS = $row_detop['DET_NM_STATUS'];
							if ($DET_NM_STATUS == 1){
								$status_epps = 1;
							}
						}
						if($status_epps == 0){ //todos los epps tienen valor cero
							include('../mdl/m_update_epp_op_sql.php');
							if($error != ''){
								$error_update_op++;
							}
						}else{
							$error_update_op = 0;
						}
					}
					if($error_update_op == 0){
						include('../mdl/m_search_accesos_sql.php');
						if($error_accs == ''){
							if($row_acc = $stmt_accs->fetch(PDO::FETCH_ASSOC)){
								$ACC_NM_ID = $row_acc['ACC_NM_ID'];	
								include('../mdl/m_update_access_sql.php');
								if($error_uaccs == ''){
									$output = array(
										"status"  => TRUE,
										"status_msg" => '2'
										);
								}else{
									$output = array( 
											"status"  => FALSE,
											"error_msg" => 'ERROR 5: '.$error_uaccs
										);
								}
							}else{
								$output = array( 
									"status"  => FALSE,
									"error_msg" => 'ERROR 6: El usuario no tiene registrado un Ingreso.'
								);
							}
						}else{
							$output = array( 
									"status"  => FALSE,
									"error_msg" => 'ERROR 7: '.$error_accs
								);
						}
					}else{
						$output = array( 
									"status"  => FALSE,
									"error_msg" => 'ERROR 8: Error al cambiar estado operacion entrega'
								);
					}
				}else{
					$output = array(
						"status"  => FALSE,
						"error_msg" => 'ERROR 9: Error al insertar detalle operacion de retorno'
					);
				}
			}else{
				$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 10: Error al obtener ID de operacion de retorno'.$error
				);
			}	
		}else{
			$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 11: Error al guardar operacion de retorno. '.$error
			);
		}
	}else{
		$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 12: Error al cambiar estado EPP detalle operaciones'
		);
	}
}else{
	$msg_error_epp = '';
	$msg_error_lamp = '';
	$msg_error_lamp2 = '';
	if($no_error_epp < $count_id_epps){
		$msg_error_epp = 'ERROR 13: '.' Error al cambiar estado EPP';
	}
	if($error_lamp > 0){
		$msg_error_lamp = 'ERROR 14: '.' Error al consultar sys_id en Postgre';
	}
	if($error_lamp2 > 0){
		$msg_error_lamp2 = 'ERROR 15: '.' Error al consultar API ICA. Code: '.$error_lamp2_msg;
	}
	$error_msg = $msg_error_epp.$msg_error_lamp.$msg_error_lamp2;
	$output = array( 
		"status"  => FALSE,
		"error_msg" => $error_msg
	);
}
echo json_encode($output);
exit();
?>