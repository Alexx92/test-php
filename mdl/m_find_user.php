<?php
$error_bd = 0;
$error_ldap = 0;
$error_ldap2 = 0;
$ip = $_SERVER["REMOTE_ADDR"];
$txt_error = '';

$idrol = '';
$nomrol = '';
$idusr = '';
$idbodega = '';
$nombodega = '';
$sid = '';

$adldap = connectionToActiveDirectory();
try {
	$adldap = new adLDAP();
} catch (adLDAPException $e) {
	$error_ldap = 1;
	$txt_error = 'ERROR 1: '.$e; //No se puede realizar la conexion con Active Directory
	return $error_ldap;   
}   
if($error_ldap == 0){
	if(!authenticateUser($adldap,$user,$pass)){
		$error_ldap2 = 1;
		$txt_error = 'ERROR 2: No se puede autenticar el Usuario con Active Directory'; //Autenticación de usuario Active Directory
	}
}
//$error_ldap2 = 0; // sin active directory
if($error_ldap2 == 0){
	try {
		$sql = "select u.USU_NM_ID, u.USU_TX_USUARIO, u.USU_TX_RUT, u.USU_TX_NOMBRE, u.BOG_NM_ID, b.BOG_TX_BODEGA, p.PRF_NM_ID, p.PRF_TX_NOMBRE_PERFIL, b.MIN_NM_ID";
		$sql .= " from USUARIOS u join USUARIOS_PERFILES up on up.USU_NM_ID = u.USU_NM_ID, PERFILES p, BODEGAS b";
		$sql .= " where UPPER(u.USU_TX_USUARIO) = UPPER('".$user."')";
		$sql .= " and up.PRF_NM_ID = p.PRF_NM_ID";
		$sql .= " and (p.PRF_NM_ID <> 5)";
		$sql .= " and u.BOG_NM_ID = b.BOG_NM_ID";
		$sql .= " and u.USU_TX_ACTIVO = 'S'";
		  
		$stmt = $conn->query( $sql );   
		if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){			
		   $idrol     = $row['PRF_NM_ID'];
		   $nomrol    = $row['PRF_TX_NOMBRE_PERFIL'];
		   $idusr     = $row['USU_NM_ID']; 
		   $idbodega  = $row['BOG_NM_ID'];
		   $nombodega = $row['BOG_TX_BODEGA'];
		   $idfaena   = $row['MIN_NM_ID'];
		   $rutusr    = $row['USU_TX_RUT'];
		   $nomusr    = $row['USU_TX_NOMBRE'];
		   if ($nomrol!=""){
				$uid = md5(uniqid(rand()));
				$date = new DateTime();
				$sid = sha1("".$date->format('Y-m-d H:i:s') . $user . $nomrol) . $uid ."LL".$idbodega;
				
				$sql  = "insert into AUDITORIAS_CONEXIONES(USU_NM_ID,AUC_TS_FECHA_HORA_CONEXION, AUC_TX_IP,AUC_TX_SID, PRF_NM_ID,BOG_NM_ID,USU_TX_NOMBRE,USU_TX_ROL)";
				$sql .= " values (?,SYSDATETIME(),?,?,?,?,?,?) ";				
				try{  
					$stmt = $conn->prepare($sql);  
					$stmt->execute([$idusr,$ip,$sid,$idrol,$idbodega,$user,$nomrol]);
				}catch(Exception $e){
					$error_bd = 2;
					$txt_error = 'ERROR 3: '.$e->getMessage(); //No se pudo ejecutar sesion en BD
					die(print_r($e->getMessage()));  
				}
		   }
		}else {
		   $error_bd = 1;
		   $txt_error = 'ERROR 4: Problema al extraer datos.'; // error en traer datos desde BD
		}
	} catch(PDOException $e) {
		$error_bd = 2;
		$txt_error = 'ERROR 5: '.$e->getMessage();
	}
}
//$error_ldap = 0; // sin active directory
//$error_ldap2 = 0; // sin active directory
?>