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
	$out .=			'<div class="col-md-12">';
	$out .= 			 '<h1>Administration</h1>';
	$out .=			'</div>';
	$out .=     '</div>';

	$out .=		'<div class="row">';
	$out .=			'<div class="col-md-12">';
	$out .=				'<h3 class = "new_project_header text-center">Edit Users</h3>';
	$out .=			'</div>';
	$out .=     '</div>';

	$usersQuery = mysqli_query($con, "select * from users order by username asc");
	$count= mysqli_num_rows($usersQuery);


	$out .=	'<div class="row">';

	$out .=		'<div class="col-md-3">';
	$out .=				'<div class = "edit-back-button-wrapper">';
	$out .=					'<a class = "back-button" href = "admin.php">Back</a>';
	$out .=				'</div>';
	$out .=		'</div>';

	$out .=		'<div class="col-md-6">';
	$out .=			'<div class = "edit-users-wrapper">';
				foreach ($usersQuery as $key => $value) {
					$name = ucwords($value['username']); 
	$out .=			'<form onsubmit="return sure()" action = "remove_user.php" method = "post">';
	$out .=				'<div class = "row">';	
	$out .=					'<div class="col-md-6">';
	$out .= 					'<span class = "user">'.$name.'</span>';
	$out .= 					'<input class = "user" name = "user" type = "hidden" value = "'.$name.'">';
	$out .=					'</div>';

	$out .=					'<div class="col-md-3">';
	$out .=					'</div>';

	$out .=					'<div class="col-md-3">';
	$out .= 				 	 '<input class = "remove-user-button" type = "submit" value = "Remove">';
	$out .=					'</div>';
	$out .=				'</div>';
$out .=				 '</form>';
					}
	$out .=			'</div>';
	$out .=		'</div>';

	$out .=		'<div class="col-md-3">';
	$out .=		'</div>';

	$out .= '</div>';



	echo $out;

    require('footer.html');

?>
<script>
function sure(){
	if (confirm('Are You Sure? This CANNOT be undone!')){
	   return true;
	}
	else{
	   return false;
	}
}

</script>