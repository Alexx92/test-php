<?php
$rut = $_GET['rut'];
$idusr = $_GET['idusr'];
/*
$rut = '15947870-K';
*/
include('../start_ajax.php');
include('../mdl/m_delete_user_prf_sql.php');
if($error_upusr == ''){
	include('../mdl/m_delete_user_sql.php');
	if($error_dusr == ''){	
		$output = array(
			"status"  => TRUE
			);
	}else{
		$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 1: '.$error_dusr
		);
	}
}else{
	$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 2: '.$error_upusr
		);
}
echo json_encode($output);
exit();
?>