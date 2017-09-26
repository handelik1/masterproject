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
	$out .=			  '<h1 class = "repo-title text-center">MSU Project Repo</h1><br><br>';
	$out .= 				'<form id = "login-form" action = "logincheck.php" method = "post">';
	$out .=							'<div class = "credential-wrapper">';
	$out .= 							'<label class = "credential-label">Username</label><input id = "username" type="text" name="username" size = "40" style = "width: 200px;" required><br><br>';
	$out .= 							'<label class = "password credential-label">Password</label><input id = "password" type="password" name="password" size = "40" style = "width: 200px;"  required>';
	$out .=							'</div>';
	$out .= 					'<input class = "login-button" type = "submit" name = "submit" value = "Login">';
	$out .= 				'</form>
			  			</div>
					</div>';
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