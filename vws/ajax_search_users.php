<?php
include('../start_ajax.php');
include('../mdl/m_search_users_sql.php');
if($error_usrs == ''){
	$count = 0;
	while ($row_usrs = $stmt_usrs->fetch(PDO::FETCH_ASSOC)){
		$USU_TX_RUT = $row_usrs['USU_TX_RUT'];
		$USU_TX_USUARIO = $row_usrs['USU_TX_USUARIO'];
		$USU_TX_NOMBRE = $row_usrs['USU_TX_NOMBRE'];
		$PRF_TX_NOMBRE_PERFIL = $row_usrs['PRF_TX_NOMBRE_PERFIL'];
		$BOG_TX_BODEGA = $row_usrs['BOG_TX_BODEGA'];
		$EMP_TX_NOMBRE = $row_usrs['EMP_TX_NOMBRE'];
		$USU_TX_ACTIVO = $row_usrs['USU_TX_ACTIVO'];
		
		if($USU_TX_ACTIVO == 'S'){
			$USU_TX_ACTIVO_IN = 'ACTIVO';
		}else if($USU_TX_ACTIVO == 'N') {
			$USU_TX_ACTIVO_IN = 'INACTIVO';
		}else{
			$USU_TX_ACTIVO_IN = '';
		}
		$r = array();
		$r[] = $USU_TX_RUT;
		$r[] = $USU_TX_USUARIO;
		$r[] = $USU_TX_NOMBRE;
		$r[] = $PRF_TX_NOMBRE_PERFIL;
		$r[] = $BOG_TX_BODEGA;
		$r[] = $EMP_TX_NOMBRE;
		$r[] = $USU_TX_ACTIVO_IN;
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