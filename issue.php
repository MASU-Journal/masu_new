<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';
include 'db.php';
include 'conf.php';
if(empty($_GET['volume']) || empty($_GET['issue'])){
    echo "Invalid Request";
    exit;
}
$volume = trim($_GET['volume']);
$issue = trim($_GET['issue']);
$volume_year = DEFAULT_VOLUME_YEAR + ($volume - DEFAULT_VOLUME);
$journal_sql="SELECT id,title,authors,volume,issue,file,doi FROM tbl_publication where status = '1' AND volume = '$volume' AND issue = '$issue' ORDER BY id";
$journal_data=$db->query($journal_sql);
include 'header.php';
$is = strtolower($issue);
if($is == 'march'){
    $issue_detail = $is.'(1-3)';
} else if($is == 'june'){
    $issue_detail = $is.'(4-6)';
} else if($is == 'september'){
    $issue_detail = $is.'(7-9)';
} else if($is == 'december'){
    $issue_detail = $is.'(10-12)';
} else {
    $issue_detail = $is;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type="text/css">
    .ho-ev-link > span {
        font-size : 14px !important;
    }
</style>
<link href="styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <!--SECTION START--> 
<section style="background-color : #FFFFFF;">
    <div class="container com-sp">
        <div class="row">
            <div class="cor about-sp">
                <div class="ed-about-tit">
                    <div class="con-title">
                        <h2><span><?php echo ucfirst($issue_detail)."  ".$volume_year; ?></span></h2>
                    </div>
                    <div>
                        <div class="ho-event pg-eve-main">
                            <ul>
                                <?php foreach($journal_data->rows as $row) { ?>
                                <li>
                                    <div class="ho-ev-link pg-eve-desc">
                                        <?php
                                            if($volume == '107' && $issue == 'March'){
                                                $page_url = "107/".pathinfo($row->file, PATHINFO_FILENAME).".php";
                                            } else {
                                                $page_url = "view_journal.php?id=".$row->id; 
                                            }
                                        ?>                                            
                                        <a href="<?php echo $page_url; ?>">
                                            <h4 style="font-size: 16px"><?php echo $row->title; ?></h4>
                                        </a>
                                        <span><b><?php echo $row->authors; ?></b></span>&nbsp &nbsp &nbsp <!-- <span><b>DOI</b>:2019; 10.29321/MAJ.2019.000310</span> -->
                                        <br>
                                        <span>Vol : <?php echo $row->volume; ?></span>&nbsp &nbsp &nbsp
                                        <span>Issue : <?php echo $row->issue; ?></span>&nbsp &nbsp &nbsp
                                        <span>
                                            <!-- <a style="color:#0077b6;" href="<?php echo $row->doi; ?>"><?php echo $row->doi; ?></a> -->
                                            <?php echo $row->doi; ?>
                                        </span>&nbsp &nbsp &nbsp
                                        <div class="hom-list-share">
                                            <ul>
                                                <li>
                                                    <a target="_blank" href="<?php echo APP_URL.$row->volume.'/'.$row->file; ?>"><i class="fa fa" aria-hidden="true"></i>Download
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $page_url; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href=https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=MasuJournal+Downloads&body=<?php echo APP_URL .$row->volume.'/'.$row->file; ?>&tf=1&pli=1';'+msgbody+><i class="fa fa-share-alt" aria-hidden="true"></i> Share
                                                    </a>
                                                </li>
                                                                 
                                            </ul>
                                          </div>
                                      </div>
                                        <div class="pg-eve-reg">
                                            <a href="<?php echo APP_URL.$row->volume.'/'.$row->file; ?>" target="_blank">Full Text</a>
                                            
                                        </div>
                                  </li>
                              <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!--SECTION END-->
<?php include 'footer.php';?>
</body>
</html>

