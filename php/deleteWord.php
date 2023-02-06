<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/default_page.css">
</head>
<body>
	
  <form method="POST" action="deleteWord.php" accept-charset="utf-8" style = "text-align:center;font-size: 34px;width: 35%;margin: auto;background-color: #FFBABA;">
  <label for="word">Enter a Word to delete: </label><br>
  <input type="text" id="word" name="word" required><br>
  
  <button type="submit" name="submit">Submit</button>
  </form> 

</body>

</html>

<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['word'])) {
    $word = $_POST['word'];
    
	mysqli_query($link, "DELETE FROM scramble_words WHERE word='$word'");
		if (mysqli_affected_rows($link) == 1) {
			echo "<script>alert('Η διαγραφή της λέξης ολοκληρώθηκε επιτυχώς!')</script>";
		} else {
			echo "<script>alert('Η διαγραφή της λέξης απέτυχε. Παρακαλώ προσπαθήστε ξανά!')</script>";
		} 

  } else {

    echo "Error: Εισήγαγε Λέξη προς Διαγραφή!";
  }
}

mysqli_close($link);  
?>
