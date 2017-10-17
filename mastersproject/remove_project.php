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
	$out .=				'<h3 class = "new_project_header text-center">Remove A Project</h3>';
	$out .=			'</div>';
	$out .=     '</div>';

	$out .=	'<div class="row">';

	$out .=		'<div class="col-md-2">';
	$out .=		'</div>';

	$out .=		'<div class="col-md-8">
					<form id = "search-form" class = "search-form-results text-center" action="remove_project.php" method="post">
						<input type = "hidden" name = "remove" value = "remove">
						<input class = "search-bar-results" placeholder = "Search for projects" type = "text" name = "remove-search" required><br>
						<input form = "search-form" class = "remove-button-results" type = "submit" value = "Go">
					</form>					
  				</div>';

	$out .=		'<div class="col-md-2">';
	$out .=		'</div>';

	$out .=	'</div>';
	if(isset($_POST['remove'])){
		$remove = mysqli_real_escape_string($con,$_POST['remove']);
	}
	if(isset($remove)){
		$search = mysqli_real_escape_string($con,$_POST['remove-search']);

		$publicationQuery = mysqli_query($con, "select * from publications where title like '%$search%' or abstract like '%$search%' or firstname like '%$search%' or lastname like '%$search%' or supervisor like '%$search%'");
		$count= mysqli_num_rows($publicationQuery);

		$out .=	'<div class="row">';

		$out .=		'<div class="col-md-2">';
		$out .=		'</div>';

		$out .=		'<div class="col-md-8">';
		$out .= 	'<div class = "remove-wrapper">';
		$out.= '<form onsubmit= "return sure()" id = "remove_project_form" class = "project-form-results" action="add_remove_project.php" method="post">';
									$out .=		'<input type = "hidden" name = "remove_project">';
					if($count > 0){
							$c = 0;
								foreach ($publicationQuery as $key => $value) {
								$out .=		'<div class="col-md-12">';
									if($value['middle_initial'] != NULL){
									$out .= 		'<div class = "result" id = "result'.$c.'">
															<h1 class = "remove-title" id = "remove-title'.$c.'">'.$value['title'].'</h1><span class = "person-name">By: '. $value['firstname'] . ' ' . $value['middle_initial'] . '. ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>';
									$out .= 			'<input class = "remove-check" type = "checkbox" name = "check_list[]" value = "'.$value['title'].'">';
									$out .=			'</div>';
									}
									else{		
									$out .= 		'<div class = "result" id = "result'.$c.'">
														<h1 class = "remove-title" id = "remove-title'.$c.'">'.$value['title'].'</h1>'. '<span class = "person-name"> By: '. $value['firstname'] . ' ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>';
									$out .= 			'<input class = "remove-check" type = "checkbox" name = "check_list[]" value = "'.$value['title'].'">';
									$out .=			'</div>';
									}
								$out .= '</div>';
								$c++;
								}
								$out.= '</form>';
					}
					else{
						$out .=		'<div class="col-md-12">';
						$out .= 		'<h1>No results</h1>';
						$out .=		'</div>';
				}

		$out .= 	'</div>';
		$out .=		'<div class = "remove-button-wrapper text-center">';
		$out .=      	'<input form = "remove_project_form" type="submit" id = "submit" class="remove-project-button text-center" value="Remove" ">';
		$out .=		'</div>';
		$out .=	'</div>';

		$out .=		'<div class="col-md-2">';
		$out .=		'</div>';

		$out .=	'</div>';
	}
	$out .= '</body>';
    mysqli_close($con); 
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