<?php
include "../control/global_query.php";



if (isset($_POST['patreq']) && ($_POST['patreq'] == 'patreq'))  {
    // passes JSON of all patients' id, lastname, SSN
    $pat_id_ln_ssn = get_patient_id_name_ssn_map();
    echo json_encode($pat_id_ln_ssn);
} else if (isset($_POST['getPatName'])) {  // called from handle_ar_apps.js
    $pat_id = $_POST['getPatName'];
    echo json_encode(get_full_name_of_patient($pat_id));
} else {
    // do nothing
}
