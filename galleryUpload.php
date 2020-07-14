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
  $location = 'assets/gallery_pics/';  
  $imagePath = $location . uniqid() . basename($imageName);
  move_uploaded_file($_FILES["file"]["tmp_name"], $imagePath);
 
 echo $imagePath;
 
 $date = date("Y-m-d H:i:s");
 $insert_query2 = mysqli_query($con, "INSERT INTO creative_gallery VALUES('','$imageName', 'application/octet-stream','File Transfer', 'attachment','0','must-revalidate', 'public', '50', '$userLoggedIn','$date','$imagePath')");
}

?>
