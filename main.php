<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de l'usuari</title>
		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/main.css" />
	
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
		<script src="./js/utils.js"></script>
		
		<?php 
			require './php/login.php';
		?>
		
		<script>
			let user = {
				'id': <?=$user->id?>,
				'quimata': <?=$user->quimata?>,
				'requested': <?=$user->requested?>,
				'mort': <?=$user->mort?>
			};
			
			let victim = {
				'id': <?=$victim->id?>,
				'quimata': <?=$victim->quimata?>,
				'nom': "<?=$victim->nom()?>"
			};
		</script>
	
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h2>Hola <name id="user_name"><?=$user->nom()?></name>,</h2>
				<h3>La teva víctima és:</h3>
				<div id="state">0</div>
				
				<div class="victima">
					<img width="300px" src="./imgs/<?=$victim->id?>.png" />
					<h2 id="victim_name"><?=$victim->nomcomplet?></h2>
					<h3><span id="victim_curs"><?=$victim->curs?></span>-<span id="victim_grau"><?=$victim->grau?></span></h3>
				</div>
			</div>
		</div>
		<div id="butons">
			<button id="win" onclick="js: send_request(user, victim, 'REQ KILL');">L'he matat</button>
			<button id="lose" onclick="js: send_request(user, victim, 'REQ DEAD');">M'han matat</button>
		</div>
		
		<script>
			$(document).ready(function() {
				let checking = setInterval(function() {
					$.ajax({ url: "./php/checkrequests.php", data: { id: user.id }, type: 'GET',
						success: function(data) {
							$("#state").load("./php/checkrequests.php?id=" + user.id, function(response, status, xhr) {
								console.log(response);
								if (!user.mort) user.mort = check_requests(response, user, victim);
								else clearInterval(checking);
							});
						}});
				}, 1000);
			});
		</script>
	</body>
</html>
