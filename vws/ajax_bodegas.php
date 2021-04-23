<?php
$rut = $_GET['rut'];
include('../start_ajax.php');
include('../mdl/m_search_user_sql.php');
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$idbodega_user = $row['BOG_NM_ID'];
	include('../mdl/m_search_bodegas_sql.php');
}else echo '<option selected="" value="">Seleccione la Bodega</option>';
?>