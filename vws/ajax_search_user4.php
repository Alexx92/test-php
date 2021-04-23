<?php
$rut = $_GET['rut'];
include('../start_ajax.php');
include('../start_ajax2.php');
include('../mdl/m_search_user_sql.php');
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id  = $row['USU_NM_ID'];
	$nomusr = $row['USU_TX_USUARIO'];
	$nombre = $row['USU_TX_NOMBRE'];
	$statusr = $row['USU_TX_ACTIVO'];
	if($statusr == 'S'){
		include('../mdl/m_search_accesos_sql.php');
		if($error_accs == ''){
			if($row_acc = $stmt_accs->fetch(PDO::FETCH_ASSOC)){
				$ACC_NM_ID = $row_acc['ACC_NM_ID'];
				$ACC_TS_FECHA_ENTRADA = $row_acc['ACC_TS_FECHA_ENTRADA'];
				$bod = $row_acc['UBI_NM_ID'];
				$fae = $row_acc['FAE_NM_ID'];
				$niv = $row_acc['ACC_TX_NIVEL'];
				$des = $row_acc['ORI_NM_ID'];
				
				include('../mdl/m_search_faenas_sql.php');
				$selector_fae = '<option value="">Seleccione la Faena</option>';
				while ($row_fae = $stmt_fae->fetch(PDO::FETCH_ASSOC)){
					$MIN_NM_ID = $row_fae['MIN_NM_ID'];
					$MIN_TX_MINAS = $row_fae['MIN_TX_MINAS'];
					if($fae == $MIN_NM_ID){
						$sel = '<option selected="selected" value="'.$MIN_NM_ID.'">'.$MIN_TX_MINAS.'</option>';	
					}else{
						continue;
					}
					$selector_fae = $selector_fae.$sel;
				}
				$id_mina = $fae+152;
				include('../mdl/m_search_niveles_sql.php');
				$selector_niv = '<option value="">Seleccione el Nivel</option>';
				while ($row_niv = $stmt_niv->fetch(PDO::FETCH_ASSOC)){
					$nivel = $row_niv['nivel'];
					if($niv == $nivel){
						$sel = '<option selected="selected" value="'.$nivel.'">'.$nivel.'</option>';
					}else{
						$sel = '<option value="'.$nivel.'">'.$nivel.'</option>';
					}
					$selector_niv = $selector_niv.$sel;
				}
				$niv_int = $niv;
				include('../mdl/m_search_destinos_sql.php');
				$selector_des = '<option value="">Seleccione el Destino</option>';
				while ($row_des = $stmt_des->fetch(PDO::FETCH_ASSOC)){
					$ori_id = $row_des['ori_id'];
					$origen = $row_des['origen'];
					if($des == $ori_id){
						$sel = '<option selected="selected" value="'.$ori_id.'">'.$origen.'</option>';
					}else{
						$sel = '<option value="'.$ori_id.'">'.$origen.'</option>';
					}
					$selector_des = $selector_des.$sel;
				}
				include('../mdl/m_search_bodegas_sql.php');
				$selector_bod = '<option value="">Seleccione la Bodega</option>';
				while ($row_bod = $stmt_bod->fetch(PDO::FETCH_ASSOC)){
					$BOG_NM_ID = $row_bod['BOG_NM_ID'];
					$BOG_TX_BODEGA = $row_bod['BOG_TX_BODEGA'];
					$BOG_TX_CODIGO = $row_bod['BOG_TX_CODIGO'];
					if($bod == $BOG_NM_ID){
						$sel = '<option selected="selected" value="'.$BOG_NM_ID.'">'.$BOG_TX_BODEGA.'</option>';
					}else{
						$sel = '<option value="'.$BOG_NM_ID.'">'.$BOG_TX_BODEGA.'</option>';
					}
					$selector_bod = $selector_bod.$sel;
				}
				//buscar epp asignados
				include('../mdl/m_search_epp_op_sql.php');
				if($stmt_op && $error_op == ''){ //$row_op && $stmt_op
					$arr_epps = array();
					$count_epps_asig = 0;
					while ($row_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
						$OPE_NM_ID  = $row_op['OPE_NM_ID'];
						$status = 1;
						include('../mdl/m_search_epp_detop_sql.php');
						if($error_detop == ''){
							while ($row_detop = $stmt_detop->fetch(PDO::FETCH_ASSOC)){
								$STO_NM_ID = $row_detop['STO_NM_ID'];
								$STO_TX_BARRA = $row_detop['STO_TX_BARRA'];
								include('../mdl/m_search_epp_id_sql.php');
								if($error_epp == ''){
									$row_epp = $stmt_epp->fetch(PDO::FETCH_ASSOC);
									$r = array();
									$r[] = $row_epp['STO_NM_ID'];
									$r[] = $row_epp['PRO_TX_CODIGO'];
									$r[] = $row_epp['STO_TX_BARRA'];
									$r[] = $row_epp['PRO_TX_PRODUCTO'];
									$r[] = $row_epp['STO_NM_STATUS'];
									if($row_epp['STO_TX_TAG'])
										$r[] = $row_epp['STO_TX_TAG'];
									else
										$r[] = '';
									$r[] = $OPE_NM_ID;
									$r[] = $row_epp['BOG_NM_ID'];
									$arr_epps[] = $r;
									$count_epps_asig++;
								}else{
									$output = array(
										"status"  => FALSE,
										"error_code" => 1,
										"error_msg" => 'ERROR 1 '.' No se encontro información relacionada a los EPP de la Operacion'
									);
								}
							}
						}else{
							$output = array(
								"status"  => FALSE,
								"error_code" => 2,
								"error_msg" => 'ERROR 2: '.' No se encontro información relacionada al Detalle de la Operación'
							);
						}
					}
					if($arr_epps){
						$output = array(
							"status"  => TRUE,
							"status_code" => 1,
							"id" => $id,
							"nomusr" => $nomusr,
							"nombre" => $nombre,
							"statusr" => $statusr,
							"selector_fae" => $selector_fae,
							"selector_niv" => $selector_niv,
							"selector_des" => $selector_des,
							"selector_bod" => $selector_bod,
							"count_epps_asig" => $count_epps_asig,
							"epps_asignados" => $arr_epps
						);
					}else{ //true, pero sin epps
						$output = array(
							"status"  => TRUE,
							"status_code" => 1,
							"id" => $id,
							"nomusr" => $nomusr,
							"nombre" => $nombre,
							"statusr" => $statusr,
							"selector_fae" => $selector_fae,
							"selector_niv" => $selector_niv,
							"selector_des" => $selector_des,
							"selector_bod" => $selector_bod,
							"count_epps_asig" => 0,
							"epps_asignados" => ''
						);
					}
				}else{
					$output = array( 
						"status"  => FALSE,
						"error_code" => 3,
						"error_msg" => 'ERROR 3: '.' No se encontro información relacionada a la Operación'
					);
				}
			}else{ //no tiene entrada marcada, pero si puede tener epps asignados
				
				//buscar epp asignados
				include('../mdl/m_search_epp_op_sql.php');
				if($stmt_op && $error_op == ''){ //$row_op && $stmt_op
					$arr_epps = array();
					$count_epps_asig = 0;
					while ($row_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
						$OPE_NM_ID  = $row_op['OPE_NM_ID'];
						$status = 1;
						include('../mdl/m_search_epp_detop_sql.php');
						if($error_detop == ''){
							while ($row_detop = $stmt_detop->fetch(PDO::FETCH_ASSOC)){
								$STO_NM_ID = $row_detop['STO_NM_ID'];
								$STO_TX_BARRA = $row_detop['STO_TX_BARRA'];
								include('../mdl/m_search_epp_id_sql.php');
								if($error_epp == ''){
									$row_epp = $stmt_epp->fetch(PDO::FETCH_ASSOC);
									$r = array();
									$r[] = $row_epp['STO_NM_ID'];
									$r[] = $row_epp['PRO_TX_CODIGO'];
									$r[] = $row_epp['STO_TX_BARRA'];
									$r[] = $row_epp['PRO_TX_PRODUCTO'];
									$r[] = $row_epp['STO_NM_STATUS'];
									if($row_epp['STO_TX_TAG'])
										$r[] = $row_epp['STO_TX_TAG'];
									else
										$r[] = '';
									$r[] = $OPE_NM_ID;
									$r[] = $row_epp['BOG_NM_ID'];
									$arr_epps[] = $r;
									$count_epps_asig++;
								}else{
									$output = array(
										"status"  => FALSE,
										"error_code" => 8,
										"error_msg" => 'ERROR 8 '.' No se encontro información relacionada a los EPP de la Operacion'
									);
								}
							}
						}else{
							$output = array(
								"status"  => FALSE,
								"error_code" => 9,
								"error_msg" => 'ERROR 9: '.' No se encontro información relacionada al Detalle de la Operación'
							);
						}
					}
					if($arr_epps){
						$output = array(
							"status"  => TRUE,
							"status_code" => 2,
							"id" => $id,
							"nomusr" => $nomusr,
							"nombre" => $nombre,
							"statusr" => $statusr,
							"count_epps_asig" => $count_epps_asig,
							"epps_asignados" => $arr_epps
						);
					}else{ //true, pero sin epps
						$output = array(
							"status"  => TRUE,
							"status_code" => 2,
							"id" => $id,
							"nomusr" => $nomusr,
							"nombre" => $nombre,
							"statusr" => $statusr,
							"count_epps_asig" => 0,
							"epps_asignados" => ''
						);
					}
				}else{
					$output = array( 
						"status"  => FALSE,
						"error_code" => 10,
						"error_msg" => 'ERROR 10: '.' No se encontro información relacionada a la Operación'
					);
				}
				/*$output = array(
					"status"  => FALSE,
					"error_code" => 4,
					"error_msg" => 'ERROR 4: El usuario no tiene registrado un Ingreso.'
				);*/
			}
		}else{
			$output = array( 
					"status"  => FALSE,
					"error_code" => 5,
					"error_msg" => 'ERROR 5: '.$error_accs
				);
		}
	}else{
		$output = array( 
					"status"  => FALSE,
					"error_code" => 6,
					"error_msg" => 'ERROR 6: El RUT ingresado se encuentra inactivo.'
				);
	}
} else {
	$output = array( 
		"status"  => FALSE,
		"error_code" => 7,
		"error_msg" => 'ERROR 7: No se encontro información relacionada al Usuario'
	);
}
echo json_encode($output);
exit();
?>