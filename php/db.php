<?php
// Ανοιγω συνδεση με τη βαση δεδομενων
	  $link = mysqli_connect("127.0.0.1","ddpms22533","dpmsp@$$","ddpms22533");
	
	  if(mysqli_connect_error()){
			exit ("Connect error: ".mysqli_connect_error());
		}
