<?php
include 'journal_details.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to Madras Agriculture Journal</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/slider/ic.jpg" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700"
        rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <!-- <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" /> -->
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
    <style>
        .pro-user {
            position: relative;
            margin-top: -10px;
            box-shadow: 0px 5px 18px -11px rgba(150, 150, 150, 0.8);
            border: 1px solid #f3f2f2;
            border-bottom: 0px;
            z-index: 9;
        }

        .udb-sec {
            position: relative;
            overflow: hidden;
            margin-top: -66px;
            margin-bottom: 35px;
            background: #fff;
            padding: 25px;
            border-radius: 2px;
            box-shadow: 0px 5px 18px -11px rgba(150, 150, 150, 0.8);
            border: 1px solid #f3f2f2;
        }

        ol.progtrckr {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        ol.progtrckr li {
            display: inline-block;
            text-align: center;
            line-height: 3.5em;
        }

        ol.progtrckr[data-progtrckr-steps="2"] li {
            width: 49%;
        }

        ol.progtrckr[data-progtrckr-steps="3"] li {
            width: 33%;
        }

        ol.progtrckr[data-progtrckr-steps="4"] li {
            width: 24%;
        }

        /*ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }*/
        ol.progtrckr[data-progtrckr-steps="6"] li {
            width: 16%;
        }

        ol.progtrckr[data-progtrckr-steps="7"] li {
            width: 14%;
        }

        ol.progtrckr[data-progtrckr-steps="8"] li {
            width: 12%;
        }

        ol.progtrckr[data-progtrckr-steps="9"] li {
            width: 11%;
        }

        ol.progtrckr li.progtrckr-done {
            color: black;
            border-bottom: 4px solid yellowgreen;
        }

        ol.progtrckr li.progtrckr-todo {
            color: silver;
            border-bottom: 4px solid silver;
        }

        ol.progtrckr li:after {
            content: "\00a0\00a0";
        }

        ol.progtrckr li:before {
            position: relative;
            bottom: -2.5em;
            float: left;
            left: 50%;
            line-height: 1em;
        }

        ol.progtrckr li.progtrckr-done:before {
            content: "\2713";
            color: white;
            background-color: yellowgreen;
            height: 2.2em;
            width: 2.2em;
            line-height: 2.2em;
            border: none;
            border-radius: 2.2em;
        }

        ol.progtrckr li.progtrckr-todo:before {
            content: "\039F";
            color: silver;
            background-color: white;
            font-size: 2.2em;
            bottom: -1.2em;
        }

        #save {
            display: none;
        }

        #main-stu-container {
            min-height: 600px;
        }

        #stu-sidebar {
            min-height: 600px;
        }

        .journal_box {
            width: 100%;
            height: auto;
            border: 1px solid #ABC3C7;
            margin-bottom: 20px;
            box-shadow: 0 8px 6px -6px #ABC3C7;
        }

        .journal_title {
            margin: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ABC3C7;
        }

        .journal_content {
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .journal-button {
            margin: 0px 50px 15px 20px;
            color: white;
        }
    </style>
</head>

<body>

    <!-- MOBILE MENU -->


    <!--HEADER SECTION-->
    <?php include 'header.php';?>
    <!--END HEADER SECTION-->


    <!--SECTION START-->
    <section>

        <div class="pro-menu">
            <div class="container">
                <div class="col-md-9 col-md-offset-3">
                    <ul>
                        <!--<li><a class="tablinks active" onclick="openCity(event, 'dashboard_stud')" >My Dashboard</a></li>-->
                        <li><a class="tablinks" onclick="openCity(event, 'dashboard_stud')" id="defaultOpen">My
                                Dashboard</a></li>
                        <li><a class="tablinks " onclick="openCity(event, 'pro_file_stud')">Profile</a></li>
                        <!-- <li><a class="tablinks" onclick="openCity(event, 'my_inbox_stud')">My Inbox</a></li>-->
                        <li><a id="a-submit-paper" class="tablinks active"
                                onclick="openCity(event, 'sub_papers_stud')">Submit Papers</a></li>
                        <!--<li><a class="tablinks" onclick="openCity(event, 'resub_papers_stud')">Paper ReSubmission</a></li>-->
                        <li><a class="tablinks" onclick="openCity(event, 'status_bar_stud')">Status</a></li>
                        <!--<li><a id='notification_checking_but' class="tablinks" onclick="openCity(event, 'notification_stud')">Notifications <span class='badge badge-light' id='notification_count'></span></a></li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="stu-db">
            <div class="container pg-inn" id="main-stu-container">
                <!--<div class="col-md-3">
                    <div class="pro-user">
                        <img src="images/user.jpg" alt="user">
                    </div>
                    <div class="pro-user-bio">
                        <ul>
                            <li>
                                <h4><?php echo $user_details[0]->user_instutename; ?>
                </h4>
                </li>
                <li><a href="#"><b>Research Topics</b></a></li>
                <div class="">
                    <a href="index.html"><img src="images/logo.png" alt="" style="width: 94px;">
                    </a>
                    <p style="text-align:justify">Madras Agricultural Students Union (MASU) started in the year 1911 was
                        registered as a Society during 1923 (Registration No.1/1923 -24)</p>
                    <a href="M-index.html">Read more</a>
                </div>
                </ul>
            </div>
        </div>-->
        <div class="col-md-3">
            <!--<div class="pro-user">
                        <img src="images/user.jpg" alt="user">
                    </div>-->
            <div id="stu-sidebar" class="pro-user-bio"
                style="background: #2f4f73;border: 1px solid #c0c8d1;    box-shadow: 0px 10px 16px -8px rgba(150,150,150,0.8);">
                <ul>
                    <li>
                        <h4 style="color:white">
                            <?php //echo $user_details[0]->first_name.' '.$user_details[0]->last_name;?>
                        </h4>
                    </li>
                    <li style="color:white">Institution Id:
                        MASU<?php //echo $user_details[0]->user_id;?>
                    </li>
                    <div class="">
                        <!--<a ><img src="images/logo.png" alt="" style="width: 94px;">
									</a>-->
                        <!--<p style="text-align:justify"> Madras Agricultural Students Union (MASU) started in the year 1911 was registered as a Society during 1923 (Registration No.1/1923 -24)</p>-->

                    </div>
                </ul>
            </div>
        </div>
        <div class="tabcontent col-md-9" id="pro_file_stud">
            <div class="udb">
                <div class="udb-sec udb-prof">
                    <h4><img src="images/icon/db1.png" alt="" /> My Profile</h4>

                    <div class="sdb-tabl-com sdb-pro-table">
                        <table class="responsive-table bordered">
                            <tbody>
                                <tr>
                                    <th><b>Name of the Institution</b></th>
                                    <th>:</th>
                                    <th>&nbsp&nbsp</th>
                                    <td><?php echo ucwords($user_details[0]->user_instutename); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><b>Institution Id</b></th>
                                    <th>:</th>
                                    <th>&nbsp&nbsp</th>
                                    <td>MASU<?php echo $user_details[0]->user_id; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><b>Email</b></th>
                                    <th>:</th>
                                    <th>&nbsp&nbsp</th>
                                    <td><?php echo $user_details[0]->user_email; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><b>Phone</b></th>
                                    <th>:</th>
                                    <th>&nbsp&nbsp</th>
                                    <td><?php  echo $user_details[0]->user_contact;  ?>
                                    </td>
                                </tr>
                                <!--<tr>
                                            <th>Year</th>
                                            <th>:</th>
                                            <td><?php echo date('d M Y', strtotime($user_details[0]->created_date)); ?>
                                </td>
                                </tr>-->

                                <tr>
                                    <th><b>Status</b></th>
                                    <th>:</th>
                                    <th>&nbsp&nbsp</th>
                                    <td><span
                                            class="db-done"><?php echo($user_details[0]->status==0 ? 'Active' : 'Inactive');?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="sdb-bot-edit">
                            <!--<button class="btn btn-info" id="edit"><span class="glyphicon glyphicon-edit"></span>Edit my profile</button>-->
                            <button class="btn btn-success" id="save"><span class="glyphicon glyphicon-save"></span>
                                save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabcontent col-md-9" id="dashboard_stud"
            style="display: block;padding: 0px 12px;border: 0.5px solid #fbfbfb;">
            <?php if(!empty($journal_data) && count($journal_data)>0) { ?>
            <!-- <div class="col-md-12"><h3>Active Journals</h3></div> -->
            <?php foreach($journal_data as $journal_id => $data) { ?>

            <div class="col-md-12 journal_box">
                <div class="col-md-11 journal_title">
                    <h4><?php echo ucfirst($data['title']); ?>
                    </h4>
                </div>
                <div class="col-md-12 journal_content">
                    <span><b>Author : </b>
                        <?php echo $data['author']; ?></span>
                </div>
                <div class="col-md-12 journal_content">
                    <div class="col-md-6">
                        <span><b>Subject : </b>
                            <?php echo $data['subject']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Type : </b>
                            <?php echo $data['type']; ?></span>
                    </div>
                </div>
                <div class="col-md-12 journal-button">
                    <button type="button" name="journal_submit_but" class="col-md-3 btn">Review Forum</button>
                </div>
            </div>
            <?php }
            } else { ?>
            <div class="col-md-12" style="color:black;margin-top:20%;text-align: center;">
                <span>Sorry..You do not have any active manuscript. Click the button to submit manuscript.</span>
                <div style="text-align:center;" class="col-md-12">
                    <button style="float:none;color:white;" type="button" id="dash_2_paper_btn"
                        name="journal_submit_but" class="col-md-4 btn">Submit</button>
                </div>
            </div>

            <?php } ?>
        </div>
        <!----my_inbox-------->
        <div class="tabcontent col-md-9" id="my_inbox_stud">
            <div class="udb">
                <div class="udb-sec udb-prof">
                    <h4><img src="images/icon/db1.png" alt="" /> Myinbox</h4>
                    <p>notification msg enabled</p>
                </div>
            </div>
        </div>

        <!----submit-------->
        <div class="tabcontent col-md-9" id="sub_papers_stud">
            <div class="udb">
                <div class="udb-sec udb-prof">
                    <div class="box-inn-sp admin-form">
                        <h4>Add Papers</h4>
                        <div class="tab-inn">
                            <?php if(!empty($_SESSION['form_error'])) { ?>
                            <div class="row col-md-12 form-error">
                                <span><?php echo $_SESSION['form_error']; ?></span>
                            </div>
                            <?php unset($_SESSION['form_error']);
                            } ?>
                            <?php if(!empty($_SESSION['form_success'])) { ?>
                            <div class="row col-md-12 form-success">
                                <span><?php echo $_SESSION['form_success']; ?></span>
                            </div>
                            <?php unset($_SESSION['form_success']);
                            } ?>
                            <form id='journal_submit_form' method="POST" action="journal_submit.php"
                                enctype="multipart/form-data">
                                <input type="hidden" name='student_submit_profile_id'
                                    value="<?php echo $user_details[0]->user_id; ?>" />
                                <input type="hidden" name='journal_submit' value="db-institutionprofile.php" />
                                <div class="row" id="resub_sub">
                                    <div class="form-group col-md-6" id="resub_sub" style="width: 50%;">
                                        <select name="subject" id='journal_subject' name="journal_subject"
                                            class="form-control">
                                            <option value="--" selected>-- Select Subject --</option>
                                            <option value="Agriculture" selected>Agriculture</option>
                                            <option value="Horticulture">Horticulture</option>
                                            <option value="Agriculture Engineering">Agriculture Engineering</option>
                                            <option value="Foof Science">Food Science</option>
                                            <option value="Sericulture">Sericulture</option>
                                        </select>
                                        <span class="validation-error" id="journal_subject-error"></span>
                                    </div>
                                    <div class="form-group col-md-6" id="resub_artticle" style="width: 50%;">
                                        <select name="journal_type" id='journal_type' name="journal_type"
                                            class="form-control">
                                            <option value="--" selected>-- Select Article Type --</option>
                                            <option value="Original Research" selected>Original Research</option>
                                            <option value="Review Article">Review Article</option>
                                            <option value="Conference Paper">Conference Paper</option>
                                        </select>
                                        <span class="validation-error" id="journal_type-error"></span>
                                    </div>
                                </div>
                                <div class="row" id="resub_title">
                                    <div class="form-group col-md-12">
                                        <input type="text" id="journal_title" name="journal_title"
                                            value="asdasdasdasdasd" placeholder="Title" class="validate form-control">
                                        <span class="validation-error" id="journal_title-error"></span>
                                    </div>
                                </div>
                                <div class="row" id="resub_title">
                                    <div class="form-group col-md-12">
                                        <input type="text" id="journal_author" name="journal_author"
                                            value="asdasdasdasd" placeholder="All Author Names"
                                            class="validate form-control">
                                        <span class="validation-error" id="journal_author-error"></span>
                                    </div>
                                </div>
                                <div class="row" id="resub_title">
                                    <div class="form-group col-md-12">
                                        <input type="text" id="affiliation" name="affiliation" value="asdasdasdasdasd"
                                            placeholder="Affiliation Details" class="validate form-control">
                                        <span class="validation-error" id="affiliation-error"></span>
                                    </div>
                                </div>
                                <div class="row" id="id4">
                                    <div class="col-md-6" style="width: 50%;">
                                        <h5>Journal File (Original):</h5>
                                        <div class="file-field input-field col-md-12" id="resub_file">
                                            <div class="col-md-12 admin-upload-btn">
                                                <input type="file"
                                                    style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;"
                                                    id="journal-file" name="journal-file">
                                            </div>
                                            <p>pdf,doc,docx only</p>
                                        </div>
                                        <span class="validation-error" id="journal-file-error"></span>
                                    </div>
                                    <div class="col-md-6" style="width: 50%;">
                                        <h5>Journal file without author info & affiliation :</h5>
                                        <div class="file-field input-field col-md-12" id="resub_file">
                                            <div class="col-md-12 admin-upload-btn">
                                                <input type="file"
                                                    style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;"
                                                    id="journal-file2" name="journal-file2">
                                            </div>
                                            <p>pdf,doc,docx only</p>
                                        </div>
                                        <span class="validation-error" id="journal-file2-error"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button style="color:white;float:right;" type="button" id="journal_submit"
                                            name="journal_submit_but" class="col-md-6 btn">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---------status bar----->
        <div class="tabcontent col-md-9" id="status_bar_stud">
            <div class="udb">
                <div class="udb-sec udb-prof">
                    <h4><img src="images/icon/db1.png" alt="" /> Status</h4>
                    <ol class="progtrckr" data-progtrckr-steps="5">
                        <li class="progtrckr-done">View Submission</li>
                        <li class="progtrckr-done">Quality Check</li>
                        <li class="progtrckr-done">Edit Submission</li>
                        <li class="progtrckr-todo">Delete Submission</li>
                        <li class="progtrckr-todo">Aprove Submission</li>
                    </ol>
                </div>
            </div>
        </div>
        <!----notification---->
        <div class="tabcontent col-md-9" id="notification_stud">
            <div class="udb">
                <div class="udb-sec udb-prof">
                    <h4><img src="images/icon/db1.png" alt="" /> Notification <span
                            id='notification_count'></span></span></h4>
                    <div class="detailBox">
                        <div class="titleBox">
                            <label>Notification Info</label>

                        </div>

                        <div class="actionBox">
                            <!--<ul class="commentList">
                                          <li>
                                            <div class="commenterImage">
                                              <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                <p class=""><a href=""><b>Chief Editor</b> Assigned to your Paper</a></p> <span class="date sub-text">on March 5th, 2014</span>
                            
                                            </div>
                                        </li>
                                        <li>
                                            <div class="commenterImage">
                                              <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                 <p class=""><a href=""><b>Associate  Editor</b> Command on your Paper</a></p> <span class="date sub-text">on March 5th, 2014</span>
                            
                                            </div>
                                        </li>
                                     
                                       
                                    </ul>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!--SECTION END-->


    <!--SECTION START-->
    <section>
        <div class="full-bot-book">
            <div class="container">
                <div class="row">
                    <div class="bot-book">
                        <div class="col-md-2 bb-img">
                            <img src="images/3.png" alt="">
                        </div>
                        <div class="col-md-7 bb-text">

                            <h3 style="color:#fff;"> Madras Agricultural Journal Vol.106(10-12) December, 2019 issue.
                            </h3>
                            <p>Original Research Articles related to
                            <div class="col-md-4 foot-tc-mar-t-o">
                                <ul>
                                    <li><i class="fa fa-angle-double-right"></i> Agriculture </li>
                                    <li><i class="fa fa-angle-double-right"></i> Forestry</li>
                                    <li><i class="fa fa-angle-double-right"></i> Agricultural Engineering</li>
                                    <li><i class="fa fa-angle-double-right"></i> Sericulture</li>
                                    <li><i class="fa fa-angle-double-right"></i> Agricultural Economics</li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <ul>
                                    <li><i class="fa fa-angle-double-right"></i> Food Processing</li>
                                    <li><i class="fa fa-angle-double-right"></i> Environmental Science</li>
                                    <li><i class="fa fa-angle-double-right"></i> Agricultural Extension</li>
                                    <li><i class="fa fa-angle-double-right"></i> Agri-Business Management</li>
                                    <li><i class="fa fa-angle-double-right"></i> Biotechnology</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul>
                                    <li><i class="fa fa-angle-double-right"></i> Home Science</li>
                                    <li><i class="fa fa-angle-double-right"></i> Agricultural Bioinformatics</li>
                                    <li><i class="fa fa-angle-double-right"></i> Horticulture</li>
                                    <li><i class="fa fa-angle-double-right"></i> Home Science</li>
                                </ul>
                            </div>

                            </p>
                        </div>
                        <!--<div class="col-md-3 bb-link">
                            <a href="">Submit Now</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->

    <!--HEADER SECTION-->
    <?php include 'footer.php';?>

    <!--Import jQuery before materialize.js-->
    <!-- <script src="js/main.min.js"></script> -->
    <!--    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script> -->
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dash_2_paper_btn").click(function() {
                $("#a-submit-paper").click();
            });
            $(".tablinks").click(function() {
                $("#stu-sidebar").css('height', $("#main-stu-container").css('height'));
            });
            $(".validation-error").prev().keyup(function() {
                $(this).next().hide();
                $(".form-error, .form-success").hide();
            });
            $(".validation-error").prev().change(function() {
                $(this).next().hide();
                $(".form-error, .form-success").hide();
                $(".validation-error").hide();
            });
            $("#journal-file").change(function() {
                $(".form-error, .form-success").hide();
                $(".validation-error").hide();
            });
            $("#journal-file2").change(function() {
                $(".form-error, .form-success").hide();
                $(".validation-error").hide();
            });
            $('#journal_submit').click(function(e) {
                $(".validation-error").empty().hide();
                var error = 0;
                //Title validation
                $title_regex = "[^.*$]{1,}";
                if (!$("#journal_title").val().match($title_regex)) {
                    $("#journal_title-error").html("Please enter journal title").show();
                    error = 1;
                }
                //Authors Validation
                $author_regex = "[^.*$]{1,}";
                if (!$("#journal_author").val().match($author_regex)) {
                    $("#journal_author-error").html("Please enter author names").show();
                    error = 1;
                }
                //Volume validation
                $journal_subject = "[^.*$]{3,}";
                if (!$("#journal_subject").val().match($journal_subject)) {
                    $("#journal_subject-error").html("Please choose Journal Subject").show();
                    error = 1;
                }
                //Affiliation validation
                $affiliation = "[^.*$]{1,}";
                if (!$("#affiliation").val().match($affiliation)) {
                    $("#affiliation-error").html("Please enter affiliation details").show();
                    error = 1;
                }
                //Issue Validation
                $journal_type = "[^.*$]{3,}";
                if (!$("#journal_type").val().match($journal_type)) {
                    $("#journal_type-error").html("Please choose journal type").show();
                    error = 1;
                }
                //File Validation
                $journal_file = "[^.*$]{1,}";
                if (!$("#journal-file").val().match($journal_file)) {
                    $("#journal-file-error").html("Please select a file").show();
                    error = 1;
                }
                $journal_file2 = "[^.*$]{1,}";
                if (!$("#journal-file2").val().match($journal_file2)) {
                    $("#journal-file2-error").html("Please select a file").show();
                    error = 1;
                }
                if (error == 1) {
                    e.preventDefault();
                    return false;
                } else {
                    $("#journal_submit_form").submit();
                }
            });
        });
    </script>

</body>


<!-- Mirrored from rn53themes.net/themes/demo/education-master/db-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Jun 2018 12:23:32 GMT -->

</html>