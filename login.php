<?php
session_start(); 
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Form Demo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.0/build/grids-responsive-min.css">
    <style type='text/css'>
      body { font-family: "Open Sans", sans-serif; color: #444; }
      .pure-g {padding-top: 40px}
    </style>
  </head>
  <body>
    <div class="pure-g">
      <div class="pure-u-1 pure-u-md-1-6"></div>
      <div class="pure-u-1 pure-u-md-2-3">    
        <form id="uploadForm" action="api/login_user.php" method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
          <div class="pure-control-group">
            <label for="name">Username</label>
            <input name="username" type="text" placeholder="Username" required>
          </div>
          <div class="pure-control-group">
            <label for="name">Password</label>
            <input name="password" type="password" placeholder="Password" required>
          </div>
          <div class="pure-controls">
            <label for="cb" class="pure-checkbox">
              <input id="cb" type="checkbox" required> I've read the terms and conditions
            </label>
            <input type="submit" class="pure-button pure-button-primary" value="Submit">
            <div id="response">
              <br><br>
              <?php
                if(isset($_SESSION["message"])) {
                  echo $_SESSION["message"];
                }
              ?>
            </div>
          </div>
        </form>
        
        <hr/>
        Don't have an account? <a href="create.php">create one</a>
      </div>
      <div class="pure-u-1 pure-u-md-1-6"></div>
    </div>

  </body>
</html>