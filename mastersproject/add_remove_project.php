<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}


if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{

require('connect.php');
if(isset($_POST['add_project'])){

	$title = strip_tags(mysqli_real_escape_string($con,$_POST['new_title']));
	$first = strip_tags(mysqli_real_escape_string($con,$_POST['new_first_name']));
	if($_POST['new_middle_name'] != null){
		$middle = strip_tags(mysqli_real_escape_string($con,$_POST['new_middle_name']));
	}
	else{
		$middle = '';
	}
	$last = strip_tags(mysqli_real_escape_string($con,$_POST['new_last_name']));
	$supervisor = strip_tags(mysqli_real_escape_string($con,$_POST['new_supervisor']));
	$school = strip_tags(mysqli_real_escape_string($con,$_POST['new_school']));
	$dept = strip_tags(mysqli_real_escape_string($con,$_POST['new_dept']));
	$semester = strip_tags(mysqli_real_escape_string($con,$_POST['new_semester']));
	$year = strip_tags(mysqli_real_escape_string($con,$_POST['new_year']));
	if($_POST['new_url'] != null){
		$url = strip_tags(mysqli_real_escape_string($con,$_POST['new_url']));
	}
	else{
		$url = '';
	}
	$type = strip_tags(mysqli_real_escape_string($con,$_POST['new_type']));
	$abstract = strip_tags(mysqli_real_escape_string($con,$_POST['new_abstract']));
	$abstract = htmlentities($abstract, ENT_QUOTES, 'UTF-8');

	if(isset($_FILES['new_data'])) {

		$fileName = $_FILES['new_data']['name'];
		$tmpName  = $_FILES['new_data']['tmp_name'];
		$fileSize = $_FILES['new_data']['size'];

		if(!get_magic_quotes_gpc()){
	    	$fileName = addslashes($fileName);
		}

	}
	if($fileSize > 3000000){
		echo '<script>alert("File too large, try again!")</script>';
		echo '<script>window.location = "admin.php"</script>';
		exit();
	}

	$num = rand(1,1000000);
	$name_parts= explode(".", $fileName);
	$newname = $name_parts[0] . $num . "." . $name_parts[1]; 
	$fileName = $newname;
	move_uploaded_file($tmpName, "src/pdfs/$fileName");

	$supervisorQuery = "select * from supervisor where name = '$supervisor'";
	
	$result = mysqli_query($con, $supervisorQuery);
	
	$count= mysqli_num_rows($result);
	//checks if row is queried
	if($count != 1){
		$insertSupervisor = mysqli_query($con,"insert into supervisor (name) VALUES ('$supervisor')");
	}

	$insertPublication = "insert into publications (firstname, lastname, middle_initial, abstract, title, school, department, supervisor, semester, year, url, type, data) VALUES ('$first', '$last', '$middle', '$abstract', '$title', '$school', '$dept', '$supervisor', '$semester', '$year', '$url', '$type', '$fileName')";

	mysqli_query($con, $insertPublication) or die('Error, query failed');

	$insertFile = mysqli_query($con, "insert into upload (name) VALUES ('$fileName')");

    mysqli_close($con); 

    echo "<script>window.location = 'admin.php'</script>";
}
if(isset($_POST['remove_project'])){
	$list = $_POST['check_list'];
	foreach($list as $value){
		$publication = strip_tags(mysqli_real_escape_string($con, $value));
		$titleQuery  = mysqli_query($con, "select data from publications where title ='$publication'");
		$id = mysqli_fetch_assoc($titleQuery);
		$id = $id['data'];
		$removeQuery = mysqli_query($con, "delete from publications where data = '$id'");
	}

	mysqli_close($con); 
    echo "<script>window.location = 'admin.php'</script>";
}

}

?>