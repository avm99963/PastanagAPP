<option>Selecciona usuari...</option>

<?php
	require '../credentials.php';
	require '../php/utils.php';
	$users = get_users(0);

	foreach ($users as $user) {
		$nopassword = $user->md5password == "" ? "nopassword" : "";
		echo "<option class='".$nopassword."' value='".$user->id."'>".$user->nomcomplet."</option>\n";
	}
?>
