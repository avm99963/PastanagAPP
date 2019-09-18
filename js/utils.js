function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(id, msg) {
	$.ajax({
		'url': '../php/request.php', 
		'type': 'GET',
		'dataType': 'json',
		'data': { 'id': id, 'msg': msg }, 
		'success': function(data) { console.log('Success'); },
		'error': function(xhr, status, error) { alert('Error! Torna-ho a intentar o contacta amb l\'Andreu: +34681236024'); console.log(xhr); }
	});
}
