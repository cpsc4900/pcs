<?php
session_start();
include "db_connect.php";
include "../model/date_formatter.php";

/*=============================================================================
=                         Global Formatting                                   =
==============================================================================*/

// get a single value from an array of tuples (key => value)
// precondition must only contain a single tuple relationship
function pull_single_element($index, $statement_array) {
	return $statement_array[$index];
}

/**
 * Removes the double entries given by all PHP Queries. PDO objects return arrays
 * with double entries.  One form of the entry is "key => value" and the other is
 * int => value.  This function removes the int => value.  So, the returned array
 * has only the key => value pairs.
 *
 * @precondition a single layer of arrays must be passed. For example:
 *
 *      Array[                <=== Will Work
 *          array1[]
 *          array2[]
 *      ]
 *
 *      Array[                  <=== Will Not Work
 *          array1[
 *              array2[]
 *          ]
 *      ]
 */
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

/*------------------    End of Global Formatting        ----------------------*/


/*==============================================================================
=                           Appointment Queries                                =
==============================================================================*/


/**
 * Returns an array of the appointments per week
 * @param  [type] $year  [description]
 * @param  [type] $month [description]
 * @param  [type] $week  1-5   (1st through 5th week)
 * @return [type]        [description]
 */
function get_weekly_appointments($year, $month, $week) {
    global $db_conn;
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
    global $db_conn;
}

/*------------------     End of Appointment Queries  -------------------------*/

/*==============================================================================
=                      Doctor and Nurse Related Queries                        =
==============================================================================*/

/**
 * Returns an array of the Doctors belonging to a particular clinic.
 * @param [int] $clinic_id The clinic_id of which the doctors belong to.  Note, default
 * is to use session info of currently logged in person.
 * @return [array] a list of doctors.
 */
function get_list_of_doctor_names_and_ids($clinic_id = null) {
    global $db_conn;

    if ($clinic_id == null) {
        $clinic_id = $_SESSION['ClinicID'];
    }
    $query = 'SELECT Fname, Lname, EmployeeID FROM EMPLOYEE WHERE 
              ClinicID = ? AND UserType = \'Doctor\'';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $clinic_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $list_of_docs = helper_filter_result($result);                 // filter
        return $list_of_docs;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return 0;  // error 
    }
}

function get_patient_list() {

}

// returns the last name of the patient specified by $pat_id
function get_last_name_of_patient($pat_id) {
    global $db_conn;
    if ($pat_id == null) {
        return "No Patient ID supplied";
    }
    $query = 'SELECT Lname FROM PATIENT WHERE 
              PatientID = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return pull_single_element('Lname', $result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return "Patient DnE";  // error 
    }    
}

// returns the first name of the patient specified by $pat_id
function get_first_name_of_patient($pat_id) {
    global $db_conn;
    if ($pat_id == null) {
        return "No Patient ID supplied";
    }
    $query = 'SELECT Fname FROM PATIENT WHERE 
              PatientID = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return pull_single_element('Fname', $result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return "Patient DnE";  // error 
    }    
}

// returns the full name of the patient specified by $pat_id
function get_full_name_of_patient($pat_id) {
    global $db_conn;
    if ($pat_id == null) {
        return "No Patient ID supplied";
    }
    $query = 'SELECT Fname, Lname FROM PATIENT WHERE 
              PatientID = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return helper_filter_result($result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return "Patient DnE";  // error 
    }    
}

// Test
/*$result = get_list_of_doctor_names_and_ids();
foreach ($result as $child) {
    print "child = <br/>";
    foreach ($child as $key => $value) {
    print $key. "=>". $value. "<br/>";
        # code...
    }
    print "endOfchild <br/>";
}*/


/*$result = get_first_name_of_patient(1);
var_dump($result);
*/


/*------------------     End of Doc and Nurse Queries  -----------------------*/
?>