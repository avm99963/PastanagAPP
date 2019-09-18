if (mort) {
	// User is dead
	document.write("Venga niño, pitjor que el Condom, MORT.");
} else {				
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
}
