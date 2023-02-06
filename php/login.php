<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/default_page.css">
</head>

<body bgcolor="white" text="black">
<h1 style = "text-align:center;font-size: 30px>"><i><b>Scramble Game</b></i></h1> 
<h1 style = "text-align:center;font-size: 30px>"><b>Login Page</b></h4> 
<form name="loginForm" action="" method="post" accept-charset="utf-8" style = "text-align:center;font-size: 24px;width: 25%;margin: auto;background-color: #FFBABA;">
	<!--Δημιουργία Form για την εισαγωγη των στοιχειων του χρήστη για το log In-->
	<!--Εισαγωγη του username σε αντιστοιχο label-->
	<label for="username">Please insert your username:</label><br>
	<input type="text" id="username" name="username"><br>
	  
	 <!--Εισαγωγη του password σε αντιστοιχο label. Δηλωση type=password, 
	 ωστε να μην εμφανιζεται ο κωδικος για λογους ασφαλειας-->
	<label for="password">Please insert your password:</label><br>
	<input type="password" id="password" name="password"><br><br>
	 
	 <!--Δημιουργια το submit--> 
	<input type="submit" name="submit" value="Log In">
</form> 
</body>
</html>


<?php
//Ανοιγω PHP session για να κραταω τα στοιχεια του χρηστη και να τα κανω retrieve οποιαδηποτε στιγμη τα χρειαζομαι
session_start();
	  /*
		Δημιουργια του αντιστοιχου script PHP για το log In.
		Θα τραβηξω τα δεδομενα που εισαγει ο χρηστης στη φορμα html και
		θα κανω τον ελεγχο με τη βαση δεδομενων. Αν βρεθει ένα (1) match
		με τη βαση, του επιτρέπω την είσοδο και τον κατευθύνω στην κεντρική σελίδα
		του παιχνιδιού
	  */
	  
	  //Πα΄ιρνω τα στοιχεια που εισηγαγε ο χρηστης στις αναλογες φορμες
	  $username = $_POST['username'];
	  $password = $_POST['password'];
	  
	  $_SESSION['player_name'] = $username;
	  $_SESSION['player_password'] = $password;
	  $_SESSION['player_log'] = 0;
	
	  include 'db.php';
	
	  //Απαραιτητο για χρηση ελληνικων χαρακτηρων. 
	  mysqli_query($link, "SET NAMES utf8 collate utf8_general_ci"); 
	
	  /*Κανω ελεγχο αν υπαρχει match των  credentials που εισηγαγε ο χρηστης
	    με εγγραφες του πινακα*/
	  $query = "SELECT * FROM scramble_users WHERE name LIKE '%$username%' AND password='$password'";
	  $result = mysqli_query($link, $query);
	  
	  $row = mysqli_fetch_array($result);
	  
      $_SESSION['player_id'] = $row['player_id'];
      $player_id=$_SESSION['player_id'];
	  
	  //Αν βρεθει εστω μια εγγραφη, τοτε το login ειναι επιτυχημενο και ο user ειναι logged in 
	  if (mysqli_num_rows($result) != 0 && $_POST['submit']){
	  	$_SESSION['player_log'] = 1;
	  	
	  	if($player_id == 1){
	  	header("Location: https://195.251.218.44/code/workspace/ddpms22533/scramble/php/admin.php");
	    exit;	
	  	}
	  	// Κανω redirect τον user στην main page του παιχνιδιου
	  	else{
	  	mysqli_query($link, "UPDATE scramble_scores SET games_played = games_played + 1 WHERE player_id ='$player_id'");
	    header("Location: https://195.251.218.44/code/workspace/ddpms22533/scramble/php/game.php");
	    exit;
	  	}
	  }
	  else if ($_POST['submit']){
		//Εμφανιζω καταλληλο μηνυμα λαθος.
		echo "Error: Λάθος όνομα ή κωδικός. Προσπάθησε ξανά!";
		}	 

	  mysqli_close($link);  
?>