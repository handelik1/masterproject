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
	$out .=						'<input form = "login-form" class = "account-button" type = "submit" name = "submit" value = "Login">';
	$out .= 					'<button class = "account-button" name = "register" data-toggle="modal" data-target="#register-modal">Register</button>';
	$out .=		  		'</div>';
	$out .=			'</div>';

	     																#  Registration modal
	$out .=     '<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	$out .=       '<div class="credential-panel" id="reg-panel">';
	$out .=         '<form class="credential-form" id="reg-form" action = "register.php" method="post">';
	$out .=           '<h2 class="sign-in">Registration</h2>';
	$out .=           '<label class="credential-label" style="margin-top: 0px">First Name</label>';
	$out .=           '<input class="reg-credential" id="reqacc_firstname" type="text">';
	$out .=           '<label class="credential-label">Last Name</label>';
	$out .=           '<input class="reg-credential" id="reqacc_lastname" type="text">';
	$out .=           '<label class="credential-label">Email Address</label>';
	$out .=           '<input class="reg-credential" id="reqacc_email" type="text">';
	$out .=           '<label class="credential-label">User Name</label>';
	$out .=           '<input class="reg-credential" id="reqacc_uname" type="text">';
	$out .=           '<label class="credential-label">Password</label>';
	$out .=           '<input class="reg-credential passpop" id="reqacc_pword" name="password" type="password" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Password must be at least 8 characters long, contain at least one letter and at least 1 number.">';
	$out .=           '<label class="credential-label">Confirm Password</label>';
	$out .=           '<input class="reg-credential" id="reqacc_confirmpword" type="password">';
	$out .=           '<input type="submit" class="register-button" value="Submit" ">';
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
						<input class = "search-bar" type = "text" name = "search"><br>
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