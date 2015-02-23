<?php



// Calculating the first day of the month and the number
// of days in the month

  $month = date("n");
  $year = date("Y");
  $firstDay = mktime(0,1,0,$month,1,$year);
  $daysInMonth = date("t",$firstDay);
  $firstDay = date("w",$firstDay);
  echo "<table  border='3'>\n";
    echo "<tr>\n";
      echo "<td align='center'>" . date("F Y") . "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
      echo "<td>\n";
        echo "<table border='1' cellspacing='2' cellpadding='2'>\n";
          echo "<tr align='center'>\n";
            echo "<td width='60'>Sun</td>\n";
            echo "<td width='60'>Mon</td>\n";
            echo "<td width='60'>Tue</td>\n";
            echo "<td width='60'>Wed</td>\n";
            echo "<td width='60'>Thu</td>\n";
            echo "<td width='60'>Fri</td>\n";
            echo "<td width='60'>Sat</td>\n";
          echo "</tr>\n";
          # Calculate number of rows
          $totalCells = $firstDay + $daysInMonth;
          if($totalCells < 36){
            $rowNumber = 5;
          } else {
            $rowNumber = 6;
          }
          $dayNumber = 1;
          # Create Rows
          for($currentRow=1; $currentRow <= $rowNumber; $currentRow++){
            if($currentRow == 1){
              # Create First Row
              echo "<tr align='center'>\n";
              for($currentCell  = 0; $currentCell<7; $currentCell++){
                if($currentCell == $firstDay){
                  # First Day of the Month
                    echo "<td width='60'>" . $dayNumber . "</td>\n";
                    $dayNumber++;
                } else {
                  if($dayNumber > 1){
                    # First Day Passed so output Date
                    echo "<td width='60'>" . $dayNumber . "</td>\n";
                    $dayNumber++;
                  } else {
                    # First Day Not Reached so display blank cell
                    echo "<td width='60'>&nbsp;</td>\n";
                  }
                }
              }
              echo "</tr>\n";
            } else {
              # Create Remaining Rows
              echo "<tr align='center'>\n";
              for($currentCell = 0; $currentCell < 7; $currentCell++){
                if($dayNumber > $daysInMonth){
                  # Days in month exceeded so display blank cell
                    echo "<td width='60'>&nbsp;</td>\n";
                } else {
                    echo "<td width='60'>" . $dayNumber . "</td>\n";
                    $dayNumber++;                            
                }
              }
              echo "</tr>\n";
            }
          }
        echo "</table>\n";
      echo "</td>\n";
    echo "</tr>\n";
  echo "</table>\n";

?>