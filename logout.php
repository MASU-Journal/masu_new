<?php 
//  $con = mysqli_connect("localhost","masu_login","13coimbatore13","masu_login");

// // Check connection
// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
session_start();

session_destroy();
header('Location:index.php');
?>