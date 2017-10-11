<?php

    require('connect.php');

    $schoolQuery = mysqli_query($con, "select name from university");

    $school_name_list = array();
    while($row = mysqli_fetch_array($schoolQuery))
    {
        $school_name_list[] = $row['name'];
    }
    echo json_encode($school_name_list);
    mysqli_close($con); 
?>
