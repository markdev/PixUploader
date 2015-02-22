<?php
	require_once("dbheader.php");
	require_once("User.php");
	$user = new User();
	
	include("htmlhead.php");
?>

	<body>
		<h1>Admin Dashboard</h1>
		<p>Welcome, <?=$user->email?> !</p>
		<a href="logout.php">Log Out</a>
		<hr/>
		<table style="width: 100%; min-height: 100%">
			<tr>
				<td style="width: 300px; background-color: #77f">
					<ul id="userlist">

<?  $users = User::getAllUsers();
	foreach ($users as $user) { ?>
		<li id="<?=$user['id']?>">
			<input type="checkbox" class="usercheck" id="<?=$user['id']?>" />
			<label><?=$user['email']?></label>
		</li>
<?  } ?>

					</ul>
				</td>
				<td>
					<ul id="picturelist">
					</ul>
				</td>
			</tr>
		</table>
		<script>
			$(document).ready(function() {
				$('input.usercheck').click(function() {
					if ($(this).is(':checked')) {
						var data = { uid : $(this).attr('id') };
						$.ajax({
							url: "dashboard_adminAjax.php",
							type: "POST",
							data: data,
							success: function(res) {
								var response = JSON.parse(res);
								var imageString = "";
								console.log(response.images[1]);
								for (var i=0; i<response.images.length; i++) {
									imageString += '<div class="imgFrame"><img src="images/' + response.images[i].hash + '" /></div>';
								}
								$('ul#picturelist').append('<li class="displayitem" id="img' + response.user.id + '"><div class="userdisplay" id="' + response.user.id + '"><p>'+ response.user.email+ '</p>' + imageString + '</div></li>');
								console.log(response);
							}
						});
					} else { // if unchecked; deletes the div
						$('ul#picturelist li#img' + $(this).attr('id')).remove();
					}
				});
			});
		</script>
