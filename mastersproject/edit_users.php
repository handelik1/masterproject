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
				$c = 0;
				foreach ($usersQuery as $key => $value) {
					$name = ucwords($value['username']); 
	$out .=				'<div class = "row">';	
	$out .=					'<div class="col-md-4">';
	$out .= 					'<span class = "user">'.$name.'</span>';
	$out .= 					'<input class = "user" name = "user" type = "hidden" value = "'.$name.'">';
	$out .=					'</div>';

	$out .=					'<div class="col-md-4">';
	$out .=						'<input class = "change-pass" type = "button"  data-toggle="modal" data-target="#new-pass-modal'.$c.'" value = "Change Password">';
	$out .=   			 	 '<div class="modal fade" id="new-pass-modal'.$c.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
	$out .=       				'<div class="credential-panel" id="reg-panel">';
	$out .=   			      	 '<form onsubmit="return (newPassFormValidate() && checkPwd())"  class="new-pass-form" id="new-pass-form'.$c.'" action = "new_password.php" method="post">';
	$out .=          				 '<h2 class="sign-in">Change Password</h2>';
										$name = strtolower($name);
	$out .= 						    '<input name = "username" type = "hidden" value = "'.$name.'">';
	$out .=           					'<label class="credential-label">Password</label><span class = "password-regex">(At least 8 characters, contains at least 1 letter and 1 number)</span>';
	$out .=           					'<input class="reg-credential" name="new-password" id="newpass" name="password" type="password">';
	$out .=           					'<label class="credential-label">Confirm Password</label>';
	$out .=           					'<input class="reg-credential" id="new-confirm-password" type="password">';
	$out .=           					'<input form = "new-pass-form'.$c.'" type="submit" id = "submit" class="change-pass-button" value="Submit" ">';
	$out .=        			   	  '</form>';
	$out .=       				 '</div>';
	$out .=     		 	  '</div>';

	$out .=					'</div>';


	$out .=					'<div class="col-md-4">';
	$out .=						'<form id = "remove-form'.$c.'" onsubmit="return sure()" action = "remove_user.php" method = "post">';
	$out .= 						'<input class = "user" name = "user" type = "hidden" value = "'.$name.'">';
	$out .= 				 	 	'<input form = "remove-form'.$c.'" class = "remove-user-button" type = "submit" value = "Remove">';
	$out .=						'</form>';
	$out .=					'</div>';

	$out .=				'</div>';
					$c++;
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

<script type="text/javascript">
function newPassFormValidate()
{
  var pass = document.getElementById('newpass').value;
  var confirm = document.getElementById('new-confirm-password').value;

  if(pass != confirm)
  { 
    alert("Password and confirm password do not match.");
    return false;
  }

}
</script>

<script>
function checkPwd() {
	var str = document.getElementById('newpass').value;
    if (str.length < 8) {
        alert("Password is too short");
        return false;
    } else if (str.search(/\d/) == -1) {
        alert("Password must contain at least 1 number");
        return false;
    } else if (str.search(/[a-zA-Z]/) == -1) {
        alert("Password must contain at least 1 letter");
        return false;
    }
    else{
    return true;
	}
}

</script>