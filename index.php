<?php

	// Let's initialize the database
	define('DATABASE', "localhost");
	define('DATABASE_USER', "root");
	define('DATABASE_PASS', "foo"); // this is my local mysql password.  Now you know all my secrets.
	define('DATABASE_NAME', "PixUploader");
	$db = mysql_connect(DATABASE, DATABASE_USER, DATABASE_PASS, DATABASE_NAME)
		or die("Unable to connect to MySQL");

	mysql_select_db(DATABASE_NAME) 
		or die("Unable to select database");

	/*
	$sql = "SELECT * from Users";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)) {
		print_r($row);
	}
	*/

	// testing
	//$_SESSION['admin'] = array('permission' => 'admin');
	//$_SESSION['user'] = array('permission' => 'user');

	if (empty($_SESSION['user'])) {
		// forces redirect to login page if no one is logged in
		header("Location: http://localhost/login.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: http://localhost/dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: http://localhost/dashboard_user.php");
	}

	print_r($_SESSION);

	mysql_close($db);

	echo "Connected to Mysql";
?>
