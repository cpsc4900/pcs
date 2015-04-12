<?php
/**
 * @file
 *
 * Gets the patients that are currently sectioned and returns this list as
 * JSON
 */

include "global_query.php";

if (isset($_POST['get_sectioned']) && ($_POST['get_sectioned'] == "true")) {
    $result = get_sectioned_pat_array();

    if (! $result) {
        echo json_encode("No Sectioned Patients");
    }

    echo json_encode($result);
} else {
    echo "error";
}




?>