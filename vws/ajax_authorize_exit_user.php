<?php
$fae = $_GET['fae'];
$niv = $_GET['niv'];
if($niv == '')
	$niv = 'NULL';
$rut = $_GET['rut'];
include('../start_ajax.php');
include('../mdl/m_search_accesos_sql.php');
if($error_accs == ''){
	if($row_acc = $stmt_accs->fetch(PDO::FETCH_ASSOC)){
		$ACC_NM_ID = $row_acc['ACC_NM_ID'];	
		include('../mdl/m_update_access_sql.php');
		if($error_uaccs == ''){
			$output = array(
				"status"  => TRUE
				);
		}else{
			$output = array( 
					"status"  => FALSE,
					"error_msg" => 'ERROR 1: '.$error_uaccs
				);
		}
	}else{
		$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 2: El usuario no tiene registrado un Ingreso.'
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