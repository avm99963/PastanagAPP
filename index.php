<html>
	<head>
		<meta charset="UTF-8">
		<title>PastanagAPP</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="https://api.myjson.com/bins/u6r41">

		<!-- Apple web app -->
		<link rel="apple-touch-icon" href="./bin/images/icons/icon-72x72.png">
		<meta name="apple-mobile-web-app-title" content="PastanagAPP">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="green">

		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

		<link rel="stylesheet" href="./css/basic.css" />
		<link rel="stylesheet" href="./css/login.css" />

		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
		
		<script src="./js/utils.js"></script>
		<script src="./js/animations.js"></script>
	</head>
	<body>
		<div id="outter-container">
			<div id="inner-container">
				<form action="./main.php" method="POST">
					<input type="hidden" name="user" id="user">

					<!-- MD Search Box -->
					<div class="md-google-search__metacontainer">
					  <div class="md-google-search__container">
						<div class="md-google-search">
						  <span class="md-google-search__search-btn">
							<svg height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
						  </span>
						  <div class="md-google-search__field-container">
							<input id="search-input" class="md-google-search__field" required autocomplete="off" placeholder="Introdueix el teu nom..." value="" name="search" type="text" spellcheck="false" style="outline: none;">
						  </div>
						  <span class="md-google-search__empty-btn" style="display: none;">
							<svg focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
						  </span>
						</div>
					  </div>

							<div class="autocomplete-container" style="display: none;">
						  <div id="autocomplete-list" class="autocomplete-items"></div>
						</div>
					</div>

					<input disabled required placeholder="Clau d'accés..." id="password" type="password" name="password"/>
					<input type="submit" value="Entrar" id="submit" />
				</form>
				
				<p>La primera persona que entri al teu compte tindrà l'oportunitat de canviar la contrasenya.</p>
			</div>
		</div>

		<script src="./js/autocomplete.js"></script>
		<script>
			fetch("./ajax/getusers.php").then(result => result.json()).then(users => {
				autocomplete(document.getElementById("search-input"), users, "search");
				console.log(users);
				
				userid = <?=isset($_COOKIE['user']) ? (int)$_COOKIE['user'] : -1 ?>;
				username = get_user_name(users, userid);
				if (userid > 0) $("#search-input").prop("placeholder", username);
			});
			
			$(document).ready(function() {
				// Notify of messages
				if (getUrlParameter("passwordchanged")) read_message("La teva clau d'accés ha canviat", "error");
				if (getUrlParameter("wrongpassword")) read_message("La clau d'accés no és correcta", "error");
				if (getUrlParameter("wrongconfirmation")) read_message("Les contrasenyes no coincideixen", "error");
				if (getUrlParameter("errordb")) read_message("Hi ha hagut un problema a la base de dades, torna-ho a intentar", "error");
				if (getUrlParameter("successpassword")) read_message("La teva clau d'accés s'ha guardat", "success");
			});
		</script>
	</body>
</html>
