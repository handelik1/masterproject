<?php

	require('connect.php');

	$user = strip_tags(mysqli_real_escape_string($con, $_POST['user']));
	$removeUserQuery  = mysqli_query($con, "delete from users where username ='$user'");	
	
	mysqli_close($con); 

    echo "<script>window.location = 'edit_users.php'</script>";

?>