<?php

class User {

	public function __construct($email, $permission) {

	}

	public function login() {

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