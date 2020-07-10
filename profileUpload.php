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
 
 move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
 echo $imagePath;
$update_query1 = mysqli_query($con, "UPDATE users SET profile_pic='$imagePath' WHERE username='$userLoggedIn'");
}


//  // Getting file name
//  $filename = $_FILES['imagefile']['name'];
 
//  // Valid extension
//  $valid_ext = array('png','jpeg','jpg');

//  // Location
//  $location = "assets/images/profile_pics/".$filename;

//  // file extension
//  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
//  $file_extension = strtolower($file_extension);

//  // Check extension
//  if(in_array($file_extension,$valid_ext)){

//    // Compress Image
//    compressImage($_FILES['imagefile']['tmp_name'],$location,60);

//  }else{
//    echo "Invalid file type.";
//  }
// }

// // Compress image
// function compressImage($source, $destination, $quality) {

//  $info = getimagesize($source);

//  if ($info['mime'] == 'image/jpeg') 
//    $image = imagecreatefromjpeg($source);

//  elseif ($info['mime'] == 'image/gif') 
//    $image = imagecreatefromgif($source);

//  elseif ($info['mime'] == 'image/png') 
//    $image = imagecreatefrompng($source);

//  imagejpeg($image, $destination, $quality);

// }
?>
