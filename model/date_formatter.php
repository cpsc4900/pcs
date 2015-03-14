<?php

/**
 * Javascript uses 0-11 for months. MySQL uses 1-12
 * MySQL requires two digit format for months, days, hours, and minutes.
 * This file handles these conversions for Quering the database.
 *
 * Specifically, to query a datetime field in MySQL, call formatDateTime from
 * here.
 *
 *
 * For example, to query using March 5, 2015  1:00pm
 *
 *      $datetime = formatDateTime(2015, 2, 5, 13);
 *
 * Note: months 0-11
 *       hours  0-23
 */



// ----------   Javascript to PHP/MySQL DateTime Formatting ---------//
// format YYYY-MM-DD HH:MM:SS
function formatMonth($month) {
    $month = $month + 1;        // Javascript uses 0-11
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

function formatDateTime($year, $month, $day, $hour) {
    $datetime = strval($year)."-".formatMonth($month)."-".formatDay($day)." ";
    $datetime = $datetime.formatHour($hour).":00:00";
    return $datetime;
}





?>