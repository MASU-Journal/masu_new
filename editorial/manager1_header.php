<?php 
include_once('../connection.php');
include_once('../db.php');
include_once('../common_functions.php');
//pre($_SESSION,1);
if(empty($_SESSION['admin_login']) || empty($_SESSION['role_id']) || $_SESSION['admin_login'] != 'yes' || $_SESSION['role_id'] != '15'){
  header("Location:".APP_URL."logout.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Vendors Min CSS -->
        <link rel="stylesheet" href="assets/css/vendors.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <title>MASU Journal - Manager</title>
        <link rel="shortcut icon" href="../images/masu_logo.jpg" type="image/x-icon">
        <script src="assets/js/jquery.js"></script>
        <style type="text/css">
            .loader-mask{
                width:100%;
                height : 100%;
                background-color: rgba(255,255,255,0.7);
                z-index:999999999999999999999999999;
                position:fixed;
                top:0;
                left:0;
                display:none;
            }
            .loader-image{
                height : 50px;
                left:48%;
                top:45%;
                position : fixed;
            }
        </style>
    </head>

    <body>
        <div class="loader-mask">
            <img class="loader-image" src="../images/loader.gif" alt="Loading.. Please wait">
        </div>
        <?php include_once('manager1_sidebar.php'); ?>

        <!-- Start Main Content Wrapper Area -->
        <div class="main-content d-flex flex-column">

            <!-- Top Navbar Area -->
            <nav class="navbar top-navbar navbar-expand">
                <div class="collapse navbar-collapse" id="navbarSupportContent">
                    
                    <form style="visibility: hidden;" class="nav-search-form d-none ml-auto d-md-block">
                        <label><i class='bx bx-search'></i></label>
                        <input type="text" class="form-control" placeholder="Search here...">
                    </form>

                    <ul class="navbar-nav right-nav align-items-center">

                        <li class="nav-item dropdown profile-nav-item">
                            <a href="#" id="profile-drop-down-trigger" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div class="menu-profile">
                                    <span class="name">Welcome <?php echo ucwords($_SESSION['user_name']);?>!</span>
                                    <img src="assets/img/user.png" class="rounded-circle" alt="image">
                                </div>
                            </a>

                            <div class="dropdown-menu profile-drop-down active">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="figure mb-3">
                                        <img src="assets/img/user.png" class="rounded-circle" alt="image">
                                    </div>

                                    <div class="info text-center">
                                        <span class="name"><?php echo ucwords($_SESSION['user_name']);?></span>
                                        <p class="mb-3 email"><?php echo $_SESSION['user_email'];?></p>
                                    </div>
                                </div>

                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                        <li class="nav-item">
                                            <a href="profile.php" class="nav-link">
                                                <i class='bx bx-user'></i> <span>Profile</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="dropdown-footer">
                                    <ul class="profile-nav">
                                        <li class="nav-item">
                                            <a href="../logout.php" class="nav-link">
                                                <i class='bx bx-log-out'></i> <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Top Navbar Area -->