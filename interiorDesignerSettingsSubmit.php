<?php
include("includes/header.php"); 
 
//contact settings variables
$location = false;
$email = false;
$office_no = false;
$residential_address = false;
$office_address = false;
$reg_as_int_des = false;

//contact settings process  
 if(isset($_POST['isPressedContactSettings'])){
    $location = $_POST['location'];
    $email = $_POST['email'];
    $office_no = $_POST['office_no'];
    $residential_address = $_POST['residential_address'];
    $office_address = $_POST['office_address'];

    if ($_POST['reg_as_int_des']=="no") {
        $reg_as_int_des="no";
} else {
    $reg_as_int_des="interior";
    }
    $query = mysqli_query($con, "UPDATE users SET location='$location',email='$email',office_no='$office_no',residential_address='$residential_address',office_address='$office_address',	added_profile='$reg_as_int_des' WHERE username='$userLoggedIn'"); 

//About Me variables
  $about_me = false;
  $instagram_id = false;
  $facebook_id = false;
  $youtube_id = false;
  $linkedin_id = false; 
} 
//About Me process
  if(isset($_POST['isPressed'])){
      $about_me = $_POST['about_me'];
      $instagram_id = $_POST['instagram_id'];
      $facebook_id = $_POST['facebook_id'];
      $youtube_id = $_POST['youtube_id'];
      $linkedin_id = $_POST['linkedin_id'];
  $query = mysqli_query($con, "UPDATE users SET about_me='$about_me',instagram_id='$instagram_id',facebook_id='$facebook_id',youtube_id='$youtube_id',linkedin_id='$linkedin_id' WHERE username='$userLoggedIn'"); 
  }
?>
