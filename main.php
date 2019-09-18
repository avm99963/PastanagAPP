<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de l'usuari</title>
		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/main.css" />
	
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="./js/utils.js"></script>
		
		<?php require './php/login.php'; ?>
		<script>
			if (<?=$user->mort?>) {
				// User is dead
				document.write("Venga niño, pitjor que el Condom, MORT.");
			} else {				
				let dead = false;
				let killed = false;
				
				// Check for requests
				if(<?=$user->requested?> == 1) dead = confirm("El teu assassí ha dit que t'ha matat, és veritat?");
				if(<?=$user->requested?> == 2) killed = confirm("En/na <?=$victim->nom()?> ha dit que l'has matat, és veritat?");
				
				// Confirm/deny request
				if (dead) send_request(<?=$user->id?>, 3); // confirm death
				else send_request(<?=$user->id?>, 4); // deny death
				if (killed) send_request(<?=$victim->id?>, 3); // confirm kill
				else send_request(<?=$user->id?>, 4); // deny kill
			}
		</script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h2>Hola <name id="user_name"><?=$user->nom()?></name>,</h2>
				<h3>La teva víctima és:</h3>
				
				<div class="victima">
					<img width="300px" src="./imgs/<?=$victim->id?>.png" />
					<h2 id="victim_name"><?=$victim->nomcomplet?></h2>
					<h3><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></h3>
				</div>
			</div>
		</div>
		<div id="butons">
			<button id="win" onclick="js: send_request(<?=$victim->id?>,1);">L'he matat</button>
			<button id="lose" onclick="js: send_request(<?=$user->id?>,2);">M'han matat</button>
		</div>
		
		<script>
			
		</script>
	</body>
</html>
