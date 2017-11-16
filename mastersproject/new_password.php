<?php

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{
	require('connect.php');

  	$username = strip_tags(mysqli_real_escape_string($con,$_POST['username']));
	$password = strip_tags(mysqli_real_escape_string($con,$_POST['new-password']));
	$epass = hash('sha512', $username.$password);

	$userQuery = mysqli_query($con, "update users set password = '$epass' where username = '$username'");

	mysqli_close($con);
    echo "<script>window.location = 'edit_users.php'</script>";
}
?>