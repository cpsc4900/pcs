<?php
/**
* Displays a Login Form.
*
**/
include "../model/authenticate.php";
include "../model/global.php";

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

} /*-----  End of Test Suite  ------*/




/*============================================
=            Check entered fields            =
============================================*/

if (isset($_POST['userName']) && !empty($_POST['userName'])  
    && !empty($_POST['passWord'])  && isset($_POST['userName'])) {  // does username have a value ?

  $userName = $_POST['userName'];
  $passWord = $_POST['passWord'];

  // TEST
  if ($is_dev) {
    if ($mock_usrname === $userName && validateLogin($passWord, $mock_passwd)) {
      $login_is_correct = true;
      header("Location: ../view/ar_dashboard.php");  
      exit(); 
    } else {
      header("Location: ../index.php?error=true");       // Password incorrect, try again
      exit();
    }
    // END TEST
  } 
  //TODO need to handle usertype login here !!!
  
} else {                                          // No password or username, try again
  header("Location: ../index.php");               // Note: this should be handled by script in index.php
  exit();                                         // Fall through purpose only.
} 
/*-----  End of Check entered fields  ------*/

?>