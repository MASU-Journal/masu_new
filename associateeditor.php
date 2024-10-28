<?php 
include 'connection.php';
include 'db.php';
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);
//$_SESSION['journal_submission_msg']=array();

$role_id=$_SESSION['role_id'];  
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
$sql="SELECT * FROM  tbl_admin where admin_id=".$user_id;
$user_data=$db->query($sql);
$user_details=$user_data->rows;
$journal_sql="SELECT * FROM  tbl_journal_assign as tja,tbl_journal as tj where tja.is_deleted=0 AND tj.is_deleted=0 AND tj.journal_id=tja.journal_id  AND tja.admin_id=".$user_id." ORDER BY tj.journal_id DESC";
$journal_data=$db->query($journal_sql);
$author_details_qry="SELECT * FROM tbl_author where is_deleted=0";
$author_data=$db->query($author_details_qry); 
/*echo '<pre>';
print_r($journal_data);
echo '</pre>';
die;*/
$journal_total_detail_array=[];
(object)$journal_total_detail_obj = "";
foreach($journal_data->rows as $key=>$val){
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
	<style>
	.col-xs-6 {
    width: 16% ! important;
}
	  .commentList {
        max-height: unset;
       }
	   #notificationsBody {
     padding: 0px !important; 
     }
    </style>
	
</head>
<body>
    <!--== MAIN CONTRAINER ==-->
    <?php include 'header1.php';?>
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
                            <h5>Associate Editor <span><?php echo  $user_ins_name; ?></span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a href="" class="menu-active"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard</a>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-book" aria-hidden="true"></i> All Journals</a>
                            <div class="collapsible-body left-sub-menu">
                               <ul>
                                    <li> <a >Under Correction</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="">All Users</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!--== BODY INNER CONTAINER ==-->
            <div class="sb2-2">
                <!--== breadcrumbs ==-->
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#"> Dashboard</a>
                        </li>
                        <li class="page-back"><a href="index.php"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                        </li>
                    </ul>
                </div>

                <!--== User Details ==-->
                <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-inn-sp"  >
                                <div class="inn-title">
                                    <h4>New Journals Details</h4>
                                    <p>All about courses, program structure, fees, best course lists (ranking), syllabus, teaching techniques and other details.</p>
                                </div>
                                <div class="tab-inn">
                                    <div class="table-responsive table-desi">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
												    <th>Title</th>
													<th>Cmd</th>
                                                    <th>Send</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php if(count($journal_total_detail_array)> 0) { foreach($journal_total_detail_array as $key=>$val) { ?>
                                                <tr>
                                                    <td><?php echo $val[0]->title ?></td>
                                                    <td> 
													   <a href="" />Command</a></td>
                                                    </td>
													<td><a href="" class="ad-st-view">Download</a></td>
                                                </tr>
												<?php }  } else { ?>
                                                <tr>
                                                    <td>There is No Journals Assign for You</td>
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
            </div>

        </div>
    </div>

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