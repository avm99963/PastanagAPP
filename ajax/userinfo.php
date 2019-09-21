<?php
	require '../php/utils.php';
	$user = get_users($_POST['id']);
	
	echo '{ ';
	$first = true;
	foreach ($user as $prop => $value) {
		if (!$first) echo ', ';
		else $first = false;
		if ($prop == "nomcomplet") echo '"'.$prop.'": "'.$value.'"';
		else echo '"'.$prop.'": '.$value;
	}
	echo ' }';
?>
