<?php
/**
 * Autenticación contra Active Directory.
 * @param  adLDAP $adldap   Instancia de conexión LDAP
 * @param  string $username Nombre de usuario
 * @param  string $pass     Contraseña de usuario
 * @return boolean          Resultado de autenticación. True en caso de éxito, False en caso contrario.
 */
function authenticateUser(adLDAP $adldap, $username,$pass){
	return $adldap->authenticate('cobre\\' . $username, $pass); 
}
/*
 * Conexion contra Active Directory
 * @return mixed Si conecta, entonces devuelve la instacia de conexión. Si no conecta retorna error.
 */
function connectionToActiveDirectory(){
	try {
		$adldap = new adLDAP();
		return $adldap;
	}catch (adLDAPException $e) {
		return $e;   
	}
}
?>