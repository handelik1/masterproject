<?php
	require('connect.php');

  	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['new-password']);
	$epass = hash('sha512', $username.$password);

	var_dump($username);
	$userQuery = mysqli_query($con, "update users set password = '$epass' where username = '$username'");

	mysqli_close($con);
	header("Location: edit_users.php");
?>