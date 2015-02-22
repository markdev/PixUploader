<?php

	require_once("dbheader.php");
	require_once("User.php");

	if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: http://localhost/dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: http://localhost/dashboard_user.php");
	}

	if (!empty($_POST)) {
		$user = new User();
		$user->authenticate($_POST['email'], $_POST['password']);
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
