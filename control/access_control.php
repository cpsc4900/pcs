<?php
session_start();
/**
*
* Controls user's ability to access particular pages.  This file should
* be included with all files that EXCEPT for the Login Page.
*
**/

if (isset($_SESSION['EmployeeID']))  {
$EmployeeID = $_SESSION['EmployeeID'];
}
if (isset($_SESSION['UserType'])) {
$UserType = $_SESSION['UserType'];
}
if (isset($_SESSION['ClinicID']))  {
$ClinicID = $_SESSION['ClinicID'];
}
if (isset($_SESSION['StartTime']))  {
$StartTime = $_SESSION['StartTime'];
}


/*print $EmployeeID. "<br/>";
print $UserType  . "<br/>";
print $StartTime . "<br/>";
print $ClinicID  . "<br/>";*/

?>