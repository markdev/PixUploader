<?php
	require_once("dbheader.php");
	require_once("User.php");

	echo User::create($_POST['email'], $_POST['password'], $_POST['permission']);

	mysql_close($db);
?>