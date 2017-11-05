<?php
	$user = 'root';
	$pass = '';
	$host = 'localhost';
	$db = 'carshop';
	$conn = mysql_connect($host, $user, $pass);

	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	mysql_select_db($db);
?>