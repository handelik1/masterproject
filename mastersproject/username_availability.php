<?php
require('connect.php');

if(isset($_POST["username"]) && !empty($_POST["username"])) {
  $username = $_POST["username"];
  $result = mysqli_query($con, "select * from users where username= '$username'");
  $row = mysqli_num_rows($result);
  if($row > 0) {
      echo '<span id = "not-available" class ="not-available">Username Not Available.</span>';
  }else{
      echo '<span class ="available">Username Available.</span>';
  }
}
?>