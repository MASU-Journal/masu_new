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
$journal_sql = "SELECT id,title,authors,volume,issue,file,keywords,abstract,doi,created_at FROM tbl_publication where status = '1' AND id = '$id'";
$journal_data = $db->query($journal_sql);
// echo "<pre>";
// print_r($journal_data);
// exit;
$journal_data = $journal_data->row;
$keywords = array();
$keywords = explode(",", $journal_data->keywords);
$authors_array = array();
$authors_array = explode(",", $journal_data->authors);
$code_url = APP_URL . 'view_journal.php?id=' . $id;
$file_url = APP_URL . $journal_data->volume . '/' . $journal_data->file;
$html_url = APP_URL . 'store_file/html/' . str_replace('.pdf', '', $journal_data->file).'.html';
$volume = $journal_data->volume;
$volume_year = DEFAULT_VOLUME_YEAR + ($volume - DEFAULT_VOLUME);
$issue = $journal_data->issue;
$abstract = $journal_data->abstract;
$doi = $journal_data->doi;
$title = $journal_data->title;
$authors = $journal_data->authors;
$created_at = date("F d, Y", strtotime($journal_data->created_at));
$created_year = date("Y", strtotime($journal_data->created_at));
$is = strtolower($issue);
if ($is == 'march') {
    $issue_detail = $is . '(1-3)';
} elseif ($is == 'june') {
    $issue_detail = $is . '(4-6)';
} elseif ($is == 'september') {
    $issue_detail = $is . '(7-9)';
} elseif ($is == 'december') {
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
    <title><?php echo $title; ?></title>
    <!-- META TAGS -->
    <meta property="og:url" name="url"
        content="<?php echo $code_url; ?>" />
    <meta name="citation_volume" content="<?php echo $volume; ?>" />
    <meta name="citation_Issue"
        content="<?php echo $issue_detail; ?>" />
    <meta name="citation_journal_title" content="Madras Agricultural Journal" />
    <meta name="citation_publisher" content="Madras Agricultural Students' Union" />
    <meta name="citation_journal_abbrev" content="Madras.Agric.J" />
    <meta name="citation_issn" content="0024-9602" />
    <meta name="citation_eissn" content="<?php echo EISSN; ?>" />
    <meta name="citation_doi" content="<?php echo $doi; ?>" />
    <meta name="citation_pages" content="1" />
    <meta name="citation_language" content="English" />
    <meta name="citation_title" content="<?php echo $title; ?>" />
    <meta name="citation_keywords"
        content="<?php echo $journal_data->keywords; ?>" />
    <meta name="citation_abstract"
        content="<?php echo $abstract; ?>" />
    <meta name="description" content="<?php echo $abstract; ?>" />
    <meta name="citation_online_date"
        content="<?php echo $created_at; ?>" />
    <meta name="citation_date"
        content="<?php echo $created_year; ?>" />
    <meta name="citation_publication_date"
        content="<?php echo $created_at; ?>" />
    <meta name="citation_pdf_url"
        content="<?php echo $file_url; ?>" />
    <?php foreach ($authors_array as $key => $value) {
        ?>
    <meta name="citation_author" content="<?php echo $value; ?>" />
    <?php
    }
?>
    <meta name="Keywords"
        content="<?php echo $journal_data->keywords; ?>" />
    <meta name="dc.identifier" content="<?php echo $doi; ?>">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">

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
                            <h2><span><?php echo ucfirst($issue_detail) . "  " . $volume_year; ?></span>
                            </h2>
                        </div>
                        <div class="title">
                            <a href="" align="left"> </a>
                            <h2 style="line-height:50px;" align="left">
                                <?php echo $title; ?>
                            </h2>
                        </div>
                        <div>
                            <div class="ho-event pg-eve-main">
                                <ul>
                                    <li>
                                        <div class="ho-ev-link pg-eve-desc">
                                            <p><b>Author</b>:<?php echo $authors; ?>
                                            </p>
                                            <!-- <span><a style="color:#0077b6;" href="<?php echo $doi; ?>"><?php echo $doi; ?></a></span>
                                            -->
                                            <span><?php echo $doi; ?></span>
                                            <div data-badge-popover="right" data-badge-type="1"
                                                data-doi="<?php echo $doi; ?>"
                                                class="altmetric-embed"></div>
                                        </div>
                                        <div class="pg-eve-reg">
                                            <a href="<?php echo $file_url; ?>"
                                                target="_blank">Download</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3>Abstract</h3>
                        <p align="justify"> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $abstract; ?>
                        </p>
                        <div id="journal-content"></div>
                        <p>
                            <b>Key words : </b>
                            <?php echo $journal_data->keywords; ?>
                        </p>
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
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?php echo $html_url; ?>",
                type: 'GET',
                success: function(response) {
                    $('#journal-content').html(response);
                }
            });
        });
    </script>
</body>

</html>