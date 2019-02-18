<?php
include("sql.php");


if (isset($_POST['submit'])) {
	// find the candidates to match the answers
	$vaalipiiri = $mysqli->real_escape_string($_POST['vaalipiiri']);
	$haeehdokkaat = "select * from ehdokas where vaalipiiri = '$vaalipiiri'";

	// and then the crazy difficult part ... 
	$get_question_count = "select count(*) from kysymys";
	$count_result = $mysqli->query($get_question_count);
	$question_count_row=$count_result->fetch_row();
	$question_count = $question_count_row[0]; 


	

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
