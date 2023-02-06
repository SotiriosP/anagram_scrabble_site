// Set the target date for the countdown (2 minutes from now)
var targetDate = new Date().getTime() + 2 * 60 * 1000;

// Update the countdown every 1 second
var countdown = setInterval(function() {
  // Get the current date and time
  var currentDate = new Date().getTime();

  // Find the distance between the current date and the target date
  var distance = targetDate - currentDate;

  // Calculate the minutes and seconds
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with the ID "timer"
  document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

  // If the countdown is finished, clear the interval and display a message
  if (distance < 0) {
    clearInterval(countdown);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);
