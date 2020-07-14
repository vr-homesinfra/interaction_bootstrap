<?php
include("includes/header.php"); 

$username=$_SESSION['uname'];
// $reqMobNo=false;
//About Me process
if(isset($_POST['reqMobNo'])){
  
  $add_friend_query=mysqli_query($con,"UPDATE users SET friend_array=CONCAT(friend_array,'$username,')WHERE username='$userLoggedIn'");
  $reqMobNo = $_POST['reqMobNo'];
  }
?>
