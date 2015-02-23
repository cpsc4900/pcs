<?php
/**
*
* Authenticates a user who is attempting to login
*
**/
define('UNIQUE_SALT', '5&nL*dF4');


/**
* Hashes a string
* @param string $string The string to hash
* @param string $hash_method the hash to use
**/

function create_hash($string, $hash_method = 'sha256') {
	if (function_exists('hash') && in_array($hash_method, hash_algos())) {
		return hash($hash_method, UNIQUE_SALT . $string);
	}
	return sha1(UNIQUE_SALT . $string);
}


/**
 * @param string $pass The user submitted password
 * @param string $hashed_pass The hashed password pulled from the database
 * @param string $hash_method The hashing method used to generate the hashed password
 */
function validateLogin($pass, $hashed_pass, $hash_method = 'sha256') {
	if (function_exists('hash') && in_array($hash_method, hash_algos())) {
		return ($hashed_pass === hash($hash_method, UNIQUE_SALT . $pass));
	}
	return ($hashed_pass === sha1($hash_method, UNIQUE_SALT . $pass));
}




?>