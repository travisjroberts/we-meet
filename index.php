<?php
include ('api/check_token.php');

?>
<!DOCTYPE html>
<html> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Calendar</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="moment.js"></script>
    <script type="text/javascript">
      
      var displayWeek;
      var displayYear;

      // Shorthand for $( document ).ready()

      $(function() {
          console.log( "ready!" );
          currentWeek();
      });

      // Decrease week and reload calendar

      function previousWeek() {
        displayWeek = displayWeek - 1;
        showCalendar();
      }
      
      // Load calendar for this week

      function currentWeek() {

        // moment.js is a library to make working with dates easier

        displayWeek = parseInt(moment().format('W'));
        displayYear = parseInt(moment().format('Y'));
        showCalendar();
      }

      // Increase week and reload calendar

      function nextWeek() {
        displayWeek = displayWeek + 1;
        showCalendar();
      }
      
      function showCalendar() {

        // jQuery    

        $.ajax({
          type: "GET",
          url: "show_calendar.php",
          data: {week: displayWeek, year: displayYear},
          success: function( data ) {
            $( "#calendar" ).html( data );
          }
        });
      }
        
      function compareCalender() {

        // jQuery    

        $.ajax({
          type: "GET",
          url: "compare_calendar.php",
          data: {week: displayWeek, year: displayYear},
          success: function( data ) {
            $( "#calendar" ).html( data );
          }
        });
      }

	  // http://momentjs.com/docs/

	  function toggleTime(td, epoch) {  

        // Store in database using ajax
        // Create your variables

        var timestamp = epoch;
        console.log(timestamp);
        
        var year = moment.unix(epoch).format('YYYY');
        console.log(year);
        
        var week = moment.unix(epoch).format('W');
        console.log(week);
          
        var day = moment.unix(epoch).format('DDD');
        console.log(day);
        
        var hour = moment.unix(epoch).format('H');
        console.log(hour);
        
        var minutes = moment.unix(epoch).format('m');
        console.log(minutes);


        var selected = $( td ).attr( "selected" );


      if (selected) {

          // Send variables via AJAX to remove_time.php
          
	      $.ajax({
	        type: "GET",
	        url: "remove_time.php",
	        data: {time_stamp: timestamp},
            success: function( data ) {
			console.log("time removed");
			
            }
	       });
	   		$(td).removeAttr('selected');
            $(td).css('background-color', ''); // Set background color to none

        } else {

          // Send variables via AJAX to add_time.php

          $.ajax({
            type: "GET",
            url: "add_time.php",
            data: {time_stamp: timestamp, year: year, week: week, day: day, hour: hour, minutes: minutes},
            success: function( data ) {

            }
          });
          
          $(td).attr('selected', 'true');
          $(td).css('background-color', 'green');
        }
	  }
    </script>
  </head>
  
  <body>
      
	<div class="buttons-container"> 
        <a class="logout button" href="api/logout_user.php">Log out</a>
        <a class="compare button" onclick="compareCalender()">Compare</a>
        <a class="button" onclick="nextWeek()">Next Week</a>
        <a class="button" onclick="currentWeek()">Current Week</a>
        <a class="button" onclick="previousWeek()">Previous Week</a>
    </div>
    <div id="calendar"></div>

  </body>
</html>