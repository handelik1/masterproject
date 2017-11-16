<?php  
if(session_status() == PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{

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

function acm($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$acmName = acmName($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>ACM: </strong>'. $acmName . '. ' . $value['year'] . '. <i>' . $value['title'] . '</i>. ' . $value['type'] . ', ' . $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . '. '  .'</p>';
	}
	return $out;
}

function acmName($first, $last, $middle){
	$acmName = '';
	if($middle != NULL){
		$acmName = $first . ' ' . substr($middle, 0) . '. ' . $last ;
	}
	else{
		$acmName = $first . ' ' . $last;
	}
	return $acmName;
}

function apa($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$apaName = apaName($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>APA: </strong>'. $apaName . '. (' . $value['year'] . '). <i>' . $value['title'] . '</i> (' . $value['type'] . '). ' . $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . '. '  .'</p>';
	}
	return $out;
}

function apaName($first, $last, $middle){
	$apaName = '';
	if($middle != NULL){
		$apaName = $last . ', ' . substr($first, 0, 1) . '. ' . substr($middle, 0);
	}
	else{
		$apaName = $last . ', ' . substr($first, 0, 1);
	}
	return $apaName;
}

}
?>