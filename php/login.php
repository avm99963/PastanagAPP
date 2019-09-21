<?php
	require 'utils.php';
	
	// Set the 'user' POST and COOKIE variable
	if (isset($_POST['user'])) {
		setcookie('user', $_POST['user'], time() + (86400 * 10), "/");
	} else if (isset($_COOKIE['user']) && !isset($_POST['user'])) {
		$_POST['user'] = $_COOKIE['user'];
	} else if (!isset($_COOKIE['user']) && !isset($_POST['user'])) {
		header("Location: ./index.php");
		die();
	}
	
	header("Location: ../main.php");
?>
