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
	$idbodega = $row['BOG_NM_ID'];
	$statusr = $row['USU_TX_ACTIVO'];
	$output = array(
				"status"  => TRUE,
				"id" => $id,
				"nomusr" => $nomusr,
				"nombre" => $nombre,
				"statusr" => $statusr
				);
} else {
	$output = array( 
		"status"  => FALSE
	);
}
echo json_encode($output);
exit();
?>