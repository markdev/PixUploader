<?php
	require_once("dbheader.php");
	
	print_r($_POST);

	$email = $_POST['email'];
	$password = $_POST['password'];
	$permission = $_POST['permission'];
	$sql = 'INSERT INTO Users (email, password, permission, created_on) VALUES ("' . $email .'", md5("' . $password . '"), "' . $permission . '", NOW())';
	$res = mysql_query($sql);
	if ($res == 1) {
		$_SESSION['user'] = array('email' => $email, 'permission' => $permission);
		echo true;
	}

	mysql_close($db);

?>