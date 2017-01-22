<?php
  session_start();
  $user_token = $_SESSION["user_token"];
  $user_id = $_SESSION["user_id"];
  if ( !isset($user_token) ) {
    $user_token = $_POST["user_token"];
    $user_id = $_POST["user_id"];
  }
  if ( !isset($user_token) ) {
    $_SESSION["message"] = "You must login first.";
    header( "Location: login.php" );
    exit();
  } else {
    $user_token = filter_var($user_token, FILTER_SANITIZE_STRING);
    $database = new SQLite3("database.db"); 

    $query_string = "SELECT * FROM users WHERE token = '$user_token' AND id = '$user_id'";
    $result = $database->query($query_string);
    $row = $result->fetchArray();
    $database->close();
    if($row == false) {
      $_SESSION["message"] = "You must login first.";
      header( "Location: login.php" );
      exit();
    } else {
      // Success! 
    }
  }
?>