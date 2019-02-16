<?php

$username = 'vaalikone';
$password = "DZuHe6pmsU49pS29";
$db = "vaalikone_proto";
$mysqli = new mysqli("localhost", $username, $password, $db);
if($mysqli->connect_error) {
	exit('Error connecting to database', $mysqli->connect_error); 
}
$mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");
?>
