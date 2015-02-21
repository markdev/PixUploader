<?php
	session_start();

	echo "<h1>Dashboard Admin</h1>";
	echo "<p>Welcome, " . $_SESSION['user']['email'] . "!";
	echo "<a href='logout.php'>Log Out</a>";
?>
