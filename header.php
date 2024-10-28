<?php
include_once('connection.php');
include_once('db.php');
include_once("conf.php");
include_once("common_functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Madras Agricultural Journal</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/masu_logo.jpg" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700"
        rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <?php if (strpos($_SERVER['REQUEST_URI'], 'db-Institutionprofile') == false) { ?>
    <link href="css/materialize.css" rel="stylesheet">
    <?php } ?>
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link
        href="css/style.css?<?php echo date("dHis"); ?>"
        rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-5759270-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-5759270-1');
    </script>
    <style>
        .wed-logo a img {
            padding: 0px 0px;
        }

        .top-logo {
            background-color: #fff;
        }

        .ed-com-t1-left ul li a {
            color: #fff;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /*.wed-logo a img {
    width: 283px !important;
}*/
    </style>

</head>

<body>
    <div class="loader-mask">
        <img class="loader-image" src="images/loader.gif" alt="Loading.. Please wait">
    </div>
    <!-- MOBILE MENU -->
    <section>
        <div class="ed-mob-menu">
            <div class="ed-mob-menu-con">
                <div class="ed-mm-left">
                    <div class="wed-logo">
                        <a href="index.php"><img style="width:570px;"
                                src="images/logo.png?v=<?php echo date('mY'); ?>"
                                alt="" />
                        </a>

                    </div>
                </div>
                <div class="ed-mm-right">
                    <div class="ed-mm-menu">
                        <a href="#" class="ed-micon"><i class="fa fa-bars"></i></a>
                        <div class="ed-mm-inn">
                            <a href="#" class="ed-mi-close"><i class="fa fa-times"></i></a>
                            <h4>Home</h4>
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="about-masu.php">About-masu</a></li>
                                <li><a href="about-maj.php">About-maj</a></li>
                            </ul>
                            <h4>User Account</h4>
                            <ul>
                                <li><a href="auth/login.php">Sign In</a></li>
                                <li><a href="auth/login.php?action=2">Register</a></li>
                                <li><a href="logout.php" style="font-family:sans-serif; color: #fff;">Sign Out </a></li>
                            </ul>
                            <!-- <h4>Journal</h4>
                            <ul>
                                <li><a href="">Agriculture</a></li>
                                <li><a href="">Agrl.Engg</a></li>
                                <li><a href="">Forestry</a></li>
                                <li><a href="">Home Science</a></li>
                                <li><a href="">Course details</a></li>
                            </ul>
                            <h4>Research</h4>
                            <ul>
                                <li><a href="">Agriculture</a></li>
                                <li><a href="">Agrl.Engg</a></li>
                                <li><a href="">Forestry</a></li>
                                <li><a href="">Home Science</a></li>
                                <li><a href="">Course details</a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--HEADER SECTION-->
    <section>
        <!-- TOP BAR -->
        <div class="ed-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li style="width:100%">
                                <marquee behavior="scroll" direction="left">
                                    <?php
                                    $news_data = $db->query("SELECT *  FROM tbl_home_flash_news where status='active' order by id DESC");
if (!empty($news_data->rows)) {
    foreach ($news_data->rows as $index => $data) {
        ?>

                                    <a href="" style="color:white !important;"><img src="images/newgif.GIF"
                                            style="width: 50px;"><b><?php echo $data->news; ?></b>
                                        <img src="images/newgif.GIF" style="width: 50px;"></a>
                                    <?php }
    } ?>
                                </marquee>
                            </li>
                        </ul>
                        <!-- <input type='hidden' id="signout_user" value="<?php echo $_SESSION['user_id']; ?>"
                        /> -->
                    </div>

                    <!-- <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ed-com-t1-right">
							<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') { ?>
                    <ul>
                        <?php if (isset($_SESSION['category_id']) && $_SESSION['category_id'] != 1) { ?>
                        <li style="color: white;margin-right: 10px;margin-top: 3px;">
                            Hi&nbsp&nbsp<?php echo $_SESSION['user_ins_name']; ?>
                        </li>
                        <?php } else { ?>
                        <li style="color: white;margin-right: 10px;margin-top: 3px;">
                            Hi&nbsp&nbsp<?php echo $_SESSION['user_ins_name']; ?>
                        </li>
                        <?php } ?>
                        <li><a href="#!" id='sign_out'>Sign out</a>
                        </li>
                    </ul>
                    <?php } else { ?>
                    <?php }  ?>
                </div> -->
            </div>
        </div>
        </div>

        <!-- LOGO AND MENU SECTION -->
        <div class="top-logo" data-spy="affix" data-offset-top="250">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wed-logo" style="width : 100%; text-align: center;">
                            <a href="index.php"><img style="width:570px;"
                                    src="images/logo.png?v=<?php echo date('mY'); ?>"
                                    alt="" />
                            </a>

                        </div>
                        <div class="main-menu" style="width : 100%;float:left;padding: left 15px;">
                            <ul style="float: left;margin-right: 20px; margin-left: 180px;">
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="assets/docs/aim&scope.pdf">AIM & SCOPE</a></li>
                                <li class="about-menu">
                                    <a href="journal.php" class="mm-arr">PUBLICATION</a>
                                    <!-- MEGA MENU 1 -->
                                    <div class="mm-pos">
                                        <div class="about-mm m-menu">
                                            <div class="m-menu-inn">
                                                <div class="mm1-com mm1-s1">
                                                    <div class="ed-course-in">
                                                        <a class="course-overlay menu-about" href="journal.php">
                                                            <img src="images/tnau_ri.jpg" alt="">
                                                            <span>MAJ</span> </a>
                                                    </div>
                                                </div>
                                                <div class="mm1-com mm1-s2">
                                                    <p>MASU has been publishing a reputed journal, Madras Agricultural
                                                        Journal (MAJ) since 1913 and it is one of the longest serving
                                                        journals in India for the students and research community in
                                                        agriculture and allied sectors.MAJ has joined the Directory of
                                                        Open Access Journal Lund, Germany.MAJ are widely cited in
                                                        research studies</p>
                                                    <a href="about-maj.php" class="mm-r-m-btn">Read more</a>
                                                </div>
                                                <div class="mm1-com mm1-s3">
                                                    <ul>
                                                        <li><a href="journal.php">Volumes & Issues</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                </li>



                                <li><a href="editorial-board.php">EDITORIAL BOARD</a></li>

                                <li><a href="gallery-photo.php">GALLERY</a> </li>
                                <li><a href="contact-us.php">CONTACT</a> </li>
                            </ul>
                            <div style="margin-right: -20px;vertical-align:middle;padding:10px;">
                                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='') { ?>
                                <!-- <span style="margin-left:10px;font-weight:bold;font-size:15px;">Hi <?php echo $_SESSION['user_ins_name']; ?></span>
                                -->
                                <a style="color: white;background: #d62828;padding: 10px 15px;border-radius:15px;"
                                    href="#" id="sign_out">Sign Out</a>
                                <?php } else { ?>
                                <a style="color: white;background: #d62828;padding: 10px 15px;border-radius:15px;"
                                    href="auth/login.php">Submit Article</a>
                                <a style="color: white;background: #003049;padding: 10px 15px;border-radius:15px;"
                                    href="auth/login.php">Login</a>
                                <?php }  ?>
                            </div>

                        </div>
                    </div>
                    <div class="all-drop-down-menu">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END HEADER SECTION-->
</body>

</html>