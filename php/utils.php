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
	
	function query($query) {
		// Define MySQL login variables
		$servername = "localhost"; // "andreuhuguet78654.ipagemysql.com";
		$username = "root"; // "andreu";
		$password = ""; // "1234";
		$dbname = "pastanaga"; // "fme_2019";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
		$conn->set_charset("utf8");
		
		// Execute query and save result
		$result = $conn->query($query);
		
		// Close the connection 
		$conn->close();
		
		// Return result of query
		return $result;
	}
	
	function get_users($id = 0) {
		$users = [];
		
		// Prepare the query
		$query = "SELECT * FROM users";
		if ($id > 0) $query .= " WHERE id=".$id;

		// Fetch the information of the user
		if ($result = query($query)) {
			while ($row = $result->fetch_row()) {
				$user = new User();
				
				$user->id = $row[0];
				$user->nomcomplet = $row[1];
				$user->curs = $row[2];
				$user->grau = $row[3];
				$user->quimata = $row[4];
				$user->requested = $row[5];
				$user->mort = $row[6];
				$user->md5password = $row[7];
				
				array_push($users, $user);
			}
			$result->close();
		} else {
			die("Wrong query: " . $query);
		}
		
		if ($id > 0) return $users[0];
		else return $users;
	}
?>
