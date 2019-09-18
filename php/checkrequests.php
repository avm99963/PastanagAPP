<?php
	// Get the id
	$id = $_GET['id'];
	
	// Define MySQL login variables
	$servername = "localhost"; // "fdb22.awardspace.net";
	$username = "root"; // "3155560_users";
	$password = ""; // "btechnoro@fox4news.info";

	// Create connection
	$conn = new mysqli($servername, $username, $password, "pastanaga");
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$conn->set_charset("utf8");
	
	// Do the query
	$query = "SELECT requested FROM users WHERE id=".$id;
	$state = 0;

	// Fetch the information of the user
	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_row()) $state = $row[0];
		$result->close();
	} else {
		die("Wrong query: " . $query);
	}

	// Close connection
	$conn->close();
	
	// Print the state
	echo $state;
?>
