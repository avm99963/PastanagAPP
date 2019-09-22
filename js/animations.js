function change_victim(user) {
	let loadURL = './ajax/victiminfo.php?userid=' + user.id + ' #victim_info';
	$(".victima").fadeOut('slow').load(loadURL).fadeIn('slow');
}

function read_message(msg, type) {
	$.notify(msg, type);
	newURL = window.location.href.split('?')[0];
	history.pushState({}, null, newURL);
}
