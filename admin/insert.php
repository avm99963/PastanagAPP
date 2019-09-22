<?php
	require '../credentials.php';
	require '../php/utils.php';
	
	$inscrits = [
		['Joan Hernanz Segarra', 3, 1],
		['Olga Almudena Martínez', 1, 1],
		['Jordi Ganso Rodríguez', 2, 0],
		['Júlia Montserrat Puig', 3, 0],
		['Berta Galofré Mestres', 4, 0],
		['Laia Pomar Raventós', 3, 1],
		['Irene Cusiné Baltà', 1, 0]
	];
	
	$start = 6;
	$i = $start;
	foreach ($inscrits as $user) {
		$i = ($i + 1) % ($start + count($inscrits));
		if ($i == 0) $i = $i + 1;
		$template = "INSERT INTO `users` (`id`, `nom`, `curs`, `grau`, `quimata`, `requested`, `mort`, `password`)" .
					" VALUES (NULL, '".$user[0]."', '".$user[1]."', '".$user[2]."', ".$i.", '0', '0', '')";
		if (query($template)) echo $template . "\n";
	}
?>
