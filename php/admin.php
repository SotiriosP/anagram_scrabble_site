<?php
/*
Το συγκεκριμενο script καλειτε αν κανει login καποιος admin.
O admin μπορει να προσθέτει, να τροποποιει και να διαγράφει λέξεις στη βάση δεδομένων, 
καθώς και να βλεπει μια συνολικη λιστα με τους παίκτες και τα αντιστοιχα σκορ τους. 
*/

?>
<html>
<head>
  <title>admin_menu</title>
  
   <link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/admin_page.css">
    
</head>
<body>
  <div class="container">
    <h1>Administrator Μενού</h1>
    <a href="addWord.php">Πρόσθεσε Λέξη</a>
    <a href="modifyWord.php">Τροποποίησε Λέξη</a>
    <a href="deleteWord.php">Διέγραψε λέξη</a>
    <a href="viewScores.php">Συνολικό Σκορ Χρηστών</a>
    <a href="viewWords.php">Εμφάνιση Λίστας Λέξεων</a>
  </div>
</body>
</html>

