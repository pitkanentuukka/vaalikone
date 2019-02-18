<?php
error_reporting(E_ALL);
include("sql.php");
// if form is submitted, validate and save answers to database
// otherwise, fetch all questions and create the form

if (isset($_POST['submit'])) {
	// we need to validate that all questions have been answered before we get here
	// let's find a javascript library for that

	// debug!!
	//var_dump($_POST);die;
	$get_question_count = "select count(*) from kysymys";
	$count_result = $mysqli->query($get_question_count);
	$question_count_row=$count_result->fetch_row();
	$question_count = $question_count_row[0]; // there's gotta be an easier way to get the count

	$puolueid = 1; // FIXME!!! tää on testausta varten
	$vaalipiiriid = $mysqli->real_escape_string($_POST['vaalipiiri']);
	$ehdokasnimi = $mysqli->real_escape_string($_POST['name']);
	$numero = $mysqli->real_escape_string($_POST['numero']);
	$insertehdokas = "INSERT INTO ehdokas (puolue, vaalipiiri, nimi, numero) VALUES ('$puolueid', '$vaalipiiriid',  '$ehdokasnimi', '$numero' )";
	//$mysqli->begin_transaction();	
	$mysqli->query($insertehdokas);
	$ehdokas_id = $mysqli->insert_id;
	
	for ($i=1;$i<=$question_count;$i++) {
		//var_dump($i);
		//var_dump($_POST['radios']);
		$answers = $_POST['radios'];
		//echo "<p>answers: ";
		$answer = $mysqli->real_escape_string($answers[$i]);
		//echo "</p><p>comments: ";
		$comments = $_POST['comments'];
		$comment = $mysqli->real_escape_string($comments[$i]);
		//var_dump($comments[$i]);
		//echo "</p> ";
		//var_dump($_POST["radios"[$i]]);
		
		//$insertanswer = "INSERT INTO vastaus (, "

		$insert = "INSERT INTO vastaus (kysymysid,ehdokasid, vastaus, teksti) VALUES ('$i', '$ehdokas_id', '$answer', '$comment')";
		$mysqli->query($insert);


	}
	die;
	//foreach ($_POST['radios'] as $answers) {
	/*while ($i<
		//var_dump($answers);
		
		$vastaus = $mysqli->real_escape_string($answers);
		//var_dump($vastaus);
		var_dump($_POST['comments'[$i]]);
		$i++;

	}*/
	
//	$mysqli->commit();


} else {

	echo "<div class='form'>";
	echo "<form action='ehdokkaalle.php' method='post'>";
	echo "<p>";
	echo "Nimi: <input type=text name='name'>";
	echo "</p>";
	echo "<p>";
	echo "Ehdokasnumero: <input type=text name='numero'>";
	echo "</p>";
	$query = "SELECT * FROM vaalipiiri";
	$result = $mysqli->query($query);
	echo "Vaalipiiri: <select name='vaalipiiri'>";
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

		echo "<option value=" . $row['id'] .">" . $row['vaalipiiri'] ."</option>";

	}
	echo "</select>";

	$query = "SELECT * FROM kysymys";
	$result = $mysqli->query($query);

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		echo "<p>";
		echo "<div>". $row['kysymys']."</div>";
		echo "<div>";	
		$id = $row['id'];
		echo "<input type='radio' name='radios[$id]'";
			echo " value='1'>vahvasti eri mieltä";
		echo "<input type='radio' name='radios[$id]'";
			echo " value='2'>eri mieltä";
		echo "<input type='radio' name='radios[$id]'";
			echo " value='3'>ei mitään mieltä";
		echo "<input type='radio' name='radios[$id]'";
			echo " value='4'>samaa mieltä";
		echo "<input type='radio' name='radios[$id]'";
		echo " value='5'>vahvasti samaa mieltä";
		echo "</div>";	
		echo "<div>";	
		echo "Lisäkommenti: <textarea name='comments[$id]' rows=5 cols=40></textarea>";


		echo "</p>";
	}
	echo "<input type=submit value='lähetä' name='submit'>";
}
