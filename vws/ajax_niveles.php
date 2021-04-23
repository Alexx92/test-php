<?php
$fae = $_GET['fae'];
$fae_int = (int)$fae;
$id_mina = 152 + $fae_int;
include('../start_ajax2.php');
include('../mdl/m_search_niveles_sql.php');
if($stmt_niv){
	$selector_niv = '<option value="">Seleccione el Nivel</option>';
	while ($row_niv = $stmt_niv->fetch(PDO::FETCH_ASSOC)){
		$nivel = $row_niv['nivel'];
		$sel = '<option value="'.$nivel.'">'.$nivel.'</option>';
		$selector_niv = $selector_niv.$sel;
	}
	$output = array(
			"status"  => TRUE,
			"selector_niv" => $selector_niv
		);
}else{
	$output = array(
			"status"  => FALSE,
			"error_code" => 2,
			"error_msg" => 'ERROR 2:'
		);
}
echo json_encode($output);
exit();
?>