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
			let mort = <?=$user->mort?>;
			let requested = <?=$user->requested?>;
			let userid = <?=$user->id?>;
			let victimid = <?=$victim->id?>;
			let victimnom = "<?=$victim->nom()?>";
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
			<button id="win" onclick="js: send_request(<?=$victim->id?>,1);">L'he matat</button>
			<button id="lose" onclick="js: send_request(<?=$user->id?>,2);">M'han matat</button>
		</div>
		
		<script>
			$(document).ready(function() {
				let checking = setInterval(function() {
					$.ajax({ url: "./php/checkrequests.php", data: { id: userid }, type: 'GET',
						success: function(data) {
							$("#state").load("./php/checkrequests.php?id=" + userid, function(response, status, xhr) {
								console.log(response);
								if (!mort) mort = check_requests(response, victimnom, victimid, userid);
								else clearInterval(checking);
							});
						}});
				}, 1000);
			});
		</script>
	</body>
</html>
