function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(user, msg) {
	$.ajax({
		'url': './php/request.php', 
		'type': 'GET',
		'contentType': 'application/json; charset=utf-8',
		'data': { 'user_id': user.id,
				  'user_quimata': user.quimata,
				  'msg': msg
				}, 
		'success': function(data) {
			$.notify('Resposta guardada', 'success');
			console.log(data);
			
			if (msg == 'CONF KILL' || msg == 'CONF DEAD') {
				$(".victima").fadeOut(400, function() {
					$(".victima").load('./ajax/victiminfo.php?userid=' + user.id);
					$(".victima").fadeIn(400);
				});
			}
		},
		'error': function(xhr, status, error) { 
			$.notify('Error! Torna-ho a intentar o contacta amb l\'Andreu: +34681236024');
			console.log(error);
		}
	});
}

function check_requests(info, user) {	
	let dead = false;
	
	if (info.requested) {
		// Check for requests
		if(info.requested) dead = confirm("El teu assassí ha dit que t'ha matat, és veritat?");
	
		// Confirm/deny request
		if (dead) send_request(user, "CONF DEAD"); // confirm death
		else send_request(user, "DENY REQ"); // deny kill/death
	}	

	// Return mort
	return dead || info.mort;
}

function change_victim(user) {
	$(".victima").fadeOut(400, function() {
		$(".victima").load('./ajax/victiminfo.php?userid=' + user.id);
		$(".victima").fadeIn(400);
	});
}
