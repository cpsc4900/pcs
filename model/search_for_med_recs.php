<?php
include "../control/global_query.php";

// request to searchby SSN | Lname | patID
if(isset($_POST['searchBy'])  && isset($_POST['searchValue'])) {
   $result = search_for_patient_id($_POST['searchBy'], $_POST['searchValue']);

   echo json_encode($result);

// request for medical records
} else if(isset($_POST['patid'])) {

}


?>