<?php
	// Define MySQL login variables
	$servername = "fdb22.awardspace.net";
	$username = "3155560_users";
	$password = "btechnoro@fox4news.info";

	// Create connection
	$conn = new mysqli($servername, $username, $password, "3155560_users");
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$conn->set_charset("utf8");
	
	// Do the query
	$query = "SELECT * FROM users";

	// Fetch the information of the user
	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_row()) {
			$id = $row[0];
			$nomcomplet = $row[1];
			$curs = $row[2];
			$grau = $row[3];
			$quimata = $row[4];
			
			// Echo the options
			echo "<option value='".$id."'>".$nomcomplet."</option>\n";
		}
		$result->close();
	} else {
		die("Wrong query: " . $query);
	}

	// Close connection
	$conn->close();
?>
