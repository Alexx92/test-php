<?php
include('../start_ajax.php');
include('../mdl/m_search_roles_sql.php');
if($stmt_rol){
	$selector_rol = '<option value="">Seleccione el Rol</option>';
	while ($row_rol = $stmt_rol->fetch(PDO::FETCH_ASSOC)){
		$PRF_NM_ID = $row_rol['PRF_NM_ID'];
		$PRF_TX_NOMBRE_PERFIL = $row_rol['PRF_TX_NOMBRE_PERFIL'];
		$sel = '<option value="'.$PRF_NM_ID.'">'.$PRF_TX_NOMBRE_PERFIL.'</option>';
		$selector_rol = $selector_rol.$sel;
	}
	$output = array(
			"status"  => TRUE,
			"selector_rol" => $selector_rol
		);
}else{
	$output = array(
			"status"  => FALSE,
			"error_code" => 1,
			"error_msg" => 'ERROR 1: No se encuentran Roles'
		);
}
echo json_encode($output);
exit();
?>