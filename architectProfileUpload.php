<?php
include("config/config.php");  
$imagePath="";
$imageName="";
$userLoggedIn = $_SESSION['userLoggedIn'];

if($_FILES["file"]["name"] != '')
{
  $imageName = $_FILES['file']['name'];
//    $test = explode('.', $_FILES['file']['name']);
//    $ext = end($test);
 //  $name = rand(100, 999) . '.' . $ext;
  $location = 'assets/images/profile_pics/';  
  $imagePath = $location . uniqid() . basename($imageName);
move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath);
 
 echo $imagePath;
 
$update_query1 = mysqli_query($con, "UPDATE users SET profile_pic='$imagePath' WHERE username='$userLoggedIn'");
}
?>
