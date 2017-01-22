<?php
	session_start();
	$time_stamp = "";
    $user_id = $_SESSION['user_id'];
  
  if(isset($_GET["time_stamp"])) {
    $time_stamp = clean_input($_GET["time_stamp"]);
    $query_string = "DELETE FROM availability WHERE time_stamp = '$time_stamp' AND user_id = '$user_id'"; // user_id = 4";
  
    // Open the database
    $database = new SQLite3("database.db");
  
    // Query the database
    $database->query($query_string);
  
    // Close the database
    $database->close();
    echo "Time $time_stamp was removed for $user_id.";  
  } else {
      
    echo "No time.. provided";
  }

  function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>