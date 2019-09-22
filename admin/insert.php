<?php
	require '../credentials.php';
	require '../php/utils.php';

	// Read from CSV
	$inscrits = array_map('str_getcsv', file('inscrits.csv'));
	array_shift($inscrits); // remove header
	
	$start = 1;
	$i = $start;
	foreach ($inscrits as $user) {
		$i = ($i + 1) % ($start + count($inscrits));
		if ($i == 0) $i = $i + 1;
		$template = "INSERT INTO `newusers` (`id`, `nom`, `curs`, `grau`, `quimata`, `requested`, `mort`, `password`)" .
					" VALUES (NULL, '".$user[0]."', '".$user[1]."', '".$user[2]."', ".$i.", '0', '0', '')";
		if (query($template)) echo $template . "<br />";
	}
?>
