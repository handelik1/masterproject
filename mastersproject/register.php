<?php

if(session_status() == PHP_SESSION_NONE){
session_start();
}

	require('connect.php');

  	$firstname = strip_tags(mysqli_real_escape_string($con,$_POST['firstname']));
	$lastname = strip_tags(mysqli_real_escape_string($con,$_POST['lastname']));
  	$email = strip_tags(mysqli_real_escape_string($con,$_POST['email']));
  	$username = strip_tags(mysqli_real_escape_string($con,$_POST['username']));
	$password = strip_tags(mysqli_real_escape_string($con,$_POST['password']));
	$epass = hash('sha512', $username.$password);
	$time = time();

	$userQuery = mysqli_query($con, "insert into users (username, password, created, firstname, lastname, email, user_type) values ('$username','$epass', '$time', '$firstname', '$lastname', '$email', 'authenticated user')");

	mysqli_close($con);
    echo "<script>window.location = 'index.php'</script>";

?>