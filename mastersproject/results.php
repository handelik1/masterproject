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

require_once('citations.php');


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

		//Title, results
$out .=	'<div class="row">
			<div class="col-md-12">';
$out .= 		'<h2>Search Results</h2>';
$out .= 	'</div>
		</div>';

$limit = 5;  
if (isset($_GET["page"])){ 
	$page  = $_GET["page"]; 
} 
else { 
	$page=1;
}
$start = ($page-1) * $limit;  

		//Results information
$out .=	'<div class="row">';

if((isset($_POST['search']) && $_POST['search'] == ' ') || (isset($_POST['advanced_search']) && $_POST['advanced_search'] == ' ')){
	echo "<script>window.location = 'index.php'</script>";
}

//regular search
if(isset($_POST['search'])){
	unset($_SESSION['$buildQuery']);
	$_SESSION['search'] = strip_tags(mysqli_real_escape_string($con,$_POST['search']));
}

if(isset($_POST['search'])){
	$buildQuery = "title like '%".$_SESSION['search']."%' or abstract like '%".$_SESSION['search']."%'or firstname like '%".$_SESSION['search']."%' or lastname like '%".$_SESSION['search']."%' or supervisor like '%".$_SESSION['search']."%'";
}

//advanced search
if(isset($_POST['advanced_search'])){
	unset($_SESSION['$buildQuery']);
	$_SESSION['search'] = strip_tags(mysqli_real_escape_string($con,$_POST['advanced_search']));
	$search = $_SESSION['search'];
	//removes unnecesarry commas
	$search = str_replace(",,,", ',', $search);
	for($k = 0; $k < 5; $k++){
		$search = str_replace(",,", ',', $search);
	}

	$build = explode(",",$search);
	end($build);
	$key = key($build);
	unset($build[$key]);
	//builds an associative array with field names as key and user input as values.
	if(isset($build)){
		$buildQuery = '';
		$word = '';
		$insideArray = array();
		$buildArray = array_fill_keys(array('Keyword', 'Year', 'Semester', 'Supervisor', 'School', 'Department'), $insideArray);
		for($i = 0; $i < count($build); $i++){
			if($build[$i] == "Year" || $build[$i] == "Semester" || $build[$i] == "Supervisor" || $build[$i] == "Department" || $build[$i] == "School" || $build[$i] == "Keyword"){
				$word = $build[$i];
				$buildArray[$word][$i]= $build[$i];
			}
			else{
				$buildArray[$word][$i-1] = $build[$i];	
			}
		}
		//takes associate array and builds the query.
		foreach($buildArray as $key => $value){

				foreach($value as $item){
					if($key == 'Keyword'){
					$key = 'abstract';
				}
				$key = lcfirst($key);
				$buildQuery .= $key ." like '%" . $item . "%' and ";
				}
		}
	}

$_SESSION['$buildQuery'] = substr($buildQuery, 0, -4);
$buildQuery = $_SESSION['$buildQuery'];
}

if(isset($_SESSION['$buildQuery'])){
$buildQuery = $_SESSION['$buildQuery'];
$publicationQuery = mysqli_query($con, "select * from publications where $buildQuery LIMIT $start, $limit");
}
else{
$publicationQuery = mysqli_query($con, "select * from publications where $buildQuery LIMIT $start, $limit");

}

$count = mysqli_num_rows($publicationQuery);

if($count > 0){
		$c = 0;
		foreach ($publicationQuery as $key => $value) {
				$_SESSION['value'] = $value;
				$out .=		'<div class="col-md-10">';	
				if($value['middle_initial'] != NULL){
				$out .= 		'<div class = "result" id = "result'.$c.'">
									<form id = "project-form" class = "project-form-results" action="project.php" method="post">
									<input type = "hidden"  name = "key" value = "'.$key.'">
									<input type = "hidden"  name = "value" value = "'.htmlspecialchars(json_encode($value)).'">
									<input type = "hidden"  name = "title" value = "'.$value['title'].'">
									<input type = "hidden"  name = "firstname" value = "'.$value['firstname'].'">
									<input type = "hidden"  name = "middle_initial" value = "'.$value['middle_initial'].'">
									<input type = "hidden"  name = "lastname" value = "'.$value['lastname'].'">
									<input type = "hidden"  name = "supervisor" value = "'.$value['supervisor'].'">
									<input type = "hidden"  name = "department" value = "'.$value['department'].'">
									<input type = "hidden"  name = "type" value = "'.$value['type'].'">
									<input type = "hidden"  name = "semester" value = "'.$value['semester'].'">
									<input type = "hidden"  name = "year" value = "'.$value['year'].'">
									<input type = "hidden"  name = "data" value = "'.$value['data'].'">
									<input type = "hidden"  name = "url" value = "'.$value['url'].'">
									<input type = "hidden"  name = "abstract" value = "'.$value['abstract'].'">
										<input type = "submit" class = "result-title" value = "'.$value['title'].'" id = "result-title'.$c.'"> </input><br>'. '<span class = "person-name">By: '. $value['firstname'] . ' ' . $value['middle_initial'] . '. ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>
									</form>';
									if (strlen($value['abstract']) > 100){
											$abstract = substr($value['abstract'], 0, 290) . '...';
									
				$out .=					'<p class = "result-abs" id = "result-abs'.$c.'">'.$abstract.'</p><br>';
									}
									else{
				$out .=					'<p class = "result-abs" id = "result-abs'.$c.'">'.$value['abstract'].'</p><br>';
									}
				$out .=					'</div>';
				}
				else{		
				$out .= 		'<div class = "result" id = "result'.$c.'">
									<form id = "project-form" class = "project-form-results" action="project.php" method="post">
									<input type = "hidden"  name = "key" value = "'.$key.'">
									<input type = "hidden"  name = "value" value = "'.htmlspecialchars(json_encode($value)).'">
									<input type = "hidden"  name = "title" value = "'.$value['title'].'">
									<input type = "hidden"  name = "firstname" value = "'.$value['firstname'].'">
									<input type = "hidden"  name = "lastname" value = "'.$value['lastname'].'">
									<input type = "hidden"  name = "supervisor" value = "'.$value['supervisor'].'">
									<input type = "hidden"  name = "department" value = "'.$value['department'].'">
									<input type = "hidden"  name = "type" value = "'.$value['type'].'">
									<input type = "hidden"  name = "semester" value = "'.$value['semester'].'">
									<input type = "hidden"  name = "year" value = "'.$value['year'].'">
									<input type = "hidden"  name = "data" value = "'.$value['data'].'">
									<input type = "hidden"  name = "url" value = "'.$value['url'].'">
									<input type = "hidden"  name = "abstract" value = "'.$value['abstract'].'">
									<input type = "submit" class = "result-title" value = "'.$value['title'].'" id = "result-title'.$c.'"></input><br>'. '<span class = "person-name"> By: '. $value['firstname'] . ' ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>

									</form>';
									if (strlen($value['abstract']) > 100){
											$abstract = substr($value['abstract'], 0, 290) . '...';
									
				$out .=					'<p class = "result-abs" id = "result-abs'.$c.'">'.$abstract.'</p><br>';
									}
									else{
				$out .=					'<p class = "result-abs" id = "result-abs'.$c.'">'.$value['abstract'].'</p><br>';
									}
				$out .=					'</div>';
				}


				$out .= '<div class="container">
						  <!-- Trigger the modal with a button -->

						  <!-- Modal -->
						  <div class="modal fade modal-container" id="citationModal'.$c.'" role="dialog">
						    <div class="modal-dialog">
						    
						      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Citations</h4>
						        </div>
						        <div class="modal-body">';									          
				$out .=			'<div class = "citation" id = "citation'.$c.'" value = "'.$c.'">';
				$out .=				mla($key, $value);
				$out .=				ieee($key, $value);
				$out .=				acm($key, $value);
				$out .=				apa($key, $value);
				$out .=			'</div>';
				$out .=		    '</div>
						        <div class="modal-footer">
					 	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        </div>
						      </div>
						      
						    </div>
						  </div>
						  
						</div>';
				$out .=		'</div>';
							//End col-md-10
				$out .=		'<div class="col-md-2">';
								'<input type = "hidden" value = "'.$value['data'].'">';
				$out .=			'<div class = "cite-me" id = "cite-me'.$c.'" value = "'.$c.'" data-toggle="modal" data-target="#citationModal'.$c.'">Cite Me</div>';
				$out .=		'</div>';
				$c++;
		}

	}
else{
		$out .=		'<div class="col-md-12">';
		$out .= 		'<h1>No results</h1>';
		$out .=		'</div>';
}

$out .=	'</div>';

$out .= '<div class = "row">';
$out .=		'<div class = "col-md-2">';
$out .=		'</div>';

$out .=		'<div class = "col-md-8">';
$out .=		  '<div class = "page-wrapper">';
$out .= 		'<div class="pagination">'; 


if(isset($_SESSION['$buildQuery'])){
$buildQuery = $_SESSION['$buildQuery'];
$countQuery = mysqli_query($con, "select data from publications where $buildQuery");
}
else{
$countQuery = mysqli_query($con, "select data from publications where $buildQuery");
}
$currentPage = $_SERVER['REQUEST_URI'];
$currentPage = substr($currentPage, -1);
$countAmount= mysqli_num_rows($countQuery);
$total_records = $countAmount;
$total_pages = ceil($total_records / $limit); 
	if($currentPage != "p" and $total_pages != 1 && $total_records != 0){
		$out .= "<a href='results.php?page=".($page-1)."' class='button'>Previous</a>";
	}
	if($currentPage == "p" && $total_records != 0){
		$currentPage = 1;
	}
	if($total_records != 0){
		$out .= '<a class = "current" href="results.php?page='.$currentPage.'">'.$currentPage.'</a>';
	}

	if($currentPage != $total_pages and $total_pages != 1 && $total_records != 0){
		$out .= "<a href='results.php?page=".($page+1)."' class='button'>Next</a>";
	}
$out .=			'</div>'; 
$out .=		  '</div>';
$out .=		'</div>';

$out .=		'<div class = "col-md-2">';
$out .=		'</div>';

$out .= '</div>';

$out .=	'</div>';

$out .= '</body>';
 

mysqli_close($con);
require('footer.html');

echo $out;
}


?>
