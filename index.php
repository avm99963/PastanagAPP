<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de benvinguda</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/login.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h1>Selecciona el teu nom</h1>
				<p>Per entrar al joc de la Pastanaga Assessina</p>
				<form action="./php/login.php" method="POST">
					<select name="user" id="list">
					</select>

					<input disabled required placeholder="Clau d'accés..." id="password" type="password" name="password"/>
					<input type="submit" value="Entrar" />
				</form>
			</div>
		</div>

		<script>
			$.post("./ajax/getusers.php", function(data, status){
				$("#list").html(data);
								
				userid = <?=isset($_COOKIE['user']) ? $_COOKIE['user'] : -1 ?>;
				username = $('option[value=' + userid + ']').text();
		
				if (userid > 0) {
					redir = confirm("Has entrat com a usuari " + username + " anteriorment, vols tornar-ho a fer?");
					if (redir) window.location.href = 'main.php';
				}
			});

			$('select').on('change', function() {
				let nopassword = $('select option:selected').hasClass('nopassword');
				$('#password').prop('disabled', nopassword);
			});
		</script>
	</body>
</html>
