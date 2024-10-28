<?php
include_once('conf.php');
//$con = mysqli_connect("localhost", "root", "", "masu");
$con = mysqli_connect("localhost","Admin","masu1907@","masu");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(empty($_SESSION)) {
    session_start();
}
//print_r($_SESSION);
$_SESSION['lksls']=1;
//include 'db.php';
//session_start();
//session_destroy();
function pre($obj, $exit = 1)
{
    echo "<pre>";
    echo "<br>";
    print_r($obj);
    echo "<br>";
    if($exit) {
        exit;
    }
}
