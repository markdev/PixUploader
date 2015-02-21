<?php
	session_start();
	print_r($_POST);

	// Let's initialize the database
	define('DATABASE', "localhost");
	define('DATABASE_USER', "root");
	define('DATABASE_PASS', "foo"); // this is my local mysql password.  Now you know all my secrets.
	define('DATABASE_NAME', "PixUploader");
	$db = mysql_connect(DATABASE, DATABASE_USER, DATABASE_PASS, DATABASE_NAME)
		or die("Unable to connect to MySQL");

	mysql_select_db(DATABASE_NAME) 
		or die("Unable to select database");

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