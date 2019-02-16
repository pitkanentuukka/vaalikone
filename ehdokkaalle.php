<?php

include("sql.php");

// if form is submitted, validate and save answers to database
// otherwise, fetch all questions and create the form

if (isset($_POST['submit'])) {

} else {
	// puolue otetaan get-parametrina, se pitää validoida
	$puolue = $_GET['puolue'];
	$query = $mysqli->prepare('SELECT * FROM puolue WHERE puolue = ?');



}

