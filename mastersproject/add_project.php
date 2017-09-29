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
	$out .=			'</div>';
	$out .=     '</div>';
				//Blank column
	$out .=		'<div class="row">';
	$out .=			'<div class="col-md-4">';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=				'<h3 class = "new_project_header text-center">Add New Project</h3>';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=			'</div>';
	$out .=     '</div>';
				//Form inputs
	$out .=		'<div class="row">';
	$out .= 		'<form autocomplete="on" class = "add_project_form" id = "add-project-form" action = "send_add_form.php" method = "post" enctype="multipart/form-data">';
	$out .=				'<div class="col-md-4">';
	$out .=					'<label class = "new_project_label">Title</label><input class = "new_project_input" type = "text" size="46"></input><br><br>';
	$out .=					'<label class = "new_project_label">Name</label><br><input class = "new_first_name" type = "text" size="18" placeholder = "First"></input>';
	$out .=					'<input class = " new_middle_name" type = "text" size="2" placeholder = "M."></input>';
	$out .=					'<input class = " new_last_name" type = "text" size="22" placeholder = "Last"></input><br><br>';
	$out .=					'<label class = "new_project_label">Supervisor</label><input id = "new_supervisor" class = "new_project_input new_supervisor" type = "text" size="39"></input><br><br>';
	$out .=					'<label class = "new_project_label">School</label><input class = "new_project_input new_school" type = "text" size="43"></input><br><br>';
	$out .=					'<label class = "new_project_label">Department</label><input class = "new_project_input new_dept" type = "text" size="38"></input>';
	$out .=				'</div>';

	$out .=				'<div class="col-md-4">';
	$out .=						'<label class = "new_project_label">Semester</label><input class = "new_project_input" type = "text" size="46"></input><br><br>';
	$out .=					'<label class = "new_project_label">Year</label><br><input class = "new_year new_project_input" type = "text" ></input><br><br>';
	$out .=					'<label class = "new_project_label">URL <span>(Optional)</span></label><br><input class = "new_year new_project_input" type = "text" ></input><br><br>';
	$out .=					'<label class = "new_project_label">Type</label><select class = "new_project_input new_type">';
	$out .=						'<option value = "Master\'s Project">Master\'s Project</option>';
	$out .=						'<option value = "Thesis">Thesis</option>';
	$out .=					'</select><br><br>';
	$out .=					'<label class = "new_project_label">File</label>';
	$out .= 								'<input type="hidden" name="MAX_FILE_SIZE" value="2000000">';
	$out .= 								'<input type="file" name="form_data" size="40" required>';

	$out .=				'</div>';

	$out .=				'<div class="col-md-4">';
	$out .=					'<label class = "new_project_label">Abstract</label> <textarea rows="15" cols="51"></textarea>';
	$out .=				'</div>';
	$out .=			'</form>';
	$out .=     '</div>';

	$out .=		'<div class="row">';
	$out .=			'<div class="col-md-4">';
	$out .=				'<div class = "back-button-wrapper">';
	$out .=					'<a class = "back-button" href = "admin.php">Back</a>';
	$out .=				'</div>';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=           '<input form = "add-project-form" type="submit" id = "submit" class="new-project-button" value="Submit" ">';
	$out .=			'</div>';

	$out .=			'<div class="col-md-4">';
	$out .=			'</div>';
	$out .=     '</div>';


	$out .= '</body>';

	echo $out;

    require('footer.html');

?>

<script type="text/javascript">
$(function() {
    var availableTags = <?php include('autocomplete.php'); ?>;
    $("#new_supervisor").autocomplete({
        source: availableTags,
        autoFocus:true
    });
});
</script>