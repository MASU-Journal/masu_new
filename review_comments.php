<?php

include 'connection.php';
include 'db.php';
session_start();
error_reporting(E_ALL);

$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
$static_ques_qry="SELECT * FROM tbl_questions where is_deleted=0";
$static_ques_fetch=$db->query($static_ques_qry);
$static_ques_data=$static_ques_fetch->rows;
$journal_id=$_GET['journal_id'];

foreach($static_ques_data as $qkey=>$qval) {
    $ques_sql="SELECT DISTINCT tc.* FROM tbl_comments2 AS tc,tbl_questions as tq,tbl_journal AS tj WHERE tc.journal_id =".$journal_id." AND tj.journal_id = tc.journal_id AND (tc.admin_id=".$user_id." OR tc.admin_id=0) AND tq.question_id=tc.ques_id AND tc.ques_id=$qval->question_id ORDER BY tc.admin_id DESC";

    $ques_sql_fetch=$db->query($ques_sql);
    $ques_sql_fetch_data=$ques_sql_fetch->rows;
    $static_ques_data[$qkey]->answers=$ques_sql_fetch_data;
}
/*echo "<pre>";
print_r($static_ques_data);
echo "</pre>";
die;*/
if(isset($_POST['new_answer'])&& $_POST['new_answer']!="") {
    if(isset($role_id)&& $role_id!="") {
        $set_admin_id=$_POST['ques_command_user_id'];
    } else {
        $set_admin_id=0;
    }
    $ins_command_data=array(
    "comments"=>$_POST['new_answer'],
    "ques_id"=>$_POST['ques_id'],
    "admin_id"=>$set_admin_id,
    "journal_id"=>$_POST['ques_command_journal_id'],
    'created_date'=>date("Y-m-d H:i:s"),
    'modified_date'=>date("Y-m-d H:i:s")
    );
    $command_add_query = $db->insert('tbl_comments2', $ins_command_data);
    if($command_add_query!=0) {
        //header("Location:view_commands.php?view=journal_commentview&journal_id=".$journal_id"");
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
if(isset($_GET['view'])&& $_GET['view']="journal_commentview") {
    $journal_id=$_GET['journal_id'];
    $journal_sql="SELECT DISTINCT 
    ta.admin_name,tc.*
FROM
    tbl_comments AS tc,
    tbl_admin AS ta,
    tbl_journal AS tj
WHERE
    tc.journal_id = ".$journal_id."
        AND tj.journal_id = tc.journal_id
        AND tc.admin_id = ta.admin_id
ORDER BY tc.comment_id DESC";
    $comments_data_qry=$db->query($journal_sql);
    $comments_details=$comments_data_qry->rows;
    

}
if(isset($_POST['add_new_command']) && ($_POST['add_new_command']!="")) {
    //echo 'slsl';
    $ins_command_data=array(
    "comments"=>$_POST['comments'],
    "admin_id"=>$_POST['command_user_id'],
    "journal_id"=>$_POST['journal_id'],
    'created_date'=>date("Y-m-d"),
    'modified_date'=>date("Y-m-d")
    );
    $command_add_query = $db->insert('tbl_comments', $ins_command_data);
    if($command_add_query!=0) {
        //header("Location:view_commands.php?view=journal_commentview&journal_id=".$journal_id"");
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
if(isset($_POST['select_add_new_command']) && ($_POST['select_add_new_command']!="")) {
    //echo 'slsl';
    $comments="";
    if(isset($_POST['character'])&& $_POST['character']!="") {
        $comments.="Character:".$_POST['character']."/";
    }
    if(isset($_POST['paper'])&& $_POST['paper']!="") {
        $comments.="Paper:".$_POST['paper']."/";
    }
    if(isset($_POST['information'])&& $_POST['information']!="") {
        $comments.="Information:".$_POST['information']."/";
    }
    if(isset($_POST['methods'])&& $_POST['methods']!="") {
        $comments.="Methods:".$_POST['methods']."/";
        
    }if(isset($_POST['data'])&& $_POST['data']!="") {
        $comments.="Data:".$_POST['data']."/";
    }
    if(isset($_POST['statical'])&& $_POST['statical']!="") {
        $comments.="Statical Analysis:".$_POST['statical']."/";
    }
    if(isset($_POST['interpretation'])&& $_POST['interpretation']!="") {
        $comments.="Interpretation:".$_POST['interpretation']."/";
    }
    if(isset($_POST['title'])&& $_POST['title']!="") {
        $comments.="Title:".$_POST['title']."/";
    }
    if(isset($_POST['title'])&& $_POST['title']!="") {
        $comments.="Title:".$_POST['title']."/";
    }if(isset($_POST['abstract'])&& $_POST['abstract']!="") {
        $comments.="Abstract:".$_POST['abstract']."/";
    }if(isset($_POST['illustration'])&& $_POST['illustration']!="") {
        $comments.="Illustration:".$_POST['illustration']."/";
    }if(isset($_POST['tables'])&& $_POST['tables']!="") {
        $comments.="Tables:".$_POST['tables']."/";
    }if(isset($_POST['abbrevations'])&& $_POST['abbrevations']!="") {
        $comments.="Abbreviations,Formulae and Units:".$_POST['abbrevations']."/";
    }if(isset($_POST['reference'])&& $_POST['reference']!="") {
        $comments.="Reference:".$_POST['reference']."/";
    }if(isset($_POST['reference_style'])&& $_POST['reference_style']!="") {
        $comments.="Reference Style:".$_POST['reference_style']."/";
    }if(isset($_POST['approval'])&& $_POST['approval']!="") {
        $comments.="Approval:".$_POST['approval']."/";
    }if(isset($_POST['select_msg'])&& $_POST['select_msg']!="") {
        $comments.="Message:".$_POST['select_msg'].'.';
    }
    
    
    $ins_command_data=array(
    "comments"=>$comments,
    "admin_id"=>$user_id,
    "journal_id"=>$_POST['select_command_journal_id'],
    'created_date'=>date("Y-m-d"),
    'modified_date'=>date("Y-m-d"),
    'is_select_command'=>1
    );
    $command_add_query = $db->insert('tbl_comments', $ins_command_data);
    if($command_add_query!=0) {
        //header("Location:view_commands.php?view=journal_commentview&journal_id=".$journal_id"");
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

/*echo '<pre>';
    print_r($comments_details);
    echo '</pre>';*/
?>


<?php
   if(isset($_SESSION['admin_id'])&&$_SESSION['admin_id']!="") {
       include_once 'admin_headers.php'  ;
   } else {
       include_once 'header.php' ;
   }
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
			</div>
			<div class="pull-left info">
				<p style="color:#fff">Review Comments</p>
			</div>
		</div>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Info boxes -->
		<!--  <div class="row">		  
		  <div class="cointainer">
            <div class="col-md-11">
                <div class="detailBox">
                 <div class="titleBox" style="background-color: #462323;text-align:center">
					  <label style="color:white"><b>COMMENT BOX</b></label>
                 </div>
				<div class="col-md-9">
					<?php if(count($comments_details)>0) {
                        
					    foreach($comments_details as $key=>$val) {
					        if($val->is_select_command > 0) {
					            $myArray = explode('/', $val->comments);
					            ?>
		<div class="udb">
			<form id='student_edit_form' method="POST" action="backend.php">
				<input type="hidden" name='student_edit_profile_id'
					value="<?php  echo $user_details[0]->user_id; ?>" />
				<input type="hidden" name='edit_profile' value="db-profile.php" />
				<div class="udb-sec udb-prof">
					<h4><img src="images/icon/db1.png" alt="" />Paper Comments</h4>

					<div class="sdb-tabl-com sdb-pro-table">
						<table class="table table-hover responsive-table bordered">
							<tbody>
								<?php foreach($myArray as $mkey=>$mval) {
								    $table_head_val = explode(':', $mval);
								    ?>
								<tr>
									<th><?php echo $table_head_val[0]; ?>
									</th>
									<th>:</th>
									<th><?php echo $table_head_val[1]; ?>
									</th>
								</tr>
								<?php } ?>
							</tbody>

						</table>
						<div class="sdb-bot-edit">
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php }
					        }
					}?>
</div>
<div class="actionBox">
	<?php if(count($comments_details)>0) {  ?>
	<ul class="commentList">
		<?php foreach($comments_details as $key=>$val) {
		    if($val->is_select_command ==0) {?>
		<li>
			<div class="commenterImage">
				<img src="images/adv/header_icon.png" />
			</div>
			<div class="commentText">
				<h3 class="">
					<?php echo $val->admin_name; ?>
				</h3>
				<p class="">
					<?php echo $val->comments; ?>
				</p>
				<span class="date sub-text">
					<?php echo date('M Y', strtotime(".$val->created_date.")); ?>
				</span>

			</div>
		</li>
		<?php }
		    } ?>
	</ul>
	<?php } else { ?>
	<div class='col-xs-12'>
		<h2>No Comments Yet ! </h2>
	</div>
	<?php } ?>
	<form name='add_commands' id="comment_form" method='post' action="#">
		<div class="form-group">
			<label for="comment">Comment:</label>
			<textarea class="form-control" rows="5" id="comments" name='comments'></textarea>
		</div>
		<input type='hidden' name='command_user_id'
			value="<?php echo $user_id; ?>" />
		<input type='hidden' name='journal_id' id="journal_id"
			value="<?php echo $journal_id; ?>" />
		<input type='hidden' name='add_new_command' value="commands_new" />
		<div class="form-group">
			<button type='button' id='add_command_but' class="btn btn-default">Add</button>
		</div>
	</form>

</div>
</div>
</div>
</div>
</div>-->
<div class="inbox_msg">
	<div class="container" style="max-width: 100%;">
		<div class="titleBox" style="background-color: #462323;text-align:center">
			<h3 class=" text-center" style="color:white">Comment Section</h3>
		</div>
		<div class="messaging">
			<div class="">
				<div class="mesgs">
					<div class="msg_history">
						<?php foreach($static_ques_data as $key=>$val) { ?>
						<div class="comment1">
							<form method="POST" action="#">
								<input type='hidden' name='ques_command_user_id'
									value="<?php echo $user_id; ?>" />
								<input type='hidden' name='ques_id'
									value="<?php echo $val->question_id; ?>" />
								<input type='hidden' name='ques_command_journal_id' id="ques_journal_id"
									value="<?php echo $journal_id; ?>" />
								<input type='hidden' name='ques_command_role_id'
									value="<?php echo $role_id; ?>" />
								<div class="incoming_msg">
									<div class="incoming_msg_img"><!--<p>Chief Editor </p>--></div>
									<div class="received_msg">
										<div class="received_withd_msg">
											<p><?php echo $val->question; ?>
											</p>
										</div>
									</div>
								</div>
								<?php if(count($val->answers) > 0) {
								    foreach ($val->answers as $anskey=>$ansval) {
								        if($ansval->admin_id!=0) {?>
								<div class="incoming_msg">
									<div class="incoming_msg_img"> <!--<p>Reviewer</p>--> </div>
									<div class="received_msg">
										<div class="received_withd_msg">
											<p><?php echo $ansval->comments; ?>
											</p>
											<span class="time_date">
												<?php  date_default_timezone_set('Asia/Kolkata');
								            $time = strtotime($ansval->created_date .' UTC');
								            $dateInLocal = date("h:i A", $time);
								            echo "<strong>".$dateInLocal."</strong>"; ?>
												|
												<?php   $middle = strtotime($ansval->created_date);
								            echo "<strong>".date('M d', $middle)."</strong>"; ?>
											</span>
										</div>
									</div>
								</div>
								<?php } else { ?>
								<div class="outgoing_msg">
									<div class="sent_msg">
										<p><?php echo $ansval->comments; ?>
										</p>
										<span class="time_date"> <?php  date_default_timezone_set('Asia/Kolkata');
								    $time = strtotime($ansval->created_date .' UTC');
								    $dateInLocal = date("h:i A", $time);
								    echo "<strong>".$dateInLocal."</strong>"; ?> |
											<?php   $middle = strtotime($ansval->created_date);
								    echo date('M d', $middle); ?>
										</span>
									</div>
								</div>
								<?php }
								}
								} ?>
								<div class="type_msg" style="border-radius: 24px;border: 0.5px solid #00a65a;">
									<div class="input_msg_write">
										<input type="text" class="write_msg" name="new_answer" value="" colmn="4"
											placeholder="&nbsp;&nbsp;&nbsp;&nbsp;Type a message" />
										<button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
												aria-hidden="true"></i></button>
									</div>
								</div>
								<hr>
							</form>
						</div>
						<?php } ?>

						<div class="type_msg">
							<form class="text-center" id="select_command_form" method='post' action="#"
								style="color: #757575;">
								<input type='hidden' name='select_command_user_id'
									value="<?php echo $user_id; ?>" />
								<input type='hidden' name='select_command_journal_id' id="journal_id"
									value="<?php echo $journal_id; ?>" />
								<input type='hidden' name='select_add_new_command' value="select_commands_new" /><br>
								<div class="col-md-12">
									<button id="select_add_command_but" class="btn btn-outline-success btn-lg"
										type="button">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- /.row -->
</section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'admin_footer.php'; ?>