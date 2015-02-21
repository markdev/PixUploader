<?php

session_start();

// Let's initialize the database
define('DATABASE', "localhost");
define('DATABASE_USER', "root");
define('DATABASE_PASS', "foo"); // this is my local mysql password.  Now you know all my secrets.
define('DATABASE_NAME', "PixUploader");
$db = mysql_connect(DATABASE, DATABASE_USER, DATABASE_PASS, DATABASE_NAME)
	or die("Unable to connect to MySQL");

mysql_select_db(DATABASE_NAME) 
	or die("Unable to select database");

?>