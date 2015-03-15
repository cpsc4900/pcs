<?php
include "../control/handle_apps.php";

/*+-----------------+--------------+------+-----+---------+----------------+
| Field           | Type         | Null | Key | Default | Extra          |
+-----------------+--------------+------+-----+---------+----------------+
| AppointmentID   | int(11)      | NO   | PRI | NULL    | auto_increment |
| Time            | datetime     | NO   |     | NULL    |                |
| ShowedUp        | tinyint(1)   | YES  |     | 0       |                |
| CLINIC_ClinicID | mediumint(9) | NO   |     | NULL    |                |
| Patient_ID
+-----------------+--------------+------+-----+---------+----------------+
MySQL
datetime format = 'YYYY-MM-DD HH:MM:SS'

PHP
$date = new DateTime('2000-01-10 12:00:00');
$formatDate = $date->format('Y-m-d H:i:s');
*/

// Query notes: be sure to format in ASC from time
// Query should be limited to Clinic via SessionID


// Test
/*$temp_2015 = array(
array('AppointmentID' => "2" , "AppTime" => "2015-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "3" , "AppTime" => "2015-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "4" , "AppTime" => "2015-03-18 13:00:00", "PatientID" => "1", "EmployeeID" => "1"));

$temp_2014 = array(
array('AppointmentID' => "1", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "2", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "3", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "4", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"));
*/
if (isset($_POST["month"]) && isset($_POST["year"])) {
	$apps_per_month = get_apps_per_month($_POST["year"], $_POST["month"]);
	$apps_per_month = reformat_month_apps($apps_per_month);		// format
	$apps_per_month = jsonfy_apps_per_month($apps_per_month);	// json encode
    echo $apps_per_month;
} else {
    // Just circle back to dashboard
    header("Location: ../view/ar_dashboard.php");    // AR Dashboard
    exit();
}

?>