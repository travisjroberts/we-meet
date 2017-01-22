<?php
session_start();
$user_id = $_SESSION['user_id'];

// https://stackoverflow.com/questions/18868128/creation-of-weekly-calender-in-php

date_default_timezone_set('America/Chicago');
$dt = new DateTime();

// Check for year and week passed in as variables

if (isset($_GET['year']) && isset($_GET['week']))
	{

	// Set the week / year

	$dt->setISODate($_GET['year'], $_GET['week']);
	$dt->setTime(8, 0);
	}
  else
	{

	// Default to the current week

	$dt->setISODate($dt->format('o') , $dt->format('W'));
	$dt->setTime(8, 0);
	}

$year = intval($dt->format('Y'));
$week = intval($dt->format('W'));

// show links using one SELECT STATEMENT

$query_string = "SELECT * FROM 'availability' WHERE year='$year' AND week='$week' AND user_id='$user_id'";

// Open the database

$database = new SQLite3("database.db");

// Query the database

$result = $database->query($query_string);
$selectedTimes = [];

// Loop through results

while ($row = $result->fetchArray())
	{
	array_push($selectedTimes, $row['time_stamp']);
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

for ($i = 0; $i < 7; $i++)
	{
	echo "<td class='dark'>" . $dt->format('l') . "<br />" . $dt->format('d M Y') . "</td>\n";

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

for ($d = 0; $d < 28; $d++)
	{
	echo "<tr>";
	for ($i = 0; $i < 7; $i++)
		{
		$epoch = $dt->format('U');
		$isSelected = in_array($dt->format('U') , $selectedTimes);
		if ($isSelected)
			{
			echo "<td selected='selected' style='background-color: green;' onclick='toggleTime(this, $epoch)'>" . $dt->format('h:i A');
			}
		  else
			{
			echo "<td onclick='toggleTime(this, $epoch)'>" . $dt->format('h:i A');
			};

		// HERE

		$dt->modify('+1 day');
		echo "</td>";
		}

	// HERE

	$dt->modify('-7 day');
	$dt->modify('+30 minutes');
	echo "</tr>";
	}

?>
  </tbody>
</table>