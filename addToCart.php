<?php
require "config/config.php";

  if (isset($_GET)&& !empty($_GET)) {
      $uname=$_GET['uname'];
      $city=$_GET['city'];
      $profile=$_GET['profile'];
      $_SESSION['uname']=$uname;
      $_SESSION['city']=$city;
      $_SESSION['profile']=$profile;
    //   $str="profile=".$profile."&"."city="."$city";
    //   header('Location:extSearchProfiles.php?'.$str);
    header('Location:otpLogin.php');

} else {
header('Location:extSearch.php');
}
// echo ($_SESSION['uname']);
// echo ($_SESSION['city']);
?>
