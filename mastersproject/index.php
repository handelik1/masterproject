<?php
session_start();
require('connect.php');

$out = '';

require('header.html');

$out .='<body>';
$out .= '<div class="container">';

require('nav.php');


		//Content section, Title
$out .=	'<div class="row">
			<div class="col-md-12">
				<hr class = "hor-line">
				<h1 class = "title text-center">Project Archives</h1>
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

?>