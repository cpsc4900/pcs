<?php

// Stores global scope information.  Note the global scope should only apply to
// a session.  In other words, the globals only exist from the time the user is
// authenticated to the time the user log's out (i.e. session expires)

/**
* Set true if in developement, if release set to false.
* This is used throughout the models for easier debugging messages enabled.
*/
$is_dev = true;

if($is_dev) {
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
} else {
	error_reporting(0);
}


?>


