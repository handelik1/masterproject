<?php
$out = '';
if(session_status() == PHP_SESSION_NONE){
session_start();
}
require('connect.php');


require('header.html');
if(!isset($_SESSION['user'])){

	require('nav.php');
				//displays login form
	$out .=		'<div class="row">
					<div class="col-md-12">';
	$out.= 			 '<hr class = "hor-line">';
	$out .=				'<div class = "login-wrapper">';
	$out .=			  		'<h1 class = "repo-title text-center">MSU Project Repo</h1><br><br>';
	$out .= 				'<form id = "login-form" action = "logincheck.php" method = "post">';
	$out .=							'<div class = "credential-wrapper">';
	$out .= 							'<label class = "credential-label-login">Username</label><input id = "username" type="text" name="username" size = "40" style = "width: 200px;" required><br><br>';
	$out .= 							'<label class = "password credential-label-login">Password</label><input id = "password" type="password" name="password" size = "40" style = "width: 200px;"  required>';
	$out .=							'</div>';
	$out .= 				'</form>';
	$out .=						'<input form = "login-form" id = "login-button" class = "account-button" type = "submit" name = "submit" value = "Login">';
	$out .= 					'<button class = "account-button" name = "register" data-toggle="modal" data-target="#register-modal">Register</button>';
	$out .=		  		'</div>';
	$out .=			'</div>';

	     																#  Registration modal
	$out .=     '<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	$out .=       '<div class="credential-panel" id="reg-panel">';
	$out .=         '<form onsubmit="return validateMyForm();" class="credential-form" id="reg-form" action = "register.php" method="post">';
	$out .=           '<h2 class="sign-in">Registration</h2>';
	$out .=           '<label class="credential-label" >First Name</label>';
	$out .=           '<input class="reg-credential" name="firstname" id="firstname" type="text">';
	$out .=           '<label class="credential-label">Last Name</label>';
	$out .=           '<input class="reg-credential" name="lastname" id="lastname" type="text">';
	$out .=           '<label class="credential-label">Email Address</label>';
	$out .=           '<input class="reg-credential" name="email" id="email" type="text">';
	$out .=           '<label class="credential-label">User Name</label>';
	$out .=           '<input class="reg-credential" name="username" id="username" type="text">';
	$out .=           '<label class="credential-label">Password</label>';
	$out .=           '<input class="reg-credential" name="password" id="pass" name="password" type="password">';
	$out .=           '<label class="credential-label">Confirm Password</label>';
	$out .=           '<input class="reg-credential" id="confirmpassword" type="password">';
	$out .=           '<input type="submit" id = "submit" class="register-button" value="Submit" ">';
	$out .=         '</form>';
	$out .=       '</div>';
	$out .=     '</div>';

	$out .= 	'</div>';
	$out .= '</body>';

	echo $out;
}
else{
	$out = '';
	$out .='<body>';
	$out .= '<div class="container">';
	require('nav.php');

			//Content section, Title
	$out .=	'<div class="row">
				<div class="col-md-12">
					<hr class = "hor-line">
					<h1 class = "title text-center">MSU Project Repo</h1>
	  			</div>
			</div>';
			//Content section, Search Bar
	$out .=	'<div class="row">
				<div class="col-md-12">
					<form id = "search-form" class = "search-form text-center" action="results.php" method="post">
						<input class = "search-bar" type = "text" name = "search" required><br>
						<a class = "advanced">Advanced Search</a>
					</form>
	  			</div>
			</div>';

	$out .=	'<div class="row">
				<div class="col-md-12">
					<div class = "search-button-wrapper text-center">
						<input form = "search-form" class = "search-button" type = "submit" value = "Search">
					</div>
				</div>
			</div>';

	$out .=	'</div>';
	$out .= '</body>';

	require('footer.html');

	echo $out;
}

    require('footer.html');

?>

<script type="text/javascript">
function validateMyForm()
{
  var pass = document.getElementById('pass').value;
  var confirm = document.getElementById('confirmpassword').value;

  if(pass != confirm)
  { 
    alert("Password and confirm password do not match.");
    return false;
  }

  alert("Thank you for registering. Please login with your username and password.");
  return true;
}
</script>

<script>
function validateEmail(email) {
  var emailregex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return emailregex.test(email);
}

function validate() {
  var email = $("#email").val();
  if (validateEmail(email)) {
  	return true;
  } 
  else {
   alert("Email not valid.");
    return false;
  }

}

$("#submit").bind("click", validate);
</script>
