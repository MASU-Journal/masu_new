<?php
if(!isset($_SESSION)) {
    session_start();
}
if(empty($_SESSION['role_id']) || $_SESSION['role_id'] != 4) {
    header("location:index.php");
}
if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] != 'yes') {
    header("location:index.php");
}
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
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
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

        .validation-error {
            color: red;
            font-weight: bold;
            font-size: 12px;
            display: none;
        }

        .form-error,
        .form-success {
            width: 100%;
            padding: 5px;
            background-color: #df3b57;
            text-align: center;
            text-decoration-style: solid;
        }

        .form-success {
            background-color: #009944 !important;
        }

        .form-error span,
        .form-success span {
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <section>
        <div class="pro-menu">
            <div class="container">
                <div class="col-md-9 col-md-offset-3">
                    <ul>
                        <li><a class="tablinks active" onclick="openCity(event, 'issues-tab')" id="defaultOpen">Add
                                Issues</a></li>
                        <li><a class="tablinks " onclick="openCity(event, 'pro_file_stud')">Manage Authors</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stu-db">
            <div class="container pg-inn">
                <div class="tabcontent col-md-12" id="issues-tab">
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
                                    <form id='journal_publish_form' method="POST" action="backend.php"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name='publish_journal_submit' value="aPanel.php" />
                                        <div class="row" id="resub_title">
                                            <h5>Journal Title:</h5>
                                            <div class="input-field col-12 formhide">
                                                <input type="text" id="journal-title" name="journal-title"
                                                    placeholder="Journal Title" class="col-md-12 validate" value="">
                                                <span class="validation-error" id="journal-title-error"></span>
                                            </div>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <h5>Authors Name:</h5>
                                            <div class="input-field col s12 formhide">
                                                <input type="text" id="authors-name" name="authors-name"
                                                    placeholder="Authors Name (separated by commas)"
                                                    class="col-md-12 validate" value="">
                                                <span class="validation-error" id="authors-name-error"></span>
                                            </div>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                                <h5>Volume:</h5>
                                                <select class="col-md-12" name="volume" id='volume'>
                                                    <?php
                                                        $yArray = ["2017" => "104"];
$current_year = '2018';
for($i=-1;$i<4;$i++) {
    $yr = $current_year + $i;
    $diff = $yr - 2017;
    $currentvol = $yArray["2017"] + $diff;
    $slct = ('2020' == $yr) ? 'selected' : '';
    ?>
                                                    <option
                                                        value="<?php echo $currentvol; ?>"
                                                        <?php echo $slct;?>
                                                        ><?php echo $currentvol; ?>
                                                    </option>
                                                    <?php
}
?>
                                                </select>
                                                <span class="validation-error" id="volume-error"></span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h5>Issue:</h5>
                                                <select class="col-md-12" name="issue" id='issue'>
                                                    <option value="March">1-3 [March]</option>
                                                    <option value="June">4-6 [June]</option>
                                                    <option value="September">7-9 [September]</option>
                                                    <option value="December">10-12 [December]</option>
                                                    <option value="Special">Special</option>
                                                </select>
                                                <span class="validation-error" id="issue-error"></span>
                                            </div>


                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <h5>DOI : </h5>
                                                <div class="input-field col-md-12">
                                                    <input type="text" id="doi" name="doi" placeholder="DOI"
                                                        class="col-md-12 validate" value="">
                                                    <span class="validation-error" id="doi-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h5>Start Page : </h5>
                                                <div class="input-field col-md-12">
                                                    <input type="text" id="page_start" name="page_start"
                                                        placeholder="Start" class="col-md-12 validate" value="">
                                                    <span class="validation-error" id="page_start-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h5>End Page : </h5>
                                                <div class="input-field col-md-12">
                                                    <input type="text" id="page_end" name="page_end" placeholder="End"
                                                        class="col-md-12 validate" value="">
                                                    <span class="validation-error" id="page_end-error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="abstract_row">
                                            <h5>Abstract:</h5>
                                            <textarea class="col-md-12" name="abstract" id="abstract"></textarea>
                                            <span class="validation-error" id="abstract-error"></span>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <h5>Keywords : </h5>
                                            <div class="input-field col-md-12 formhide">
                                                <input type="text" id="keywords" name="keywords"
                                                    placeholder="Keywords (separated by commas)"
                                                    class="col-md-12 validate" value="">
                                                <span class="validation-error" id="keywords-error"></span>
                                            </div>
                                        </div>
                                        <div class="row formhide" id="id4">
                                            <h5>Journal File:</h5>
                                            <div class="file-field input-field col-md-12" id="resub_file">
                                                <div class="col-md-12 admin-upload-btn">
                                                    <input type="file"
                                                        style="background-color: #d5eeff;width: 100%;padding: 8px;border: 1px dashed;"
                                                        id="journal-file" name="journal-file">
                                                    <span class="validation-error" id="journal-file-error"></span>
                                                </div>
                                                <p>Note:(doc,docs,pdf only Can upload )</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="waves-effect waves-light btn-large waves-input-wrapper"
                                                    style="width:100%;">
                                                    <input type="submit" id="publish_journal_submit_btn"
                                                        name="journal_submit_button" class="btn"
                                                        style="color:white;min-width:30%;background-color: #FF005B;width:100%;"></button></i>
                                            </div>
                                        </div>
                                    </form>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!----notification---->
                <div class="tabcontent col-md-9" id="notification_stud">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4>Notification<span id='notification_count'></span></span></h4>
                            <div class="detailBox">
                                <div class="titleBox">
                                    <label>Notification Info</label>
                                </div>
                                <div class="actionBox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->
    <!--HEADER SECTION-->
    <?php include 'footer.php';?>
    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
            $(".validation-error").prev().keyup(function() {
                $(this).next().hide();
                $(".form-error, .form-success").hide();
            });
            $("#journal-file").change(function() {
                $(".form-error, .form-success").hide();
            });
            $('#journal_publish_form').submit(function(e) {
                $(".validation-error").empty().hide();
                var error = 0;
                //Title validation
                $title_regex = "[^.*$]{5,}";
                if (!$("#journal-title").val().match($title_regex)) {
                    $("#journal-title-error").html("Journal title must contain atleast 5 characters")
                        .show();
                    error = 1;
                }
                //Authors Validation
                $author_regex = "[^.*$]{5,}";
                if (!$("#authors-name").val().match($author_regex)) {
                    $("#authors-name-error").html("Authors name must contain atleast 3 characters")
                        .show();
                    error = 1;
                }
                //Volume validation
                $volume_regex = "^[0-9]{3,5}$";
                if (!$("#volume").val().match($volume_regex)) {
                    $("#volume-error").html("Volume is numeric and must contain atleast 3 characters")
                        .show();
                    error = 1;
                }
                //Issue Validation
                $issue_regex = "[^.*$]{3,}";
                if (!$("#issue").val().match($issue_regex)) {
                    $("#issue-error").html("Issue must contain atleast 5 characters").show();
                    error = 1;
                }
                //Abstract Validation
                $abstract_regex = "[^.*$]{100,}";
                var abstract = $.trim($("#abstract").val());
                if (!abstract.match($abstract_regex)) {
                    $("#abstract-error").html("Abstract must contain atleast 100 characters").show();
                    error = 1;
                }
                //Keywords Validation
                // $keyword_regex = "^.{5,}$";
                // if(!$("#keywords").val().match($keyword_regex)) {
                //    $("#authors-name-error").html("Keywords must contain atleast 5 characters").show();
                //    error = 1;
                // }
                //File Validation
                //$file_regex = "";
                if (error == 1) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>

</html>