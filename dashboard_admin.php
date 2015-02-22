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
					<ul>

<?  $users = User::getAllUsers();
	foreach ($users as $user) { ?>
		<li id="<?=$user['id']?>">
			<input type="checkbox" id="<?=$user['id']?>" />
			<label><?=$user['email']?></label>
		</li>
<?  } ?>

					</ul>
				</td>
				<td>
				</td>
			</tr>
		</table>
