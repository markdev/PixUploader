<?php
	require_once("dbheader.php");
	require_once("User.php");

	function deletePic() {
		$user = new User();
		$res = $user->deleteImage($_POST['id']);
		echo $res;		
	}

	function uploadImage() {
		//let's make a hash for the name
		$file_name = basename($_FILES["fileToUpload"]["name"]);
		$extension_array = explode(".", $file_name);
		$extension = array_pop($extension_array);
		$file_hash = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)) . "." . $extension;

		$target_file = "images/" . $file_hash;

		// Check if image file is a actual image or fake image
		if(isset($_POST["uid"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
				$sql = 'INSERT INTO Images (hash, image_order, uid) VALUES ("' . $file_hash . '", 1, ' . $_POST['uid'] . ')';
				$res = mysql_query($sql);
				echo $res;
			} else {
				echo "File is not an image.";
			}
		} else {
			echo "Not submitted";
		}
	}

	if (!empty($_POST)) {
		if (isset($_POST['method']) && $_POST['method'] == "deletePic") { 
			deletePic(); 
		} else { // yes this is messy, but there are only two methods here
			uploadImage(); 
		}
	}

?>

