<?php
/**
 * @file
 *
 * Handles all AJAX requests from the edit_pat_record_model.php.  See
 * control/handle_edit_pat_prim_rec.js for AJAX requests
 *
 * This file handles; (a) request for returning patient primary records
 * based on search criteria (SSN, Lname, or PatientId), (b) request for
 * updating a patient's primary record.
 * 
 */
include "global_query.php";


// Edit Patient Primary Search Request
if (isset($_POST['criteria']) && isset($_POST['value'])) {
    $result = search_for_patient_primary($_POST['criteria'], $_POST['value']);
    echo json_encode($result);

// Update Patient Primary Record Request
} else if (isset($_POST['patid']) && isset($_POST['fname']) && 
           isset($_POST['lname']) && isset($_POST['ssn']) && isset($_POST['bday']) &&
           isset($_POST['phoneNum']) && isset($_POST['gender']) && isset($_POST['street']) && 
           isset($_POST['city'])  && isset($_POST['state']) && isset($_POST['zip']))  {

    $result = update_pat_record($_POST['patid'], $_POST['fname'], 
                                $_POST['lname'], $_POST['ssn'], $_POST['bday'], 
                                $_POST['phoneNum'], $_POST['gender'], $_POST['street'], 
                                $_POST['city'], $_POST['state'], $_POST['zip']);
    
    // Was the update successful?
    if ($result != 0) {
        echo "success";                 // Yes
    } else {
        echo "err_on_update";          // NO, error
    }

// You do not have rights to view this page
} else {
    header("Location: ../PermissionDenied.php");
    exit();
}

exit();
?>





