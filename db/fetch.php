<?php
	if ($result = $conn->query($query)) {
		
		// Fetch the information of the user
		while ($row = $result->fetch_row()) {
			$user->id = $row[0];
			$user->nomcomplet = $row[1];
			$user->curs = $row[2];
			$user->grau = $row[3];
			$user->quimata = $row[4];	
		}
	
		$result->close();
	} else {
		echo "Wrong query";
	}
?>
