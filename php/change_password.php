<?php
	require 'utils.php';

	// Check if confirmation is the same
	if ($_POST['password'] != $_POST['confirmation']) {
		header("Location: ../main.php?wrong_password=1");
		die();
	} else {
		// Execute query to change password
		$update_password = "UPDATE users SET password=\"".md5($_POST['password'])."\" WHERE id=".$_POST['userid'];
		if(!$result = query($update_password)) header("Location: ../main.php?errordb=1");
		
		// Save 'password' to cookies
		setcookie('password', md5($_POST['password']), time() + (86400 * 10), "/");
		
		// Go back to main page
		header("Location: ../main.php?successpassword=1");
	}
?>
