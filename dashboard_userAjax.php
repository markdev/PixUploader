<?php
	require_once("dbheader.php");

	print_r($_POST);
	print_r($_FILES);

	//let's make a hash for the name
	$file_name = basename($_FILES["fileToUpload"]["name"]);
	$extension_array = explode(".", $file_name);
	$extension = array_pop($extension_array);
	$file_hash = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)) . "." . $extension;


/*
	$target_file = "images/" . basename($_FILES["fileToUpload"]["name"]);

	// Check if image file is a actual image or fake image
	if(isset($_POST["email"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		} else {
			echo "File is not an image.";
		}
	} else {
		echo "Not submitted";
	}
*/
?>

