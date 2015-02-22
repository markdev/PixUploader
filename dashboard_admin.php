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
						console.log("checked!!");
					} else {
						console.log("not checked");
					}
				});
			});
		</script>
