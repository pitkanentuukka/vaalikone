<?php
include("sql.php");




if (isset($_POST['submit'])) {
	$kysymys = $mysqli->real_escape_string($_POST['kysymys']);
	$query = "INSERT INTO kysymys (kysymys) VALUES ('$kysymys')";
	$mysqli->query($query);
	
}

// list parties, generate links

$query = "SELECT * FROM kysymys";

$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$kysymys = $row['kysymys'];
	
	echo "<p>";
	echo $kysymys . "</p> " ;
}



echo "<div class='form'>";
echo "<form action='lisaakysymys.php' method='post'>";
echo "<p>";

echo "kysymys: <input type=text name='kysymys'>";

echo "<input type=submit value='lähetä' name='submit'>";
