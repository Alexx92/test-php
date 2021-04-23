<?php
$error = '';
try{ 
    $sql = "select @@IDENTITY as OPE_NM_ID";
	//echo 'sql: '.$sql.'</br>';
    $stmt = $conn_ajax->query($sql);   
} catch(Exception $e){ 
    $error = $e->getMessage(); 
} 
?>