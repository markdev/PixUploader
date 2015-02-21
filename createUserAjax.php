<?php

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

	$sql = 'INSERT INTO Users (email, password, permission, created_on) VALUES ("' . $_POST['email'] .'", md5("' . $_POST['password'] . '"), "' . $_POST['permission'] . '", NOW())';
	$res = mysql_query($sql);
	echo $res;

	mysql_close($db);

?>