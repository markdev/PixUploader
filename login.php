<?php

	require_once("dbheader.php");

	if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: http://localhost/dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: http://localhost/dashboard_user.php");
	}

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

		</head>
		<body>
			<h1>Login</h1>
	';

	if (!empty($errors)) {
		echo '<p style="color: #f00">' . $errors[0] . '</p>';
	}

	echo '<form action="login.php" name="login" method="post">
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
