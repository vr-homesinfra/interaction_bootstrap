<?php
include("includes/header.php");  
//contact settings variables
$email = false;
$office_no = false;
$residential_address = false;
$office_address = false;
// $reg_as_int_des = false;

//About Me variables
  $coa_no = false;
  $about_me = false;
  $instagram_id = false;
  $facebook_id = false;
  $youtube_id = false;
  $linkedin_id = false; 
  
//contact settings process  
 if(isset($_POST['isPressedContactSettings'])){
    $email = $_POST['email'];
    $office_no = $_POST['office_no'];
    $residential_address = $_POST['residential_address'];
    $office_address = $_POST['office_address'];
    // $reg_as_int_des = $_POST['reg_as_int_des'];
$query = mysqli_query($con, "UPDATE users SET email='$email',office_no='$office_no',residential_address='$residential_address',office_address='$office_address' WHERE username='$userLoggedIn'"); 
} 
//About Me process
  if(isset($_POST['isPressed'])){
      $coa_no = $_POST['coa_no'];
      $about_me = $_POST['about_me'];
      $instagram_id = $_POST['instagram_id'];
      $facebook_id = $_POST['facebook_id'];
      $youtube_id = $_POST['youtube_id'];
      $linkedin_id = $_POST['linkedin_id'];
  $query = mysqli_query($con, "UPDATE users SET coa_no='$coa_no',about_me='$about_me',instagram_id='$instagram_id',facebook_id='$facebook_id',youtube_id='$youtube_id',linkedin_id='$linkedin_id' WHERE username='$userLoggedIn'"); 
  }
?>
