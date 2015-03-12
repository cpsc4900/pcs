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


// Test
$temp_2015 = array(
array('AppointmentID' => 1 , 'Year' => 2015, 'Month' => 2, 'Day' => 21, 'Time' => 9, 'Patient_ID' => 1), 
array('AppointmentID' => 2 , 'Year' => 2015, 'Month' => 2, 'Day' => 21, 'Time' => 9, 'Patient_ID' => 2), 
array('AppointmentID' => 3 , 'Year' => 2015, 'Month' => 2, 'Day' => 21, 'Time' => 10, 'Patient_ID' => 3), 
array('AppointmentID' => 4 , 'Year' => 2015, 'Month' => 2, 'Day' => 15, 'Time' => 11, 'Patient_ID' => 4));

$temp_2014 = array(
array('AppointmentID' => 1 , 'Year' => 2014, 'Month' => 2, 'Day' => 19, 'Time' => 9, 'Patient_ID' => 1), 
array('AppointmentID' => 2 , 'Year' => 2014, 'Month' => 2, 'Day' => 18, 'Time' => 9, 'Patient_ID' => 2), 
array('AppointmentID' => 3 , 'Year' => 2014, 'Month' => 2, 'Day' => 17, 'Time' => 10, 'Patient_ID' => 3), 
array('AppointmentID' => 4 , 'Year' => 2014, 'Month' => 2, 'Day' => 16, 'Time' => 11, 'Patient_ID' => 4));

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