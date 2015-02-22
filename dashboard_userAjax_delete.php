<?php
	require_once("dbheader.php");
	require_once("User.php");
	
	$user = new User();
	$res = $user->deleteImage($_POST['id']);

	echo $res;

?>