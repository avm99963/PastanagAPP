<option selected disabled hidden>Selecciona usuari...</option>

<?php
	require '../credentials.php';
	require '../php/utils.php';
	$users = get_users(0);

	foreach ($users as $user) {
		$nopassword = $user->md5password == "" ? "nopassword" : "";
		$mort = $user->mort ? "disabled" : "";
		echo "<option ".$mort." class='".$nopassword."' value='".$user->id."'>".$user->nomcomplet."</option>\n";
	}
?>
