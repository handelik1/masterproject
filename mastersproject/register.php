<?php
	require('connect.php');

  	$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
	$lastname = mysqli_real_escape_string($con,$_POST['lastname']);
  	$email = mysqli_real_escape_string($con,$_POST['email']);
  	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$epass = hash('sha512', $username.$password);
	$time = time();

	$userQuery = mysqli_query($con, "insert into users (username, password, created, firstname, lastname, email, user_type) values ('$username','$epass', '$time', '$firstname', '$lastname', '$email', 'authenticated user')");

	mysqli_close($con);
	header("Location: index.php");
?>