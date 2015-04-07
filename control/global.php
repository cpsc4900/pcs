<?php

// Stores global scope information.  Note the global scope should only apply to
// a session.  In other words, the globals only exist from the time the user is
// authenticated to the time the user log's out (i.e. session expires)

/**
* Set true if in developement, if release set to false.
* This is used throughout the models for easier debugging messages enabled.
*/
$is_dev = false;

if($is_dev) {
	error_reporting(E_ALL | E_ERROR | E_WARNING | E_PARSE);
} else {
	error_reporting(0);
}

define('MAX_APPS_PER_HOUR', 3);

// Supress Notices of unused variable REMOVE me !!!
if (MAX_APPS_PER_HOUR == 3) {
    $x = 0;
}

?>


