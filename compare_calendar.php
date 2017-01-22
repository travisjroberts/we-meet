<?php
  date_default_timezone_set('America/Chicago');
  $dt = new DateTime();
  // Check for year and week passed in as variables
  if (isset($_GET['year']) && isset($_GET['week'])) {
      // Set the week / year
      $dt->setISODate($_GET['year'], $_GET['week']);
	  $dt->setTime(8,0);
  } else {
      // Default to the current week
      $dt->setISODate($dt->format('o'), $dt->format('W'));
	  $dt->setTime(8,0);
  }
  $year = intval($dt->format('Y'));
  $week = intval($dt->format('W'));
  // show times using one SELECT STATEMENT
  $query_string = "SELECT time_stamp, count(user_id) FROM 'availability' WHERE year = '{$year}' AND week = '{$week}' GROUP BY time_stamp;";
  
  // Open the database
  $database = new SQLite3("database.db");  
  
  // Query the database
  $result = $database->query($query_string);

  $compareTimes = [];

  // Loop through results
  while ($row = $result->fetchArray())
  {
    // index 0 is the time_stamp
    // index 1 is the user count for that time_stamp
    $compareTimes[$row[0]] = $row[1];
  }

  // Close the database
  $database->close();
?>

<!-- Echo out the table -->
<table class="pure-table">
  <!-- Create the table headers -->
  <thead>
    <tr>
      <?php
        for($i = 0; $i < 7; $i++) {
          echo "<td class='dark'>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
          // PHP function that adds one day to our date
          $dt->modify('+1 day');
        }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
	  $dt->modify('-7 day');
      // This is where we will build out our table of time slots.
      // Each time slot should have an onclick handler.
    for($d = 0; $d < 28; $d++) 
    {
      echo "<tr>";	

      for($i = 0; $i < 7; $i++){
          $epoch = $dt->format('U');
		  // Access the count we saved earlier 
          $count = $compareTimes[$epoch];
          // Change background color based on $count
          // TODO: Toggle for user to set their groups calender for 'x' amount of users. Percents based.
          if ($count && $count <= 1) {
              echo "<td style='background-color: #032900'>" . $dt->format('h:i A') . "<br>" . $count;
          } else if ($count && $count <= 2) {
              echo "<td style='background-color: #053D00'>" . $dt->format('h:i A') . "<br>" . $count;
          } else if ($count && $count <= 3) {
              echo "<td style='background-color: #075200'>" . $dt->format('h:i A') . "<br>" . $count;
          }
          else if ($count && $count <= 4) {
              echo "<td style='background-color: #096600'>" . $dt->format('h:i A') . "<br>" . $count;
          }
          else if ($count && $count <= 5) {
              echo "<td style='background-color: #0A7A00'>" . $dt->format('h:i A') . "<br>" . $count;
          }
          
          
          else {
              echo "<td>" . $dt->format('h:i A') . "<br> 0";
          }
          

          $dt->modify('+1 day');
          echo "</td>";
      }
      $dt->modify('-7 day');
      $dt->modify('+30 minutes');
      echo "</tr>";
    }
    ?>
  </tbody>
</table>