<?php
  session_start();
  $valid = true;
  $password = $_POST["password"];
  $hash = "";
  $user_id = "";
  $token = "";
  $filter_password = filter_var($password, FILTER_SANITIZE_STRING);

  if(isset($password) && $password == $filter_password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
  } else {
    $_SESSION["message"] = "Invalid password.";
    $valid = false;
  }
  
  $user = $_POST["username"];
  $filter_user = filter_var($user, FILTER_SANITIZE_STRING);
  if(isset($user) && $user == $filter_user) {
    // Check for duplicates
    $database = new SQLite3("../database.db"); 
    $query_string = "SELECT * FROM users WHERE username = '$user'";
    $result = $database->query($query_string);
    $row = $result->fetchArray();
    
    if($row == false) {
      $_SESSION["message"] = "User not found.";
      $valid = false;
    }else {
      $hash = $row['hash'];
      $token = $row['token'];
      $user_id = $row['id'];
    }
    $database->close();
  } else {
    $_SESSION["message"] = "Invalid username.";
    $valid = false;
  }


  if($valid) {
    if (password_verify($password, $hash)) {
      $_SESSION['user_token'] = $token;
      $_SESSION['user_id'] = $user_id;
      // Invalid credentials
      header( "Location: ../index.php" );
      exit(); 
    } else {
      // Invalid credentials
      $_SESSION["message"] = "Invalid credentials.";
      header( "Location: ../login.php" );
      exit(); 
    }

  } else {
    header( "Location: ../login.php" );
    exit(); 
  }



?>