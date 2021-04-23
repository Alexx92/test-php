<?php
$rut = $_GET['rut'];
include('../start_ajax.php');
include('../mdl/m_search_user_sql.php');
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id  = $row['USU_NM_ID'];
	$nomusr = $row['USU_TX_USUARIO'];
	$nombre = $row['USU_TX_NOMBRE'];
	$idbodega = $row['BOG_NM_ID'];
	$statusr = $row['USU_TX_ACTIVO'];
	include('../mdl/m_search_user_prf_sql.php');
	if ($row_prf = $stmt_prf->fetch(PDO::FETCH_ASSOC)){
		//tiene un perfil asignado
		$prfusr  = $row_prf['PRF_NM_ID'];
	}else{
		$prfusr = 5; //por defecto Trabajador Mina
	}
	$output = array(
				"status"  => TRUE,
				"id" => $id,
				"nomusr" => $nomusr,
				"nombre" => $nombre,
				"idbodega" => $idbodega,
				"statusr" => $statusr,
				"prfusr" => $prfusr
				);
} else {
	$output = array( 
		"status"  => FALSE
	);
}
echo json_encode($output);
exit();
?>