<?php
	// Define MySQL login variables
	$servername = "localhost"; // "fdb22.awardspace.net";
	$username = "root"; // "3155560_users";
	$password = ""; // "btechnoro@fox4news.info";

	// Create connection
	$conn = new mysqli($servername, $username, $password, "pastanaga");
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$conn->set_charset("utf8");
	
	// Do the query
	$query = "";
	if ($_GET['msg'] == 1) $query = "UPDATE users SET requested=".$_GET['msg']." WHERE id=".$_GET['id']; // request kill
	if ($_GET['msg'] == 2) $query = "UPDATE users SET requested=".$_GET['msg']." WHERE quimata=".$_GET['id']; // request dead
	if ($_GET['msg'] == 3) $query = "UPDATE users SET mort=1 WHERE id=".$_GET['id']; // confirm dead/killed
	if ($_GET['msg'] == 4) $query = "UPDATE users SET requested=0 WHERE id=".$_GET['id']; // deny request

	// Fetch the information of the user
	if ($result = $conn->query($query)) echo 'Success!';
	else die("Wrong query: " . $query);

	// Close connection
	$conn->close();
?>
