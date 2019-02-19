<?php
include("sql.php");


if (isset($_POST['submit'])) {
	// find the candidates to match the answers
	$district = $mysqli->real_escape_string($_POST['vaalipiiri']);
	$getcandidates = "select * from ehdokas where vaalipiiri = '$district'";
	$candidates_result = $mysqli->query($getcandidates);
	if ($candidates_result->num_rows == 0) exit(" emme löytäneet ehdokkaita valitsemastasii vaalipiiristä");
	// and then the crazy difficult part ... 
	$get_question_count = "select count(*) from kysymys";
	$count_result = $mysqli->query($get_question_count);
	$question_count_row=$count_result->fetch_row();
	$question_count = $question_count_row[0]; 

	// at least two layered loops
	// three?
	//var_dump($candidates_result);
	while ($row = $candidates_result->fetch_array(MYSQLI_ASSOC)) {
		//var_dump($row);
		$candidateid = $mysqli->real_escape_string($row['id']);
		$getcandidateanswers = "SELECT * FROM vastaus WHERE ehdokasid = '$candidateid'";
		$result = $mysqli->query($getcandidateanswers);
		
		//var_dump($result);
		$answers = $_POST['radios'];
		$comparison_numbers = array();
		foreach ($answers as $answer) {
			echo "<p>äänestäjän vastaus: ";
			var_dump($answer);
			echo "</p>";
			//echo $answer . "<p>";
			while ($candidateanswer = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<p>ehdokkaan vastaus: ";
				var_dump($candidateanswer['vastaus']);
			echo "</p>";
			echo "<p>vertausluku: ";	
			$comparison = abs($candidateanswer['vastaus'] - $answer);
			echo $comparison . "</p>";
			}
		}
	
	
	}

} else {

	echo "<div class='form'>";
	echo "<form action='aanestajalle.php' method='post'>";
	echo "<p>";

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
	
	}
	
	echo "<input type=submit value='lähetä' name='submit'>";
}
?>
