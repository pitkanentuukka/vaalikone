<?php
error_reporting(E_ALL);
include("sql.php");
// if form is submitted, validate and save answers to database
// otherwise, fetch all questions and create the form

if (isset($_POST['submit'])) {

} else {
	// puolue otetaan get-parametrina, se pitää validoida
	/*$link = $_GET['link'];
	$query = $mysqli->prepare('SELECT * FROM puolue WHERE link = ?');
	 */

	//$get_questions = $mysqli->prepare('SELECT * FROM kysymys');

	// Form for name, number, stuff


echo "<div class='form'>";
echo "<form action='ehdokkaalle.php' method='post'>";
echo "<p>";
echo "Nimi: <input type=text name='name'>";
echo "</p>";
// haetaan kannasta vaalipiirit, foreach
$query = "SELECT * FROM vaalipiiri";
$result = $mysqli->query($query);
//$row = $result->fetch_array(MYSQLI_ASSOC);
echo "Vaalipiiri: <select name='vaalipiiri'>";
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

	//echo "<option value=" . $vaalipiiri['id'] .">" . $Vaalipiiri['vaalipiiri'] ."</option>";
	echo "<option value=" . $row['id'] .">" . $row['vaalipiiri'] ."</option>";
	//var_dump($row);

}
echo "</select>";
//$vaalipiiriarray = mysqli_fetch_all($result);
/*echo "<select name='vaalipiiri' id='vaalipiiri_id'>";
while ($row = mysqli_fetch_array($result))
	echo "<p>$row</p>";
/*
	foreach ($vaalipiiriarray as $vaalipiiri) {


}
*/
/*






 */
$query = "SELECT * FROM kysymys";
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
	echo "<div>". $row['kysymys']."</div>";
	echo "<input type='radio' name=" . $row['id'];
		echo " value='1'>vahvasti eri mieltä";
	echo "<input type='radio' name=" . $row['id'];
		echo " value='2'>eri mieltä";
	echo "<input type='radio' name=" . $row['id'];
		echo " value='3'>ei mitään mieltä";
	echo "<input type='radio' name=" . $row['id'];
		echo " value='4'>samaa mieltä";
	echo "<input type='radio' name=" . $row['id'];
		echo " value='5'>vahvasti samaa mieltä";
		


}
}
