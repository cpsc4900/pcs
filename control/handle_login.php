<?php
session_start();
/**
* @file
*
* Handles initial logging in.  This file excepts a username and password,
* checks for valigation using control/authenticate.php, and redirects the
* user upon authentication to the correct user Dashboard.  This is where
* the Session starts.  Session data includes: (a)EmployeeID, (b) UserType,
* (c) ClinicID, (d) and a timestamp, for logging when a user has logged in.
* This session data is persistant until a user logs out OR the session 
* expires due to no activity (currently set to 10 minutes).
**/
include "authenticate.php";

/*==================================
=            Test Suite            =
==================================*/
if ($is_dev) {

  $mock_passwd;           // mock stored password in database
  $moc_usrname;           // mock stored username in database
  
  if (isset($_POST['passWord']) && isset($_POST['userName'])) {
    $mock_passwd = create_hash($_POST['passWord']);
    $mock_usrname =  $_POST['userName'];
    // $_POST['userName'];
  }
} 

/**
*
*              username| usertype | password
*             ---------------------|---------
*              mark    | AR       | arpass
*              jenny   | EM       | empass
*              joe     | Doctor   | docpass
*              alice   | Nurse    | nursepass
*              bob     | MRS      | mrspass
*                
* 
*              Database Access
*              username |  password
*              ---------|----------
*              Login      logpass
*              Master   | Master
**/
/*-----  End of Test Suite  ------*/




/*============================================
=            Check entered fields            =
============================================*/

if (isset($_POST['userName']) && !empty($_POST['userName'])  
    && !empty($_POST['passWord'])  && isset($_POST['userName'])) {  // does username have a value ?

  init_login_db_conn();                  // connect to database as Login user

  $userName = $_POST['userName'];
  $passWord = $_POST['passWord'];

  $hashed_pwd = retrieveHashedPwd($userName);      // get saved hashed password

  if(validateLogin($passWord, $hashed_pwd)) {     // Does the password match?
    //
    $emp_id = retrieveEmployeeID($userName);      // and set session info
    $_SESSION['EmployeeID'] = $emp_id;               
    $_SESSION['UserType'] = retrieveUserType($emp_id);
    $_SESSION['ClinicID'] = retrieveUserClinicID($emp_id);

    $date = new DateTime();
    $now_unix_ts = $date->getTimeStamp();
    $_SESSION['StartTime'] = $now_unix_ts;
    include "access_control.php";

    // update activity log
    update_activity_log('UserLogin', $_SESSION['EmployeeID']);

    // Take the User to the appropiate Dashboard
    // TODO: Assign passwords to database, depending on usertype!!!!
    switch ($_SESSION['UserType']) {
      case 'Doctor':
        header("Location: ../view/doc_dashboard.php");   // Doc Dashboard
        exit();
        break;
      case 'AR':
        header("Location: ../view/ar_dashboard.php");    // AR Dashboard
        exit();
        break;
      case 'EM':
        header("Location: ../view/em_dashboard.php");     // EM Dashboard
        exit();
        break;
      case 'MRS':
        header("Location: ../view/mrs_dashboard.php");    // MRS Dashboard
        exit();
        break;
      case 'Nurse':
        header("Location: ../view/nurse_dashboard.php");  // Nurse Dashboard
        exit();
        break;      
      default:
        header("Location: ../view/index.php");            // Back to Index
        exit();
        break;
    }

  } else {
    header("Location: ../index.php?error=true");  // No, try again
    exit();
  }


  
} else {                                          // No password or username, try again
  header("Location: ../index.php");               // Note: this should be handled by script in index.php
  exit();                                         // Fall through purpose only.
} 
/*-----  End of Check entered fields  ------*/



?>