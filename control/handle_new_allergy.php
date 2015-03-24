<?php

include "global_query.php";

if (isset($_POST['allergyName'])&& isset($_POST['severity'])&& isset($_POST['patid'])) {
    $result = set_new_patient_allergy($_POST['allergyName'], $_POST['severity'], 
                                                             $_POST['patid']);
    if ($result == 'success') {
        echo "success";
    } else {
        echo "failed";
    }
} else {
    echo "failed";
}

?>