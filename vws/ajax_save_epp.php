<?php

$idusr = $_GET['idusr'];
$rutusr = $_GET['rutusr'];
$nmusr = $_GET['nmusr'];
$estepp = $_GET['estepp'];
$idepp = $_GET['idepp'];
$codigo = $_GET['codigo'];
$tipo = $_GET['tipo'];
$est = $_GET['est'];
$bodega = $_GET['bodega'];
$mactag = $_GET['mactag'];
/*
$idusr = 1;
$rutusr = '13456789-9';
$nmusr = 'perfil.estandar';
$idepp = '179997';
$estepp = 1;
$codigo = 'LAMPCC0010';
$tipo = 530;
$est = 0;
$bodega = 7;
$mactag = '68CC9CCB4FC2';
*/

include('../start_ajax.php');
include('../mdl/m_search_product_cod_sql.php');
if($error_pc == ''){
	$row_pc = $stmt_pc->fetch(PDO::FETCH_ASSOC);
	$PRO_TX_CODIGO = $row_pc['PRO_TX_CODIGO'];
	include('../mdl/m_update_epp_sql.php');
	if($error_ue == ''){
		include('../mdl/m_assign_epp_op3_sql.php');
		if($error == ''){
			include('../mdl/m_scope_identity_epp_op_sql.php');
			if($error == ''){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$idope = $row['OPE_NM_ID'];
				include('../mdl/m_assign_epp_detop2_sql.php');
				if($error == ''){
					//buscar operacion de asignacion
					include('../mdl/m_search_epp_op_sql3.php');
					if($error_op == ''){
						if($row_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){ //hay una operacion asociada
							$OPE_NM_ID = $row_op['OPE_NM_ID'];
							$idop = $OPE_NM_ID;
							$DET_NM_ID = $row_op['DET_NM_ID'];
							$id_epp = $idepp;
							include('../mdl/m_update_epp_detop_sql.php');
							if($error == ''){
								$rut = $rutusr;
								$epps_sel = $codigo;
								$bod = $bodega;
								$epp = $codigo;
								$id_epp = $idepp;
								include('../mdl/m_return_epp_op_sql.php');
								if($error == ''){
									include('../mdl/m_scope_identity_epp_op_sql.php');
									if($error == ''){
										$row = $stmt->fetch(PDO::FETCH_ASSOC);
										$idope = $row['OPE_NM_ID'];
										include('../mdl/m_return_epp_detop_sql.php');
										if($error == ''){
											//consultar si todos los epp de la operacion estan devueltos, para marcar la operacion con cero
											include('../mdl/m_search_epp_detop_sql2.php');
											if($error_detop == ''){
												$count = 0;
												$est_0 = 0;
												while ($row_detop = $stmt_detop->fetch(PDO::FETCH_ASSOC)){
													$DET_NM_STATUS = $row_detop['DET_NM_STATUS'];
													if($DET_NM_STATUS == 0)
														$est_0++;
													$count++;		
												}
												$error_upop = 0;
												if($count == $est_0){
													//update operacion completa
													include('../mdl/m_update_epp_op_sql.php');
													if($error != ''){
														$error_upop++;
													}
												}
												$error_lamp = 0;
												$error_lamp2 = 0;
												$error_lamp2_msg = '';
												if($estepp == 1 && $est != 1){ //se pasa estado asignado a otro estado
													//echo 'se pasa estado asignado a otro estado</br>';
													$find_lamp   = 'LAMPCC';
													$find_pos = strpos($codigo, $find_lamp);
													if ($find_pos !== false) {
														include('../start_ajax3.php');
														include('../mdl/m_search_epp_sysid_sql.php');
														if($error_sysid == ''){
															$row_sysid = pg_fetch_assoc($stmt_sysid);
															$sys_id = $row_sysid['sys_id'];
															$active = $row_sysid['active'];
															$onSite = false;
															$rut = '';
															$nmusr = '';												
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
													$msg_error_lamp = '';
													$msg_error_lamp2 = '';
													if($error_lamp > 0){
														$msg_error_lamp = 'ERROR 1: '.' Error al consultar sys_id en Postgre';
													}
													if($error_lamp2 > 0){
														$msg_error_lamp2 = 'ERROR 2: '.' Error al consultar API ICA. Code: '.$error_lamp2_msg;
													}
													if($error_upop > 0){
														$msg_error_upop = 'ERROR 3: Error al actualizar la operación '.$idop;
														$error_msgg = $msg_error_upop.$msg_error_lamp.$msg_error_lamp2;
														$output = array( 
																"status"  => FALSE,
																"error_msg" => $error_msgg
														);
													}else{
														$error_msgg = $msg_error_lamp.$msg_error_lamp2;
														$output = array(
																"status"  => TRUE,
																"STO_NM_ID" => $idepp,
																"error_msg" => $error_msgg
														);
													}
												}else{
													//echo 'else</br>';
													$output = array(
														"status"  => TRUE,
														"STO_NM_ID" => $idepp,
														"error_msg2" => 'cambio de estado'
														);
												}
											}else{
												$output = array( 
													"status"  => FALSE,
													"error_msg" => 'ERROR 4: '.$error_detop
												);
											}											
										}else{
											$output = array( 
												"status"  => FALSE,
												"error_msg" => 'ERROR 5: '.$error
											);
										}
									}else{
										$output = array( 
											"status"  => FALSE,
											"error_msg" => 'ERROR 6: '.$error
										);
									}
								}else{
									$output = array( 
										"status"  => FALSE,
										"error_msg" => 'ERROR 7: '.$error
									);
								}						
							}else{
								$output = array( 
									"status"  => FALSE,
									"error_msg" => 'ERROR 8: '.$error
								);
							}
						}else{
							$output = array(
									"status"  => TRUE,
									"STO_NM_ID" => $idepp,
									"error_msg2" => 'sin operacion relacionada al epp'
									);
						}
					}else{
						$output = array( 
							"status"  => FALSE,
							"error_msg" => 'ERROR 9: '.$error_op
						);
					
					}
				}else{
					$output = array( 
						"status"  => FALSE,
						"error_msg" => 'ERROR 10: '.$error
					);
				}		
			}else{
				$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 11: '.$error
				);
			}
		}else{
			$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 12: '.$error
			);
		}
	}else{
		$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 13: '.$error_ue
		);
	}
}else{
	$output = array( 
		"status"  => FALSE,
		"error_msg" => 'ERROR 14: '.$error_pc
	);
}
echo json_encode($output);
exit();
?>