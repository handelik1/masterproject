<?php

if(session_status() == PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{
    require('connect.php');

    $schoolQuery = mysqli_query($con, "select name from university");

    $school_name_list = array();
    while($row = mysqli_fetch_array($schoolQuery))
    {
        $school_name_list[] = $row['name'];
    }
    echo json_encode($school_name_list);
    mysqli_close($con); 
}
?>
