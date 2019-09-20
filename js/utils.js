function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(user, victim, msg) {
	$.ajax({
		'url': './php/request.php', 
		'type': 'GET',
		'contentType': 'application/json; charset=utf-8',
		'data': { 'user_id': user.id,
				  'victim_id': victim.id,
				  'user_quimata': user.quimata,
				  'victim_quimata': victim.quimata,
				  'msg': msg
				}, 
		'success': function(data) {
			if (msg <= 2) $.notify('Confirmació enviada', 'success');
			else $.notify('Resposta guardada', 'success');
			console.log(data);
		},
		'error': function(xhr, status, error) { 
			console.log('Error! Torna-ho a intentar o contacta amb l\'Andreu: +34681236024');
			console.log(xhr.responseText);
		}
	});
}

function check_requests(requested, user, victim) {	
	let dead = false;
	let killed = false;
	
	if (requested != 0) {
		// Check for requests
		if(requested == 1) dead = confirm("El teu assassí ha dit que t'ha matat, és veritat?");
		if(requested == 2) killed = confirm("En/na " + victim.nom + " ha dit que l'has matat, és veritat?");
		
		// Confirm/deny request
		if (dead) send_request(user, victim, "CONF DEAD"); // confirm death
		else if (killed) send_request(user, victim, "CONF KILL"); // confirm kill
		else send_request(user, victim, "DENY REQ"); // deny kill/death
	}	

	// Return mort
	return dead;
}
