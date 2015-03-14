<?php

include "global.php";
include "db_connect.php";
include "../model/date_formatter.php";



/**
 * Creates either the upper or lower bounds for querying a table that contains
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

	$query = 'SELECT * FROM APPOINTMENT WHERE 
	          AppTime BETWEEN ? AND ?';

	try {
		$statement = $db_conn->prepare($query);
		$statement->bindValue( 1 , $lowerBound);
		$statement->bindValue( 2 , $upperBound);
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
 * Gets all the appointments between the begin and end date.
 * @param  [int] $year the year
 * @param  [int] $month the month (0-11)
 * @param  [int] $begin_date the first date to begin retrieving apps (inclusive)
 * @param  [int] $end_date   the last date to end retrieving apps (inclusive)
 * @return [tuple array] returns an associative array (see get_apps_per_month)
 */
function get_apps_per_time_span($year, $month, $begin_date, $end_date) {

}


/**
 * PRIVATE
 * Sets the Required fields needed to create a new appointment.
 * @param [int] $pat_id    patient's id
 * @param [int] $clinic_id clinic's id
 * @param [int] $doc_id    doctor's id
 */
function set_app_fields($pat_id, $clinic_id, $doc_id) {

}
/**
 * Adds a new appointment to the database
 * @param [type] $year  [description]
 * @param [type] $month [description]
 * @param [type] $date  [description]
 * @param [type] $hour  [description]
 */
function set_app($year, $month, $date, $hour) {

}

// removes the double entries given by all PHP Queries
function helper_filter_result($result) {
	$filtered = array();
	$temp = array();
	$i = 0;
	foreach($result as $child) {
		foreach ($child as $key => $value) {
			if (is_int($key)) {continue;}
			$temp[$key] = $value;
		}
		$filtered[$i] = $temp;
		unset($temp);
		$i += 1;
	}
	return $filtered;
}

/**
 * TEMP TEST AREA::::::
 */
/*$result = get_apps_per_month(2015, 2);
var_dump($result);*/

?>

