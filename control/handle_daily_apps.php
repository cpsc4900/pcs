<?php

include "global_query.php";
/**
 * @file
 *
 * Handles the daily_apps_model.php
 * Referenced by handle_daily_apps.js
 * 
 */
if (isset($_POST['get_daily_apps']) && $_POST['get_daily_apps'] =="true") {

    if ($_SESSION['UserType'] == "Doctor") {
        $emp_id = $_SESSION['EmployeeID'];
        $datetime = date_create();
        // TODO Remove
    }
    $result = get_apps_per_doc_id_and_date($emp_id, $datetime = "empty");
    echo json_encode($result);
}




?>