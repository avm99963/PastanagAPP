<?php
	require '../credentials.php';
	require '../php/utils.php';
	$users = get_users(0);

	$return = [];

	foreach ($users as $user) {
		if ($user->mort) continue;

		$return[] = [
			"id" => $user->id,
			"nomcomplet" => $user->nomcomplet,
			"grau" => $user->grau,
			"curs" => $user->curs,
			"nopassword" => ($user->md5password == "" ? "nopassword" : "")
		];
	}

	echo json_encode($return);
