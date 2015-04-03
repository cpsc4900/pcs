<?php
/**
 * @file
 *
 * Handles a user logging out.  During logout, the session is stopped
 * and an activity log is added to the ACTIVITY_LOG
 */

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