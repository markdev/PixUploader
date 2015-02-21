<?php
	require_once("dbheader.php");

	echo '
		<html>
			<head>
			</head>
			<body>
				<h1>Dashboard User</h1>
				<p>Welcome, ' . $_SESSION['user']['email'] . '!
				<a href="logout.php">Log Out</a>
				<hr/>
				<form action="dashboard_userAjax.php" method="post" enctype="multipart/form-data">
					<input type="file" name="image" />
					<input type="submit" />
				</form>
				<hr/>

			</body>
		</html>
	';
?>
