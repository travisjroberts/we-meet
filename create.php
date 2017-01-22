<?php
session_start(); 
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Form Demo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style type='text/css'>
      body { font-family: "Open Sans", sans-serif; color: #444; }
    </style>
  </head>
  <body>
    
    <form id="uploadForm" action="api/create_user.php" method="post" enctype="multipart/form-data">
      Username: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" value="Submit">
    </form>
    <div id="response">
      <?php 
        
        if(isset($_SESSION["message"])) {
          echo $_SESSION["message"];
        }
      ?>
    </div>
  </body>
</html>