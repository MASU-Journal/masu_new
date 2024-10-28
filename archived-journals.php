<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
include 'db.php';
$journal_sql = "SELECT id,volume,issue FROM tbl_archive where status = '1' GROUP BY volume, issue ORDER BY id";
$journal_data = $db->query($journal_sql);
$publications = array();

$issue_order["Jan"] = 1;
$issue_order["Feb"] = 2;
$issue_order["Mar"] = 3;
$issue_order["Apr"] = 4;
$issue_order["May"] = 5;
$issue_order["Jun"] = 6;
$issue_order["Jul"] = 7;
$issue_order["Aug"] = 8;
$issue_order["Sep"] = 9;
$issue_order["Oct"] = 10;
$issue_order["Nov"] = 11;
$issue_order["Dec"] = 12;
foreach ($journal_data->rows as $index => $row) {
    $issue = explode("-", $row->issue);
    if (!empty($issue[0])) {
        $publications[$row->volume][$issue_order[$issue[0]]] = $row->issue;
        ksort($publications[$row->volume]);
    }
}

krsort($publications);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MADRAS AGRICULTURAL PUBLICATION</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MASU AGRICULTURAL JOURNAL - TamilNadu Agricultural University">
    <meta name="keyword"
        content="Madras Agricultural University,Agricultural Journal,MASU,Tamilnadu Agricultural University,Agriculture Unniversity,TNAU,MAJ,Publish Journal,Institution Journal,Student Publish ">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/masu_logo.jpg" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700"
        rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <style>
        p.groove {
            border-style: groove;
        }

        .archive-btn {
            background-color: #d90429 !important;
            color: #fff !important;
            border-radius: 20px !important;
        }
    </style>
</head>

<body style="background-color:#fff;">

    <?php include 'header.php'; ?>
    <section>
        <div class="head-2">
            <div class="container">
                <div class="head-2-inn">
                    <h1>PUBLICATION</h1>
                    <!--<p>Fusce id sem at ligula laoreet hendrerit venenatis sed purus. Ut pellentesque maximus lacus, nec pharetra augue.</p>-->
                    <!--<div class="event-head-sub">
                        <ul>
                            <li>Date: 07,Jan 2017</li>
                            <li>Time: 09:15 am – 5:00 pm</li>
                            <li>Location: Illunois</li>
                        </ul>
                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <!--SECTION START-->
    <section>
        <div class="container pad-bot-70">
            <div class="row">
                <div class="cor about-sp">
                    <div class="s18-age-event l-info-pack-days">
                        <ul>
                            <li>
                                <div class="s17-eve-time">
                                    <div class="s17-eve-time-tim">
                                        <span style="font-size: 18px;"><b>YEARS</b></span>
                                    </div>
                                    <div class="s17-eve-time-msg">
                                        <h4>ISSUES</h4>
                                    </div>
                                </div>
                            </li>
                            <?php foreach ($publications as $volume => $issues) {
                                ?>
                            <li>
                                <div class="age-eve-com age-eve-1">
                                    <img src="images/icon/awa/2.png" alt="">
                                </div>
                                <div class="s17-eve-time">
                                    <div class="s17-eve-time-tim">
                                        <?php $volume_year = DEFAULT_VOLUME_YEAR + ($volume - DEFAULT_VOLUME); ?>
                                        <span><?php echo $volume_year; ?></span>
                                    </div>
                                    <div class="s17-eve-time-msg">
                                        <?php foreach ($issues as $index => $issue) {
                                            ?>
                                        <div class="event-head-sub">
                                            <ul>
                                                <li><a
                                                        href="archive-issue.php?volume=<?php echo $volume; ?>&issue=<?php echo $issue; ?>"><?php echo $issue; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
?>
                        </ul>
                    </div>
                    <div class="ed-about-sec1">
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->


    <!--SECTION START-->

    <!--SECTION END-->

    <?php include 'footer.php'; ?>

    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
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
    </script>
</body>

</html>