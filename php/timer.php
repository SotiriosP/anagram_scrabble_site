<?php
// Set the target date for the countdown (2 minutes from now)
$targetDate = time() + 2 * 60;

// Get the current date and time
$currentDate = time();

// Find the distance between the current date and the target date
$distance = $targetDate - $currentDate;

// Calculate the minutes and seconds
$minutes = floor($distance / 60);
$seconds = $distance % 60;

// Check if the countdown has expired
if ($distance < 0) {
  echo "ΤΕΛΟΣ ΧΡΟΝΟΥ!!!\n"; 
  
} else {
  // Display the result
  echo "$minutes minutes $seconds seconds";
}

?>