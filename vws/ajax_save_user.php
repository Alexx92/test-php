<?php
$rut = $_GET['rut'];
$idusr = $_GET['idusr'];
$nombre = $_GET['nombre'];
$usuario = $_GET['usuario'];
$bodega = $_GET['bodega'];
$est = $_GET['est'];
$rol = $_GET['rol'];
include('../start_ajax.php');
if($idusr == ''){ //creacion de usuario
	include('../mdl/m_create_user_sql.php');
	if($error_cusr == ''){
		include('../mdl/m_scope_identity_usr_crt_sql.php'); //se reutiliza para obtener ultimo ID de acceso
		if($error == ''){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$USU_NM_ID = $row['USU_NM_ID'];
			include('../mdl/m_create_user_prf_sql.php');
			if($error_pusr == ''){
				$output = array(
					"status"  => TRUE,
					"USU_NM_ID" => $USU_NM_ID,
					);
			}else{
				$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 1: '.$error_pusr
				);
			}
		}else{
			$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 2: '.$error
			);
		}
	}else{
		$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 3: '.$error_cusr
			);
	}
}else{ //modificacion de usuario
	include('../mdl/m_update_user2_sql.php');
	if($error_uusr == ''){
		include('../mdl/m_update_user_prf_sql.php');
		if($error_upusr == ''){
			$output = array(
				"status"  => TRUE,
				"USU_NM_ID" => $idusr,
				);
		}else{
			$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 4: '.$error_upusr
				);
		}
	}else{
		$output = array( 
				"status"  => FALSE,
				"error_msg" => 'ERROR 5: '.$error_uusr
			);
	}
}
echo json_encode($output);
exit();
?>