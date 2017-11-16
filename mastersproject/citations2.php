<?php 
if(session_status() == PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{

function mla2($key, $value){
	$mlaName = mlaName2($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>MLA: </strong>'. $mlaName . '<i>' . $value['title'] . '</i>. ' . $value['type'] . '. ' . $value['school'] . '. ' . 'Web. ' . date("j M.  Y.") .'</p>';

	return $out;
}

function mlaName2($first, $last, $middle){
	$mlaName = '';
	if($middle != NULL){
		$mlaName = $last . ', ' . $first . ' ' . $middle . '. ' ;
	}
	else{
		$mlaName = $last . ', ' . $first . '. ';
	}
	return $mlaName;
}

function ieee2($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$ieeeName = ieeeName2($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>IEEE: </strong>'. $ieeeName . '"' . $value['title'] . '," ' . $value['type'] . ', ' . $value['department'] . ', '. $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . ', ' . $value['year'] . '.' .'</p>';
	}
	return $out;
}

function ieeeName2($first, $last, $middle){
	$mlaName = '';
	if($middle != NULL){
		$ieeeName = substr($first, 0, 1) . '. ' . substr($middle, 0) . '. ' . $last . ', ' ;
	}
	else{
		$ieeeName = substr($first, 0, 1) . '. ' . $last . ', ';
	}
	return $ieeeName;
}

function acm2($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$acmName = acmName2($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>ACM: </strong>'. $acmName . '. ' . $value['year'] . '. <i>' . $value['title'] . '</i>. ' . $value['type'] . ', ' . $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . '. '  .'</p>';
	}
	return $out;
}

function acmName2($first, $last, $middle){
	$acmName = '';
	if($middle != NULL){
		$acmName = $first . ' ' . substr($middle, 0) . '. ' . $last ;
	}
	else{
		$acmName = $first . ' ' . $last;
	}
	return $acmName;
}

function apa2($key, $value){
	require('connect.php');
	$school = $value['school'];
	$universityQuery = mysqli_query($con, "select * from university where name = '$school'");
	foreach($universityQuery as $key => $val){
	$apaName = apaName2($value['firstname'], $value['lastname'], $value['middle_initial']);
	$out = '';
	$out .= '<p class = "citation-style"><strong>APA: </strong>'. $apaName . '. (' . $value['year'] . '). <i>' . $value['title'] . '</i> (' . $value['type'] . '). ' . $value['school'] . ', ' . $val['city'] . ', ' . $val['state'] . '. '  .'</p>';
	}
	return $out;
}

function apaName2($first, $last, $middle){
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