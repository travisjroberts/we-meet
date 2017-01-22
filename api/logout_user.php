<?php
  session_start();
  $_SESSION['user_token'] = "";
  $_SESSION['user_id'] = "";
  $_SESSION['message'] = "";
  header( "Location: ../login.php" );
  exit(); 
?>