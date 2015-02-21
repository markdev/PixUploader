<?php

	echo "<h1>Hello uploader</h1>";

	// Let's initialize the database
	define('DATABASE_NAME', "localhost");
	define('DATABASE_USER', "root");
	define('DATABASE_PASS', "foo"); // this is my local mysql password.  Now you know all my secrets.
	$db = mysql_connect(DATABASE_NAME, DATABASE_USER, DATABASE_PASS)
		or die("Unable to connect to MySQL");

	echo "Connected to Mysql";
?>
