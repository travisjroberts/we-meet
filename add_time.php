<?php
    $year = "";
    $week = "";
    $day = "";
    $hour = "";
    $minutes = "";
    $time_stamp = "";
    $user_id = "";
    $valid = true;

    function clean_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if(isset($_GET['year'])) {
      $year = clean_input($_GET['year']);
      $week = clean_input($_GET['week']);
      $day = clean_input($_GET['day']);
      $hour = clean_input($_GET['hour']);
      $minutes = clean_input($_GET['minutes']);
      $time_stamp = clean_input($_GET['time_stamp']);
      $user_id = clean_input($_GET['user_id']);
    } else {
      $valid = false;
    }

    if ($valid == true) {
        // Open the database
        $database = new SQLite3("database.db"); 
      
        // Begin INSERT
        // Insert a test entry
        $query_string = "INSERT INTO availability (time_stamp, year, week, day, hour, minutes, user_id)
                         VALUES ('$time_stamp', '$year', '$week', '$day', '$hour', '$minutes', '$user_id');";

        $database->query($query_string);
        echo "Success. ";
        // End INSERT

        // Close the database
        $database->close();
    }
?>
