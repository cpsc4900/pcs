<?php
session_start();
include "db_connect.php";
include "../model/date_formatter.php";
include "../model/num_gen.php";

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

/**
 * Gets the address id specified by the supplied fields
 * @param  [string] $street the street address
 * @param  [string] $city   the city
 * @param  [string] $state  the state
 * @param  [int] $zip       the zip code
 * @return [string]         the address id of the found address, if no address
 *                          is found, returns 0. 
 */
function get_address_id($street, $city, $state, $zip) {
    global $db_conn;
    $query = 'SELECT AddressID FROM ADDRESS WHERE 
              Street = ? AND City = ? AND State = ? AND Zip = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $street);
        $statement->bindValue( 2 , $city);
        $statement->bindValue( 3 , $state);
        $statement->bindValue( 4 , $zip);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        $result = pull_single_element('AddressID', $result);
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return 0;  // error 
    }    
}

/**
 * Sets a new address record into the ADDRESS table.  Returns the AddressID of
 * the newly created address. If failure, returns zero.
 * @param [type] $stAdd [description]
 * @param [type] $city  [description]
 * @param [type] $state [description]
 * @param [type] $zip   [description]
 */
function set_new_address($stAdd, $city, $state, $zip) {
    global $db_conn;

    $query = 'INSERT INTO ADDRESS (Street, City, State, Zip)
              VALUES(?, ?, ?, ?)';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $stAdd);
        $statement->bindValue( 2 , $city);
        $statement->bindValue( 3 , $state);
        $statement->bindValue( 4 , $zip);
        $statement->execute();
        $statement->closeCursor();
        return $list_of_docs;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error inseting Address: 
             $e </p>";
        }   
        return 0;  // error 
    } 
}

/**
 * Creates a new Patient along with a new address belonging to the patient
 * @param [string] $fname     
 * @param [string] $lastName  
 * @param [string] $patSSN    
 * @param [string] $phoneNum  todo add a phone number field to the PATIENT table 
 * @param [string] $genderChk 
 * @param [string] $patBday   
 * @param [string] $patStAdd  
 * @param [string] $patCity   
 * @param [string] $patZip    
 * @param [string] $patState  
 */
function set_new_pat_record($fname, $lastName, $patSSN, $phoneNum, $genderChk, 
                            $patBday, $patStAdd, $patCity, $patState, $patZip) {
    global $db_conn;

    // add new address, and get the addressID
    set_new_address($patStAdd, $patCity, $patState, $patZip);
    $addId = get_address_id($patStAdd, $patCity, $patState, $patZip);

    // generate a random alphanumeric value for the patient num
    $patNum = gen_ran_patient_num();

    $query = 'INSERT INTO PATIENT (Fname, Lname, SSN, Birthdate, Sex, AddressID,
              PatientNum)
              VALUES(?, ?, ?, ?, ?, ?, ?)';
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $fname);
        $statement->bindValue( 2 , $lastName);
        $statement->bindValue( 3 , $patSSN);
        $statement->bindValue( 4 , $patBday);
        $statement->bindValue( 5 , $genderChk);
        $statement->bindValue( 6 , $addId);
        $statement->bindValue( 7 , $patNum);
        $isInserted = $statement->execute();
        $statement->closeCursor();
        if ($isInserted) {
            return 1;   // TODO Return new patient ID for adding new appointment
        } else {
            return 0;                                     // Insert did not work
        }
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error inseting Address: 
             $e </p>";
        }   
        return 0;  // error 
    } 
}

/**
 * Returns an array of appointments per hour in the following format:
 *
 * +-----------+----------+-------+--------------+------------+---------------------+---------------+
 * | PatientID | Lname    | Fname | DocFullName  | EmployeeID | AppTime             | AppointmentID |
 * +-----------+----------+-------+--------------+------------+---------------------+---------------+
 * |         3 | Columbus | Chris | the Doc, Doc |          3 | 2015-03-02 10:00:00 |           103 |
 * +-----------+----------+-------+--------------+------------+---------------------+---------------+
 *                                     ^
 *                                     |
 *                                     Doctors full name as one field
 *                                        
 * @param  [string] $datetime formatted datetime 
 * 
 */
function get_apps_per_datetime($datetime) {
    global $db_conn;
    if ($datetime == null) {
        return "No DateTime supplied";
    }
    $query = 'SELECT pat.PatientID, pat.Lname, pat.Fname, 
              CONCAT_WS(\', \', doc.Lname, doc.Fname) AS DocFullName, doc.EmployeeID,
              app.AppTime, app.AppointmentID 
              FROM PATIENT pat 
              INNER JOIN APPOINTMENT app 
              ON app.AppTime = ? AND app.PatientID = pat.PatientID 
              INNER JOIN EMPLOYEE doc ON app.AppTime = ? 
              AND app.EmployeeID = doc.EmployeeID';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $datetime);
        $statement->bindValue( 2 , $datetime);
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

/**
 * Removes an appointment. Returns 1 for success, otherwise returns 0
 * @param  [type] $app_id [description]
 * @return [type]         [description]
 */
function remove_app($app_id) {
    global $db_conn;
    if ($app_id == null) {
        return 0;
    }
    $query = 'delete from APPOINTMENT where AppointmentID = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $app_id);
        $statement->execute();
        $statement->closeCursor();
        return 1;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error deleting APPOINTMENT: 
             $e </p>";
        } 
        return 0;  // error 
    }    

}
/*------------------     End of Appointment Queries  -------------------------*/

/*==============================================================================
=                       Primary Patient Record Queries                         =
==============================================================================*/

/**
 * Searches for patient record(s). Returns both PATIENT and ADDRESS results
 * @param  [string] $criteria the criteria to search by.  Valid values are 
 *                  ssn | lname | patid 
 * @param  [string] $value  the value to search for.
 * @return [array]  an array of the results
 */
function search_for_patient_primary($criteria, $value) {
    global $db_conn;   

    $statement = "";
    switch ($criteria) {                              // prepare query statement
        case 'ssn':
            $statement = make_query_pat_primary_by_ssn($value);
            break;
        case 'lname':
            $statement = make_query_pat_primary_by_lname($value);
            break;
        case 'patid':
            $statement = make_query_pat_primary_by_patid($value);
            break;
        default:
            return 0;
            break;
    }
    try {
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);                 // filter
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Patient Primary Record: 
             $e </p>";
        }   
        return 0;  // error 
    }
}

// private: used with search_for_patient_primary
function make_query_pat_primary_by_ssn($value) {
    global $db_conn;
    $query = 'SELECT PATIENT.*, ADDRESS.* FROM PATIENT, ADDRESS WHERE 
              PATIENT.AddressID = ADDRESS.AddressID AND PATIENT.SSN = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
}
// private: used with search_for_patient_primary
function make_query_pat_primary_by_lname($value) {
   global $db_conn;
    $query = 'SELECT PATIENT.*, ADDRESS.* FROM PATIENT, ADDRESS WHERE 
              PATIENT.AddressID = ADDRESS.AddressID AND PATIENT.Lname = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
    
}
// private: used with search_for_patient_primary
function make_query_pat_primary_by_patid($value) {
    global $db_conn;
    $query = 'SELECT PATIENT.*, ADDRESS.* FROM PATIENT, ADDRESS WHERE 
              PATIENT.AddressID = ADDRESS.AddressID AND PATIENT.PatientID = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
}

function update_pat_record($patid, $fname, $lname, $ssn, $bday, $phoneNum, 
                                           $gender, $street, $city, $state, $zip) {
    global $db_conn;

    $query = 'UPDATE PATIENT,ADDRESS SET PATIENT.Fname = ?, PATIENT.Lname = ?,
              PATIENT.SSN = ?, PATIENT.Birthdate = ?, PATIENT.Sex = ?, ADDRESS.Street = ?,
              ADDRESS.City = ?, ADDRESS.State = ?, ADDRESS.Zip = ? WHERE
              PATIENT.PatientID = ? AND PATIENT.AddressID = ADDRESS.AddressID';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $fname);
        $statement->bindValue( 2 , $lname);
        $statement->bindValue( 3 , $ssn);
        $statement->bindValue( 4 , $bday);
        $statement->bindValue( 5 , $gender);
        $statement->bindValue( 6 , $street);
        $statement->bindValue( 7 , $city);
        $statement->bindValue( 8 , $state);
        $statement->bindValue( 9 , $zip);
        $statement->bindValue( 10 , $patid);

        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error Updating Patient Primary & address: 
             $e </p>";
        }   
        return 0;  // error 
    }    
}



/*-------------      End of Primary Patient Record Queries      --------------*/


/*==============================================================================
=                      Doctor and Nurse Related  Get Queries                   =
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

/**
 * Gets patient id, last name, first name, and SSN of all the patients. Mostly used for 
 * javascript search bars.
 * @return [array] array of last name to patient id mapping (tuples)
 */
function get_patient_id_name_ssn_map() {
    global $db_conn;

    $query = 'SELECT PatientID, Fname, Lname, SSN  FROM PATIENT';

    try {
        $statement = $db_conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return helper_filter_result($result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Lname, PatientID from PATIENT: 
             $e </p>";
        }   
        return "PATIENT Empty";  // error 
    }    
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
            echo "<p>Error retrieving  Lname FROM PATIENT: 
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
            echo "<p>Error retrieving Fname FROM PATIENT: 
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

/*------------------     End of Doc and Nurse Queries  -----------------------*/





//**************************    Temp Test Queries ******************************
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

/*$result = get_patient_id_lname_ssn_map();
foreach ($result as $child) {
    print "child = <br/>";
    foreach ($child as $key => $value) {
    print $key. "=>". $value. "<br/>";
        # code...
    }
    print "endOfchild <br/>";
}*/

/*$result = get_apps_per_datetime("2015-03-04 10:00:00");
foreach ($result as $child) {
    print "child = <br/>";
    foreach ($child as $key => $value) {
        print $key. "=>". $value. "<br/>";
    }
    print "endOfchild <br/>";
}*/

/*
$result = get_address_id('4019 Lost Oak Drive', 'Ooltewah', 'TN', '37363');
print $result;

$result = get_address_id("753 Easy Way", "Chattanooga", "TN",  "37421");
print $result;
*/


/*$result = set_new_pat_record("Bob", "Hope", "8887774646", "1236545555", "male",
                            "1982-12-23", "4545 Cummings Hwy", "Roanoke", "VA", "45685");

print $result;*/
?>