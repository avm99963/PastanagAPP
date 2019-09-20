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
	$query2 = "";
	if ($_GET['msg'] == "REQ KILL") $query = "UPDATE users SET requested=1 WHERE id=".(int)$_GET['victim_id']; // request kill
	if ($_GET['msg'] == "REQ DEAD") $query = "UPDATE users SET requested=2 WHERE quimata=".(int)$_GET['user_id']; // request dead
	if ($_GET['msg'] == "CONF DEAD") {
		// User gets killed
		$query = "UPDATE users SET requested=0, quimata=".(int)$_GET['user_quimata']." WHERE quimata=".$_GET['user_id']; // assign new victim to killer
		$query2 = "UPDATE users SET quimata=0, mort=1 WHERE id=".(int)$_GET['user_id']; // confirm victim dead/killed
	}
	if ($_GET['msg'] == "CONF KILL") {
		// Victim gets killed
		$query = "UPDATE users SET requested=0, quimata=".(int)$_GET['victim_quimata']." WHERE quimata=".$_GET['victim_id']; // assign new victim to killer
		$query2 = "UPDATE users SET quimata=0, mort=1 WHERE id=".(int)$_GET['victim_id']; // confirm victim dead/killed
	}
	if ($_GET['msg'] == "DENY REQ") $query = "UPDATE users SET requested=0 WHERE id=".(int)$_GET['user_id']; // deny request

	// Fetch the information of the user
	if ($query != "" and $result = $conn->query($query)) echo $query;
	else die("Wrong query: " . $query);
	if ($query2 != "" and $result = $conn->query($query2)) echo "\n" . $query2;
	else echo "\nNo second query";

	// Close connection
	$conn->close();
?>
