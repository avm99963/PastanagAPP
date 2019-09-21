<?php
	if (!isset($_COOKIE['user'])) {
		header("Location: ./index.php");
		die();
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de l'usuari</title>

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/main.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>

		<?php
			require './credentials.php';
			require './php/utils.php';
			$user = get_users($_COOKIE['user']);
			$victim = get_users($user->quimata);
			if ($user->mort) header("Location: ./dead.php");
		?>

		<script>
			let user = {
				'id': <?=$user->id?>,
				'quimata': <?=$user->quimata?>,
				'requested': <?=$user->requested?>,
				'mort': <?=$user->mort?>,

				'nom': "<?=$user->nomcomplet?>",
				'curs': <?=$user->curs?>,
				'grau': <?=$user->grau?>
			};
		</script>

	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h2>Hola <name id="user_name"><?=$user->nom()?></name>,</h2>

				<div class="formulari_contrasenya" style="display: none;">
					<p>Sembla que no tens contrasenya, la gent podrà entrar al teu compte...</p>
					<form action="./php/change_password.php" method="POST">
						<input type="hidden" value="<?=$_COOKIE['user']?>" name="userid">
						<input type="password" placeholder="Nova contrasenya..." name="password" /><br />
						<input type="password" placeholder="Repeteix la contrasenya" name="confirmation"/><br />
						<input type="submit">
					</form>
				</div>

				<h3>La teva víctima és:</h3>

				<div class="victima">
					<img width="300px" src="./imgs/<?=$victim->id?>.png" />
					<h2 id="victim_name"><?=$victim->nomcomplet?></h2>
					<h3><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></h3>
				</div>
			</div>
		</div>
		<div id="butons" class="options">
			<button id="win" onclick="js: send_request(user, 'REQ KILL');">L'he matat</button>
		</div>

		<script>
			$(document).ready(function() {
				// Set interval of checking
				let checking = setInterval(function() { update_info(user); }, 1500);
				// Set to hidden or not the password prompt
				if (<?=$user->md5password=="" ? 1 : 0?>) $(".formulari_contrasenya").show();
			});
		</script>
	</body>
</html>
