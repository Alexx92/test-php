<?php
$fae = $_GET['fae'];
$niv = $_GET['niv'];
$des = $_GET['des'];
if($des == '')
	$des = 'NULL';
$b = $_GET['b'];
$idusr_login = $_GET['idusr_login'];
$rut = $_GET['rut'];
include('../start_ajax.php');
include('../mdl/m_search_accesos_sql.php');
if($error_accs == ''){
	//verificar si hay un acceso sin marcar salida
	$arr_accs = $stmt_accs->fetchAll();
	$count_arr_accs = count($arr_accs);
	if(!$count_arr_accs > 0){
		include('../mdl/m_save_access_sql.php');
		if($error_saccs == ''){
			include('../mdl/m_scope_identity_epp_op_sql.php'); //se reutiliza para obtener ultimo ID de acceso
			if($error == ''){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$ACC_NM_ID = $row['OPE_NM_ID'];
				$output = array(
					"status"  => TRUE,
					"ACC_NM_ID" => $ACC_NM_ID,
					);
			}else{
				$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 4: '.$error
				);
			}
		}else{
			$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 1: '.$error_saccs
				);
		}
	}else{
		$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 2: El usuario ya cuenta con un Ingreso registrado sin marcar Salida.'
		);
	}
}else{
	$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 3: '.$error_accs
		);
}
echo json_encode($output);
exit();
?>