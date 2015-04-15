<?php
/**
 * @file
 *
 * Gets the patients that are currently sectioned and returns this list as
 * JSON
 */

include "global_query.php";

// get all sectioned patients at THIS clinic
if (isset($_POST['get_sectioned']) && ($_POST['get_sectioned'] == "true")) {
    $clinicID = $_SESSION['ClinicID'];

    $result = get_sectioned_pat_array($clinicID);

    if (! $result) {
        echo json_encode("No Sectioned Patients");
    }

    echo json_encode($result);
// get medications of selected patient from sectioned patient table
} elseif (isset($_POST['get_medication']) && isset($_POST['patID'])) {
    $result = get_medication_records_by_id($_POST['patID']);
    echo json_encode($result);

// else: an error has occured
} else {
    echo "error";
}




?>