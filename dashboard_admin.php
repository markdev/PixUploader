<?php
	require_once("dbheader.php");

	echo "<h1>Dashboard Admin</h1>";
	echo "<p>Welcome, " . $_SESSION['user']['email'] . "!";
	echo "<a href='logout.php'>Log Out</a>";
?>
