<?php

include "global_query.php";

if (isset($_POST['getDocList']) && ($_POST['getDocList'] == "true")) {
    echo json_encode(get_list_of_all_doctor_names_and_ids());
    exit();

// ==========       Handle New Treatment Submission                =============
} else if (isset($_POST['diagnosis']) && isset($_POST['descript'])) {
    $patID = $_POST['patid'];
    $diagnosis = $_POST['diagnosis'];
    $description = $_POST['descript'];

    // -------------   Doctor Referral Treatment
    if(isset($_POST['docRefID'])) {                         
        $employeeID = $_SESSION['EmployeeID'];
        $docID = $_POST['docRefID'];
        $docFname = $_POST['docFname'];
        $docLname = $_POST['docLname'];
        $result = set_new_referral_record($patID, $diagnosis, $description, $docID, 
                                                $docFname, $docLname, $employeeID);
        if ($result != 0) {
            echo "success";
        } else {
            echo "err:11";
        }        
        exit();

    // -------------   Therapy Treament
    } else if (isset($_POST['therapy']))  {                  // Therapy Treatment
        $employeeID = $_SESSION['EmployeeID'];
        $therapyDescript = $_POST['therapyDescript'];
        $therapyDuration = $_POST['therapyDuration'];
        $result = set_new_therapy_record($patID, $diagnosis, $description, 
                                         $therapyDescript, $therapyDuration,
                                         $employeeID);
        if ($result != 0) {
            echo "success";
        } else {
            echo "err:12";
        }
        exit();

    // ------------- New Medication Treatment
    } else if (isset($_POST['medName'])) {                  

    // ------------- Section Patient Treatment
    } else if (isset($_POST['section'])) {                  // FOR DOCTOR USE ONLY !!!

    } else {
        echo "err:13";
    }
// ------------ End of Handle New Treatment Submission
} else {
    echo "err:14";
}


/**
 * Error codes:
 * 14: No POST data detected
 * 13: incorrect formatted new treatment submission
 * 12: Therapy Treatment specific error
 * 11: Doctor referral Treatment specific error
 */



?>