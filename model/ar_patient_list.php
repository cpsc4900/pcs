<?php
include "../control/global_query.php";



if (isset($_POST['patreq']) && ($_POST['patreq'] == 'patreq'))  {
// TODO pull list of patients for autofill effect when searching for patients
// see your playground
} else if (isset($_POST['getPatName'])) {  // called from handle_ar_apps.js
    $pat_id = $_POST['getPatName'];
    echo json_encode(get_full_name_of_patient($pat_id));
} else {

}

?>