function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function send_request(id, msg) {
	$.ajax({
		'url': '../request.php', 
		'type': 'GET',
		'dataType': 'json',
		'data': { 'id': id, 'msg': msg }, 
		'success': function(data) { alert("S'ha avisat a l'altre jugador"); },
		'error': function(xhr, status, error) {
			alert(xhr.responseText);
		 }
	});
}
