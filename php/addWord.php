<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/default_page.css">
</head>
<body>
	
  <form method="POST" action="addWord.php" accept-charset="utf-8" style = "text-align:center;font-size: 34px;width: 35%;margin: auto;background-color: #FFBABA;">
  <label for="word">Enter a new Word: </label><br>
  <input type="text" id="word" name="word" required><br><br>
  <label for="number">Enter the value of the new Word: </label><br>
  <input type="text" id="number" name="number" required><br>
  
  <button type="submit" name="submit">Submit</button>
  </form> 

</body>

</html>

<?php

include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['number']) && !empty($_POST['word'])) {
    $number = $_POST['number'];
    $word = $_POST['word'];
    
	mysqli_query($link, "INSERT INTO scramble_words (`id`, `word`, `value`) VALUES (NULL, '$word', '$number')");
		if (mysqli_affected_rows($link) == 1) {
			echo "<script>alert('Η εισαγωγή της λέξης ολοκληρώθηκε επιτυχώς!')</script>";
		} else {
			echo "<script>alert('Η εισαγωγή της λέξης απέτυχε. Παρακαλώ προσπαθήστε ξανά!')</script>";
		} 

  } else {

    echo "Error: Εισήγαγε Λέξη και τους Βαθμούς της αντίστοιχα!";
  }
}

mysqli_close($link);  
?>