<?php
	require '../php/utils.php';
	$users = get_users(0);
	foreach ($users as $user) echo "<option value='".$user->id."'>".$user->nomcomplet."</option>\n";
?>
