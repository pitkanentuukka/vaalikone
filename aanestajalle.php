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

	$comparison_numbers = array();
	while ($row = $candidates_result->fetch_array(MYSQLI_ASSOC)) {
		//var_dump($row);
		$candidateid = $mysqli->real_escape_string($row['id']);
		$candidate_name = $row['nimi'];
		//echo "<p>ehdokkaan nimi: " . $candidate_name . "</p>";
		$getcandidateanswers = "SELECT * FROM vastaus WHERE ehdokasid = '$candidateid'";
		$result = $mysqli->query($getcandidateanswers);
		
		//var_dump($result);
		$answers = $_POST['radios'];
		$comparison_sum = 0;
		foreach ($answers as $answer) {
			//echo "<p>äänestäjän vastaus: ";
			//var_dump($answer);
			//echo "</p>";
			//echo $answer . "<p>";
			while ($candidateanswer = $result->fetch_array(MYSQLI_ASSOC)) {
			//echo "<p>ehdokkaan vastaus: ";
				//var_dump($candidateanswer['vastaus']);
			//echo "</p>";
			//echo "<p>vertausluku: ";	
			$comparison = abs($candidateanswer['vastaus'] - $answer);
			//echo $comparison . "</p>";
			$comparison_sum += $comparison;
			}
			//echo "<p> summa : " . $comparison_sum . "</p>";
			$comparison_numbers[$candidateid] = $comparison_sum;
		}
	
	
	}
	/*echo "<p>numbers: ";
	var_dump($comparison_numbers);
	echo "</p><p>sorted:";
	asort($comparison_numbers);
	var_dump($comparison_numbers);
	echo " </p>";*/


	echo "<p><h2>sopivimmat ehdokkaat: </h2></p>";

	$getquestions = "SELECT * FROM kysymys";
	$questionresult = $mysqli->query($getquestions);
	foreach ($comparison_numbers as $id => $value) {
		
		//var_dump($comparison_numbers);
		$query = "SELECT * FROM ehdokas where id = $id";
		//var_dump($query);
		$result = $mysqli->query($query);
		$candidaterow = $result->fetch_row();
		//var_dump($result);
		///var_dump($result);
		echo "<p>";
	
		echo "Nimi: ";
		echo $candidaterow[3];
		echo "<br />";
		echo "Numero: ";
		echo $candidaterow[4];
		echo "<br />";
		echo "puolue: ";
		$getparty = "SELECT * from puolue WHERE id = '$candidaterow[1]'";
		$partyresult = $mysqli->query($getparty);

		//var_dump($partyresult);
		$partyrow = $partyresult->fetch_row();
		echo $partyrow[1];
		echo "<br />";

		echo "</p>";
	



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
