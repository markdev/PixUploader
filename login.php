<?php

	if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "admin") {
		// admin dashboard
		header("Location: http://localhost/dashboard_admin.php");
	} else if (isset($_SESSION['user']) && $_SESSION['user']['permission'] == "user") {
		// user dashboard
		header("Location: http://localhost/dashboard_user.php");
	}

	$page = '
	<html>
		<head>

		</head>
		<body>
			<h1>Login</h1>
			<form action="login.php" method="post">
				<table>
					<tr>
						<td>Email: </td>
						<td><input type="text" id="email"/></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="password" id="password"/></td>
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
?>