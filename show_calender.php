<?php
date_default_timezone_set('America/Chicago');
$dt = new DateTime();
// Check for year and week passed in as variables.
if (isset($_GET['year']) && isset($_GET['week'])) {
    // Set the week / year.
    $dt->setISODate($_GET['year'], $_GET['week']);
    $dt->setTime(8,0);
} else {
    // Default to the current week.
    $dt->setISODate($dt->format('o'), $dt->format('W'));
    $dt->setTime(8,0);
}
?>

    <!-- Echo out the table -->
    <table class="pure-table">
        <!-- Create the table headers -->
        <thead>
            <tr>
                <?php
for ($i = 0; $i < 7; $i++) {
    echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</td>\n";
    // PHP function that adds one day to our date.
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
for($d = 0; $d < 28; $d++) 
	
	{
		echo "<tr>";	
		  
		for($i = 0; $i < 7; $i++){
			$epoch = $dt->format('U');
			echo "<td onclick='toggleTime(this, $epoch)'>" . $dt->format('h:i A');
			// HERE
			$dt->modify('+1 day');
		}
		// HERE
		$dt->modify('-7 day');
		$dt->modify('+30 minutes');
		echo "</tr>";
	}

?>
        </tbody>
    </table>
