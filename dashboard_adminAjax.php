<?php
	require_once("dbheader.php");
	require_once("User.php");


/*
	if (!empty($_POST)) {
		if (isset($_POST['method']) && $_POST['method'] == "deletePic") { 
			deletePic(); 
		} else { // yes this is messy, but there are only two methods here
			uploadImage(); 
		}
	}
*/

	$user = User::getById($_POST['uid']);
	$images = User::getImagesByUserId($_POST['uid']);
	$ret = array('user'=>$user, 'images'=>$images);
	echo json_encode($ret);

?>

