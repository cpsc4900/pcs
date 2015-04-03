<?php
include "db_connect.php";
/**
 * @file
 *
 * Handles updating the ACTIVITY_LOG table.  When a user performs an 'activity'
 * worth logging, the table is updated with the ID of the user, timestamp, and
 * an id of the record that the user changed, deleted, or created.  See the function
 * description for update_activity_log for activities that get logged.
 */
/*==============================================================================
=                           Activity Log Queries                               =
==============================================================================*/
/**
 * Updates the activity logs. Activity logs include:
 *
 *   PrimaryNew
 *   PrimaryEdit
 *   AllergyEdit
 *   AllergyNew
 *   UserLogin
 *   UserLogout
 *   TreatmentNew
 *   TreatmentRemove
 * @param  [string] $activityType See list above
 * @param  [int] $empID        The id of the user who performed the logged activity
 * @param  [int] $recID        If the activity includes updating, creating, or deleting
 * a record, the id of the record must be supplied.  For example, PrimaryNew activityType
 * would require the primary key (i.e. PatientID) from the newly created record in the
 * PATIENT table
 * @return [int/string]        Returns zero if the activityType is not recognized. Returns
 *                             'failed' if the actual query fails to insert the log.  Otherwise,
 *                             returns the last Activity_LOG ID (i.e. the last inserted row's id).
 */
function update_activity_log($activityType, $empID, $recID = 0) {
    global $db_conn;
    $statement = "";
    switch ($activityType) {
        case 'PrimaryNew':
            $statement = gen_activity_pat_new_rec_query($empID, $recID);
            break;
        case 'PrimaryEdit':
            $statement = gen_activity_pat_edit_rec_query($empID, $primRecID);
            break;
        case 'AllergyEdit':
            $statement = gen_activity_allergy_edit_query($empID, $recID);
            break;
        case 'AllergyNew':
            $statement = gen_activity_new_allergy_query($empID, $recID);
            break;
        case 'UserLogin':
            $statement = gen_activity_user_login_query($empID);
            break;
        case 'UserLogout':
            $statement = gen_activity_user_logout_query($empID);
            break;
        case 'TreatmentNew':
            $statement = gen_activity_treat_new_rec_query($empID, $recID);
            break;
        case 'TreatmentRemove':
            $statement = gen_activity_treat_remove_rec_query($empID, $recID);
            break;
        default:
            return 0;
    }
    try {
        $statement->execute();
        $result = $db_conn->lastInsertId();
        $statement->closeCursor();
        return $result;
    } catch (Exception $e) {
        if($is_dev) {
            echo "<p>Error setting new ACTIVITY_LOG: 
             $e </p>";
        }   
        return "failed";  // error 
    }
}

// private: prepare insert query for primary new log
function gen_activity_pat_new_rec_query($empID, $primRecID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, PatientRecID, TimeStamp) 
              VALUES(\'PrimaryNew\', ?, ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $primRecID);
    $statement->bindValue( 3 , $date);

    return $statement;
}

// private: prepare insert query for primary edit log
function gen_activity_pat_edit_rec_query($empID, $primRecID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, PatientRecID, TimeStamp) 
              VALUES(\'PrimaryEdit\', ?, ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $primRecID);
    $statement->bindValue( 3 , $date);

    return $statement;
}

// private: prepare insert query for allergy edit log
function gen_activity_allergy_edit_query($empID, $allergyID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, AllergyID, TimeStamp) 
              VALUES(\'AllergyEdit\', ?, ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $allergyID);
    $statement->bindValue( 3 , $date);

    return $statement;
}

// private: prepare insert query for new allergy log
function gen_activity_new_allergy_query($empID, $allergyID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, AllergyID, TimeStamp) 
              VALUES(\'AllergyNew\', ?, ?, ? )';
    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $allergyID);
    $statement->bindValue( 3 , $date);

    return $statement;
}

// private: prepare insert query for user login log
function gen_activity_user_login_query($empID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, TimeStamp) 
              VALUES(\'UserLogin\', ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $date);

    return $statement;
}

// private: prepare insert query for user clean logout log
function gen_activity_user_logout_query($empID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, TimeStamp) 
              VALUES(\'UserLogout\', ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $date);

    return $statement;
}

// private: prepare insert query for primary edit log
function gen_activity_treat_new_rec_query($empID, $treatID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, TreatmentID, TimeStamp) 
              VALUES(\'TreatmentNew\', ?, ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $treatID);
    $statement->bindValue( 3 , $date);

    return $statement;
}

// private: prepare insert query for treatment removal log
function gen_activity_treat_remove_rec_query($empID, $treatID){
    global $db_conn;

    // get current date
    $date = date('y-m-d H:i:s');

    $query = 'INSERT INTO ACTIVITY_LOG(ActivityType, EmployeeID, TreatmentID, TimeStamp) 
              VALUES(\'TreatmentNew\', ?, ?, ? )';

    $statement = $db_conn->prepare($query);
    $statement->bindValue( 1 , $empID);
    $statement->bindValue( 2 , $treatID);
    $statement->bindValue( 3 , $date);

    return $statement;
}


/*----------------------  End of Activity Log Queries  -----------------------*/

?>