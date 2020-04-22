<?php
	require "login.php";

	if (isset($_SESSION['userid'])) {
		echo '<div id="login-status"><p>You are logged in</p></div>';
	}
	else {
		echo '<div id="login-status"><p id="login-status">You are logged out</p></div>';
	}
?>