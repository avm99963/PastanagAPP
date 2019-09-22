function change_victim(user) {
	$(".victima").fadeOut(400, function() {
		$(".victima").load('./ajax/victiminfo.php?userid=' + user.id + " #victima");
		$(".victima").fadeIn(400);
	});
}
