<?php

/**
 * @file
 *
 * Handles most of the queries to the database.  Queries are organized
 * based on functionality.  Functions labeled as 'private' should not be
 * called directly.
 */

include "db_connect.php";
include "handle_activity_log.php";
include "../model/date_formatter.php";
include "../model/num_gen.php";

/*=============================================================================
=                         Global Formatting/Queries                            =
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

/**
 * Gets the user type from the supplied id number
 * @param  [type] $id the employee's id to search for
 * @return string     if the employee does not exist in the database, then returns
 *                    'EDE', otherwise returns the user type found
 */
function get_user_type($id) {
    global $db_conn;
    $query = 'SELECT UserType FROM EMPLOYEE WHERE 
              EmployeeID = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        $result = pull_single_element('UserType', $result);
        if ($result == null) {
            $result = "EDE";
        }
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving APPOINTMENT: 
             $e </p>";
        }   
        return 0;  // error 
    }     
}




/*------------------    End of Global Formatting/Queries ----------------------*/


/*==============================================================================
=                           Appointment Queries                                =
==============================================================================*/


/**
 * Gets all the appointments between the begin and end date.
 * @param  [int] $year the year
 * @param  [int] $month the month (0-11)
 * @param  [int] $begin_date the first date to begin retrieving apps (inclusive)
 * @param  [int] $end_date   the last date to end retrieving apps (inclusive)
 * @return [tuple array] returns an associative array (see get_apps_per_month)
 */
function get_apps_per_doc_id_and_date($doc_id, $datetime = "empty") {
    global $db_conn;
    if ($datetime == "empty") {
        $datetime = date("Y-m-d");
        $date_begin = $datetime . " 00:00:00";
        $date_end = $datetime . " 23:59:59";
    } else {
        $temp = date_create($datetime);
        $date_begin = date_format($temp, "Y-m-d") . " 00:00:00";
        $date_end = date_format($temp, "Y-m-d") . " 23:59:59";
    }

    $query = 'SELECT pat.PatientID, pat.Lname, pat.Fname, 
              app.AppTime, app.AppointmentID, app.EmployeeID 
              FROM PATIENT pat 
              INNER JOIN APPOINTMENT app 
              ON app.AppTime BETWEEN ? AND ?
              AND pat.PatientID = app.PatientID AND app.EmployeeID = ?
              ORDER BY AppTime DESC';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $date_begin);
        $statement->bindValue( 2 , $date_end);
        $statement->bindValue( 3 , $doc_id);
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
        return $db_conn->lastInsertID();
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
function set_new_pat_record($fname, $lastName, $patSSN, $phoneNum, $genderChk, $patBday, $patStAdd, $patCity, $patState, $patZip) {
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
        $lastInsert = $db_conn->lastInsertID();
        update_activity_log('PrimaryNew', $_SESSION['EmployeeID'], $lastInsert);
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

/**
 * Updates a Patient's Primary Record.
 * @param  [string] $patid    [description]
 * @param  [string] $fname    [description]
 * @param  [string] $lname    [description]
 * @param  [string] $ssn      [description]
 * @param  [string] $bday     [description]
 * @param  [string] $phoneNum [description]
 * @param  [string] $gender   [description]
 * @param  [string] $street   [description]
 * @param  [string] $city     [description]
 * @param  [string] $state    [description]
 * @param  [string] $zip      [description]
 * @return Returns non-zero value upon success, otherwise returns zero
 */
function update_pat_record($patid, $fname, $lname, $ssn, $bday, $phoneNum, $gender, $street, $city, $state, $zip) {
    global $db_conn;

    $query = 'UPDATE PATIENT,ADDRESS SET PATIENT.Fname = ?, PATIENT.Lname = ?,
              PATIENT.SSN = ?, PATIENT.Birthdate = ?, PATIENT.Sex = ?, PATIENT.PhoneNum = ?, 
              ADDRESS.Street = ?, ADDRESS.City = ?, ADDRESS.State = ?, ADDRESS.Zip = ? WHERE 
              PATIENT.PatientID = ? AND PATIENT.AddressID = ADDRESS.AddressID';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $fname);
        $statement->bindValue( 2 , $lname);
        $statement->bindValue( 3 , $ssn);
        $statement->bindValue( 4 , $bday);
        $statement->bindValue( 5 , $gender);
        $statement->bindValue( 6 , $phoneNum);
        $statement->bindValue( 7 , $street);
        $statement->bindValue( 8 , $city);
        $statement->bindValue( 9 , $state);
        $statement->bindValue( 10 , $zip);
        $statement->bindValue( 11 , $patid);

        $result = $statement->execute();
        $statement->closeCursor();
        $lastUpate = $db_conn->lastInsertID();
        update_activity_log('PrimaryEdit', $_SESSION['EmployeeID'], $lastUpate);
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
            echo "<p>Error retrieving Doctor: 
             $e </p>";
        }   
        return 0;  // error 
    }
}
/**
 * Returns an array of all the Doctors
 * 
 * @return [array] a list of doctors.
 */
function get_list_of_all_doctor_names_and_ids() {
    global $db_conn;

    $query = 'SELECT Fname, Lname, EmployeeID FROM EMPLOYEE WHERE 
              UserType = \'Doctor\'';

    try {
        $statement = $db_conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $list_of_docs = helper_filter_result($result);                 // filter
        return $list_of_docs;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Doctor: 
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

/**
 * Returns true if $doc_id is the employee of id of a 'Doctor' employee UserType
 * @param  [string | int]  $doc_id the id of the employee in question
 * @return boolean         true if $doc_id is of UserType 'Doctor', otherwise 
 *                         returns false.
 */
function is_doctor($doc_id) {
    $usr_type = get_user_type($doc_id);
    if ($usr_type == 'Doctor') {
        return true;
    } else {
        return false;
    } 
}

/*------------------     End of Doc and Nurse Queries  -----------------------*/

/*=========================================================================
=                      Get Medical Record Related Queries                          =
==============================================================================*/

// NOTE: These nested selects are not effecient, should use JOIN, but no time


/**
 * Gets the allergies belonging to a patient by patient id
 * @param  [string/int] $pat_id the patient's ID
 * @return [array]  An array of allergies AllergyID, AllergyName, Severity
 */
function get_allergy_records_by_id($pat_id) {
    global $db_conn;

    $query = 'SELECT AllergyID, AllergyName, Severity FROM ALLERGY WHERE AllergyID IN
             (SELECT AllergyID from MED_RECORD_has_ALLERGY WHERE RecordID IN 
             (SELECT RecordID from MED_RECORD WHERE PatientID = ?))';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return helper_filter_result($result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Allergy Record: 
             $e </p>";
        }   
        return "Allergies Error";  // error 
    } 
}

/**.
 * Gets the treatments given to a Patient
 * @param  [type] $pat_id [description]
 * @return [type]         [description]
 */
function get_treatments_records_by_id($pat_id) {
    global $db_conn;

    $query = 'SELECT TreatmentID, Diagnosis, Treats, Description, Duration, DateDiagnosed, 
              EmployeeID FROM TREATMENT WHERE TreatmentID IN 
              (SELECT TREATMENT_TreatmentID from MED_RECORD_has_TREATMENT WHERE 
              MED_RECORD_RecordID IN (SELECT RecordID from MED_RECORD WHERE PatientID = ?))';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return helper_filter_result($result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Allergy Record: 
             $e </p>";
        }   
        return "Allergies Error";  // error 
    } 
}

/**
 * Gets the medication records for the given Patient ID
 * @param  [type] $pat_id the patient's id
 * @return  an array of medications
 */
function get_medication_records_by_id($pat_id) {
    global $db_conn;

    $query = 'SELECT MedicationID, CommonName, Side_Effects, Dosage, TimesPerDay, ActiveRx FROM 
              MEDICATION WHERE MedicationID IN (SELECT MEDICATION_MedicationID 
              FROM TREATMENT_has_MEDICATION WHERE 
              TREATMENT_TreatmentID IN (SELECT TreatmentID FROM TREATMENT WHERE 
              TreatmentID IN 
              (SELECT TREATMENT_TreatmentID FROM MED_RECORD_has_TREATMENT WHERE 
              MED_RECORD_RecordID IN
              (SELECT RecordID FROM MED_RECORD WHERE PatientID = ?))))';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $pat_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return helper_filter_result($result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Medication Record: 
             $e </p>";
        }   
        return "Medications Error";  // error 
    } 
}

/**
 * Searches for a patient record by a certain criteria and the value supplied
 * for that criteria
 * @param  [string] $criteria either ssn | lname | patid
 * @param  [string] $value    the value to search by
 * @return [array]  returns an array of the matched results
 */
function search_for_patient_id($criteria, $value) {
    global $db_conn;   

    $statement = "";
    switch ($criteria) {                              // prepare query statement
        case 'ssn':
            $statement = get_pat_info_by_ssn($value);
            break;
        case 'lname':
            $statement = get_pat_info_by_lname($value);
            break;
        case 'patid':
            $statement = get_pat_info_by_patid($value);
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
            echo "<p>Error retrieving Patient Info: 
             $e </p>";
        }   
        return 0;  // error 
    }
}

// private: used with search_for_patient_id
function get_pat_info_by_ssn($value) {
    global $db_conn;
    $query = 'SELECT * FROM PATIENT WHERE 
              SSN = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
}
// private: used with search_for_patient_id
function get_pat_info_by_lname($value) {
   global $db_conn;
    $query = 'SELECT * FROM PATIENT WHERE 
              Lname = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
    
}
// private: used with search_for_patient_id
function get_pat_info_by_patid($value) {
    global $db_conn;
    $query = 'SELECT * FROM PATIENT WHERE 
              PatientID = ?';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $value);
    return $statement;
}

// gets a single allergy id by allergy name
function get_allergy_id($allergyName) {
    global $db_conn;

    $query = 'SELECT AllergyID from ALLERGY WHERE AllergyName = ?';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $allergyName);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);
        $result = $result[0];
        return pull_single_element("AllergyID", $result);
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Allergy Record: 
             $e </p>";
        }   
        return "Allergies Error";  // error 
    } 
}

/*----------------- End of Get Medical Record Queries  -----------------------*/

/*==============================================================================   
=                       Set Allergy Records                               =
==============================================================================*/

/**
 * Creates a new medical record with a new allergy. Optional, a pre-existing record
 * can be used if known, otherwise a new record is created
 * @param [string] $allergyName the name of the allergy
 * @param [string] $severity    the severity of the allergy
 * @param [string] $patid       the patient ID
 */
function set_new_patient_allergy($allergyName, $severity, $patid, $rec_id = 0) {
    global $db_conn;
    $allergyID = "";                          

    $query = 'INSERT INTO MED_RECORD(PatientID) VALUES( ? )';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $patid);
        $statement->execute();
        if ($rec_id === 0) {
            $rec_id = $db_conn->lastInsertID();
        }
        $statement->closeCursor();
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new MED_RECORD: 
             $e </p>";
        }   
        return "failed";  // error 
    }

    $allergyID = set_new_allergy($allergyName, $severity);

    $query = 'INSERT INTO MED_RECORD_has_ALLERGY(RecordID, AllergyID) VALUES(?, ?)';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $rec_id);
        $statement->bindValue( 2 , $allergyID);
        $statement->execute();
        $statement->closeCursor();
        update_activity_log('AllergyNew', $_SESSION['EmployeeID'], $allergyID);
        return "success";
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new MED_RECORD: 
             $e </p>";
        }   
        return "failed";  // error 
    }
}


// sets a new allergy.
function set_new_allergy($allergyName, $severity) {
    global $db_conn;

    $query = 'INSERT INTO ALLERGY(AllergyName, Severity) VALUES(?, ?)';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $allergyName);
        $statement->bindValue( 2 , $severity);
        $statement->execute();
        $allergyID = $db_conn->lastInsertID();
        $statement->closeCursor();
        return $allergyID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new Allergy RECORD: 
             $e </p>";
        }   
        return 0;  // error 
    }
}



/*--------------      End of Set Allergy Records                --------------*/

/*==============================================================================
=                         Set Treatment Records                                =
==============================================================================*/




// ========== New Therapy Treatment Handlers
/**
 * Sets a new treatment record of type therapy.
 * @param [type] $patid           [description]
 * @param [type] $diagnosis       [description]
 * @param [type] $descript        [description]
 * @param [type] $therapyDescript [description]
 * @param [type] $therapyDuration [description]
 */
function set_new_therapy_record($patid, $diagnosis, $descript, $therapyDescript, $therapyDuration, $employeeID) {
    global $db_conn;

    $medRecID = get_med_record_id($patid);
    if ($medRecID == 0) {                           // create new med rec if DNE
        $medRecID = create_new_med_record($patid);
    }
    // get current date
    $date = date('y-m-d');

    // format therapy description
    $therapyDescript = parse_therapy_description($therapyDescript);

    $query = 'INSERT INTO TREATMENT(Diagnosis, Treats, Description, Duration, isOngoing,
              DateDiagnosed, EmployeeID) VALUES(?, ?, ?, ?, ?, ?, ?)';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $diagnosis);
        $statement->bindValue( 2 , $therapyDescript);
        $statement->bindValue( 3 , $descript);
        $statement->bindValue( 4 , $therapyDuration);
        $statement->bindValue( 5 , '1');
        $statement->bindValue( 6 , $date);
        $statement->bindValue( 7 , $employeeID);
        $statement->execute();
        $statement->closeCursor();
        
        $treatmentID = get_last_treat_id_added();

        // update activity log
        update_activity_log('TreatmentNew', $_SESSION['EmployeeID'], $treatmentID);

        // update MED_RECORD_has_TREATMENT table
        $isSuccess = update_med_rec_has_treat($medRecID, $treatmentID);

        if ($isSuccess != 0)  {
            return $treatmentID;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new Therapy Treatment: 
             $e </p>";
        }   
        return 0;  // error 
    }    
}

// private
function get_last_treat_id_added() {
    global $db_conn;

    $query = 'SELECT MAX(TreatmentID) FROM TREATMENT';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);
        $treatID = 0;
        foreach ($result as $entry) {
            foreach ($entry as $key => $value) {
                if ($key == 'MAX(TreatmentID)') {
                    $treatID = $value;
                }
            }
        }
        return $treatID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error getting last TreatmentID: 
             $e </p>";
        }   
        return 0;  // error 
    }  
}
// private
function update_med_rec_has_treat($medRecID, $treatID) {
    global $db_conn;

    $query = 'INSERT INTO MED_RECORD_has_TREATMENT(MED_RECORD_RecordID, 
              TREATMENT_TreatmentID) VALUES(?, ?)';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $medRecID);
        $statement->bindValue( 2 , $treatID);
        $statement->execute();
        $statement->closeCursor();
        return 1;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error updating MED_RECORD_has_TREATMENT: 
             $e </p>";
        }   
        return 0;  // error 
    }  
}

// private
function parse_therapy_description($therapyDescript) {
    $prepend = "Suggested Therapy: ";
    return $prepend . $therapyDescript;
}

// ---------- End of New Therapy Treatment Handlers

// ========== New Referral Treatment Handlers

/**
 * Sets a new referral record in the TREATMENT Table
 * @param [string | int] $patid      [description]
 * @param [string] $diagnosis  [description]
 * @param [string] $descript   [description]
 * @param [string | int] $docID      [description]
 * @param [string] $docFname   [description]
 * @param [string] $docLname   [description]
 * @param [string | int] $employeeID [description]
 */
function set_new_referral_record($patid, $diagnosis, $descript, $docID, $docFname, $docLname, $employeeID) {
    global $db_conn;

    $medRecID = get_med_record_id($patid);

    if ($medRecID == 0) {                           // create new med rec if DNE
        $medRecID = create_new_med_record($patid);
    }

    // get current date
    $date = date('y-m-d');

    // parse doctor referral info for displaying purposes
    $docReferral = parse_doc_referral($docFname, $docLname);

    $query = 'INSERT INTO TREATMENT(Diagnosis, Treats, Description, Duration, isOngoing,
              DateDiagnosed, EmployeeID) VALUES(?, ?, ?, ?, ?, ?, ?)';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $diagnosis);
        $statement->bindValue( 2 , $docReferral);
        $statement->bindValue( 3 , $descript);
        $statement->bindValue( 4 , "n/a");
        $statement->bindValue( 5 , '1');
        $statement->bindValue( 6 , $date);
        $statement->bindValue( 7 , $employeeID);
        $statement->execute();
        $statement->closeCursor();
        
        $treatmentID = get_last_treat_id_added();

        // update activity log
        update_activity_log('TreatmentNew', $_SESSION['EmployeeID'], $treatmentID);
        update_med_rec_has_treat($medRecID, $treatmentID);
        return $treatmentID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new Therapy Treatment: 
             $e </p>";
        }   
        return 0;  // error 
    }    
}

// private: formats a doctor referral for the Treats field in TREATMENT
function parse_doc_referral($docFname, $docLname) {
    $format_string = "Referred to Doctor: ";
    $format_string = $format_string . $docLname . ", " . $docFname;
    return $format_string; 
}

// ---------- New Referral Treatment Handlers

// ========== New Medication Treatment Handlers

function set_new_medication_record($patID, $diagnosis, $descript, $medName, $sideEff, 
                                           $dosage, $timesPerDay, $docID, $employeeID) {
    global $db_conn;

    $medRecID = get_med_record_id($patID);
    if ($medRecID == 0) {                           // create new med rec if DNE
        $medRecID = create_new_med_record($patid);
    }

    // get current date
    $date = date('y-m-d');

    // format medication description
    $medTreat = parse_med_for_treatment_descript($medName, $docID);

    $query = 'INSERT INTO TREATMENT(Diagnosis, Treats, Description, Duration, isOngoing,
              DateDiagnosed, EmployeeID) VALUES(?, ?, ?, ?, ?, ?, ?)';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $diagnosis);
        $statement->bindValue( 2 , $medTreat);
        $statement->bindValue( 3 , $descript);
        $statement->bindValue( 4 , "n/a");
        $statement->bindValue( 5 , '1');
        $statement->bindValue( 6 , $date);
        $statement->bindValue( 7 , $employeeID);
        $statement->execute();
        $statement->closeCursor();
        
        $treatmentID = get_last_treat_id_added();

        // update activity log
        update_activity_log('TreatmentNew', $_SESSION['EmployeeID'], $treatmentID);
        
        $medicationID = add_new_medication($medName, $sideEff, $dosage, $timesPerDay);

        // update MED_RECORD_has_TREATMENT table
        update_med_rec_has_treat($medRecID, $treatmentID);

        // update TREATMENT_has_MEDICATION
        $isSuccess = update_treatment_has_med($treatmentID, $medicationID, $medName);

        if ($isSuccess != 0)  {
            return $treatmentID;
        } else {
            return 0;
        }
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new Therapy Treatment: 
             $e </p>";
        }   
        return 0;  // error 
    }        
}

// private: parses medictaion treatment for TREATMENT table's Treats field
function parse_med_for_treatment_descript($medName, $docID) {
    $returnString = "Medication perscribed: " . $medName;
    $returnString = $returnString . "\n Prescribing Doctor ID: " . $docID;
    return $returnString;
}

// private
function get_last_medication_id_added() {
    global $db_conn;

    $query = 'SELECT MAX(MedicationID) FROM MEDICATION';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);
        $medID = 0;
        foreach ($result as $entry) {
            foreach ($entry as $key => $value) {
                if ($key == 'MAX(MedicationID)') {
                    $medID = $value;
                }
            }
        }
        return $medID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error getting last MedicationID: 
             $e </p>";
        }   
        return 0;  // error 
    } 

}
/**
 * Adds new medication record and returns the MedicationID of the field added.
 * @param [type]  $name    [description]
 * @param [type]  $sideEff [description]
 * @param [type]  $dosage  [description]
 * @param [type]  $perDay  [description]
 * @param integer $active  [description]
 */
function add_new_medication($name, $sideEff, $dosage, $perDay, $active=1) {
    global $db_conn;

    $query = 'INSERT INTO MEDICATION(CommonName, Side_Effects, Dosage, 
              TimesPerDay, ActiveRx) VALUES(?, ?, ?, ?, ?)';
    
    $perDay = $perDay . " per day";
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $name);
        $statement->bindValue( 2 , $sideEff);
        $statement->bindValue( 3 , $dosage);
        $statement->bindValue( 4 , $perDay);
        $statement->bindValue( 5 , $active);
        $statement->execute();
        $statement->closeCursor();
        
        $medID = get_last_medication_id_added();
        return $medID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new MEDICATION: 
             $e </p>";
        }   
    }     
    return 0;  // error 
}
/**
 * Updates the TREATMENT_has_MEDICATION table
 * @param  [type] $treatID [description]
 * @param  [type] $medID   [description]
 * @param  [type] $name    [description]
 * @return [type]          [description]
 */
function update_treatment_has_med($treatID, $medID, $name) {
    global $db_conn;

    $query = 'INSERT INTO TREATMENT_has_MEDICATION(TREATMENT_TreatmentID, 
              MEDICATION_MedicationID, MEDICATION_CommonName)
              VALUES(?, ?, ?)';
    
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $treatID);
        $statement->bindValue( 2 , $medID);
        $statement->bindValue( 3 , $name);
        $statement->execute();
        $statement->closeCursor();
        return true;    
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting TREATMENT_has_MEDICATION: 
             $e </p>";
        }   
    }           
    return false;  // error 
}

// ---------- End of New Medication Treatment Handlers



/**
 * Creates a new record MED_RECORD
 * @param  [type] $patID the patient's id to create a new medical record
 * @return the medical record's id
 * @precondition should perform a search for a pre-existing medical record first
 *               however, this function allows for "fail-safe".  In other words, 
 *               a patient can have multiple med records OR a patient can have a 
 *               single med record that all treatments and allergies point to.
 */
function create_new_med_record($patID) {
    global $db_conn;

    $query = 'INSERT INTO MED_RECORD(PatientID) VALUES(?)';

    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $patID);
        $statement->execute();
        $recordID = $db_conn->lastInsertID();
        $statement->closeCursor();
        return $recordID;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new medical record: 
             $e </p>";
        }   
        return 0;  // error 
    }  
}

// todo MOVE ME
/**
 * Gets the medical record id belonging to a patient.  If no medical record
 * exsist, returns 0;
 * @param  [int] $patID the patient's id to search for medical record ids for
 * @return [int] returns one of the medical record ids belonging to the patient
 *               if it exists, otherwise returns 0;
 */
function get_med_record_id($patID) {
    global $db_conn;

    $query = 'SELECT RecordID from MED_RECORD WHERE PatientID = ?';
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $patID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);
        $result = $result[0];
        $result = pull_single_element("RecordID", $result);
        if (is_null($result)) $result = 0;
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Med Record ID: 
             $e </p>";
        }   
        return 0;  // error 
    }     
}
/*-----               End of Set Treatment Records                      ------*/

/*==============================================
=            Get Sectioned Patients            =
==============================================*/
function get_sectioned_pat_array() {

    global $db_conn;

    $query = 'SELECT * from PATIENT WHERE isSectioned = 1';
    try {
        $statement = $db_conn->prepare($query);
        $statement->bindValue( 1 , $patID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $result = helper_filter_result($result);
        if (is_null($result)) $result = 0;
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error retrieving Sectioned Patients: 
             $e </p>";
        }   
        return 0;  // error 
    }    
}


/*-----  End of Get Sectioned Patients  ------*/







//**************************    Temp Test Queries ******************************


?>

