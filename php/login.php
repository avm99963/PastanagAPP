<?php
	require 'utils.php';
	$user = get_users($_GET['user']);
	$victim = get_users($user->quimata);
	
	if ($user->mort) die("Puto mort de merda");
?>
