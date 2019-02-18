<?php
include("sql.php");

$servername = $_SERVER['SERVER_NAME'];
//$path = $_SERVER['DOCUMENT_ROOT'];
// development environment, change this before production
$path = "/~tuukka/vaalikone";


if (isset($_POST['submit'])) {
	$name = $mysqli->real_escape_string($_POST['name']);
	$urlid = sha1(uniqid());
	$query = "INSERT INTO puolue (puolue, link) VALUES ('$name', '$urlid')";
	$mysqli->query($query);
	
}

// list parties, generate links

$query = "SELECT * FROM puolue";

$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	$nimi = $row['puolue'];
	$urlid = $row['link'];
	$link = $servername . $path . "/ehdokkaalle.php?link=" . $urlid;
	
	echo "<p>";
	echo $nimi . " " . "<a href=$link>" . $link . "</a>";
}



echo "<div class='form'>";
echo "<form action='lisaapuolue.php' method='post'>";
echo "<p>";

echo "Nimi: <input type=text name='name'>";

echo "<input type=submit value='lähetä' name='submit'>";
