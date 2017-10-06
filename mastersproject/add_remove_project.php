<?php

require('connect.php');
if(isset($_POST['add_project'])){

	$title = mysqli_real_escape_string($con,$_POST['new_title']);
	$first = mysqli_real_escape_string($con,$_POST['new_first_name']);
	if($_POST['new_middle_name'] != null){
		$middle = mysqli_real_escape_string($con,$_POST['new_middle_name']);
	}
	else{
		$middle = '';
	}
	$last = mysqli_real_escape_string($con,$_POST['new_last_name']);
	$supervisor = mysqli_real_escape_string($con,$_POST['new_supervisor']);
	$school = mysqli_real_escape_string($con,$_POST['new_school']);
	$dept = mysqli_real_escape_string($con,$_POST['new_dept']);
	$semester = mysqli_real_escape_string($con,$_POST['new_semester']);
	$year = mysqli_real_escape_string($con,$_POST['new_year']);
	if($_POST['new_url'] != null){
		$url = mysqli_real_escape_string($con,$_POST['new_url']);
	}
	else{
		$url = '';
	}
	$type = mysqli_real_escape_string($con,$_POST['new_type']);
	$abstract = mysqli_real_escape_string($con,$_POST['new_abstract']);

	if(isset($_FILES['new_data'])) {

		$fileName = $_FILES['new_data']['name'];
		$tmpName  = $_FILES['new_data']['tmp_name'];
		$fileSize = intval($_FILES['new_data']['size']);
		$fileType = $_FILES['new_data']['type'];

		$fp = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);

		if(!get_magic_quotes_gpc()){
	    	$fileName = addslashes($fileName);
		}
	}
	$supervisorQuery = "select * from supervisor where name = '$supervisor'";
	
	$result = mysqli_query($con, $supervisorQuery);
	
	$count= mysqli_num_rows($result);
	//checks if row is queried
	if($count != 1){
		$insertPublication = "insert into supervisor (name) VALUES ('$supervisor')";
		mysqli_query($con, $insertPublication) or die('Error, query failed');
	}

	$insertFile = "insert into upload (name, size, type, data) VALUES ('$fileName', '$fileSize', '$fileType', '$content')";

	mysqli_query($con, $insertFile) or die('Error, query failed');

	$insertPublication = "insert into publications (firstname, lastname, middle_initial, abstract, title, school, department, supervisor, semester, year, url, type) VALUES ('$first', '$last', '$middle', '$abstract', '$title', '$school', '$dept', '$supervisor', '$semester', '$year', '$url', '$type')";

	mysqli_query($con, $insertPublication) or die('Error, query failed');

    mysqli_close($con); 

    header("Location: admin.php");
}
if(isset($_POST['remove_project'])){
	$list = $_POST['check_list'];
	foreach($list as $value){
		$publication = mysqli_real_escape_string($con, $value);
		$titleQuery  = mysqli_query($con, "select data from publications where title ='$publication'");
		$id = mysqli_fetch_assoc($titleQuery);
		$id = $id['data'];
		$removeQuery = mysqli_query($con, "delete from publications where data = '$id'");
		$removeData = mysqli_query($con, "delete from upload where id = $id");
	}

	mysqli_close($con); 

    header("Location: admin.php");
}

?>