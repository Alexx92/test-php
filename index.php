<?php
	include('start.php');
	include('session.php');
	if( isset( $_REQUEST['p'] ) && $_REQUEST['p']  != '' ) {
		switch( $_REQUEST['p'] ) {
			case('user_find'):
				$user = $_POST['usuario'];
				$pass = $_POST['password'];
				include('mdl/m_find_user.php');
				if($error_bd == 0 && $error_ldap == 0 && $error_ldap2 == 0){ //no hay errorres en conexion y el usuario y pass es correcto
					$_SESSION['usuario'] = $user;
					$_SESSION['idrol'] = $idrol;
					$_SESSION['nomrol'] = $nomrol;
					$_SESSION['idusr'] = $idusr;
					$_SESSION['idbodega'] = $idbodega;
					$_SESSION['nombodega'] = $nombodega;
					$_SESSION['idfaena'] = $idfaena;
					$_SESSION['rutusr'] = $rutusr;
					$_SESSION['nomusr'] = $nomusr;
					$_SESSION['sid'] = $sid;
					
					if($_SESSION['idbodega'] == '21'){ //21 sin bodega asignada
						$tip = 1;
						include('vws/default_bod.php');
					}else{
						include('vws/default.php');
					}
				}else{
					include('vws/error_message.php');	
				}
			break;
			
			case('user_find2'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					$tip = $_POST['tip']; 
					$bodega_faena = $_POST['bodega'];
					$bfs = explode("_", $bodega_faena);
					$bodega = $bfs[0];
					$idfaena = $bfs[1];
					$b_text = $_POST['b_text'];
					$idusr = $_SESSION['idusr'];
					include('start_ajax.php');
					include('mdl/m_update_user_sql.php');
					if($error_uusr == ''){
						$_SESSION['idbodega'] = $bodega;
						$_SESSION['nombodega'] = $b_text;
						$_SESSION['idfaena'] = $idfaena;
						include('vws/default.php');
					}
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('update_bod'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					$tip = 2;
					include('vws/default_bod.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('imina'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/imina.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('smina'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/smina.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('usrs'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/usrs.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('stck'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/stck.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('inf'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/inf.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('inicio'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					include('vws/default.php');
				}else {
					include('vws/restricted.php');	
				}
			break;
			
			case('close_session'):
				if ( isset($_SESSION['usuario']) && $_SESSION['usuario'] != '' &&
					isset($_SESSION['sid']) && $_SESSION['sid'] != ''){
					cierraSesion($conn, $_SESSION['sid']);
					session_start();
					unset($_SESSION["usuario"]);
					unset($_SESSION["idrol"]);
					unset($_SESSION["nomrol"]);
					unset($_SESSION["idusr"]);
					unset($_SESSION["idbodega"]);
					unset($_SESSION["nombodega"]);
					unset($_SESSION["sid"]);
					unset($_SESSION["tiempo"]);
					session_destroy();
					header("Location: index.php?p=pr&pr=1");
					exit;
				}else {	
					include('vws/restricted.php');	
				}
			break;
			
			case('pr'):
				$pr= $_GET['pr'];
				include('vws/login.php');
			break;
		}
	}else{
		include('vws/login.php');
	}
?>