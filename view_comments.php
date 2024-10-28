
<?php 

include 'connection.php';
include 'db.php';
session_start();
//error_reporting( E_ALL );

$role_id=$_SESSION['role_id'];  
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
if(isset($_GET['view'])&& $_GET['view']="journal_commentview"){
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
	$static_ques_qry="SELECT * FROM tbl_questions where is_deleted=0";
	$static_ques_fetch=$db->query($static_ques_qry);
	$static_ques_data=$static_ques_fetch->rows;
	
	foreach($static_ques_data as $qkey=>$qval){
	$ques_sql="SELECT DISTINCT tc.* FROM tbl_comments2 AS tc,tbl_questions as tq,tbl_journal AS tj WHERE tc.journal_id =".$journal_id." AND tj.journal_id = tc.journal_id  AND tq.question_id=tc.ques_id AND tc.ques_id=$qval->question_id ORDER BY tc.admin_id DESC";
	
	$ques_sql_fetch=$db->query($ques_sql);
	$ques_sql_fetch_data=$ques_sql_fetch->rows;
	$static_ques_data[$qkey]->answers=$ques_sql_fetch_data;
	}
	
}
if(isset($_POST['add_new_command']) && ($_POST['add_new_command']!="") ){
	//echo 'slsl';
	
	$ins_command_data=array(
	"comments"=>$_POST['comments'],
	"admin_id"=>$_POST['command_user_id'],
	"journal_id"=>$_POST['journal_id'],
	'created_date'=>date("Y-m-d"),
	'modified_date'=>date("Y-m-d")	
	);
	$command_add_query = $db->insert('tbl_comments',$ins_command_data);
	if($command_add_query!=0){
		//header("Location:view_commands.php?view=journal_commentview&journal_id=".$journal_id"");	
		echo "<meta http-equiv='refresh' content='0'>";
	}
}
$select_com=0;
/*echo '<pre>';
	print_r($comments_details);
	echo '</pre>';*/
?>
 <?php 
   if(isset($_SESSION['admin_id'])&&$_SESSION['admin_id']!=""){
   include_once 'admin_header.php' ;
   }else{
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
          
         <img class="card-img-top"    src="images/editorial/Dr.U. Sivakumar.jpg" alt="">
        </div>
        <div class="pull-left info">
          <p>Dr.U. Sivakumar</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <!--  <ul class="treeview-menu">
            <li><a data-toggle="tab"  href="#newjournal"><i class="fa fa-circle-o"></i>New Journal</a></li>
            <li class="active"><a data-toggle="tab" href="#undercorrection"><i class="fa fa-circle-o"></i>Under Correction</a></li>
          </ul>--->
        </li>
       
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

   
    <section class="content">
     
         
      <!--<div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Received Papers</span>
              <span class="info-box-number">90<small></small></span>
            </div>
          
          </div>
        
        </div>
    

       
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Processing Paper</span>
              <span class="info-box-number">760</span>
            </div>
          
          </div>
        
        </div>
       
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Finished Papers</span>
              <span class="info-box-number">2,000</span>
            </div>
         
          </div>
       
        </div>
        
      </div>-->
     
	  
	   
	  <div class="col-md-12"  style="background-color: rgba(138, 109, 59, 0.17);">
				
				<div class="container">
					<h3 class=" text-center">Messaging</h3>
					<div class="messaging">
						  <div class="inbox_msg">
							<div class="mesgs">
							  <div class="msg_history">
							       <?php foreach($static_ques_data as $key=>$val) { ?>
							     <div class="comment1">	
									<div class="incoming_msg">
									  <div class="incoming_msg_img"><p>Chief Editor </p></div>
									  <div class="received_msg">
										<div class="received_withd_msg">
										  <p><?php echo $val->question; ?></p>
										 </div>
									  </div>
									</div>
									<?php if(count($val->answers) > 0) { foreach ($val->answers as $anskey=>$ansval) { if($ansval->admin_id!=0){?>
										<div class="incoming_msg">
										  <div class="incoming_msg_img"> <p>Reviewer</p> </div>
										  <div class="received_msg">
											<div class="received_withd_msg">
											  <p><?php echo $ansval->comments; ?></p>
											  <span class="time_date"> <?php  date_default_timezone_set('Asia/Kolkata'); $time = strtotime($ansval->created_date .' UTC');
$dateInLocal = date("h:i A", $time);
echo "<strong>".$dateInLocal."</strong>"; ?> | <?php   $middle = strtotime($ansval->created_date); echo "<strong>".date('M d',$middle)."</strong>"; ?>   </span>
											 </div>
										  </div>
										</div>
									<?php }else { ?>
										<div class="outgoing_msg">
										  <div class="sent_msg">
											<p><?php echo $ansval->comments; ?></p>
											<span class="time_date"> <?php  date_default_timezone_set('Asia/Kolkata'); $time = strtotime($ansval->created_date .' UTC');
$dateInLocal = date("h:i A", $time);
echo "<strong>".$dateInLocal."</strong>"; ?>    | <?php   $middle = strtotime($ansval->created_date); echo date('M d',$middle); ?>   </span> </div>
										</div>
									<?php }}} ?>
								  </form>
								</div>
								<?php } ?>
							</div>
							</div>
						</div>
					</div>
				</div>
	
	
	
	
	
	
	
	
	
	
	
                   <!-- <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Reviewer 1</h4>
                            <div class="sdb-tabl-com sdb-pro-table">
                                <div class="sdb-bot-edit">
                                    <p>Reviewer 1</p>
									<p>Independent Review Report Submitted :<span>09 Aug 2016</span></p>
									<p>Interactive  Review Activated : <span>09 Aug 2016</span></p>
									<p>Final  Report Submitted :<span>09 Aug 2016</span></p>
									<p>Calcite dissolution by Brevibacterium sp. SOTI06: A futuristic approach for the reclamation of calcareous sodic soils</p>
                                    <p><span> Tamilselvi S.M, Chitdeshwari Thiyagarajan and Sivakumar Uthandi*</span></p>
									<p><span>Original Research, Madras Agric.J., - Agriculture</span></p>
									<p>Submitted on: 01 Jul 2016, </p>
									<p>Manuscript ID: 217345</p>

									 
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
	  

     <div class="container">
			
						
					<!-- Material form login -->
						<!--== User Details ==-->
					  <div class="col-md-11" >
						<div class="detailBox">
						 <div class="titleBox">
							  <label>Comment Box</label>
						
						
						 </div>
						
					        <div class="col-md-7">
								<?php if(count($comments_details)>0) { 
									
									foreach($comments_details as $key=>$val){ 
											if($val->is_select_command > 0 ) {
												$select_com=1;
												$myArray = explode('/', $val->comments); 
												
								?>
								<div class="udb">
									<form   >
										<input type="hidden" name='student_edit_profile_id'  value="<?php  echo $user_details[0]->user_id; ?>" />
										<input type="hidden" name='edit_profile'  value="db-profile.php" />
										<div class="udb-sec udb-prof">
											<h4><img src="images/icon/db1.png" alt="" />Paper Comments</h4>
										   
											<div class="sdb-tabl-com sdb-pro-table">
												<table class="responsive-table bordered">
													<tbody>
														<?php foreach($myArray as $mkey=>$mval){
															$table_head_val = explode(':', $mval);
														?>
															<tr>
																<th><?php echo $table_head_val[0]; ?></th>
																<th>:</th>
																<th><?php echo $table_head_val[1]; ?></th>
															</tr>
														<?php }?>
													
													</tbody>
												</table>
												<!--<div class="form-group">
												   <button type='button' id='' class="btn btn-default">Send to Author</button>
												</div>-->
												<div class="sdb-bot-edit">
												</div>
											</div>
										</div>
									</form>
								</div>
						        <?php } }}?>
					        </div>
							<?php if($select_com==0){ ?>
								<div class="col-md-12"><br><br><br>
							<?php } else { ?>
								<div class="col-md-5"><br><br><br>
							<?php } ?>
								<?php if(count($comments_details)>0){ ?>
								<ul class="commentList">
									<?php foreach($comments_details as $key=>$val){ if($val->is_select_command ==0 ) {?>
									<li>
										<div class="commenterImage">
										  <img src="images/adv/header_icon.png" />
										</div>
										<div class="commentText">
											<h3 class=""><?php echo $val->admin_name; ?></h3>
											<p class=""><?php echo $val->comments; ?></p> 
											<span class="date sub-text">
											<?php echo date('M Y', strtotime(".$val->created_date.")); ?>
											</span>

										</div>
									</li>
									<?php } } ?>
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
									<input type='hidden' name='command_user_id'  value="<?php echo $user_id; ?>" />
									<input type='hidden' name='journal_id' id="journal_id" value="<?php echo $journal_id; ?>" />
									<input type='hidden' name='add_new_command'  value="commands_new" />
									<div class="form-group">
										<button type='button' id='add_command_but' class="btn btn-default">Add</button>
										
									
										<button type='button' id='correction_send_to_author' class="btn btn-default">Send To Author</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					</div>
					</div>
			
	<?php 
   if(isset($_SESSION['admin_id'])&&$_SESSION['admin_id']!=""){
   include_once 'admin_footer.php' ;
   }else{
	  include_once 'footer.php' ;
   }
	?>		
