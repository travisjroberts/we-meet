<?php
  session_start();
  $valid = true;
  $password = $_POST["password"];
  $filter_password = filter_var($password, FILTER_SANITIZE_STRING);
  if(isset($password) && $password == $filter_password && strlen($password) > 4) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
  } else {
    $_SESSION["message"] = "Invalid password. Must not contain HTML tags. Must be greater than 4 characters.";
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
      $token = generateRandomString(24);
      $query_string = "INSERT INTO users (username, hash, token)
                       VALUES ('$user', '$hash', '$token');";
      $database->query($query_string);
    }else {
      $_SESSION["message"] = "User with that username already exists.";
      $valid = false;
    }
    $database->close();
  } else {
    $_SESSION["message"] = "Invalid username.";
    $valid = false;
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  if($valid) {
    header( "Location: ../login.php" );
    exit();
  } else {
    header( "Location: ../create.php" );
    exit(); 
  }

?>