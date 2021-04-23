<?php
//aqui conexion sql server
require_once('conexion.php');
require_once('/opt/app-root/src/libs/adlap/adldap.php');
require_once('libs/adlap/adldap_functions.php');

ini_set('error_reporting', E_ALL & ~(E_NOTICE | E_DEPRECATED | E_STRICT));
ini_set('display_errors', 'On');

//ini_set('error_reporting', E_ALL | E_STRICT);
//ini_set('display_errors', 'Off');

$conn  = conectarBD();
?>