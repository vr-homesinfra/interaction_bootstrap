<?php
include("config/config.php");  
// $imagePath="";
// $imageName="";
$userLoggedIn = $_SESSION['userLoggedIn'];

// if($_FILES["file"]["name"] != '')
// {
//   $imageName = $_FILES['file']['name'];
// //    $test = explode('.', $_FILES['file']['name']);
// //    $ext = end($test);
//  //  $name = rand(100, 999) . '.' . $ext;
//   $location = 'assets/images/profile_pics/';  
//   $imagePath = $location . uniqid() . basename($imageName);
 
//  move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
//  echo $imagePath;
// $update_query1 = mysqli_query($con, "UPDATE users SET profile_pic='$imagePath' WHERE username='$userLoggedIn'");
// }



  // File name
  $filename = $_FILES["file"]["name"];
  // Valid extension
  $valid_ext = array('png','jpeg','jpg');
  
  // Location
  $location = "assets/images/profile_pics/".$filename;
  $thumbnail_location = "assets/images/thumbnail_profile_pics/".uniqid() .$filename;

  // file extension
  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);

  // Check extension
  if(in_array($file_extension,$valid_ext)){ 

    // Upload file
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

      // Compress Image
      compressImage($_FILES['file']['type'],$location,$thumbnail_location,50);

      // echo "Successfully Uploaded";
      echo $thumbnail_location;
      $update_query = mysqli_query($con, "UPDATE users SET profile_pic='$thumbnail_location' WHERE username='$userLoggedIn'");
    }
  }

// Compress image
function compressImage($type,$source, $destination, $quality) {

  $info = getimagesize($source);

  if ($type == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($type == 'image/jpg') 
    $image = imagecreatefromgif($source);

  elseif ($type == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}
?>
