<?php
	require '../credentials.php';
	require '../php/utils.php';
	$users = get_users(0, false);

	foreach ($users as &$user) {
		if ($user["mort"]) continue;

		$user["nopassword"] = $user["md5password"] == "" ? "nopassword" : "";
		unset($user["md5password"]);
	}

	echo json_encode($users);
