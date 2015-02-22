<?php
	require_once("dbheader.php");
	require_once("User.php");
	
	$sql = "DELETE FROM Images WHERE id=" . $_POST['id'];
	$res = mysql_query($sql);

	echo $res;

?>