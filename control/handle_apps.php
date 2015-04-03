<?php
/**
 * @file 
 *
 * Handles retrieving and setting appointments for the AR Dashboard's  app_form module.
 * See model/app_form.php for the model details.
 */
session_start();
include "global.php";
include "db_connect.php";
include "global_query.php";



/**
 * Helper function: Creates either the upper or lower bounds for querying a table that contains
 * a datetime field.  Use the $uppperBound param to determine if the return
 * datetime is upper bound or not.
 * @param  integer  $year 
 * @param  integer  $month 0-11     
 * @param  boolean $upperBound default (false) returns the lower bound of the month.
 * If true, returns the upper bound of the month. For lower bound, the first day of
 * the month with HH:MM:SS = 00:00:00.  For upper bound, uses the last day of the 
 * month with HH:MM:SS = 23:59:59
 * @return string returns a datetime format ready for querying a MySQL datetime column.
 */
function createDateBounds($year, $month, $upperBound = false) {
	if ($upperBound) {
		$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	} else {
		$day = 1;
	}
	$dateTime = strval($year)."-".formatMonth($month)."-".formatDay($day)." ";
	if ($upperBound) {
		$dateTime = $dateTime."23:59:59";
	} else {
		$dateTime = $dateTime."00:00:00";
	}
	return $dateTime;
}
/**
 * Returns an array of appointments belonging to the month
 * @param  [int] $month the month to retrieve appointments for (0-11)
 * @return [tuple array] returns an associative array with a hiearchy of:
 *
 *	'AppointmentID' => string '2' (length=1)
 *  'AppTime' => string '2015-03-17 11:15:00' (length=19)
 *  'ShowedUp' => string '0' (length=1)
 *  'ClinicID' => string '2' (length=1)
 *  'PatientID' => string '2' (length=1)
 *  'EmployeeID' => string '1' (length=1) 
 */
function get_apps_per_month($year, $month) {
	global $db_conn;
	$year = strval($year);
	$month;
	$lowerBound = createDateBounds($year, $month);
	$upperBound = createDateBounds($year, $month, true);
	$clinicID = $_SESSION['ClinicID'];

	$query = 'SELECT * FROM APPOINTMENT WHERE 
	          (AppTime BETWEEN ? AND ?) AND
	          (ClinicID = ?)';

	try {
		$statement = $db_conn->prepare($query);
		$statement->bindValue( 1 , $lowerBound);
		$statement->bindValue( 2 , $upperBound);
		$statement->bindValue( 3 , $clinicID);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$retrieved_month_apps = helper_filter_result($result);					// filter
		return $retrieved_month_apps;
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
		}	
		return 0;  // error	
	}
}

/**
 * Formats the monthly report of appointments into an array of arrays, structured as:
 * array('AppointmentID' => '2' , "AppTime" => "2015-03-17 13:00:00", "PatientID" => "1", "EmployeeID" => "2")
 * @param  [type] $app_array the array returned by get_apps_per_month
 * @return [type]            [description]
 */
function reformat_month_apps($app_array) {
	$reformatted = array();
	$temp = array();
	$i = 0;
	foreach ($app_array as $child) {
		foreach ($child as $key => $value) {
			if ($key == 'ShowedUp' || $key == 'ClinicID') {
				continue;
			}
			$temp[$key] = $value;
		}
		$reformatted[$i] = $temp;
		unset($temp);
		$i += 1;
	}
	return $reformatted;
}

// returns JSON format
function jsonfy_apps_per_month($app_array) {
	return json_encode($app_array);
}


/**
 * Adds a new appointment to the database. Returns true if the appointment was
 * added. Otherwise, returns false;
 * @param [string] $date_time  mySQL formatted datetime string
 * @param [int] $pat_id  the patients id
 * @param [int] $doc_id  the doctors_id
 * @precondition, user must be logged in for clinic_id retrieval.
 */
function set_new_app($date_time, $pat_id, $doc_id) {
	global $db_conn;

	$clinicID = $_SESSION['ClinicID'];

	$query = 'INSERT INTO APPOINTMENT(AppTime, ClinicID, PatientID, EmployeeID) 
			  VALUES (?, ?, ?, ?)';
	try {
		$statement = $db_conn->prepare($query);
		$statement->bindValue( 1 , $date_time);
		$statement->bindValue( 2 , $clinicID);
		$statement->bindValue( 3 , $pat_id);
		$statement->bindValue( 4 , $doc_id);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error setting APPOINTMENT: 
             $e </p>";
		}	
		return 0;  // error	
	}
}

/*==========================================================
=            Handle New Appointment                       =
==========================================================*/
if (isset($_POST['pat_id']) && isset($_POST['doc_id']) && isset($_POST['appDate'])) {
	set_new_app($_POST['appDate'],$_POST['pat_id'], $_POST['doc_id']);
	header("Location: ../view/ar_dashboard.php");    // Back to AR Dashboard
    exit();
}
/*-----  End of Handle New Appointment  ------*/


/**
 * TEMP TEST AREA::::::
 */
/*$result = get_apps_per_month(2015, 2);
var_dump($result);*/

// test passed 3/14/2015
/*$result = set_new_app("2015-04-17 10:00:00", 1, 1);
var_dump($result);*/

?>

