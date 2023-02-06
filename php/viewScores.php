<?php

	
	include 'db.php';
	
	mysqli_query($link, "SET NAMES utf8 collate utf8_general_ci"); 
	
	$result = mysqli_query($link, "SELECT scramble_users.name, scramble_scores.score FROM scramble_users 
				INNER JOIN scramble_scores ON scramble_users.id=scramble_scores.player_id WHERE scramble_users.id > 1 ORDER BY scramble_scores.score DESC");
				
	
	echo '<style>';
	echo 'table {display: flex;
				 align-items: center;
				 justify-content: center;
				 height: 100%;
				 width: 100%;
				 font-weight: 800;
				 text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
				 font-size: 25;
				 }';

	echo 'table tr:nth-child(odd) {
				 background-color: #f2f2f2;
				 }';
	echo 'table tr:hover {
				 background-color: #ffc0cb;
				 }';
				 
	echo '</style>';
	
	echo "<table>";
	echo "<tr><th>Όνομα Παίκτη</th><th>Σκορ</th></tr>";
	while ($row = mysqli_fetch_assoc($result)) {
    	$name = $row['name'];
    	$score = $row['score'];
    	echo "<tr><td>$name</td><td>$score</td></tr>";
	}
	echo "</table>";
	
	mysqli_close($link);
?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/code/workspace/ddpms22533/scramble/php/ranking_page.css">
</head>
<body>
</body>

</html>
