<?php
	require_once("dbheader.php");
	require_once("User.php");

	$user = User::getById($_POST['uid']);
	$images = User::getImagesByUserId($_POST['uid']);
	$ret = array('user'=>$user, 'images'=>$images);
	echo json_encode($ret);

?>

