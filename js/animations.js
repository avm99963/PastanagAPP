function change_victim(user) {
	$(".victima").fadeOut(400, function() {
		$(".victima").load('./ajax/victiminfo.php?userid=' + user.id);
		$(".victima").fadeIn(400);
	});
}
