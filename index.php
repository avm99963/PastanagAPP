<html>
	<head>
		<meta charset="UTF-8">
		<title>Pàgina de benvinguda</title>
		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/login.css" />
		
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<h1>Selecciona el teu nom</h1>
				<h3>Per entrar al joc de la Pastanaga Assessina</h3>
				<form action="main.php" method="GET">
					<select name="user" id="list">
					</select>
					
					<input type="submit" value="Entrar" />
				</form>
			</div>
		</div>
		
		<script>
			$.post("./ajax/getusers.php", function(data, status){
				$("#list").html(data);
			});
		</script>
	</body>
</html>
