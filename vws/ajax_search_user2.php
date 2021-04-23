<?php
$rut = $_GET['rut'];
$perfil = $_GET['p'];
$perfil_bodega = $_GET['b'];
include('../start_ajax.php');
include('../mdl/m_search_user_sql.php');
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id  = $row['USU_NM_ID'];
	$nomusr = $row['USU_TX_USUARIO'];
	$nombre = $row['USU_TX_NOMBRE'];
	$statusr = $row['USU_TX_ACTIVO'];
	include('../mdl/m_search_epp_op_sql.php');
	if($statusr == 'S'){
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
					"id" => $id,
					"nomusr" => $nomusr,
					"nombre" => $nombre,
					"statusr" => $statusr,
					"count_epps_asig" => $count_epps_asig,
					"epps_asignados" => $arr_epps
				);
			}else{
				$output = array(
					"status"  => FALSE,
					"error_code" => 3,
					"error_msg" => 'ERROR 3: '.' No se encontro información relacionada al Detalle de la Operación'
				);
			}
		}else{
			$output = array( 
				"status"  => FALSE,
				"error_code" => 4,
				"error_msg" => 'ERROR 4: '.' No se encontro información relacionada a la Operación'
			);
		}
	}else{
		$output = array( 
					"status"  => FALSE,
					"error_code" => 5,
					"error_msg" => 'ERROR 5: El RUT ingresado se encuentra inactivo.'
				);
	}
} else {
	$output = array( 
		"status"  => FALSE,
		"error_code" => 6,
		"error_msg" => 'ERROR 6: '.' No se encontro información relacionada al Usuario'
	);
}
echo json_encode($output);
exit();
?>