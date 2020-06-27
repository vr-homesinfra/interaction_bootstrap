<?php
include("includes/header.php"); 
$email = false;
$residential_address = false;
$office_address = false;
$mobile_no2 = false; 

if(isset($_POST['customer_is_pressed'])){
    $email = $_POST['email'];
    $residential_address = $_POST['residential_address'];
    $office_address = $_POST['office_address'];
    $mobile_no2 = $_POST['mobile_no2'];
    
    $query = mysqli_query($con, "UPDATE users SET email='$email',residential_address='$residential_address',office_address='$office_address',office_no='$mobile_no2' WHERE username='$userLoggedIn'"); 
}
?>
