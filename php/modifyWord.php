<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/default_page.css">
</head>
<body>
	
  <form method="POST" action="modifyWord.php" accept-charset="utf-8" style = "text-align:center;font-size: 26px;width: 35%;margin: auto;background-color: #FFBABA;">
  <label for="id">Enter the ID of the word to be modified: </label><br>
  <input type="text" id="id" name="id" required><br><br>
  <label for="word">Enter the new word: </label><br>
  <input type="text" id="word" name="word" required><br><br>
  <label for="number">Enter the new value of the modified word: </label><br>
  <input type="text" id="number" name="number" required><br>
  
  <button type="submit" name="submit">Submit</button>
  </form> 

</body>

</html>

<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['number']) && !empty($_POST['word']) && !empty($_POST['id'])) {
    $number = $_POST['number'];
    $word = $_POST['word'];
    $id = $_POST['id'];
    
	mysqli_query($link, "UPDATE scramble_words SET word='$word', value='$number' WHERE id='$id'");
		if (mysqli_affected_rows($link) == 1) {
			echo "<script>alert('Η επεξεργασία της λέξης ολοκληρώθηκε επιτυχώς!')</script>";
		} else {
			echo "<script>alert('Η επεξεργασία της λέξης απέτυχε. Παρακαλώ προσπαθήστε ξανά!')</script>";
		} 

  } else {

    echo "Error: Εισήγαγε νέα Λέξη και τους Βαθμούς της αντίστοιχα!";
  }
  
}

mysqli_close($link);  
?>
