<?php

	session_start();

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
		// Boy is this insecure
		$sql = 'SELECT * FROM Users WHERE email = "' . $_POST['email'] . '" AND PASSWORD = "' . md5($_POST['password']) . '"';
		$res = mysql_query($sql);
		$users = array();
		$errors = array();
		while ($row = mysql_fetch_array($res)) {
			$users[] = $row;
		}
		if (empty($users)) {
			$errors[] = "Your username or password is incorrect";
		}
		if (empty($errors)) {
			// log in!
			$_SESSION['user'] = array("email" => $users[0]['email'], "permission" => $users[0]['permission']);
			if ($_SESSION['user']['permission'] == "admin") {
				header("Location: http://localhost/dashboard_admin.php");
			} else if ($_SESSION['user']['permission'] == "user") {
				header("Location: http://localhost/dashboard_user.php");
			}
		}
	} 

	echo '
	<!DOCTYPE HTML>
	<html>
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		</head>
		<body>
			<h1>Create an Account</h1>
	';
/*
	if (!empty($errors)) {
		echo '<p style="color: #f00">' . $errors[0] . '</p>';
	}
*/
	echo '<form action="createUser.php" name="login" method="post">
				<table>
					<tr>
						<td>Email: </td>
						<td><input type="text" name="email" id="email"/></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="password" name="password" id="password"/></td>
					</tr>
					<tr>
						<td>Confirm Password: </td>
						<td><input type="password" name="password2" id="password2"/></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
				</table>
			</form>
			<button id="click"/>Submit</button>
			<br/><br/>
			<a href="login.php">Back to Log In</a>
			<script>
				$(document).ready(function() {
					$("button#click").click(function(){
						var email = $("input#email").val();
						var password = $("input#password").val();
						var password2 = $("input#password2").val();
						console.log(email);
						console.log(password);
						console.log(password2);
					});
				})
			</script>
		</body>
	</html>
	';