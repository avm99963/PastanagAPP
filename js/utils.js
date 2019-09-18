function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(id, msg) {
	console.log(id, msg);
	
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
