<?php
	require_once("dbheader.php");

	echo '
		<html>
			<head>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			</head>
			<body>
				<h1>Dashboard User</h1>
				<p>Welcome, ' . $_SESSION['user']['email'] . '!
				<a href="logout.php">Log Out</a>
				<hr/>
				<form action="dashboard_userAjax.php" method="post" name="uploader" enctype="multipart/form-data">
					<input type="file" id="fileToUpload" name="fileToUpload" />
					<input type="hidden" name="uid" value="' . $_SESSION['user']['id'] . '" />
					<input type="submit"/>
				</form>
				<!-- <button id="sendImage">Send</button> -->
				<hr/>
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
