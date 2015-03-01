<?php

/**
 * Destroy the session array on close
 *
 * $_SESSION = array();
 * session_destroy();
 */

session_destroy();

// redirect to login
header("Location: ../index.php");

?>