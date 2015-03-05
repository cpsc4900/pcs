<?php 

include_once "control/global.php"; 

?>

<!DOCTYPE html>


<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PCS Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/pcs_style.css">
  <script>
    function validateForm() {  // Check for empty fields
        var x = document.forms["loginForm"]["userName"].value;
        var y = document.forms["loginForm"]["passWord"].value;
        if (x == null || x == "") {                             // check user name field
            alert("Name must be filled out");
            return false;
        }   
        if (y == null || y == "") {                            // check pasword field
            alert("Password field must be filled out");
            return false;
        }
    }
  </script>
</head>

<body>
<div class="container-fluid">

  <div class="row" id="spacer"></div>  <!-- Row Spacer -->
  <div class="row"> <!-- main row -->
    <div class="col-sm-3"></div>

    <div class="col-sm-6">  <!-- Center Column -->
      <!-- Login Form -->
      <div id="login_form">
        <form class="form-horizontal" name="loginForm" action="control/handle_login.php" 
              onsubmit="return validateForm()" method="post">
          <div class="form-group">
            <label for="usrName" class="col-sm-3 control-label">User Name</label>
            <div class="col-sm-5">
              <input type="text"  name="userName" class="form-control" id="usrName">
            </div>
          </div>
          <div class="form-group">
            <label for="pwd" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-5">
              <input type="password" name="passWord" class="form-control" id="pwd">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
          </div>
        </form>
      </div>  <!-- end of Login Form -->
    </div>    <!-- end of Center Column -->
    <div class="col-sm-3">
    <?php
      if(isset($_GET['error']) && $_GET['error'] === "true") {
        $errMess = "style=\"visibility: visible;\"";
      } else {
        $errMess = "style=\"visibility: hidden;\"";
      }
    ?>
      <div class="alert alert-danger" role="alert"  <?php print $errMess; ?> >
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        Username and Password are not recognized
      </div>
    </div> <!-- end of third column -->
  </div>  <!-- end of row -->
</div> <!-- end of container-fluid -->
	
  <!-- Load scripts last, speeds up loading -->	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>
