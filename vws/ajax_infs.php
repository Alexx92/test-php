<?php
$tipo = $_GET['tipo'];
include('../start_ajax.php');
if($tipo == 1){
	$est2 = $_GET['est2'];
	$fae = $_GET['fae'];
	$tipoe = $_GET['tipoe'];
	if($est2 == 1){ //asignado		
		include('../mdl/m_search_epps3_sql.php');
		if($error_epps == ''){
			$count = 0;
			while ($row_epps = $stmt_epps->fetch(PDO::FETCH_ASSOC)){
				$STO_NM_ID = $row_epps['STO_NM_ID'];
				$PRO_TX_PRODUCTO = $row_epps['PRO_TX_PRODUCTO'];
				$STO_TX_BARRA = $row_epps['STO_TX_BARRA'];
				$STO_TX_TAG = $row_epps['STO_TX_TAG'];
				$STO_NM_STATUS = $row_epps['STO_NM_STATUS'];
				$BOG_NM_ID = $row_epps['BOG_NM_ID'];
				$BOG_TX_BODEGA = $row_epps['BOG_TX_BODEGA'];
				$MIN_NM_ID = $row_epps['MIN_NM_ID'];
				$MIN_TX_MINAS = $row_epps['MIN_TX_MINAS'];
				
				if($STO_NM_STATUS == 1){
					include('../mdl/m_search_entrega_epp_sql.php');//buscar op y detop de asignacion y retorno
					if($error_eepp == ''){
						if($row_eepp = $stmt_eepp->fetch(PDO::FETCH_ASSOC)){
							$OPE_NM_ID_E = $row_eepp['OPE_NM_ID'];
							$DET_NM_ID_E = $row_eepp['DET_NM_ID'];
							$OPE_TX_RUT_E = $row_eepp['OPE_TX_RUT'];
							$OPE_TX_NOMBRE_E = $row_eepp['OPE_TX_NOMBRE'];
							$fent_E = $row_eepp['fent'];
							$DET_NM_STATUS_E = $row_eepp['DET_NM_STATUS'];
							$atr = $row_eepp['atr'];
							$atr_E = $atr.' d&iacute;as';
							if($DET_NM_STATUS_E == 0){	
								//buscar retorno
								include('../mdl/m_search_retorno_epp_sql.php');//buscar op y detop de asignacion y retorno
								if($error_repp == ''){
									if($row_repp = $stmt_repp->fetch(PDO::FETCH_ASSOC)){
										$DET_NM_ID_R = $row_repp['DET_NM_ID'];
										$fsal_R = $row_repp['fsal'];
										$DET_NM_ID_IN = $DET_NM_ID_E.'/'.$DET_NM_ID_R;
									}else{
										$fsal_R = '';
										$DET_NM_ID_IN = $DET_NM_ID_E;
									}							
								}else{
									$fsal_R = '';
									$DET_NM_ID_IN = $DET_NM_ID_E;
								}
							}else{
								$fsal_R = '';
								$DET_NM_ID_IN = $DET_NM_ID_E;
							}
						}else{
							$OPE_NM_ID_E = '';
							$DET_NM_ID_E = '';
							$OPE_TX_RUT_E = '';
							$OPE_TX_NOMBRE_E = '';
							$fent_E = '';
							$DET_NM_STATUS_E = '';
							$atr_E = '';
							$DET_NM_ID_IN = '';
							$fsal_R = '';
						}
					}else{
						$OPE_NM_ID_E = '';
						$DET_NM_ID_E = '';
						$OPE_TX_RUT_E = '';
						$OPE_TX_NOMBRE_E = '';
						$fent_E = '';
						$DET_NM_STATUS_E = '';
						$atr_E = '';
						$DET_NM_ID_IN = '';
						$fsal_R = '';
					}
				
				}else{
					$OPE_NM_ID_E = '';
					$DET_NM_ID_E = '';
					$OPE_TX_RUT_E = '';
					$OPE_TX_NOMBRE_E = '';
					$fent_E = '';
					$DET_NM_STATUS_E = '';
					$atr_E = '';
					$DET_NM_ID_IN = '';
					$fsal_R = '';
				}
				if($STO_TX_TAG == ''){
					$STO_TX_TAG_IN = '';
				}else{
					$STO_TX_TAG_IN = $STO_TX_TAG;
				}
				
				if($STO_NM_STATUS == '0'){
					$STO_NM_STATUS_IN = 'DISPONIBLE';
				}else if($STO_NM_STATUS == '1') {
					$STO_NM_STATUS_IN = 'ASIGNADO';
				}else if($STO_NM_STATUS == '2') {
					$STO_NM_STATUS_IN = 'DADO DE BAJA';
				}else if($STO_NM_STATUS == '3') {
					$STO_NM_STATUS_IN = 'INACTIVO';
				}else if($STO_NM_STATUS == '4') {
					$STO_NM_STATUS_IN = 'EN REPARACIÓN';
				}
				$r = array();
				$r[] = $MIN_TX_MINAS;
				$r[] = $OPE_NM_ID_E;
				$r[] = $OPE_TX_RUT_E;
				$r[] = $OPE_TX_NOMBRE_E;
				$r[] = $DET_NM_ID_IN;
				$r[] = $fent_E;
				$r[] = $fsal_R;
				$r[] = $PRO_TX_PRODUCTO;
				$r[] = $STO_TX_BARRA;
				$r[] = $STO_NM_STATUS_IN;
				$r[] = $atr_E;
				$data[] = $r;
				$count++;
			}
			if(isset($data) && $count > 0){
				$datos = array("draw" =>  1,
						"recordsTotal"=> $count,
						"recordsFiltered"=> $count,
						"data" => $data);
			}else{
				$data = '';
				$datos = array("draw" =>  1,
						"recordsTotal"=> $count,
						"recordsFiltered"=> $count,
						"data" => $data);
			}
		}
	}else{ //disponible, dado de baja o en reparacion 
		include('../mdl/m_search_epps3_sql.php');
		if($error_epps == ''){
			$count = 0;
			while ($row_epps = $stmt_epps->fetch(PDO::FETCH_ASSOC)){
				$STO_NM_ID = $row_epps['STO_NM_ID'];
				$PRO_TX_PRODUCTO = $row_epps['PRO_TX_PRODUCTO'];
				$STO_TX_BARRA = $row_epps['STO_TX_BARRA'];
				$STO_TX_TAG = $row_epps['STO_TX_TAG'];
				$STO_NM_STATUS = $row_epps['STO_NM_STATUS'];
				$BOG_NM_ID = $row_epps['BOG_NM_ID'];
				$BOG_TX_BODEGA = $row_epps['BOG_TX_BODEGA'];
				$MIN_NM_ID = $row_epps['MIN_NM_ID'];
				$MIN_TX_MINAS = $row_epps['MIN_TX_MINAS'];
				
				if($STO_TX_TAG == ''){
					$STO_TX_TAG_IN = '';
				}else{
					$STO_TX_TAG_IN = $STO_TX_TAG;
				}
				
				if($STO_NM_STATUS == '0'){
					$STO_NM_STATUS_IN = 'DISPONIBLE';
				}else if($STO_NM_STATUS == '1') {
					$STO_NM_STATUS_IN = 'ASIGNADO';
				}else if($STO_NM_STATUS == '2') {
					$STO_NM_STATUS_IN = 'DADO DE BAJA';
				}else if($STO_NM_STATUS == '3') {
					$STO_NM_STATUS_IN = 'INACTIVO';
				}else if($STO_NM_STATUS == '4') {
					$STO_NM_STATUS_IN = 'EN REPARACIÓN';
				}
				$r = array();
				$r[] = $MIN_TX_MINAS;
				$r[] = $PRO_TX_PRODUCTO;
				$r[] = $STO_TX_BARRA;
				$r[] = $STO_NM_STATUS_IN;
				$data[] = $r;
				$count++;
			}
			if(isset($data) && $count > 0){
				$datos = array("draw" =>  1,
						"recordsTotal"=> $count,
						"recordsFiltered"=> $count,
						"data" => $data);
			}else{
				$data = '';
				$datos = array("draw" =>  1,
						"recordsTotal"=> $count,
						"recordsFiltered"=> $count,
						"data" => $data);
			}
		}
	}
	$datos = array("draw" =>  1,
					"recordsTotal"=> $count,
					"recordsFiltered"=> $count,
					"data" => $data);
}else if($tipo == 2){
	$fae = $_GET['fae'];
	include('../mdl/m_search_entradas_sql.php');
	if($error_fae == ''){
		$count = 0;
		while ($row_fae = $stmt_fae->fetch(PDO::FETCH_ASSOC)){
			$ACC_NM_ID = $row_fae['ACC_NM_ID'];
			$FAE_NM_ID = $row_fae['FAE_NM_ID'];
			$FAE_TX_NOMBRE = $row_fae['FAE_TX_NOMBRE'];
			$ORI_NM_ID = $row_fae['ORI_NM_ID'];
			$ACC_NM_STATUS = $row_fae['ACC_NM_STATUS'];
			$USU_TX_RUT = $row_fae['USU_TX_RUT'];
			$USU_TX_NOMBRE = $row_fae['USU_TX_NOMBRE'];
			$fecha = $row_fae['fent'];
			$hora = $row_fae['hent'];
			$nivel = $row_fae['ACC_TX_NIVEL'];
			if($nivel != 'Superficie' && $ORI_NM_ID != NULL){
				include('../start_ajax2.php');
				include('../mdl/m_search_destinos2_sql.php');
				if($stmt_des){
					$row_des = $stmt_des->fetch(PDO::FETCH_ASSOC);
					$destino = $row_des['origen'];
				}else{
					$destino = '';
				}
			}else{
				$destino = '';
			}
			
			//buscar epp asignados
			$rut = $USU_TX_RUT;
			$epps = '';
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
								if($epps == '') //epps vacio
									$epps.= $row_epp['STO_TX_BARRA'];
								else
									$epps.= ', '.$row_epp['STO_TX_BARRA'];								
							}
						}
					}
				}
			}		
			$r = array();
			$r[] = $USU_TX_RUT;
			$r[] = $USU_TX_NOMBRE;
			$r[] = $fecha;
			$r[] = $epps; //epp
			$r[] = $FAE_TX_NOMBRE;
			//$r[] = $hora;
			$r[] = $nivel;
			$r[] = $destino;
			$data[] = $r;
			$count++;
		}
		if(isset($data) && $count > 0){
			$datos = array("draw" =>  1,
					"recordsTotal"=> $count,
					"recordsFiltered"=> $count,
					"data" => $data);
		}else{
			$data = '';
			$datos = array("draw" =>  1,
					"recordsTotal"=> $count,
					"recordsFiltered"=> $count,
					"data" => $data);
		}
	}	
}else if($tipo == 3){
	$fae = $_GET['fae'];
	$f_des = $_GET['f_des'];
	$f_has = $_GET['f_has'];	
	include('../mdl/m_search_entradas_date_sql.php');
	if($error_fae == ''){
		$count = 0;
		while ($row_fae = $stmt_fae->fetch(PDO::FETCH_ASSOC)){
			$ACC_NM_ID = $row_fae['ACC_NM_ID'];
			$FAE_NM_ID = $row_fae['FAE_NM_ID'];
			$FAE_TX_NOMBRE = $row_fae['FAE_TX_NOMBRE'];
			$ORI_NM_ID = $row_fae['ORI_NM_ID'];
			$ACC_NM_STATUS = $row_fae['ACC_NM_STATUS'];
			$USU_TX_RUT = $row_fae['USU_TX_RUT'];
			$USU_TX_NOMBRE = $row_fae['USU_TX_NOMBRE'];
			$fent = $row_fae['fent'];
			$hent = $row_fae['hent'];
			$fsal = $row_fae['fsal'];
			$hsal = $row_fae['hsal'];
			$nivel = $row_fae['ACC_TX_NIVEL'];
			$fturno = $row_fae['fturno'];
			if($nivel != 'Superficie' && $ORI_NM_ID != NULL){
				include('../start_ajax2.php');
				include('../mdl/m_search_destinos2_sql.php');
				if($stmt_des){
					$row_des = $stmt_des->fetch(PDO::FETCH_ASSOC);
					$destino = $row_des['origen'];
				}else{
					$destino = '';
				}
			}else{
				$destino = '';
			}
			$hora_ent = date('H:i', strtotime($hent));
			$ent_turno = date('H:i', strtotime('08:00'));
			$sal_turno = date('H:i', strtotime('20:00'));
			$sal_turnob = date('H:i', strtotime('23:59'));
			if($hora_ent >= $ent_turno && $hora_ent < $sal_turno){
				$txt_turno = 'Turno A';
			}else{
				$txt_turno = 'Turno C';
			}
			$r = array();
			$r[] = $fturno;
			$r[] = $txt_turno;
			$r[] = $FAE_TX_NOMBRE;
			$r[] = $USU_TX_NOMBRE;
			$r[] = $USU_TX_RUT;
			$r[] = $nivel;
			$r[] = $destino;
			$r[] = $fent.' '.$hent;
			if($fsal == '')
				$r[] = '';
			else
				$r[] = $fsal.' '.$hsal;			
			$data[] = $r;
			$count++;
		}
		if(isset($data) && $count > 0){
			$datos = array("draw" =>  1,
					"recordsTotal"=> $count,
					"recordsFiltered"=> $count,
					"data" => $data);
		}else{
			$data = '';
			$datos = array("draw" =>  1,
					"recordsTotal"=> $count,
					"recordsFiltered"=> $count,
					"data" => $data);
		}
	}
}
echo json_encode($datos);
exit();
?>