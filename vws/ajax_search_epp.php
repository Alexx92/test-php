<?php
$cb = $_GET['epp'];
$bod = $_GET['bod'];
include('../start_ajax.php');
include('../mdl/m_search_epp_sql.php');
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id = $row['STO_NM_ID'];
	$cb = $row['STO_TX_BARRA'];
	$ds = $row['PRO_TX_PRODUCTO'];
	$cd = $row['PRO_TX_CODIGO'];
	$stt = $row['STO_NM_STATUS'];
	$mt = $row['STO_TX_TAG'];
	$STO_NM_STATUS = $stt;
	$STO_NM_ID = $id;
	if($STO_NM_STATUS == 1){
		include('../mdl/m_search_epp_op_sql2.php');
		if($error_op == ''){
			if($row_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
				$OPE_TX = $row_op['OPE_TX_RUT'].' '.$row_op['OPE_TX_NOMBRE'];
				$fent = $row_op['fent'];
				$hent = $row_op['hent'];
			}else{
				$OPE_TX = '';
				$fent = '';
				$hent = '';
			}
		}else{
			$OPE_TX = '';
			$fent = '';
			$hent = '';
		}
	}else{
		$OPE_TX = '';
		$fent = '';
		$hent = '';
	}
	$output = array(
				"status"  => TRUE,
				"id" => $id,
				"cb" => $cb,
				"ds" => $ds,
				"cd" => $cd,
				"stt" => $stt,
				"mt" => $mt,
				"ope" => $OPE_TX
				);
} else {
	include('../mdl/m_search_bod_epp_sql.php');
	if ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
		$id = $row2['STO_NM_ID'];
		$cb = $row2['STO_TX_BARRA'];
		$ds = $row2['PRO_TX_PRODUCTO'];
		$cd = $row2['PRO_TX_CODIGO'];
		$stt = $row2['STO_NM_STATUS'];
		$mt = $row2['STO_TX_TAG'];
		$bod = $row2['BOG_TX_BODEGA'];
		
		$STO_NM_STATUS = $stt;
		$STO_NM_ID = $id;
		if($STO_NM_STATUS == 1){
			include('../mdl/m_search_epp_op_sql2.php');
			if($error_op == ''){
				if($row_op = $stmt_op->fetch(PDO::FETCH_ASSOC)){
					$OPE_TX = $row_op['OPE_TX_RUT'].' '.$row_op['OPE_TX_NOMBRE'];
					$fent = $row_op['fent'];
					$hent = $row_op['hent'];
				}else{
					$OPE_TX = '';
					$fent = '';
					$hent = '';
				}
			}else{
				$OPE_TX = '';
				$fent = '';
				$hent = '';
			}
		}else{
			$OPE_TX = '';
			$fent = '';
			$hent = '';
		}
		$output = array( 
			"status"  => FALSE,
			"id" => $id,
			"stt" => $stt,
			"bod" => $bod,
			"ope" => $OPE_TX
		);
	}else{
		$output = array( 
			"status"  => FALSE,
		);
	}
}
echo json_encode($output);
exit();
?>