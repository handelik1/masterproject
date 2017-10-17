<?php
	require('connect.php');

	$user = mysqli_real_escape_string($con, $_POST['user']);
	$removeUserQuery  = mysqli_query($con, "delete from users where username ='$user'");	
	
	mysqli_close($con); 

    header("Location: edit_users.php");
?>