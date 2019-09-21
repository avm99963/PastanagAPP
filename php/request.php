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
	$queries = [""];
	
	$victimid = "ANY (SELECT quimata FROM users WHERE id=".(int)$_GET['user_id'].")";
	
	if ($_GET['msg'] == "REQ KILL") $queries = ["UPDATE users SET requested=1 WHERE id=".$victimid]; // request kill
	if ($_GET['msg'] == "REQ DEAD") $queries = ["UPDATE users SET requested=2 WHERE quimata=".(int)$_GET['user_id']]; // request dead
	if ($_GET['msg'] == "DENY REQ") $queries = ["UPDATE users SET requested=0 WHERE id=".(int)$_GET['user_id']]; // deny request
	if ($_GET['msg'] == "CONF DEAD") {
		$queries = ["UPDATE users SET requested=0, quimata=".(int)$_GET['user_quimata']." WHERE quimata=".(int)$_GET['user_id'], // assign new victim to killer
				  "UPDATE users SET quimata=0, mort=1 WHERE id=".(int)$_GET['user_id']]; // confirm victim dead/killed
	}
	// Fetch the information of the user
	foreach ($queries as $query) {
		if ($query != "" and $result = $conn->query($query)) echo $query;
		else die("Wrong query: " . $query);
	}
	
	// Close connection
	$conn->close();
?>
