<?php
include("config/config.php");  
$imagePath="";
$imageName="";
$user_to="";
$userLoggedIn = $_SESSION['userLoggedIn'];
$user_to=$_SESSION['user_to'];
if($_FILES["file"]["name"] != '')
{
  $imageName = $_FILES['file']['name'];
//    $test = explode('.', $_FILES['file']['name']);
//    $ext = end($test);
 //  $name = rand(100, 999) . '.' . $ext;
  $location = 'assets/images/msg_files/';  
  $imagePath = $location . uniqid() . basename($imageName);
move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath);
 
// echo $imagePath;
$date_time_now = date("Y-m-d H:i:s");
 
//upload to db from message page
// $query = mysqli_query($this->con, "INSERT INTO fileupload VALUES('','', 'application/octet-stream','File Transfer', 'attachment','0','must-revalidate', 'public', '50', '$userLoggedIn','$user_to','$date', '$body', 'ankit', '$date', '0', '0', '0','$imageName')");
$query = mysqli_query($con, "INSERT INTO messages VALUES('','$user_to','$userLoggedIn','$imageName', '$date_time_now','no','no','no', '$imagePath')");
} 
?>
