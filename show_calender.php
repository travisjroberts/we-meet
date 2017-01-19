<?php
date_default_timezone_set('America/Chicago');
$dt = new DateTime();
// Check for year and week passed in as variables.
if (isset($_GET['year']) && isset($_GET['week'])) {
    // Set the week / year.
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    // Default to the current week.
    $dt->setISODate($dt->format('o'), $dt->format('W'));
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
// This is where we will build out our table of time slots.
// Each time slot should have an onclick handler.

// List 24 hours using a for loop to echo out each.
$start = "8am";
$end   = "8pm";

$tStart = strtotime($start);
$tEnd   = strtotime($end);
$tNow   = $tStart;

while ($tNow <= $tEnd) {
    echo date("H:i", $tNow) . "<br>";
    $tNow = strtotime('+30 minutes', $tNow);
}
?>
  </tbody>
</table>