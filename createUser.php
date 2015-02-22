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
		$user = new User();
		$user->authenticate($_POST['email'], $_POST['password']);
	}


	echo '
	<!DOCTYPE HTML>
	<html>
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		</head>
		<body>
			<h1>Create an Account</h1>
			<ul id="errors" style="color: #f00;">
	';
/*
	if (!empty($errors)) {
		echo '<p style="color: #f00">' . $errors[0] . '</p>';
	}
*/
	echo '	
			</ul>
			<form action="createUser.php" name="login" method="post">
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
						<td>Permission Level:</td>
						<td>
							<select id="permission" name="permission">
								<option value="user">User</option>
								<option value="admin">Admin</option>
							</select>
						</td>
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
						$("ul#errors").empty();
						var email = $("input#email").val();
						var password = $("input#password").val();
						var password2 = $("input#password2").val();
						var permission = $("select#permission").val();
						var errors = [];
						if (email == "") errors[errors.length] = ("Email field cannot be blank");
    					var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						if (re.test(email) == false) errors[errors.length] = "Email field must be a valid email";
						if (password == "") errors[errors.length] = "password field cannot be empty";
						if (password !== password2) errors[errors.length] = "passwords must match";
						if (errors.length == 0) {
							var data = {
								email: email,
								password: password,
								permission: permission
							};
							console.log(data);
							$.ajax({
								type: "post",
								url: "createUserAjax.php",
								data: data,
								success: function (response) {
									if (response) {
										window.location.replace("http://localhost/index.php");
									}
								}
							});
						} else {
							for (var i=0; i<errors.length; i++) {
								$("ul#errors").append("<li>" + errors[i] + "</li>");
							}
							console.log($("select#permission").val());
						}
					});
				})
			</script>
		</body>
	</html>
	';