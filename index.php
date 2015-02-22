<?php
	require_once("dbheader.php");

	if (empty($_SESSION['user'])) {
		// forces redirect to login page if no one is logged in
		header("Location: login.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: dashboard_user.php");
	}

	mysql_close($db);
?>
