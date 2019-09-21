<?php
	class User{
		public $id;
		public $nomcomplet;
		public $curs;
		public $grau;
		public $quimata;
		
		public function nom() {
			$noms = explode(" ", $this->nomcomplet);
			return $noms[0];
		}
	}
	
	function get_users($id = 0) {
		$users = [];
		
		// Define MySQL login variables
		$servername = "localhost"; // "fdb22.awardspace.net";
		$username = "root"; // "3155560_users";
		$password = ""; // "btechnoro@fox4news.info";

		// Create connection
		$conn = new mysqli($servername, $username, $password, "pastanaga");
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		$conn->set_charset("utf8");
		
		// Do the query
		$query = "SELECT * FROM users";
		if ($id > 0) $query .= " WHERE id=".$id;

		// Fetch the information of the user
		if ($result = $conn->query($query)) {
			while ($row = $result->fetch_row()) {
				$user = new User();
				
				$user->id = $row[0];
				$user->nomcomplet = $row[1];
				$user->curs = $row[2];
				$user->grau = $row[3];
				$user->quimata = $row[4];
				$user->requested = $row[5];
				$user->mort = $row[6];
				
				array_push($users, $user);
			}
			$result->close();
		} else {
			die("Wrong query: " . $query);
		}

		// Close connection
		$conn->close();
		
		if ($id > 0) return $users[0];
		else return $users;
	}
?>
