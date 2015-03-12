<?php

include "global.php";
include "db_connect.php";



// ----------   Javascript to PHP/MySQL DateTime Formatting ---------//
// format YYYY-MM-DD HH:MM:SS
function formatMonth($month) {
	$month = $month + 1;		// Javascript uses 0-11
	if ($month < 10) {
		$month = "0".strval($month);
	} else {
		$month = strval($month);
	}
	return $month;
}
// format YYYY-MM-DD HH:MM:SS
function formatDay($day) {
	if ($day < 10) {
		$day = "0".strval($day);
	} else {
		$day = strval($day);
	}
	return $day;
}
// format YYYY-MM-DD HH:MM:SS
function formatTime($hour) {
	if ($hour < 10) {
		$hour = "0".strval($hour);
	} else {
		$hour = strval($hour);
	}
	return $hour.":00:00";	
}
// ----------   End Javascript to PHP/MySQL DateTime Formatting ---------//
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
 *	[ {AppointmentID, Year, Month, Day, Time, Patient_ID, Doctor_ID}
 *	]
 * Note: Returning an array like this makes for easy JSON parsing 
 */
function get_apps_per_month($year, $month) {
	global $db_conn;
	$year = strval($year);
	$month;
	$lowerBound = createDateBounds($year, $month);
	$upperBound = createDateBounds($year, $month, true);

	$query = 'SELECT * FROM APPOINTMENT WHERE 
	          Time BETWEEN ? AND ?';

	try {
		$statement = $db_conn->prepare($query);
		$statement->bindValue( 1 , $lowerBound);
		$statement->bindValue( 2 , $upperBound);
		$statement->execute();
		$retrieved_month_apps = $statement->fetchAll();
		$statement->closeCursor();
		return $retrieved_month_apps;
	} catch (Exception $e) {
		if($is_dev) {
		    echo "<p>Error retrieving UserType: 
             $e </p>";
		}	
		return 0;  // error	
	}
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

/**
 * TEMP TEST AREA::::::
 */
$result = get_apps_per_month(2015, 1);

print_r($result);


?>

