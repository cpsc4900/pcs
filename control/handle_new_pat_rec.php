<?php

include "global_query.php";


// Make sure all fields were passed
if (isset($_POST['firstName']) && isset($_POST['lastName'])  && isset($_POST['patSSN']) &&
    isset($_POST['phoneNum']) && isset($_POST['genderChk']) && isset($_POST['patBday']) && 
    isset($_POST['patStAdd']) && isset($_POST['patCity']) && isset($_POST['patZip']) &&
                                                        isset($_POST['patState'])) {

    // Assign local variables
    $fname = $_POST['firstName'];
    $lastName = $_POST['lastName']; 
    $patSSN = $_POST['patSSN']; 
    $phoneNum = $_POST['phoneNum']; 
    $gender = $_POST['genderChk'];
    $patBday = $_POST['patBday']; 
    $patStAdd = $_POST['patStAdd']; 
    $patCity = $_POST['patCity']; 
    $patState = $_POST['patState']; 
    $patZip = $_POST['patZip']; 

    // Add the new patient record and address to the pcs_db
    $result = set_new_pat_record($fname, $lastName, $patSSN, $phoneNum, $gender, 
                                 $patBday, $patStAdd, $patCity, $patState, $patZip);

    if ($result == 1) {                // a returned one means the new
        echo "success";                // patient record and address where added
    } else {
        echo "error_empty";
    }
} else {
    header("Location: ../PermissionDenied.php");
    exit();
    
}

exit();
?>

