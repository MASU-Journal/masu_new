<?php include_once 'connection.php';
include_once 'db.php';
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(!isset($_SESSION['admin_id'])&& $_SESSION['admin_id']=="") {
    header('Location:index.php');

}
$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>REVIEWER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/components/jvectormap/jquery-jvectormap.css">
  <link href="css/bootstrap.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .tab {
      width: 100%;
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      float: left;
      cursor: pointer;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      height: 300px;
    }

    .tablinks {
      font-size: 16px;
      width: 141px;
      ;
    }


    .detailBox {
      margin-top: 36px;
      border: 1px solid #bbb;

    }

    .titleBox {

      padding: 10px;
    }

    .titleBox label {
      color: #444;
      margin: 0;
      display: inline-block;
    }

    .commentBox {
      padding: 10px;
      border-top: 1px dotted #bbb;
    }

    .commentBox .form-group:first-child,
    .actionBox .form-group:first-child {
      width: 80%;
    }

    .commentBox .form-group:nth-child(2),
    .actionBox .form-group:nth-child(2) {
      width: 18%;
    }

    .actionBox .form-group * {
      width: 100%;
    }

    .taskDescription {
      margin-top: 10px 0;
    }

    .commentList {
      padding: 0;
      list-style: none;
      max-height: 200px;
      overflow: auto;
    }

    .commentList li {
      margin: 0;
      margin-top: 10px;
    }

    .commentList li>div {
      display: table-cell;
    }

    .commenterImage {
      width: 30px;
      margin-right: 5px;
      height: 100%;
      float: left;
    }

    .commenterImage img {
      width: 100%;
      border-radius: 50%;
    }

    .commentText p {
      margin: 0;
    }

    .sub-text {
      color: #aaa;
      font-family: verdana;
      font-size: 11px;
    }

    .actionBox {
      border-top: 1px dotted #bbb;
      padding: 10px;
    }

    .increase {
      height: 368px;
    }

    .form-control .assigned_select46 {
      height: 300px;
    }

    select[multiple],
    select[size] {
      height: 289px ! important;
    }
  </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>AS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="color: aliceblue;margin-top: 12px;"><b>REVIEWER</b> EDITOR</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs" style="color:white" id="sign_out">Logout</span>
                <input type="hidden" id="signout_user"
                  value="<?php echo $user_id; ?>" />
              </a>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>

      </nav>
    </header>
    <?php if(!empty($_SESSION['journal_assign_msg'])) {
        foreach($_SESSION['journal_assign_msg'] as $key=>$val) { ?>
    <div class="alert alert-success" id="success-alert">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong><?php echo $val; ?></strong>
    </div>
    <?php }
        } $_SESSION['journal_assign_msg']=array();?>