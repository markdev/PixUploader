<?php
	require_once("dbheader.php");
	require_once("User.php");
	$user = new User();

	echo '
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="PixUploader.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			</head>
			<body>
				<h1>Dashboard User</h1>
				<p>Welcome, ' . $user->email . '!
				<a href="logout.php">Log Out</a>
				<hr/>
				<form method="post" name="uploader" enctype="multipart/form-data">
					<input type="file" id="fileToUpload" name="fileToUpload" />
					<input type="hidden" name="uid" value="' . $user->id . '" />
					<input type="submit"/>
				</form>
				<!-- <button id="sendImage">Send</button> -->
				<hr/>
		';

	$images = $user->getAllImages();
	foreach ($images as $image) {
		echo '<img src="images/' . $image['hash'] . '"/>';
	}

	echo '
				<script>
					$(document).ready(function() {
						$("form[name=\'uploader\']").submit(function(e){
							var formData = new FormData($(this)[0]);
							$.ajax({
								url: "dashboard_userAjax.php",
								type: "POST",
								data: formData,
								async: false,
								success: function (msg) {
								    console.log(msg)
								},
								cache: false,
								contentType: false,
								processData: false
							});

							//e.preventDefault();							
						});
					});
				</script>
			</body>
		</html>
	';
?>
