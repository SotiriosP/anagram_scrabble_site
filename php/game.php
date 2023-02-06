<?php

//Ανοιγω PHP session για να κραταω τα στοιχεια του χρηστη και να τα κανω retrieve οποιαδηποτε στιγμη τα χρειαζομαι
session_start();
/*
Εμφανίζει το ονομα του χρηστη, το σκορ και τον αριθμό των συνολικων παιχνιδιων.
Επίσης εμφανιζει με random αλληλουχια, μια λεξη την οποια τραβαει απο τo πινακα scramble_words της βασης.
Στη συνεχεια μφανίζει το διαθέσιμο χρόνο και ποσους ποντους δινει η συγκεκριμενη λεξη.
Τελος δινει τη δυνατοτητα στο χρηστη να παρει 3 βοηθειες και εμφανιζει το 1ο,2ο,και 3ο γραμμα αντιστοιχα.
*/

//Content type και character encoding
header('Content-Type: text/html; charset=UTF-8');
$player_name=$_SESSION['player_name'];
$player_password=$_SESSION['player_password'];
$player_log=$_SESSION['player_log'];
$player_id=$_SESSION['player_id'];

//Εισάγω τη βάση δεδομενων και τη σύνδεση εκει
include 'db.php';
mysqli_query($link, "SET NAMES utf8 collate utf8_general_ci"); 

//Κανω retrieve τα στοιχεια παιχνιδιων του χρηστη απο τη βαση με SQL query.
$query = "SELECT * FROM scramble_scores WHERE player_id ='$player_id'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

//Τα θετω σε μεταβλητες αναλογα
$num_games=$row['games_played'];
$sum=$row['score'];
$current_word=$row['current_word'];
$helps = $row['helps'];
$revealed = $row['letters_revealed'];

//Κάνω fetch τη λεξη και το αντιστοιχο value της απο τον αλλο πινακα-words της βασης
$query = "SELECT * FROM scramble_words WHERE id ='$current_word'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

$word = $row['word'];
$word_value =$row['value']; 

$letters1 = str_split($word);
shuffle($letters1);
$shuffled_word = implode("", $letters1);

//$letters2 = str_split($shuffled_word);

?>


<html>
	<!-- Αντιστοιχα δημιουργια του HTML κωδικα για εμφανιση ολου το interface του παιχνιδιου -->
<head>
	<title>Scramble Game</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/default_page.css">
</head>

<body style="text: black;">
	<h1 style="font-size: 35px; text-align: center;"><center>Scramble</center></h1>
	<p style="font-size: 30px; text-align: center;">Have fun playing the game!</p>
	<br>
	<p style="font-size: 30px; text-align: center;width: 25%;height: 5%;background-color: #FFBABA;margin: auto;">Παιχνίδι Αναγραμματισμού</p>
	<p>
	<form  style="width: 25%;font-size: 20px; text-align: left; margin: auto;background-color: #FFBABA;">
		
	    <label>Παίκτης:
	    <input type="text" name="player_field" value="<?php echo $player_name; ?>" readonly>
	    </label><br>
	    <label>Σκορ:
	    <input type="text" name="sum_field" value="<?php echo $sum; ?>" readonly>
	    </label><br>
	    <label>Παιχνίδια:
	    <input type="text" name="games_field" value="<?php echo $num_games; ?>" readonly>
	    </label><br>
	    <label>Βαθμοί:
	    <input type="text" name="points_field" value="<?php echo $word_value; ?>" readonly>
	    </label><br>
	    <label>Αρχικά γράμματα:
	    <input type="text" name="letters_field" value="<?php echo $shuffled_word; ?>"readonly>
	    </label><br>
	    <label>Αριθμός Βοηθειών:
	    <input type="text" name="helps_field" value="<?php echo $helps; ?>"readonly>
	    </label><br>
	    <label>Βοηθητικά Γράμματα:
	    <input type="text" name="letters_helps_field" value="<?php echo $revealed; ?>"readonly>
	    </label><br>
	</form>
	</p>
	
	<form style="font-size: 30px; text-align: center;" name="helpForm" action="" method="post" accept-charset="utf-8">
	<input type="submit" name="help" value="Θέλω βοήθεια (-10 βαθμοί)!"<?php if ($helps == 0) echo "3 helps are already used. Sorry!"; ?>><br>
	</form>
	
	<form style="font-size: 30px; text-align: center;" name="wordForm" action="" method="post" accept-charset="utf-8">
	<label for="word" style="font-size: 30px; text-align: center;width: 25%;height: 5%;background-color: #FFBABA;margin: auto;">Πληκτρολογήστε τη λέξη:</label>
	<br>
	<input type="text" id="word" name="word">
	 <!--Δημιουργια του submit--> 
	<input type="submit" name="submit" value="Το βρήκα!">
	</form>
	
	<!-- Δμιουργια του script του μετρητη/ρολοι στο αρχειο timer.js και κληση του εδω. Εισαγωγη cs για αλλαγη της μορφης του timer  -->
	<div id="timer" style="font-size: 48px;
  width: 20%;
  height: 8%;
  font-weight: bold;
  font-family: sans-serif;
  color: #black;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
  background-image: linear-gradient(to right, white, #FFE2E2, pink, #FF8686, red);
  margin: auto;"></div>
	
	<script src="timer.js"></script>
</body>
</html>

<?php

//Έλεγχος για το ποιο από τα δύο κουμπιά πατήθηκε για να γίνει refresh στη σελιδα
if(isset($_POST['help'])) {
  if ($helps > 0) {
        $helps--;
        $sum = $sum - 10;
        $query = "UPDATE scramble_scores SET helps='$helps', score='$sum' WHERE player_id ='$player_id'";
        mysqli_query($link, $query);

        $letters_revealed = substr($word, 0, 3 - $helps);
        $query = "UPDATE scramble_scores SET letters_revealed='$letters_revealed' WHERE player_id ='$player_id'";
        mysqli_query($link, $query);
        // κανω manually redirect τον user για να εμφανιστουν τα updated στοιχεια στους πινακες, χωρις χρηση AJAX
		header("Location: " . $_SERVER["REQUEST_URI"]);
    }
} elseif(isset($_POST['submit'])){
	$submitted_word = $_POST['word'];
	if ($word == $submitted_word) {
	    
	    $sum+=$word_value;
	    mysqli_query($link, "UPDATE scramble_scores SET score = '$sum' WHERE player_id='$player_id'");
	    mysqli_query($link, "UPDATE scramble_scores SET current_word = current_word + 1 WHERE player_id ='$player_id'");
	    // κανω manually redirect τον user για να εμφανιστουν τα updated στοιχεια στους πινακες, χωρις χρηση AJAX
		header("Location: " . $_SERVER["REQUEST_URI"]);
	    }

}

mysqli_close($link);
?>



