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
// Probably best to abstract date, year, month, and time from datetime
// Will also need DoctorID
// Query should be limited to Clinic via SessionID
// {"AppointmentID":"1","AppTime":"2015-03-17 13:30:00","ShowedUp":"0","ClinicID":"2","PatientID":"1","EmployeeID":"1"}


// Test
$temp_2015 = array(
array('AppointmentID' => "2" , "AppTime" => "2015-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "3" , "AppTime" => "2015-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "4" , "AppTime" => "2015-03-18 13:00:00", "PatientID" => "1", "EmployeeID" => "1"));

$temp_2014 = array(
array('AppointmentID' => "1", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "2", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "3", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"), 
array('AppointmentID' => "4", "AppTime" => "2014-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "1"));

if (isset($_POST["month"]) && isset($_POST["year"])) {
  if ($_POST["year"] == 2015) {
    echo json_encode($temp_2015);
  }
  if ($_POST["year"] == 2014) {
    echo json_encode($temp_2014);
  }
  
} else {
  echo "MonthNotPassed";
}

?>