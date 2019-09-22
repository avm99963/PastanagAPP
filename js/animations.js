function change_victim(user) {
	$(".victima").fadeOut(400, function() {
		$(".victima").load('./ajax/victiminfo.php?userid=' + user.id + " .victima");
		$(".victima").fadeIn(400);
	});
}

function read_message(msg, type) {
	$.notify(msg, type);
	newURL = window.location.href.split('?')[0];
	history.pushState({}, null, newURL);
}
