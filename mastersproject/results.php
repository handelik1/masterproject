<?php

require('connect.php');

$out = '';

require('header.html');

$out .='<body>';
$out .= '<div class="container">';

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
					<input class = "search-bar-results" type = "text" name = "search"><br>
					<input form = "search-form" class = "search-button-results" type = "submit" value = "Search">
					<a class = "advanced-results">Advanced Search</a>
				</form>
					
  			</div>
		</div>';

		//Title, results
$out .=	'<div class="row">
			<div class="col-md-12">';
$out .= 		'<h2>Search Results</h2>';
$out .= 	'</div>
		</div>';

		//Results information
$out .=	'<div class="row">';
				$search = mysqli_real_escape_string($con,$_POST['search']);

				$publicationQuery = mysqli_query($con, "select * from publications where title like '%$search%' or abstract like '%$search%' or firstname like '%$search%' or lastname like '%$search%' or supervisor like '%$search%'");
				$count= mysqli_num_rows($publicationQuery);

				if($count > 0){
						$c = 0;
						foreach ($publicationQuery as $key => $value) {

								$out .=		'<div class="col-md-10">';	
								if($value['middle_initial'] != NULL){

								$out .= 		'<div class = "result" id = "result'.$c.'">
													<a class = "result-title" id = "result-title'.$c.'">'.$value['title'] .' '.'</a>'. '<span class = "person-name">By: '. $value['firstname'] . ' ' . $value['middle_initial'] . '. ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>

													<br>
													<p class = "result-abs" id = "result-abs'.$c.'">'.$value['abstract'].'</p><br>
												</div>';
								}
								else{		
								$out .= 		'<div class = "result" id = "result'.$c.'">
													<a class = "result-title" id = "result-title'.$c.'">'.$value['title'] .' '.'</a>'. '<span class = "person-name">By: '. $value['firstname'] . ' ' . $value['lastname'] .' - </span> <span class = "person-name">Supervisor: ' . $value['supervisor'] . '</span>

													<br>
													<p class = "result-abs" id = "result-abs'.$c.'">'.$value['abstract'].'</p><br>
												</div>';
								}
								$out .=			'<div class = "citation hidden" id = "citation'.$c.'" value = "'.$c.'">';
								$out .=				mla($key, $value);
								$out .=				ieee($key, $value);
								$out .=			'</div>';
								$out .=		'</div>';

								$out .=		'<div class="col-md-2">';
												'<input type = "hidden" value = "'.$value['id'].'">';
								$out .=			'<div class = "cite-me" id = "cite-me'.$c.'" value = "'.$c.'">Cite Me</div>';
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




$out .=	'</div>';
$out .= '</body>';


require('footer.html');

echo $out;

function mla($key, $value){
	$mlaName = mlaName($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>MLA: </strong>'. $mlaName . '<i>' . $value['title'] . '</i>. ' . $value['type'] . '. ' . $value['school'] . '. ' . 'Web. ' . date("j M.  Y.") .'</p>';

	return $out;
}

function mlaName($first, $last, $middle){
	$mlaName = '';
	if($middle != NULL){
		$mlaName = $last . ', ' . $first . ' ' . $middle . '. ' ;
	}
	else{
		$mlaName = $last . ', ' . $first . '. ';
	}
	return $mlaName;
}

function ieee($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$ieeeName = ieeeName($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>IEEE: </strong>'. $ieeeName . '"' . $value['title'] . '," ' . $value['type'] . ', ' . $value['department'] . ', '. $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . ', ' . $value['year'] . '.' .'</p>';
	}
	return $out;
}

function ieeeName($first, $last, $middle){
	$mlaName = '';
	if($middle != NULL){
		$ieeeName = substr($first, 0, 1) . '. ' . substr($middle, 0) . '. ' . $last . ', ' ;
	}
	else{
		$ieeeName = substr($first, 0, 1) . '. ' . $last . ', ';
	}
	return $ieeeName;
}
?>

<script>

	$(document).ready(function(){
		$('[id^=cite-me]').click(function(){
			var val = $(this).attr('value');
			if($('#citation' + val).hasClass("hidden")){
				$('#citation' + val).removeClass("hidden");
			}
			else{
				$('#citation' + val).addClass("hidden");
			}
		});
	});

</script>