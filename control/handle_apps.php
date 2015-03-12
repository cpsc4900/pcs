<?php

include "global.php";
include "db_connect.php";


/**
 * Returns an array of appointments belonging to the month
 * @param  [int] $month the month to retrieve appointments for (0-11)
 * @return [tuple array] returns an associative array with a hiearchy of:
 *
 *				[Month: 
 *					[Date
 *						{Hour
 *							[app ids @ hour 1]
 *							[app ids @ hour 2]
 *							...
 *						 }
 *				     ]
 *				  ]
 * Note: Returning an array like this makes for easy JSON parsing 
 */
function get_apps_per_month($month) {

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





?>

