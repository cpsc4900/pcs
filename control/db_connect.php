<?php

require "global.php";

// Handles connecting to a database

$dsn = "mysql:host=127.0.0.1; dbname=pcs_db";
$username = "Master";
$passwd = "masterpass";  // CHANGE ME


// Try to connect to database.  THIS SHOULD NEVER FAIL
try {
    $db_conn = new PDO($dsn, $username, $passwd);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>Error connecting to database: 
             $error_message </p>";
    exit();
}

?>