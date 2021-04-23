<?php

$idusr = $_GET['idusr'];
$nmusr = $_GET['nmusr'];
$count_epps_tot = $_GET['neppusr'];
$rut = $_GET['rut'];
$bod = $_GET['bod'];
$id_epps = $_GET['id_epps'];
$epps_sel = $_GET['epps'];
$mac_tags = $_GET['mac_tags'];
$count_epps_sel = $_GET['count_epps_sel'];
$fae = $_GET['fae'];
$niv = $_GET['niv'];
/*
$idusr = 2;
$nmusr = 'Cristian.Galvez';
$count_epps_tot = 3;
$rut = '10275154-k';
$bod = 7;
//$id_epps = '201872#246|201873#246|';
//$epps_sel = 'RADIOS1895|RADIOS1896|';
$mactag = '68CC9CCB5CCC';
$count_epps_sel = 2;
$fae = 1;
$niv = 235;
*/
$error_lamp = 0;
$error_lamp2 = 0;
include('../start_ajax3.php');
include('../mdl/m_search_epp_sysid_sql.php');
if($error_sysid == ''){
	$row_sysid = pg_fetch_assoc($stmt_sysid);
	$sys_id = $row_sysid['sys_id'];
	$active = $row_sysid['active'];
	$onSite = false;
	$curl_arr = [
		"firstName" => $rut,
		"lastName" 	=> $nmusr,
		"onSite"	=> $onSite,
	];
	$curl_json = json_encode($curl_arr);
	$curl_url = 'http://172.17.35.80/api/v1/entity/'.$sys_id;
	include('../mdl/m_curl_assign_epp_ica.php');
	if($error_curl != ''){
		$error_lamp2_msg.= ' '.$error_msg;
		$error_lamp2++;				
	}
}else{
	$error_lamp++;
}
if($error_lamp == 0  && $error_lamp2 == 0){
	$output = array(
		"status"  => TRUE,
		"status_msg" => '2'
	);
}else{
	$msg_error_lamp = '';
	$msg_error_lamp2 = '';
	
	if($error_lamp > 0){
		$msg_error_lamp = 'ERROR 14: '.' Error al consultar sys_id en Postgre';
		/*$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 14: '.' Error al consultar sys_id en Postgre'
		);*/
	}
	if($error_lamp2 > 0){
		$msg_error_lamp2 = 'ERROR 15: '.' Error al consultar API ICA. Code: '.$error_lamp2_msg;
		/*$output = array( 
			"status"  => FALSE,
			"error_msg" => 'ERROR 15: '.' Error al consultar API ICA. Code: '.$error_lamp2_msg
		);*/
	}
	$error_msg = $msg_error_lamp.$msg_error_lamp2;
	$output = array( 
		"status"  => FALSE,
		"error_msg" => $error_msg
	);	
}			
echo json_encode($output);
exit();
?>