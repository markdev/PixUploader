<?php

class User {

	public function __construct() {

	}

	public function authenticate($email, $password) {
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
			$_SESSION['user'] = array("id" => $users[0]['id'], "email" => $users[0]['email'], "permission" => $users[0]['permission']);
			if ($_SESSION['user']['permission'] == "admin") {
				header("Location: http://localhost/dashboard_admin.php");
			} else if ($_SESSION['user']['permission'] == "user") {
				header("Location: http://localhost/dashboard_user.php");
			}
		}
	}

	public function login() {

	}

	public function logout() {

	}

	public static function create($email, $password, $permission) {
		$sql = 'INSERT INTO Users (email, password, permission, created_on) VALUES ("' . $email .'", md5("' . $password . '"), "' . $permission . '", NOW())';
		$res = mysql_query($sql);
		if ($res == 1) {
			$_SESSION['user'] = array('email' => $email, 'permission' => $permission);
			return true;
		} else {
			return false;
		}		
	}
}

?>