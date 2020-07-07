<?php
ob_start(); //Turns on output buffering 
session_start();
$timezone = date_default_timezone_set("Asia/Kolkata");
$con = mysqli_connect("localhost", "root", "", "interaction"); //Connection variable
if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
//using pdo
$db=new PDO("mysql:host=localhost;dbname=interaction","root","");

$baseUrl = "homesinfra.com/"
?>
