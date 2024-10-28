<?php
include 'connection.php';
include 'db.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
//$_SESSION['journal_submission_msg']=array();

$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
$sql="SELECT * FROM  tbl_admin where admin_id=".$user_id;
$user_data=$db->query($sql);
$user_details=$user_data->rows;
$journal_sql="SELECT * FROM  tbl_journal where is_deleted=0 ORDER BY journal_id DESC";
$journal_data=$db->query($journal_sql);
$author_details_qry="SELECT * FROM tbl_author where is_deleted=0";
$author_data=$db->query($author_details_qry);

$journal_total_detail_array=[];
(object)$journal_total_detail_obj = "";
foreach($journal_data->rows as $key=>$val) {
    $journal_total_detail_obj[$key]=$val;
    $journal_detail_sql="SELECT * FROM  tbl_journal_details where journal_id=".$val->journal_id;
    $journal_detail_data_qry=$db->query($journal_detail_sql);
    $journal_total_detail_array[$key]=$journal_detail_data_qry->rows;
    $journal_total_detail_array[$key][]=$journal_total_detail_obj[$key];
    $journal_author_sql="SELECT ta.author_name,tja.* FROM tbl_author as ta,tbl_journal_author as tja  where  ta.author_id=tja.author_id AND tja.journal_id=".$val->journal_id." AND tja.user_id=".$val->user_id;
    $journal_author_data_qry=$db->query($journal_author_sql);
    $journal_total_detail_array[$key][]=$journal_author_data_qry->rows;
    $correction_level=$val->correction_level+1;
    $journal_assigners_qry="SELECT * FROM tbl_admin where is_deleted=0";
    $journal_assigners_details=$db->query($journal_assigners_qry);
    $journal_total_detail_array[$key][]=$journal_assigners_details->rows;
}
/*echo '<pre>';
print_r($journal_total_detail_array);
echo '</pre>';
die;*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to masujournal</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/slider/ic.jpg" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700"
        rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            width: 400px;
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
        .tabcontent {}

        .tablinks {
            font-size: 16px;
            width: 74px;
            ;
        }

        #notificationsBody {
            padding: 0px !important;
        }

        .commentList {
            max-height: unset;
        }

        #notification_count {
            margin-left: 0px;
        }
    </style>
</head>

<body>
    <!--== MAIN CONTRAINER ==-->
    <div class="container-fluid sb1">
        <div class="row">
            <!--== LOGO ==-->
            <div class="col-md-2 col-sm-3 col-xs-6 sb1-1">
                <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
                <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
                <a href="index.php" class="logo"><img src="images/logo.png" alt="" />
                </a>
            </div>
            <!--== SEARCH ==-->
            <div class="col-md-6 col-sm-6 mob-hide">
                <form class="app-search">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href="#"><i class="fa fa-search"></i></a>
                </form>
            </div>
            <!--== NOTIFICATION ==-->
            <div class="col-md-2 tab-hide">
                <div class="top-not-cen" id="notification_li">
                    <a class='waves-effect btn-noti' href="#" id="notificationLink" title="all enquiry messages"><i
                            class="fa fa-commenting-o" aria-hidden="true"></i><span id="notification_count"></span> </a>
                    <div id="notificationContainer">
                        <div id="notificationTitle">Notifications</div>
                        <div id="notificationsBody" class="notifications">
                            <div class="container">
                                <div class="actionBox">
                                    <input type="hidden"
                                        value="<?php echo $role_id;  ?>"
                                        id="role_id" />
                                    <ul id="chief_command_notifications" class="commentList">
                                        <li>
                                            <div class="commenterImage">
                                                <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                <p class=""><b>chief editor</b> command on ur journal</p> <span
                                                    class="date sub-text">on March 5th, 2014</span>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="commenterImage">
                                                <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                <p class=""><b>chief editor</b> command on ur journal</p> <span
                                                    class="date sub-text">on March 5th, 2014</span>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="commenterImage">
                                                <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                <p><b>chief editor</b> command on ur journal</p> <span
                                                    class="date sub-text">on March 5th, 2014</span>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="notificationFooter"><a href="#">See All</a></div>
                    </div>
                </div>
            </div>
            <!--== MY ACCCOUNT ==-->
            <div class="col-md-2 col-sm-3 col-xs-6">
                <!-- Dropdown Trigger -->
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img
                        src="images/user/6.png" alt="" />My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>

                <!-- Dropdown Structure -->
                <ul id='top-menu' class='dropdown-content top-menu-sty'>
                    <li><a href="admin-panel-setting.html" class="waves-effect"><i class="fa fa-cogs"
                                aria-hidden="true"></i>Admin Setting</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#" id='sign_out' class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in"
                                aria-hidden="true"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><img src="images/placeholder.jpg" alt="">
                        </li>
                        <li>
                            <h5>Chief Editor <span> Santa Ana, CA</span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a href="admin.html" class="menu-active"><i class="fa fa-bar-chart" aria-hidden="true"></i>
                                Dashboard</a>
                        </li>

                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-book"
                                    aria-hidden="true"></i> All Journals</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a data-toggle="tab" href="#newjournal">New Journal</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#undercorrection">Under Correction</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#correctedart">Corrected Article</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#publishedart">Published Article</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user"
                                    aria-hidden="true"></i> Users</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="">All Users</a>
                                    </li>
                                    <li><a href="">Add New user</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2 tab-content">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#"> Dashboard</a>
                        </li>
                        <li class="page-back"><a href="index.php"><i class="fa fa-backward" aria-hidden="true"></i>
                                Back</a>
                        </li>
                    </ul>
                </div>
                <?php if(!empty($_SESSION['journal_assign_msg'])) {
                    foreach($_SESSION['journal_assign_msg'] as $key=>$val) { ?>
                <div class="alert alert-success" id="success-alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong><?php echo $val; ?></strong>
                </div>
                <?php }
                    } $_SESSION['journal_assign_msg']=array();?>
                <!--== User Details ==-->
                <div class="sb2-2-3 tab-pane fade in active" id="newjournal">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>New Journals Details</h4>
                                    <p>All about courses, program structure, fees, best course lists (ranking),
                                        syllabus, teaching techniques and other details.</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
                                                    <th>Title</th>

                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $new_journal_count=0;
foreach($journal_total_detail_array as $key=>$val) {
    if(($val[1]->correction_level==0) && ($val[1]->is_published==0)) {
        $new_journal_count=1;?>
                                                <tr>
                                                    <td><a data-toggle="model" id="" data-target="#profileinfo"><span
                                                                class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span
                                                                class="list-enq-city"><?php
            $lastElement = end($val[2]);
        foreach($val[2] as $autkey=>$authval) {
            if($authval==$lastElement) {
                echo $authval->author_name.'.';
            } else {
                echo $authval->author_name.',';
            }
        } ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?>
                                                    </td>

                                                    <form
                                                        id="journal_assign_form<?php echo $val[0]->journal_id; ?>"
                                                        name='journal_assign_form<?php echo $val[0]->journal_id; ?>'
                                                        method="POST" action="backend.php">
                                                        <td>
                                                            <a href="#"
                                                                data-target="#journal<?php echo $val[0]->journal_id; ?>"
                                                                data-toggle="modal">Sendeditor</a>
                                                            <input type='hidden' id='journal_id'
                                                                name='assign_journal_id'
                                                                value="<?php echo $val[0]->journal_id; ?>" />
                                                            <input type='hidden' id='journal_user_id'
                                                                name='journal_user_id'
                                                                value="<?php echo $val[0]->user_id; ?>" />
                                                            <input type='hidden' id='redirect_url' name='redirect_url'
                                                                value="chiefeditor.php" />
                                                            <input type='hidden' id='correction_level'
                                                                name='correction_level'
                                                                value="<?php echo $val[1]->correction_level; ?>" />
                                                            <input type='hidden' id='correction_level'
                                                                name='status_level'
                                                                value="<?php echo $val[1]->status_id; ?>" />

                                                        </td>
                                                        <td><a class="assign-submit ad-st-view"
                                                                href="javascript:void(0);"
                                                                value="<?php echo $val[0]->journal_id; ?>">Assign</a>
                                                        </td>
                                                        <td><a href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'
                                                                class="view_comments ad-st-view">ViewComments</a></td>

                                                </tr>
                                                <div class="container">
                                                    <div class="modal fade"
                                                        id="journal<?php echo $val[0]->journal_id; ?>">
                                                        <div class="modal-dialog" style="top:128px" ;>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="tab">
                                                                        <div class="tab">
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'associate<?php echo $val[0]->journal_id; ?>')">Associate</button>
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'technical<?php echo $val[0]->journal_id; ?>')">Technical</button>

                                                                            <button type='button' class="tablinks"
                                                                                onclick="openCity(event, 'referee<?php echo $val[0]->journal_id; ?>')">Referee</button>
                                                                            <button type='button' class="tablinks"
                                                                                onclick="openCity(event, 'author')">Author</button>
                                                                        </div>
                                                                    </div>
                                                                    <input type='hidden' id='this_journal_id'
                                                                        value="<?php echo $val[0]->journal_id; ?>" />
                                                                    <div id="associate<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"
                                                                            class='form-control assigned_select<?php echo $val[0]->journal_id; ?>'
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==1) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="technical<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==2) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="referee<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==3) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="author" class="tabcontent">
                                                                        <select class="form-control assigned_select"
                                                                            multiple="multiple">
                                                                            <option value="">Author1</option>
                                                                            <option value="">Author1</option>
                                                                            <option value="">Author1</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
    } if($new_journal_count==0) { ?>
                                                <tr>
                                                    <td colspan="3">There is No New Journals</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!----under correction--->
                <div class="sb2-2-3 tab-pane fade" id="undercorrection">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Under Correction</h4>
                                    <p>All about courses, program structure, fees, best course lists (ranking),
                                        syllabus, teaching techniques and other details.</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
                                                    <th>Title</th>

                                                    <th>View Comments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $under_correction_count=0;
foreach($journal_total_detail_array as $key=>$val) {
    if(($val[1]->correction_level > 0) && ($val[1]->is_published==0)) {
        $under_correction_count=1;?>
                                                <tr>
                                                    <td><a data-toggle="model" id=""
                                                            data-target="#profileinfosend"><span
                                                                class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span
                                                                class="list-enq-city"><?php
            $lastElement = end($val[2]);
        foreach($val[2] as $autkey=>$authval) {
            if($authval==$lastElement) {
                echo $authval->author_name.'.';
            } else {
                echo $authval->author_name.',';
            }
        } ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?>
                                                    </td>

                                                    <form
                                                        id="journal_assign_form<?php echo $val[0]->journal_id; ?>"
                                                        name='journal_assign_form<?php echo $val[0]->journal_id; ?>'
                                                        method="POST" action="backend.php">


                                                        <td><a href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'
                                                                class="view_comments ad-st-view">ViewComments</a></td>

                                                </tr>
                                                <div class="container">
                                                    <div class="modal fade"
                                                        id="profileinfosend<?php echo $val[0]->journal_id; ?>">
                                                        <div class="modal-dialog" style="top:128px" ;>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="tab">
                                                                        <div class="tab">
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'associateuc<?php echo $val[0]->journal_id; ?>')">Associate</button>
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'technicaluc<?php echo $val[0]->journal_id; ?>')">Technical</button>

                                                                            <button type='button' class="tablinks"
                                                                                onclick="openCity(event, 'refereeuc<?php echo $val[0]->journal_id; ?>')">Referee</button>
                                                                        </div>
                                                                    </div>
                                                                    <input type='hidden' id='this_journal_id'
                                                                        value="<?php echo $val[0]->journal_id; ?>" />
                                                                    <div id="associateuc<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"
                                                                            class='form-control assigned_select<?php echo $val[0]->journal_id; ?>'
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==1) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="technicaluc<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==2) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="refereeuc<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==3) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
    } if($under_correction_count==0) { ?>
                                                <tr>
                                                    <td colspan="3">There is No Journals in Under Correction</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!----end uc--->
                <!----Reviewer-->
                <div class="sb2-2-3 tab-pane fade" id="correctedart">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Corrected Article</h4>
                                    <p>All about courses, program structure, fees, best course lists (ranking),
                                        syllabus, teaching techniques and other details.</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                    <th>Comments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $re_correction_count=0;
foreach($journal_total_detail_array as $key=>$val) {
    if(($val[1]->review_level > 0) && ($val[1]->is_published==0) && ($val[1]->correction_level==0)) {
        $re_correction_count=1; ?>
                                                <tr>
                                                    <td><a data-toggle="model" id="" data-target="#profileinfo"><span
                                                                class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span
                                                                class="list-enq-city"><?php
            $lastElement = end($val[2]);
        foreach($val[2] as $autkey=>$authval) {
            if($authval==$lastElement) {
                echo $authval->author_name.'.';
            } else {
                echo $authval->author_name.',';
            }
        } ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?>
                                                    </td>

                                                    <form
                                                        id="journal_assign_form<?php echo $val[0]->journal_id; ?>"
                                                        name='journal_assign_form<?php echo $val[0]->journal_id; ?>'
                                                        method="POST" action="backend.php">
                                                        <td>
                                                            <a href="#"
                                                                data-target="#correctedartsend<?php echo $val[0]->journal_id; ?>"
                                                                data-toggle="modal">Sendeditor</a>
                                                            <input type='hidden' id='journal_id'
                                                                name='assign_journal_id'
                                                                value="<?php echo $val[0]->journal_id; ?>" />
                                                            <input type='hidden' id='journal_user_id'
                                                                name='journal_user_id'
                                                                value="<?php echo $val[0]->user_id; ?>" />
                                                            <input type='hidden' id='redirect_url' name='redirect_url'
                                                                value="chiefeditor.php" />
                                                            <input type='hidden' id='correction_level'
                                                                name='correction_level'
                                                                value="<?php echo $val[1]->correction_level; ?>" />
                                                            <input type='hidden' id='correction_level'
                                                                name='status_level'
                                                                value="<?php echo $val[1]->status_id; ?>" />
                                                        </td>
                                                        <td><a href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'
                                                                class="view_comments ad-st-view">ViewComments</a></td>


                                                </tr>
                                                <div class="container">
                                                    <div class="modal fade"
                                                        id="correctedartsend<?php echo $val[0]->journal_id; ?>">
                                                        <div class="modal-dialog" style="top:128px" ;>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="tab">
                                                                        <div class="tab">
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'associatecrt<?php echo $val[0]->journal_id; ?>')">Associate</button>
                                                                            <button type="button" class="tablinks"
                                                                                onclick="openCity(event, 'technicalcrt<?php echo $val[0]->journal_id; ?>')">Technical</button>

                                                                            <button type='button' class="tablinks"
                                                                                onclick="openCity(event, 'refereecrt<?php echo $val[0]->journal_id; ?>')">Referee</button>
                                                                        </div>
                                                                    </div>
                                                                    <input type='hidden' id='this_journal_id'
                                                                        value="<?php echo $val[0]->journal_id; ?>" />
                                                                    <div id="associatecrt<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"
                                                                            class='form-control assigned_select<?php echo $val[0]->journal_id; ?>'
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==1) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="technicalcrt<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==2) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                    <div id="refereecrt<?php echo $val[0]->journal_id; ?>"
                                                                        class="tabcontent">
                                                                        <select
                                                                            name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]"
                                                                            id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree"
                                                                            class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"
                                                                            multiple="multiple">
                                                                            <option>Select</option>
                                                                            <?php foreach($val[3] as $adminkey=>$adminval) {
                                                                                if($adminval->admin_cat_id==3) {?>
                                                                            <option
                                                                                value="<?php echo $adminval->admin_id; ?>">
                                                                                <?php echo $adminval->admin_name; ?>
                                                                            </option>
                                                                            <?php }
                                                                                }?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }
    } if($re_correction_count==0) { ?>
                                                <tr>
                                                    <td colspan="4">There is No Corrected Journals</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-----end corrected article----->
                <!----published art--->
                <div class="sb2-2-3 tab-pane fade" id="publishedart">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp">
                                <div class="inn-title">
                                    <h4>Published Article</h4>
                                    <p>All about courses, program structure, fees, best course lists (ranking),
                                        syllabus, teaching techniques and other details.</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php if ($publish_count !==0) {
                                                    foreach($journal_total_detail_array as $key=>$val) {
                                                        if($val[1]->is_published==1) {
                                                            $publish_count==1;?>
                                                <tr>
                                                    <td><a data-toggle="model" id="" data-target="#profileinfo"><span
                                                                class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span
                                                                class="list-enq-city"><?php
                                                    $lastElement = end($val[2]);
                                                            foreach($val[2] as $autkey=>$authval) {
                                                                if($authval==$lastElement) {
                                                                    echo $authval->author_name.'.';
                                                                } else {
                                                                    echo $authval->author_name.',';
                                                                }
                                                            } ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?>
                                                    </td>

                                                    <form
                                                        id="journal_assign_form<?php echo $val[0]->journal_id; ?>"
                                                        name='journal_assign_form<?php echo $val[0]->journal_id; ?>'
                                                        method="POST" action="backend.php">
                                                        <td>
                                                            <a href="#"
                                                                data-target="#correctedartsend<?php echo $val[0]->journal_id; ?>"
                                                                data-toggle="modal">Sendeditor</a>
                                                            <input type='hidden' id='journal_id'
                                                                name='assign_journal_id'
                                                                value="<?php echo $val[0]->journal_id; ?>" />
                                                            <input type='hidden' id='journal_user_id'
                                                                name='journal_user_id'
                                                                value="<?php echo $val[0]->user_id; ?>" />
                                                            <input type='hidden' id='redirect_url' name='redirect_url'
                                                                value="chiefeditor.php" />
                                                            <input type='hidden' id='correction_level'
                                                                name='correction_level'
                                                                value="<?php echo $val[1]->correction_level; ?>" />
                                                            <input type='hidden' id='correction_level'
                                                                name='status_level'
                                                                value="<?php echo $val[1]->status_id; ?>" />
                                                        </td>
                                                        <td><a href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'
                                                                class="view_comments ad-st-view">ViewComments</a></td>
                                                        <td><a class="view_journal ad-st-view"
                                                                href="<?php echo 'journal_view.php?journal_view_id='.$val[0]->journal_id.'&'.'user_id='.$val[0]->user_id.'&'.'year='.$val[1]['w'].'&'.'journal_path='.$val[1]['journal_path']; ?>">View</a>
                                                        </td>

                                                </tr>

                                                <?php
                                                        }
                                                    }
                                                };
if($publish_count==0) { ?>
                                                <tr>
                                                    <td colspan="3">There is No Published Journals</td>
                                                </tr>
                                                <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!----end uc--->
        </div>

    </div>
    </div>
    <!----------select author---->
    <!----end select----->
    <div class="container">
        <div class="modal fade" id="profileinfo">
            <div class="modal-dialog" style="width:300px;">
                <div class="modal-content" style="margin-top: -53px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <p>Don't have an account? Create your account. It's take less then a minutes</p>
                    </div>

                    <div class="modal-header">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>
        /*var admins = [];
		
		var admin_obj = {};
		var correction_level=$("#correction_level").val();
		 $.ajax({
                type: 'post',
                url: 'do_login.php',
                data: {
                    correction_admins: "correction_admins_loader",
                    correct_level_id:parseInt(correction_level)+1,
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == "success") {
						console.log(response.result_data);
						admins = response.result_data;
							console.log(admins);	
							admin_loader();
                    } else {
                        alert(response.result);
                        return false;
                    }
                }
            });
			
        

        function admin_loader() {
			console.log(admins);
            $("#checkboxSelectCombo").igCombo({
                width: 300,
                dataSource: admins,
                textKey: "admin_name",
                valueKey: "admin_id",
                multiSelection: {
                    enabled: true,
                    showCheckboxes: true
                },
                dropDownOrientation: "bottom"
            });

        }*/
    </script>
</body>

</html>