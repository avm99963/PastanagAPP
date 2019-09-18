function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(id, msg) {
	$.ajax({
		'url': './php/request.php', 
		'type': 'GET',
		'contentType': 'application/json; charset=utf-8',
		'data': { 'id': id, 'msg': msg }, 
		'success': function(data) {
			console.log('Success');
			if (msg <= 2) $.notify('Confirmació enviada', 'success');
			else $.notify('Resposta guardada', 'success');
		},
		'error': function(xhr, status, error) { 
			console.log('Error! Torna-ho a intentar o contacta amb l\'Andreu: +34681236024');
			console.log(xhr.responseText);
		}
	});
}

function check_requests(requested, victimnom, victimid, userid) {			
	let dead = false;
	let killed = false;
	
	if (requested != 0) {
		// Check for requests
		if(requested == 1) dead = confirm("El teu assassí ha dit que t'ha matat, és veritat?");
		if(requested == 2) killed = confirm("En/na " + victimnom + " ha dit que l'has matat, és veritat?");
		
		// Confirm/deny request
		if (dead) send_request(userid, 3); // confirm death
		else if (killed) send_request(victimid, 3); // confirm kill
		else send_request(userid, 4); // deny kill/death
	}	

	// Reset
	return requested = 0;
}
