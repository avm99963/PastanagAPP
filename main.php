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

		<meta name="viewport" content="width=device-width, initial-scale=1">

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
					<p>Sembla que no tens contrasenya, la gent podrà entrar a la teva compta...</p>
					<form action="./php/change_password.php" method="POST">
						<input type="hidden" value="<?=$_COOKIE['user']?>" name="userid">
						<input type="password" placeholder="Nova contrasenya..." name="password" /><br />
						<input type="password" placeholder="Repeteix la contrasenya" name="confirmation"/><br />
						<input type="submit">
					</form>
				</div>

				<p>La teva víctima és:</p>

				<table class="victima">
					<tr>
						<td><img id="victim_img" src="./imgs/<?=$victim->id?>.png" /></td>
						<td>
							<div id="victim_name"><?=$victim->nomcomplet?></div>
							<div id="victim_curs_i_grau"><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></div>
							<div id="butons" class="options">
								<button id="win" onclick="js: send_request(user, 'REQ KILL');">L'he matat</button>
							</div>
						</td>
					</tr>
				</table>

				<div style="clear: both;"></div>
			</div>
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
