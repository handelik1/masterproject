<?php
$out = '';
if(session_status() == PHP_SESSION_NONE){
session_start();
}
require('connect.php');


require('header.html');
require('nav.php');

				//Line seperating nav from content
	$out .=		'<div class="row">';
	$out .=			'<div class="col-md-12">';
	$out .= 			 '<hr class = "hor-line">';
	$out .=			'</div>';
	$out .=     '</div>';

	$out .=		'<div class="row">';
	$out .=			'<div class="col-md-12">';
	$out .= 			 '<h1>Administration</h1>';
	$out .= 			 '<h4>Administrators can add new projects to the repository, remove projects from the repository, and edit users. Choose an option.</h4>';
	$out .=			'</div>';
	$out .=     '</div>';

	$out .=		'<div class="row">';

	$out .=			'<div class="col-md-4">';
	$out .=				'<a class = "admin_link_button" href = "add_project.php">';
	$out .=					'<div class = "admin_button text-center">Add New Project</div>';
	$out .=				'</a>';
	$out .=				'<div class = "back-button-wrapper">';
	$out .=					'<a class = "back-button" href = "index.php">Back</a>';
	$out .=				'</div>';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=				'<a class = "admin_link_button" href = "remove_project.php">';
	$out .=					'<div class = "admin_button text-center">Remove Project</div>';
	$out .=				'</a>';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=				'<a class = "admin_link_button" href = "edit_users.php">';
	$out .=					'<div class = "admin_button text-center">Edit Users</div>';
	$out .=				'</a>';
	$out .=			'</div>';

	$out .=     '</div>';


	$out .= '</body>';

	echo $out;

    require('footer.html');

?>