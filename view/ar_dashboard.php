<?php
include "../control/access_control.php";

global $UserType;

// Make sure user has the right to view this page
if($UserType != 'AR') {
    header("Location: ../PermissionDenied.php");
    exit();
}

print $UserType;

// Paul, you can get rid of these two lines. I was just testing.
echo "<h1>Successful Login</h1>";
print_r($_SESSION);


?>