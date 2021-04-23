<?php
/**
 * Autenticaci�n contra Active Directory.
 * @param  adLDAP $adldap   Instancia de conexi�n LDAP
 * @param  string $username Nombre de usuario
 * @param  string $pass     Contrase�a de usuario
 * @return boolean          Resultado de autenticaci�n. True en caso de �xito, False en caso contrario.
 */
function authenticateUser(adLDAP $adldap, $username,$pass){
	return $adldap->authenticate('cobre\\' . $username, $pass); 
}
/*
 * Conexion contra Active Directory
 * @return mixed Si conecta, entonces devuelve la instacia de conexi�n. Si no conecta retorna error.
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