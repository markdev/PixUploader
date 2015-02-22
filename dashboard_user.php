<?php
	require_once("dbheader.php");
	require_once("User.php");
	$user = new User();
?>

		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="PixUploader.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			</head>
			<body>
				<h1>Dashboard User</h1>
				<p>Welcome, <?=$user->email?> !</p>
				<a href="logout.php">Log Out</a>
				<hr/>
				<form method="post" name="uploader" enctype="multipart/form-data">
					<input type="file" id="fileToUpload" name="fileToUpload" />
					<input type="hidden" name="uid" value="' . $user->id . '" />
					<input type="submit"/>
				</form>
				<hr/>


<?php
	$images = $user->getAllImages();
	foreach ($images as $image) {
		echo '<div class="imgFrame" id="' . $image['id'] . '">';
		echo '<img src="images/' . $image['hash'] . '"/>';
		echo '<br/>';
		echo '<button class="delete" id="' . $image['id'] . '">Delete</button>'; 
		echo '</div>';
	}
?>

				<script>
					$(document).ready(function() {
						$("form[name=\'uploader\']").submit(function(e){
							var formData = new FormData($(this)[0]);
							formData.method = "uploadImage";
							console.log(formData);
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
						});

						$('button.delete').click(function(){
							var conf = confirm("Are you sure you want to delete this image?");
							if (conf) {
								var id = $(this).attr('id');
								var data = { 
									id : id,
									method: "deletePic" 
								};
								console.log(data);
								$.ajax({
									type: "post",
									url: "dashboard_userAjax.php",
									data: data,
									success: function (res) {
									    if (res == 1) {
									    	$('div#' + id).fadeOut();
									    }
									},

								});
					
							}
						});
					});
				</script>
			</body>
		</html>
