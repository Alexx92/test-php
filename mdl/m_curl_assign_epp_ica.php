<?php
$error_curl = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $curl_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($curl_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS,$curl_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD,"sam:pucobre.19");
$curl_response = curl_exec($ch);
if (curl_error($ch)) {
	$error_curl = curl_error($ch);
	$error_msg = 'ERROR: ' . $error_curl.'.Cod ERROR: '.curl_errno($ch);
}
curl_close($ch);
?>