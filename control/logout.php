<?php

include "handle_activity_log.php";
/**
 * Destroy the session array on close
 *
 * $_SESSION = array();
 * session_destroy();
 */
update_activity_log('UserLogout', $_SESSION['EmployeeID']);
session_destroy();

// redirect to login
header("Location: ../index.php");

?>