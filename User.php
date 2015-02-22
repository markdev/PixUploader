<?php

class User {

	public $id = "";
	public $email = "";
	public $permission = "";

	public function __construct() {
		if (isset($_SESSION['user'])) {
			$this->id = $_SESSION['user']['id'];
			$this->email = $_SESSION['user']['email'];
			$this->permission = $_SESSION['user']['permission'];
		}
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

	public static function getAllUsers() {
		$sql = 'SELECT id, email FROM Users';
		$res = mysql_query($sql);
		$users = array();
		while ($row = mysql_fetch_array($res)) {
			$users[] = $row;
		}
		return $users;
	}

	public function authenticate($email, $password) {
		$sql = 'SELECT * FROM Users WHERE email = "' . $email . '" AND PASSWORD = "' . md5($password) . '"';
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
			$this->id = $users[0]['id'];
			$this->email = $users[0]['email'];
			$this->permission = $users[0]['permission'];
			$this->login();
		}
	}

	public function getAllImages() {
		$sql = "SELECT * FROM Images WHERE uid = " . $this->id . " ORDER BY image_order";
		$res = mysql_query($sql);
		$images = array();
		while ($row = mysql_fetch_array($res)) {
			$images[] = $row;
		}
		return $images;
	}

	public function deleteImage($id) {
		$sql = "DELETE FROM Images WHERE id=" . $id;
		return mysql_query($sql);
	}

	public function logout() {
		if(isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		header("Location: http://localhost/index.php");
	}

	private function login() {
		$_SESSION['user'] = array("id" => $this->id, "email" => $this->email, "permission" => $this->permission);
		if ($_SESSION['user']['permission'] == "admin") {
			header("Location: http://localhost/dashboard_admin.php");
		} else if ($_SESSION['user']['permission'] == "user") {
			header("Location: http://localhost/dashboard_user.php");
		}
	}
}

?>