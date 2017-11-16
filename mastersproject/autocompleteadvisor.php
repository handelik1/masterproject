<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}

if(!isset($_SESSION['user'])){
    echo "<script>window.location = 'index.php'</script>";
}
else{

    require('connect.php');

    $supervisorQuery = mysqli_query($con, "select name from supervisor");

    $supervisor_name_list = array();
    while($row = mysqli_fetch_array($supervisorQuery))
    {
        $supervisor_name_list[] = $row['name'];
    }
    echo json_encode($supervisor_name_list);
    mysqli_close($con); 
}
?>
