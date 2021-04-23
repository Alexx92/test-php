<?php
$tipoe = $_GET['tipoe'];
$bod = $_GET['bod'];
$est = $_GET['est'];
include('../start_ajax.php');
include('../mdl/m_search_epps2_sql.php');
if($error_epps == ''){
	$count = 0;
	while ($row_epps = $stmt_epps->fetch(PDO::FETCH_ASSOC)){
		$STO_NM_ID = $row_epps['STO_NM_ID'];
		$PRO_TX_PRODUCTO = $row_epps['PRO_TX_PRODUCTO'];
		$STO_TX_BARRA = $row_epps['STO_TX_BARRA'];
		$STO_TX_TAG = $row_epps['STO_TX_TAG'];
		$STO_NM_STATUS = $row_epps['STO_NM_STATUS'];
		$BOG_TX_BODEGA = $row_epps['BOG_TX_BODEGA'];
		if($STO_NM_STATUS == 1){
			include('../mdl/m_search_epp_op_sql2.php');
			if($error_op == ''){
				$row_op = $stmt_op->fetch(PDO::FETCH_ASSOC);
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
		$r[] = $PRO_TX_PRODUCTO;
		$r[] = $STO_TX_BARRA;
		$r[] = $STO_TX_TAG_IN;
		$r[] = $STO_NM_STATUS_IN;
		$r[] = $BOG_TX_BODEGA;
		$r[] = $OPE_TX;
		$r[] = $fent;
		$r[] = $hent;
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
echo json_encode($datos);
exit();
?>