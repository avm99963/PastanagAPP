<?php
	require '../credentials.php';
	require 'utils.php';

	$credentials = new Credentials();
	$usersdb = $credentials->usersdb;
	$mortsdb = $credentials->mortsdb;

	// Do the query
	$queries = [""];
	$victimid = "ANY (SELECT quimata FROM (SELECT * FROM $usersdb) AS victims WHERE id=".(int)$_POST['user_id'].")";
	
	if ($_POST['msg'] == "REQ KILL") $queries = ["UPDATE $usersdb SET requested=1 WHERE id=".$victimid]; 						// request kill
	if ($_POST['msg'] == "REQ DEAD") $queries = ["UPDATE $usersdb SET requested=2 WHERE quimata=".(int)$_POST['user_id']]; 	// request dead
	if ($_POST['msg'] == "DENY REQ") $queries = ["UPDATE $usersdb SET requested=0 WHERE id=".(int)$_POST['user_id']]; 			// deny request
	if ($_POST['msg'] == "CONF DEAD") {
		$queries = ["INSERT INTO $mortsdb (id, quimatava, assassi, curs, grau) (SELECT id, quimata, (SELECT id FROM $usersdb WHERE quimata=".(int)$_POST['user_id']."), curs, grau FROM $usersdb WHERE id=".(int)$_POST['user_id'].")", 	// add to 'morts'
					"UPDATE $usersdb SET requested=0, quimata=".(int)$_POST['user_quimata'].", bits=".(int)rand(1,512)." WHERE quimata=".(int)$_POST['user_id'], 	// assign new victim to killer
					"UPDATE $usersdb SET quimata=0, mort=1 WHERE id=".(int)$_POST['user_id']];		// confirm victim dead/killed										
	}
	// Fetch the information of the user
	foreach ($queries as $query) {
		if ($query != "" and $result = query($query)) echo $query;
		else die("Query failed: " . $query);
	}
?>
