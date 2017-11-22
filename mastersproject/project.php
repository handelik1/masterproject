<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{

require('connect.php');

$out = '';

require('header.html');

require_once('citations2.php');

require('nav.php');

		//Search bar section
$out .=	'<div class="row">
			<div class="col-md-12">
				<hr class = "hor-line">
  			</div>
		</div>';

$out .=	'<div class="row">
			<div class="col-md-12">
				<form id = "search-form" class = "search-form-results text-center" action="results.php" method="post">
					<input class = "search-bar-results" type = "text" name = "search" required><br>
					<input form = "search-form" class = "search-button-results" type = "submit" value = "Search">
					<a href = "advanced.php" class = "advanced-results">Advanced Search</a>
				</form>
					
  			</div>
		</div>';

		//Project information
//$id = strip_tags(mysqli_real_escape_string($con,$_POST['number']));
$abstract = stripcslashes(strip_tags(mysqli_real_escape_string($con,$_POST['abstract'])));
$abstract = htmlentities($abstract, ENT_QUOTES, 'UTF-8');
$title = stripslashes(strip_tags(mysqli_real_escape_string($con,$_POST['title'])));
$first = strip_tags(mysqli_real_escape_string($con,$_POST['firstname']));
if(isset($_POST['middle_initial'])){
	$middle = strip_tags(mysqli_real_escape_string($con,$_POST['middle_initial']));
}
$last = strip_tags(mysqli_real_escape_string($con,$_POST['lastname']));
$supervisor = strip_tags(mysqli_real_escape_string($con,$_POST['supervisor']));
$type = stripslashes(strip_tags(mysqli_real_escape_string($con,$_POST['type'])));
$department = strip_tags(mysqli_real_escape_string($con,$_POST['department']));
$semester = strip_tags(mysqli_real_escape_string($con,$_POST['semester']));
$year = strip_tags(mysqli_real_escape_string($con,$_POST['year']));
$data = strip_tags(mysqli_real_escape_string($con,$_POST['data']));
$url = strip_tags(mysqli_real_escape_string($con,$_POST['url']));
$key = strip_tags(mysqli_real_escape_string($con,$_POST['key']));
$value = json_decode(htmlspecialchars_decode($_POST['value']));
$value = (array)$value;


$out .=	'<div class="row">';

$out .=		'<div class="col-md-5">';
$out .=			'<h2 class = "title-header text-center">'.$title.'</h2>';
			if(isset($middle)){
$out .=			'<p class = "author-name text-center">By: '.$first. ' ' . $middle . '. ' . $last .'</p>';
			}
			else{
$out .=			'<p class = "author-name text-center">By: '.$first. ' ' . $last .'</p>';
			}
$out .=			'<hr class = "hor-line"><br>';
$out .=			'<p class = "supervisor project-label text-center">Supervisor: '.$supervisor.'</p><br>';
$out .=			'<p class = "project-type project-label text-center">Project Type: '.$type.'</p><br>';
$out .=			'<p class = "department project-label text-center">Department: '.$department.'</p><br>';
$out .=			'<p class = "date-published project-label text-center">Date Published: '.$semester. ' ' . $year .'</p><br>';
if(!empty($url)){
$out .=			'<p class = "url project-label text-center">'. $url .'</p><br>';
}
$out .=			'<p class = "text-center"><a href="/mastersproject/src/pdfs/'.$data.'" target="_blank" class = "data project-label" download>Download PDF</a></p><br>';
$out .=			'<div class = "cite-me" id = "cite-me'.$key.'" value = "'.$key.'" data-toggle="modal" data-target="#citationModal'.$key.'">Cite Me</div>';

								$out .= '<div class="container">
										  <!-- Trigger the modal with a button -->

										  <!-- Modal -->
										  <div class="modal fade modal-container" id="citationModal'.$key.'" role="dialog">
										    <div class="modal-dialog">
										    
										      <!-- Modal content-->
										      <div class="modal-content">
										        <div class="modal-header">
										          <button type="button" class="close" data-dismiss="modal">&times;</button>
										          <h4 class="modal-title">Citations</h4>
										        </div>
										        <div class="modal-body">';									          
								$out .=			'<div class = "citation" id = "citation'.$key.'" value = "'.$key.'">';
								$out .=				mla2($key,$value);
								$out .=				ieee2($key,$value);
								$out .=				acm2($key,$value);
								$out .=				apa2($key,$value);
								$out .=			'</div>';
								$out .=		    '</div>
										        <div class="modal-footer">
									 	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										        </div>
										      </div>
										      
										    </div>
										  </div>
										  
										</div>';

$out .= 	'</div>';


$out .=		'<div class="col-md-7">';
$out .= 		'<h3 class = "abstract-header text-center">Abstract</h3>';
$out .=			'<div class = "abstract-wrapper">';
$out .=					'<p class = "abstract">'.$abstract.'</p>';
$out .= 		'</div>';
$out .= 	'</div>';

$out .=	'</div>';

$out .= '</div>';
$out .= '</body>';


require('footer.html');
mysqli_close($con);
echo $out;

require('citations.php');

}
 

?>


