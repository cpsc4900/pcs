<?php
/**
*
* Authenticates a user who is attempting to login.  Login requires comparing a
* supplied username and passwords against an entry in the LOGIN table.  The initial
* connection to the database is done using a "Login" user.  This user can only access
* the Login table.  After the username and password have been validated, all following 
* queries are done using the user type of the username.
*
* The functions below support:
*			creating a sha-256 hash
* 		    retreiving a hashed password w/ a given username
*           retreiving a "User Type" w/ a given EmployeeID
*			validating username and password
*
*
**/

require "global.php";
require "../model/global_query.php";

// TODO: Store salt off-site
define('UNIQUE_SALT', '5&nL*dF4');


/*===================================================================
=            		      Local DB LOGIN                            =
===================================================================*/
$login_conn;


// Handles connecting to a database ONLY for user authentication
function init_db_conn() {
	global $login_conn;
	$dsn = "mysql:host=127.0.0.1; dbname=pcs_db";
	$username = "Login";
	$passwd = "loginpass";  // CHANGE ME
	
	// Try to connect to database.  THIS SHOULD NEVER FAIL
	try {
	     $login_conn = new PDO($dsn, $username, $passwd);
	} catch (PDOException $e) {
	    $error_message = $e->getMessage();
	    echo "<p>Error connecting to database: 
	             $error_message </p>";
	    exit();
	}
}
/*--------------------  End of Local DB LOGIN  -------------------------*/

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
 * Compares a plaintext value to its hash value.  Returns non-zero if hashes
 * match.
 * @param string $pass The user submitted password
 * @param string $hashed_pass The hashed password pulled from the database
 * @param string $hash_method The hashing method used to generate the hashed password
 * @return  Returns true if the supplied password hashed equals the stored hashed
 * password.  Otherwise, returns false.
 */
function validateLogin($pass, $hashed_pass, $hash_method = 'sha256') {
	if (function_exists('hash') && in_array($hash_method, hash_algos())) {
		return ($hashed_pass === hash($hash_method, UNIQUE_SALT . $pass));
	}
	return ($hashed_pass === sha1($hash_method, UNIQUE_SALT . $pass));
}

/**
* Retrieves a hashed password from the Login table.
* @param string $usr_name The user name of the hashed password that should be
* retrieved.
* @return string the hashed password or 0 if the supplied user name is not in
* the Login table
**/
function retrieveHashedPwd($usr_name) {
	global $login_conn;
	global $is_dev;

	$query = 'SELECT Password from LOGIN 
			  WHERE Username = ? ';

	try {
		$statement = $login_conn->prepare($query);
		$statement->bindValue( 1 , $usr_name);
		$statement->execute();
		$retrieved_hash_pwd = $statement->fetch();
		$statement->closeCursor();
		return pull_single_element('Password', $retrieved_hash_pwd);
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error retrieving hashed password: 
             $e </p>";
		}	
		return 0;  // error	
	}
} 

/**
* Retrieves the "UserType" field in the EMPLOYEE table.  Valid values for 
* "UserType" are: AR, EM, Doctor, Nurse, or MRS.
* @param int $emp_id The id of the employee.
*
**/
function retrieveUserType($emp_id) {
	global $login_conn;
	global $is_dev;

	$query = 'SELECT UserType from EMPLOYEE
			  WHERE EmployeeID = ?';
	try {
		$statement = $login_conn->prepare($query);
		$statement->bindValue( 1 , $emp_id);
		$statement->execute();
		$retrieved_user_type = $statement->fetch();
		$statement->closeCursor();
		return pull_single_element('UserType', $retrieved_user_type);
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error retrieving UserType: 
             $e </p>";
		}	
		return 0;  // error	
	}
}

/**
 * Retrieves the employee ID belonging to the supplied username.
 * @param  string $usr_name the login username to find the matching 
 * employee id for
 * @return [int] Returns the employee's ID, otherwise returns 0 if a match
 * is not found
 */
function retrieveEmployeeID($usr_name) {
	global $login_conn;
	global $is_dev;

	$query = 'SELECT EMPLOYEE_EmployeeID from LOGIN
			  WHERE Username = ?';
	try {
		$statement = $login_conn->prepare($query);
		$statement->bindValue( 1 , $usr_name);
		$statement->execute();
		$retrieved_emp_id = $statement->fetch();
		$statement->closeCursor();
		return pull_single_element('EMPLOYEE_EmployeeID', $retrieved_emp_id);
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error retrieving EmployeeID: 
             $e </p>";
		}	
		return 0;  // error	
	}
}
?>