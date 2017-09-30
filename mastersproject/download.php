<?php

    require('connect.php');
    $data = $_GET['data']; 
	$queryFile = mysqli_query($con,"select * from upload where id = $data");

        if($queryFile) {
            // Make sure the result is valid
            if(mysqli_num_rows($queryFile) == 1) {
            // Get the row
                $row = mysqli_fetch_assoc($queryFile);
 
                // Print headers
                header("Content-Type: ". $row['type']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 
                // Print data
                echo $row['data'];
            }
}



?>