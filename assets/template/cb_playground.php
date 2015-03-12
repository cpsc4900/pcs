<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CB_Play</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>


<body>
<div class="container-fluid">
	
	<div class = "row"> <!-- Main Menu -->
		<div class="col-sm-2" style="background-color:lavender;">Section 1</div>
    	<div class="col-sm-6" style="background-color:lavenderblush;">Section 2</div>
    	<div class="col-sm-4" style="background-color:lavender;"> Section 3</div>
	</div>

	<?php
	echo "<h1>Welcome to the PCS project ! </h1>";
	?>
  
  <div class="row">  <!--  Main Content -->
    <div class="col-sm-2" style="background-color:lavender;">.col-sm-4</div>
    <div class="col-sm-6" style="background-color:lavenderblush;">
    <!-- **************      Play Here           ****************** -->
    <table class="table table-striped">
      <?php for ($i=0; $i < 10; $i++) { 
        echo "<tr><td>".$i."</td></tr>";
      }
      ?>
      <tr><td>
        <div class="dropdown">
          <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
          Dropdown trigger
          <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
             <p>Appointment</p>
             <p>Patient</p>
             <p>Doctor</p>
          </ul>
        </div>
      </td></tr>
    </table>

    </div>
    <div class="col-sm-4" style="background-color:lavender;">
    </div>
  </div>  <!-- end of row -->
</div> <!-- end of container-fluid -->
	
  <!-- Load scripts last, speeds up loading -->	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>