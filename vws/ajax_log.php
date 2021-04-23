<?php
$fc = $_GET['fc'];
$p = $_GET['p'];
$idusr_login = $_GET['idusr_login'];
$idfusr = $_GET['idfusr'];
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

if($myfile = fopen("../logs/log.txt", "a")){
	$txt = "Inicio Error log ".date('m-d-Y H:i:s')."\n";
	$txt .= "fc: ".$fc."\n";
	$txt .= "p: ".$p."\n";
	$txt .= "idusr_login: ".$idusr_login."\n";
	$txt .= "idfusr: ".$idfusr."\n";
	$txt .= "idusr: ".$idusr."\n";
	$txt .= "nmusr: ".$nmusr."\n";
	$txt .= "count_epps_tot: ".$count_epps_tot."\n";
	$txt .= "rut: ".$rut."\n";
	$txt .= "bod: ".$bod."\n";
	$txt .= "id_epps: ".$id_epps."\n";
	$txt .= "epps_sel: ".$epps_sel."\n";
	$txt .= "mac_tags: ".$mac_tags."\n";
	$txt .= "count_epps_sel: ".$count_epps_sel."\n";
	$txt .= "fae: ".$fae."\n";
	$txt .= "niv: ".$niv."\n";
	$txt .= "Fin Error log \n";
	fwrite($myfile, $txt);
	$output = array(
		"status"  => TRUE
	);
}else{
	$output = array( 
		"status"  => FALSE,
		"error_msg" => 'ERROR'
	);
}	
echo json_encode($output);
exit();
?>