<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
include 'db.php';
include 'conf.php';
if (empty($_GET['id'])) {
    echo "Invalid Request";
    exit;
}
$id = trim($_GET['id']);
//$volume_year = DEFAULT_VOLUME_YEAR + ($volume - DEFAULT_VOLUME);
$journal_sql = "SELECT id,title,authors,volume,issue,file,keywords,abstract,doi FROM tbl_archive where status = '1' AND id = '$id'";
$journal_data = $db->query($journal_sql);
// echo "<pre>";
// print_r($journal_data);
// exit;
$journal_data = $journal_data->row;
$keywords = array();
$keywords = explode(",", $journal_data->keywords);
$authors_array = array();
$authors_array = explode(",", $journal_data->authors);
$code_url = APP_URL . 'view_archive_journal.php?id=' . $id;
$file_url = APP_URL . 'store_file/archive/' . $journal_data->file;
$volume = $journal_data->volume;
$issue = $journal_data->issue;
$abstract = $journal_data->abstract;
$doi = $journal_data->doi;
$title = $journal_data->title;
$authors = $journal_data->authors;
$is = strtolower($issue);
if ($is == 'march') {
    $issue_detail = $is . '(1-3)';
} else if ($is == 'june') {
    $issue_detail = $is . '(4-6)';
} else if ($is == 'september') {
    $issue_detail = $is . '(7-9)';
} else if ($is == 'december') {
    $issue_detail = $is . '(10-12)';
} else {
    $issue_detail = $is;
}
// $publications = array();
// foreach($journal_data->rows as $row){
//     $publications[$row->volume][] = $row->issue; 
// }
// krsort($publications);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to MASU</title>
    <!-- META TAGS -->
    <meta property="og:url" name="url" content="<?php echo $code_url; ?>" />
    <meta name="citation_volume" content="<?php echo $volume; ?>" />
    <meta name="citation_Issue" content="<?php echo $issue_detail; ?>" />
    <meta name="citation_journal_title" content="Madras Agricultural Journal" />
    <meta name="citation_publisher" content="Madras Agricultural Students' Union" />
    <meta name="citation_journal_abbrev" content="Madras.Agric.J" />
    <meta name="citation_issn" content="0024-9602" />
    <meta name="citation_eissn" content="<?php echo EISSN; ?>" />
    <meta name="citation_doi" content="<?php echo $doi; ?>" />
    <meta name="citation_pages" content="1" />
    <meta name="citation_language" content="English" />
    <meta name="citation_title" content="<?php echo $title; ?>" />
    <meta name="citation_keywords" content="<?php echo $journal_data->keywords; ?>" />
    <meta name="citation_abstract" content="<?php echo $abstract; ?>" />
    <meta name="description" content="<?php echo $abstract; ?>" />
    <!-- <meta name="citation_online_date" content=" March 25, 2018 " />
<meta name="citation_date" content="2018" />
<meta name="citation_publication_date" content=" March 25, 2018 " /> -->
    <meta name="citation_pdf_url" content="<?php echo $file_url; ?>" />
    <?php foreach ($authors_array as $key => $value) {
    ?>
        <meta name="citation_author" content="<?php echo $value; ?>" />
    <?php
    }
    ?>
    <!-- <meta name="citation_author" content=" R. Vijay* " /> -->
    <!-- <meta name="citation_author_institution" content="Tamil Nadu Agricultural University  " /> -->
    <!-- <meta name="citation_author_email" content=" vijayaruna24@yahoo.com  " /> -->
    <!-- <meta name="citation_author" content="  V. Ravichandran " /> -->
    <!-- <meta name="citation_author_institution" content="  Tamil Nadu Agricultural University" /> -->

    <!-- <meta name="citation_author_institution" content=" Tamil Nadu Agricultural University  "  -->
    <meta name="Keywords" content="<?php echo $journal_data->keywords; ?>" />
    <meta name="dc.identifier" content=" 10.29321/MAJ.2018.000091 ">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />

</head>

<body>

    <?php include 'header.php'; ?>
    <!--END HEADER SECTION-->

    <section style="background-color: #FFFFFF; ">
        <div class="container com-sp">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
                        <div class="con-title">
                            <a href="" align="left"> </a>
                            <h2 align="left"><?php echo $title; ?></h2>

                        </div>
                        <div>
                            <div class="ho-event pg-eve-main">
                                <ul>
                                    <li>
                                        <div class="ho-ev-link pg-eve-desc">
                                            <!-- <a href="#.html">
                                                <h4 style="font-size: 16px"> </h4>
                                            </a>-->
                                            <p><b>Author</b>:<?php echo $authors; ?></p>
                                            <p><B>p-ISSN</B>:<?php echo ISSN; ?>, <B>e-ISSN</B>:<?php echo EISSN; ?>, <B>Vol</B>:<?php echo $volume; ?>,<B> Issue</B>:<?php echo $issue_detail; ?></p>
                                            <span><b>DOI</b>: <?php echo $doi;?></span>
                                            <div data-badge-popover="right" data-badge-type="1" data-doi="10.29321/MAJ.2018.000213" class="altmetric-embed"></div>
                                        </div>
                                        <div class="pg-eve-reg">
                                            <a href="<?php echo $file_url; ?>" target="_blank">Download</a>
                                            <!--<a href="event-details.html">Read more</a>-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3>Abstract</h3>
                        <p align="justify"> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $abstract; ?></p>
                        <p><b>Key words : </b><?php echo $journal_data->keywords; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER COURSE BOOKING -->
    <?php include 'footer.php'; ?>
    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>