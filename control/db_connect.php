<?php

require "../control/global.php";

// Handles connecting to a database

$dsn = "mysql:host=127.0.0.1; dbname=pcs_db";
$username = "Login";
$passwd = "loginpass";  // CHANGE ME


if($is_dev) {  // (GLOBAL) Are we developing?
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);  // show errors
} else {
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT);  // hide errors
}


// Try to connect to database.  THIS SHOULD NEVER FAIL
try {
    global $db_conn = new PDO($dsn, $username, $passwd, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: 
             $error_message </p>";
    exit();
}

?>