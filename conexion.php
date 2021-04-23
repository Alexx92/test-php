<?php    
   $ini = parse_ini_file('scol.ini');
   
   $GLOBALS["DRIVER_NAME"]  = $ini["DRIVER_NAME"];
   $GLOBALS["SERVER_NAME"]  = $ini["SERVER_NAME"];
   $GLOBALS["BD_NAME"]      = $ini["BD_NAME"];
   $GLOBALS["BD_USER"]      = $ini["BD_USER"];
   $GLOBALS["BD_PASS"]      = $ini["BD_PASS"];

   $GLOBALS["DRIVER_NAME_VOM"]  = $ini["DRIVER_NAME_VOM"];
   $GLOBALS["SERVER_NAME_VOM"]  = $ini["SERVER_NAME_VOM"];
   $GLOBALS["BD_NAME_VOM"]      = $ini["BD_NAME_VOM"];
   $GLOBALS["BD_USER_VOM"]      = $ini["BD_USER_VOM"];
   $GLOBALS["BD_PASS_VOM"]      = $ini["BD_PASS_VOM"];
   
   $GLOBALS["SERVER_NAME_PST"]  = $ini["SERVER_NAME_PST"];
   $GLOBALS["SERVER_PORT_PST"]  = $ini["SERVER_PORT_PST"];
   $GLOBALS["BD_NAME_PST"]      = $ini["BD_NAME_PST"];
   $GLOBALS["BD_USER_PST"]      = $ini["BD_USER_PST"];
   $GLOBALS["BD_PASS_PST"]      = $ini["BD_PASS_PST"];
   
   
   
   // Rutina para eliminar caracteres raros por posible ataque via SQL injection.
   function limpia_valor($valor){
	   $valor = str_replace("'"    ,"", $valor);
       $valor = str_replace("="    ,"", $valor);
       $valor = str_replace(" or " ,"", $valor);
       $valor = str_replace(" OR " ,"", $valor);
       $valor = str_replace(" oR " ,"", $valor);
	   $valor = str_replace(" Or " ,"", $valor);
       $valor = str_replace("("    ,"", $valor);
       $valor = str_replace(")"    ,"", $valor);
	   return ($valor);
   }
	   
   function conectarBD_VOM(){
		try {
			//$conn = new PDO("sqlsrv:server=PUC-DB-01-02;Database=MT_ControlMina;", "lamparera", "lamparerad");
			$conn = new PDO($GLOBALS["DRIVER_NAME_VOM"].":server=".$GLOBALS["SERVER_NAME_VOM"].";Database=".$GLOBALS["BD_NAME_VOM"].";", $GLOBALS["BD_USER_VOM"],$GLOBALS["BD_PASS_VOM"]);
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
		} catch(Exception $e) {    
		    $txt_error = 'Error al conectar a la Base de datos VOM, verifique configuracion del driver PDO_SQLSRV en php.ini. '.$e->getMessage().'. Comunicarse con el Administrador de Base de Datos para poder utilizar el sistema.';
			include('vws/error_message.php'); 
			die();
        }  
        return $conn;
   }
   
   function conectarBD_Postgre(){
		try {  
			//$conn = pg_connect("host=172.17.35.80 port=19401 dbname=fsn_register user=eai password=integration");
			$conn = pg_connect("host=".$GLOBALS["SERVER_NAME_PST"]." port=".$GLOBALS["SERVER_PORT_PST"]." dbname=".$GLOBALS["BD_NAME_PST"]." user=".$GLOBALS["BD_USER_PST"]." password=".$GLOBALS["BD_PASS_PST"]  );
        } catch(Exception $e) {    
		    $txt_error = 'Error al conectar a la Base de datos, '.$e->getMessage().'. Comunicarse con el Administrador de Base de Datos para poder utilizar el sistema.';
			include('vws/error_message.php');  
			die();
        }  
        return $conn;
   }
   function conectarBD(){
		try {  
            //$conn = new PDO("sqlsrv:server=PUC-DB-01-02;Database=PUC_LAMPARERA;", "lamparera", "lamparerad");
			$conn = new PDO($GLOBALS["DRIVER_NAME"].":server=".$GLOBALS["SERVER_NAME"].";Database=".$GLOBALS["BD_NAME"].";",  $GLOBALS["BD_USER"], $GLOBALS["BD_PASS"] );
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
        } catch(Exception $e) {    
		    $txt_error = 'Error al conectar a la Base de datos, verifique configuracion del driver PDO_SQLSRV en php.ini. '.$e->getMessage().'. Comunicarse con el Administrador de Base de Datos para poder utilizar el sistema.';
			include('vws/error_message.php');	
			die();
        }  
        return $conn;
   }
   
   function validaSesion($conn, $idsesion){   
      $sql  = "SELECT  u.USU_NM_ID,u.USU_TX_USUARIO, p.PRF_TX_NOMBRE_PERFIL,u.BOG_NM_ID, b.BOG_TX_BODEGA, b.MIN_NM_ID";
	  $sql .= " FROM AUDITORIAS_CONEXIONES c , USUARIOS u, USUARIOS_PERFILES up, PERFILES p, BODEGAS b  ";
	  $sql .= " WHERE  c.AUC_TX_SID='".$idsesion."' and (c.AUC_TS_FECHA_HORA_DESCONEXION is NULL) and  "; 
	  $sql .= "        u.USU_NM_ID=c.USU_NM_ID and up.USU_NM_ID=u.USU_NM_ID and p.PRF_NM_ID=up.PRF_NM_ID ";
	  $sql .= "        and b.BOG_NM_ID=u.BOG_NM_ID ";
	  
	  $nomusr    = "";
	  $idusr     = "";
	  $nomrol    = "";
	  $idbodega  = "";
	  $nombodega = "";
	  $idmina = "";
	  $idfaena = "";
	  
      $stmt = $conn->query( $sql );   
      if ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {   
	      $idusr     = $row['USU_NM_ID'];
          $nomrol    = $row['PRF_TX_NOMBRE_PERFIL'];
	      $nomusr    = $row['USU_TX_USUARIO'];
	      $idbodega  = $row['BOG_NM_ID'];
	      $nombodega = $row['BOG_TX_BODEGA'];
	      $idfaena   = $row['MIN_NM_ID'];
      }
      return array($nomusr,$nomrol,$idbodega,$nombodega,$idusr,$idfaena);
   }
   
   function cierraSesion($conn, $idsesion){   
	  $sql = " update AUDITORIAS_CONEXIONES set AUC_TS_FECHA_HORA_DESCONEXION=SYSDATETIME()  ";
	  $sql .= " WHERE  AUC_TX_SID=? and (AUC_TS_FECHA_HORA_DESCONEXION is NULL)";	  
	  
	  exe_stmt($conn, $sql, [$idsesion]);
	  echo 'se desconecto correctamente';
   }
   
   function exe_stmt($conn, $sql, $valores){   
      try{  
	       $stmt = $conn->prepare($sql);  
	       $stmt->execute($valores);  			   
	  } catch(Exception $e) {  
	       die(print_r($e->getMessage()));  
	  }  
   }
?>