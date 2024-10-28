<?php 

include 'connection.php';
include 'db.php';
session_start();
error_reporting( E_ALL );

$role_id=$_SESSION['role_id'];  
$user_id=$_SESSION['admin_id'];
$user_ins_name=$_SESSION['user_name'];
$user_email=$_SESSION['user_email'];
if(isset($_GET['view'])&& $_GET['view']="journal_commentview"){
	$journal_id=$_GET['journal_id'];
	$journal_sql="SELECT DISTINCT 
    ta.admin_name,tja.created_date as assigned_date,tc.*
FROM
    tbl_comments AS tc,
    tbl_journal_assign AS tja,
    tbl_admin AS ta,
    tbl_journal AS tj
WHERE
    tc.journal_id = ".$journal_id."
        AND tj.journal_id = tc.journal_id
        AND tc.admin_id = ta.admin_id
        AND tja.journal_id=tc.journal_id
ORDER BY tc.comment_id DESC";
	$comments_data_qry=$db->query($journal_sql);
	$comments_details=$comments_data_qry->rows;
	
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
/*echo '<pre>';
	print_r($comments_details);
	echo '</pre>';*/
?>

   <?php include 'header1.php';?>

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
		   <?php include 'footer1.php';?>
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
                <!-- Material form login -->
				<div class="container">
				<div class="col-md-12">
				 
				  <div class="card-body px-lg-5 pt-0"   style="margin-top: 46px;">
				    <h4>Journal Tittle</h4>
					<form class="text-center" style="color: #757575;">
						<div class="d-flex justify-content-around">
							 <div>
							  <!-- Remember me -->
							  <div class="form-check" style="text-align:left;">
								<input type="radio" name="colors" >May be Accept
								<input type="radio" name="colors" >May be Reject
							  </div>
							</div>
						</div>
						<h4>Character</h4>
						<div class="col-md-6">
						  <div class="md-form">
							<label>Paper</label>
							<select class="form-control" >
							   <option >Please Select Paper</option>
							   <option >Very Specialized</option>
							   <option >Important</option>
							   <option >General Important</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						   <div class="md-form">
							<label>Information</label>
							<select class="form-control" >
							   <option >Please Select Information</option>
							   <option >New </option>
							   <option >Useful</option>
							   <option >Already Know Results</option>
							</select>
						  </div>
						</div>
					    <div class="col-md-6">
						   <div class="md-form">
							 <label>Methods</label>
							<select class="form-control" >
							   <option >Please Select Methods</option>
							   <option >New</option>
							   <option >Adequate</option>
							   <option >InAdequate</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="md-form">
							<label>Data</label>
							<select class="form-control" >
							   <option >Please Select Data</option>
							   <option >Adequate</option>
							   <option >Too Many</option>
							   <option >Small</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="md-form">
							<label>Staistical Analysis</label>
							<select class="form-control" >
							   <option >Please Select Staistical Analysis</option>
							   <option >Adequate</option>
							   <option >Erroneous</option>
							   <option >Needs Revision</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Interpretation</label>
								<select class="form-control" >
								   <option >Please Select Interpretation</option>
								   <option >Adequate</option>
								   <option >Warrants Improvements</option>
								   <option >Too General</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Title</label>
								<select class="form-control" >
								   <option >Please Select Title</option>
								   <option >Adequate</option>
								   <option >May be Condensed</option>
								   <option >Should be Changed</option>
								</select>
							  </div>
					    </div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Abstract</label>
								<select class="form-control" >
								   <option >Please Select Abstract</option>
								   <option >Adequate</option>
								   <option >To be Rewritten</option>
								   <option >Not Required</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Language</label>
								<select class="form-control" >
								   <option >Please Select Language</option>
								   <option >Good</option>
								   <option >Fair</option>
								   <option >Needs Revision</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Illustration</label>
								<select class="form-control" >
								   <option >Please Select Illustration</option>
								   <option >Adequate</option>
								   <option >Poor Quality</option>
								   <option >Not Required</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Tables</label>
								<select class="form-control" >
								   <option >Please Select Tables</option>
								   <option >Adequate</option>
								   <option >Too Many</option>
								   <option >Needs Modification</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Abbreviations,Formulae and Units</label>
								<select class="form-control" >
								   <option >Please Select Abbreviations</option>
								   <option >Confirm Standards</option>
								   <option >Do Not Confirm To Standards</option>
								   <option >May be Explained at One Place</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Reference</label>
								<select class="form-control" >
								   <option >Please Select Reference</option>
								   <option >Adequate</option>
								   <option >InAdequate</option>
								   <option >Missing</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Reference Style</label>
								<select class="form-control" >
								   <option >Please Select Reference Style</option>
								   <option >All Right</option>
								   <option >Needs Improvement</option>
								   <option >Complete Formating Required</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							  <div class="md-form">
								<label>Approval</label>
								<select class="form-control" >
								   <option >Please Select Approval</option>
								   <option >Research Paper</option>
								   <option >Research Note</option>
								   <option >Not Accepted</option>
								</select>
							  </div>
						</div>
						<div class="col-md-6">
							<div class="md-form">
							   <label>Message</label>
							   <textarea class="form-control" id="" placeholder="Please Enter Your Message"></textarea>
						    </div>
						</div>
					  <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Add</button>
					</form>
				  </div>
				</div>
			</div>
            <!-- Material form login -->
                <!--== User Details ==-->
		  <div class="cointainer">
            <div class="col-md-12">
                <div class="detailBox">
                 <div class="titleBox">
					  <label>Comment Box</label>
				
                 </div>
                 <div class="commentBox">
                   <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                 </div>
				<div class="col-md-9">
                    <div class="udb">
						<form id='student_edit_form' method="POST" action="backend.php" >
							<input type="hidden" name='student_edit_profile_id'  value="<?php  echo $user_details[0]->user_id; ?>" />
							<input type="hidden" name='edit_profile'  value="db-profile.php" />
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" />Paper Comments</h4>
                           
                            <div class="sdb-tabl-com sdb-pro-table">
                                <table class="responsive-table bordered">
                                    <tbody>
                                        <tr>
                                            <th>Paper</th>
                                            <th>:</th>
                                            <th>Very Specialized</th>
                                        </tr>
                                        <tr>
                                            <th>Information</th>
                                            <th>:</th>
                                            <th>Useful</th>
										</tr>
                                        <tr>
                                            <th>Methods</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
                                        <tr>
                                            <th>Data</th>
                                            <th>:</th>
                                            <th>Small</th>
										</tr>
                                        <tr>
                                            <th>Staistical Analysis</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
                                        <tr>
                                            <th>Interpretation</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
                                       <tr>
                                            <th>Title</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
										<tr>
                                            <th>Abstract</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
										<tr>
                                            <th>Language</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
										<tr>
                                            <th>Illustration</th>
                                            <th>:</th>
                                            <th>Adequate</th>
										</tr>
										<tr>
                                            <th>Tables</th>
                                            <th>:</th>
                                            <th>Needs Modification</th>
										</tr>
										<tr>
                                            <th>Abbreviations,Formulae and Units</th>
                                            <th>:</th>
                                            <th>Needs Modification</th>
										</tr>
										<tr>
                                            <th>Reference</th>
                                            <th>:</th>
                                            <th>Needs Improvement</th>
										</tr>
										<tr>
                                            <th>Reference Style</th>
                                            <th>:</th>
                                            <th>Needs Modification</th>
										</tr>
										<tr>
                                            <th>Approval</th>
                                            <th>:</th>
                                            <th>Research Note</th>
										</tr>
										<tr>
                                            <th>Approval</th>
                                            <th>:</th>
                                            <th>Research Note</th>
										</tr>
                                    </tbody>
										<div class="form-group">
							       <label for="comment">Comment:</label>
							  <textarea class="form-control" rows="5" id="comments" name='comments'></textarea>
							</div>
                                </table>
								 
                                <div class="sdb-bot-edit">
                                   
									<!--<button type='button' class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>-->
                                
                                 
                                    <!--<a href="#" class="waves-effect waves-light btn-large sdb-btn sdb-btn-edit"><i class="fa fa-pencil"></i> Edit my profile</a>-->
                                </div>
                            </div>
                        </div>
						</form>
                    </div>
                </div>
					<div class="actionBox">
						<?php if(count($comments_details)>0){ ?>
						<ul class="commentList">
							<?php foreach($comments_details as $key=>$val){ ?>
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
							<?php } ?>
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
							</div>
							<div class="form-group">
								<button type='button' id='correction_send_to_author' class="btn btn-default">Send To Author</button>
							</div>
                        </form>
					
					</div>
                </div>
            </div>
			</div>
            </div>
			
			

