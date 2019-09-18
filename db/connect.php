<?php
	// Define MySQL login variables
	$servername = "fdb22.awardspace.net";
	$username = "3155560_users";
	$password = "btechnoro@fox4news.info";

	// Create connection
	$conn = new mysqli($servername, $username, $password, "3155560_users");
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$conn->set_charset("utf8");
?>
