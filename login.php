<?php

	if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: http://localhost/dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: http://localhost/dashboard_user.php");
	}

	// Let's initialize the database
	define('DATABASE', "localhost");
	define('DATABASE_USER', "root");
	define('DATABASE_PASS', "foo"); // this is my local mysql password.  Now you know all my secrets.
	define('DATABASE_NAME', "PixUploader");
	$db = mysql_connect(DATABASE, DATABASE_USER, DATABASE_PASS, DATABASE_NAME)
		or die("Unable to connect to MySQL");

	mysql_select_db(DATABASE_NAME) 
		or die("Unable to select database");

	if (!empty($_POST)) {
		print_r($_POST);
	} else {
		echo "NO POST";
	}

	$page = '
	<!DOCTYPE HTML>
	<html>
		<head>

		</head>
		<body>
			<h1>Login</h1>
			<form action="login.php" name="login" method="post">
				<table>
					<tr>
						<td>Email: </td>
						<td><input type="text" name="email"/></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="password" name="password"/></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit"/></td>
					</tr>
				</table>
			</form>
			<a href="createUser.php">Create an account</a>
		</body>
	</html>
	';

	echo $page;

	mysql_close($db);
?>
