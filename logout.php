<?php

	require_once("dbheader.php");
	require_once("User.php");
	$user = new User();
	$user->logout();

?>