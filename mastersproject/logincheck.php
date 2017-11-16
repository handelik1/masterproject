<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}

include('header.html');

include('nav.php');


	require("connect.php");
	
	
	$username= strip_tags(mysqli_real_escape_string($con,$_POST['login_username']));
    $password= strip_tags(mysqli_real_escape_string($con,$_POST['password']));
	$epass= hash('sha512', $username.$password);
	
	$logQuery= "select * from users where username= '$username' and password= '$epass'";
	
	$result = mysqli_query($con, $logQuery);
	
	$count= mysqli_num_rows($result);
	//checks if row is queried
	if($count==1){
		$_SESSION['user'] = $username;
	
	
    echo "<script>window.location = 'index.php'</script>";

	}
	else {
	echo '<script>alert("Wrong username or password!")</script>';
	echo '<script>window.history.back();</script>';
	}
	
	
	      mysqli_close($con); 


include('footer.html');


 ?>
