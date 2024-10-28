<?php 
include_once 'admin_header.php';
//$_SESSION['journal_submission_msg']=array();

$sql="SELECT * FROM  tbl_admin where admin_id=".$user_id;
$user_data=$db->query($sql);
$user_details=$user_data->rows;
$journal_sql="SELECT * FROM  tbl_journal where is_deleted=0 AND is_author_reviewed=0  ORDER BY journal_id DESC";
$journal_data=$db->query($journal_sql);
$journal_sql1="SELECT journal_id FROM  tbl_journal where is_deleted=0 AND is_published=1  ORDER BY journal_id DESC";
$journal_data1=$db->query($journal_sql1);
$journal_sql2="SELECT journal_id  FROM  tbl_journal where is_deleted=0 AND is_published=0 AND is_author_reviewed=0 AND is_rejected = 0 AND review_level = 0 AND correction_level = 0 AND is_corrected = 0 ORDER BY journal_id DESC";
$journal_data2=$db->query($journal_sql2);
$journal_sql3="SELECT journal_id  FROM  tbl_journal where is_deleted=0 AND is_published=0 AND is_author_reviewed >= 0 AND is_rejected = 0 AND review_level = 0 AND correction_level > 0 AND is_corrected = 0 ORDER BY journal_id DESC";
$journal_data3=$db->query($journal_sql3);
$journal_sql4="SELECT journal_id  FROM  tbl_journal where is_deleted=0 AND is_published=0 AND is_author_reviewed >= 0 AND is_rejected = 0 AND review_level >= 0 AND correction_level >= 0 AND is_corrected = 1 ORDER BY journal_id DESC";
$journal_data4=$db->query($journal_sql4);
$author_details_qry="SELECT * FROM tbl_author where is_deleted=0";
$author_data=$db->query($author_details_qry); 

$journal_total_detail_array=[];
$journal_total_detail_obj = [];

// echo "<pre>";
// print_r($journal_data);exit;
foreach($journal_data->rows as $key=>$val){
	$journal_total_detail_obj[$key]=$val;
	$journal_detail_sql="SELECT * FROM  tbl_journal_details where journal_id=".$val->journal_id;
	$journal_detail_data_qry=$db->query($journal_detail_sql);
	//echo "<pre>";
//print_r($journal_data);exit;
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
      <!--<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a>
            <i class="fa fa-dashboard"></i> <span>Dashboard </span>
         
          </a>
        </li>
        <li class="active"><a href="members-upload.php" class="collapsible-header active"><i class="fa fa-user" aria-hidden="true"></i> Members Upload</a> </li>
      </ul>-->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 625px;">
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

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
     <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Article</span>
              <span class="info-box-number"><?php echo count($journal_data2->rows); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
     

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Reviewer</span>
              <span class="info-box-number"><?php echo count($journal_data3->rows); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Accepted Article</span>
              <span class="info-box-number"><?php echo count($journal_data4->rows); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		     <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Published Article</span>
              <span class="info-box-number"><?php echo count($journal_data1->rows); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <!-- /.row -->
 
      <!-- /.row -->

      <!-- Main row -->
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li ><a href="#newjournal" data-toggle="tab">New Article</a></li>
              <li><a href="#undercorrection" data-toggle="tab">Reviewer</a></li>
              <li><a href="#correctedart" data-toggle="tab">Accepted Article</a></li>
              <li><a href="#publishedart" data-toggle="tab">Published Article</a></li>
           
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="newjournal">
			  
                                  <table class="table table-hover">
								   <b>New Journal:</b>
                    <thead>
                                                <tr>
                                                    <th>Author Name</th>
													<th>Title</th>
													
													<th colspan="6">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
												//echo "<pre>";
												//print_r($journal_total_detail_array);exit;
												?>
												<?php $new_journal_count=0; foreach($journal_total_detail_array as $key=>$val) { 
												//echo "<pre>";
												//print_r($val[1]);exit;
												if(isset($val[1]->correction_level) && isset($val[1]->is_published) && isset($val[1]->is_rejected) && isset($val[1]->review_level)){
												if($val[1]->correction_level==0 && $val[1]->is_published==0 &&  $val[1]->is_rejected==0 && $val[1]->review_level==0 ) { $new_journal_count=1; ?>
                                                <tr>
                                                    <td><a  data-toggle="model" id="" data-target="#profileinfo" ><span class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span class="list-enq-city"><?php 
													$lastElement = end($val[2]);
													foreach($val[2] as $autkey=>$authval){
														if($authval==$lastElement){
															echo $authval->author_name.'.';
														}	else{
															echo $authval->author_name.',';
														}
													} ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?></td>
                                                 
													<form id="journal_assign_form<?php echo $val[0]->journal_id; ?>" name='journal_assign_form<?php echo $val[0]->journal_id; ?>' method="POST" action="backend.php" >
                                                    <td> 
							<a href="#"  data-target="#journal<?php echo $val[0]->journal_id; ?>" data-toggle="modal">Select Editor</a>
							<input type='hidden' id='journal_id' name='assign_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
							<input type='hidden' id='journal_user_id' name='journal_user_id' value="<?php echo $val[0]->user_id; ?>" />
							<input type='hidden' id='redirect_url' name='redirect_url' value="chiefeditor.php" />
							<input type='hidden' id='correction_level' name='correction_level' value="<?php echo $val[1]->correction_level; ?>" />
							<input type='hidden' id='correction_level' name='status_level' value="<?php echo $val[1]->status_id; ?>" />
                                                      
                                                    </td>
				<td><a class="assign-submit ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>" > Assign</a></td>
				<td><a  href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'  class="view_comments ad-st-view">ViewComments</a></td>
				<td><a class="reject ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>"  >Reject</a></td>
				<td><a class="publish-submit ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>"  >Publish</a></td>
				<td><a class="publish-submit ad-st-view" href="javascript:void(0);" value=""  >Download</a></td>
                                                </tr>
												<div class="container">
                                    <div class="modal fade" id="journal<?php echo $val[0]->journal_id; ?>">
                                        <div class="modal-dialog" style="top:128px";>
                                            <div class="modal-content">
                                                <div class="modal-header">
													<div class="tab">
													 <div class="tab">
													  <button type="button" class="tablinks active" onclick="openCity(event, 'associate<?php echo $val[0]->journal_id; ?>')">Associate</button>
													  <button type="button"  class="tablinks" onclick="openCity(event, 'technical<?php echo $val[0]->journal_id; ?>')">Technical</button>
													 
													  <button type='button' class="tablinks" onclick="openCity(event, 'referee<?php echo $val[0]->journal_id; ?>')">Referee</button>
													 
													 </div>
													</div>
													<input type='hidden' id='this_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
													<div id="associate<?php echo $val[0]->journal_id; ?>" class="tabcontent" >
													  <select name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"  id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"  class='form-control assigned_select<?php echo $val[0]->journal_id; ?>' multiple="multiple">
																<option value="0" selected>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==1){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
													  </select>
													</div>
													<div id="technical<?php echo $val[0]->journal_id; ?>" class="tabcontent" style="display: none;">
													  <select name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option value="0" selected>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==2){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
															</select>
													</div>
													<div id="referee<?php echo $val[0]->journal_id; ?>" class="tabcontent" style="    display: none;">
													  <select name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option value="0" selected>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==3){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
														</select>
													</div>
													<div id="author" class="tabcontent"  style="    display: none;">
													     <select class="form-control assigned_select" multiple="multiple">
														    <option value="">Corresponding Author</option>
														   
														 </select>
													</div>
												</div>
												</form>
											</div>
										</div>
								    </div>
						        </div>
												<?php }} } if($new_journal_count==0) { ?>
												<tr>
													<td class="text-center" colspan="3">There is No New Articles</td>
												</tr>
												<?php } ?>
                                            </tbody>
                                        </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="undercorrection">
			    <b>Under Correction:</b>
               <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
													<th>Title</th>
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php 
												$under_correction_count=0; 
												foreach($journal_total_detail_array as $key=>$val) 
												{
												if(isset($val[1]->correction_level) && isset($val[1]->is_published) && isset($val[1]->is_rejected) && isset($val[1]->review_level) && isset($val[1]->is_corrected)){
												if($val[1]->correction_level>0 && $val[1]->is_published==0 && $val[1]->review_level==0  &&  $val[1]->is_rejected==0  &&  $val[1]->is_corrected==0) { $under_correction_count=1;?>
                                                <tr>
                                                    <td><a  data-toggle="model" id="" data-target="#profileinfosend" ><span class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span class="list-enq-city"><?php 
													$lastElement = end($val[2]);
													foreach($val[2] as $autkey=>$authval){
														if($authval==$lastElement){
															echo $authval->author_name.'.';
														}	else{
															echo $authval->author_name.',';
														}
													} ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?></td>
                                             
													<form id="journal_assign_form<?php echo $val[0]->journal_id; ?>" name='journal_assign_form<?php echo $val[0]->journal_id; ?>' method="POST" action="backend.php" >
													
													
													<td><a class="correct-submit ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>"  >Correct</a></td>
													<td><a  href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'  class="view_comments ad-st-view">ViewComments</a></td>
													
													
                                                </tr>
												<div class="container">
                                    <div class="modal fade" id="profileinfosend<?php echo $val[0]->journal_id; ?>">
                                        <div class="modal-dialog" style="top:128px";>
                                            <div class="modal-content">
                                                <div class="modal-header">
													<div class="tab">
													 <div class="tab">
													  <button type="button" class="tablinks" onclick="openCity(event, 'associateuc<?php echo $val[0]->journal_id; ?>')">Associate</button>
													  <button type="button"  class="tablinks" onclick="openCity(event, 'technicaluc<?php echo $val[0]->journal_id; ?>')">Technical</button>
													 
													  <button type='button' class="tablinks" onclick="openCity(event, 'refereeuc<?php echo $val[0]->journal_id; ?>')">Referee</button>
													 </div>
													</div>
													<input type='hidden' id='this_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
													 <div id="associateuc<?php echo $val[0]->journal_id; ?>" class="tabcontent">
													  <select name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"  id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"  class='form-control assigned_select<?php echo $val[0]->journal_id; ?>' multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==1){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
													  </select>
													</div>
													<div id="technicaluc<?php echo $val[0]->journal_id; ?>" class="tabcontent">
													  <select name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==2){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
															</select>
													</div>
													<div id="refereeuc<?php echo $val[0]->journal_id; ?>" class="tabcontent">
													  <select name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==3){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
															</select>
													</div>
												</div>
												</form>
											</div>
										</div>
								    </div>
						        </div>
												<?php } } }  if($under_correction_count==0) { ?>
												<tr>
													<td class="text-center" colspan="3">There is No  Articles in Under Correction</td>
												</tr>
												<?php } ?>
                                            </tbody>
                                        </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="correctedart">
			   <b>Corrected Article:</b>
                   <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
													<th>Title</th>
													<th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php 
												$re_correction_count=0; 
												foreach($journal_total_detail_array as $key=>$val) 
												{
												if(isset($val[1]->correction_level) && isset($val[1]->is_published) && isset($val[1]->is_rejected) && isset($val[1]->review_level) && isset($val[1]->is_corrected)){
												if($val[1]->review_level >= 0 && $val[1]->is_published==0 && $val[1]->correction_level>=0 && $val[1]->is_rejected==0  && $val[1]->is_corrected==1 ) { $re_correction_count=1; ?>
                                                <tr>
                                                    <td><a  data-toggle="model" id="" data-target="#profileinfo" ><span class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span class="list-enq-city"><?php 
													$lastElement = end($val[2]);
													foreach($val[2] as $autkey=>$authval){
														if($authval==$lastElement){
															echo $authval->author_name.'.';
														}	else{
															echo $authval->author_name.',';
														}
													} ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?></td>
                                                 
													<form id="journal_assign_form<?php echo $val[0]->journal_id; ?>" name='journal_assign_form<?php echo $val[0]->journal_id; ?>' method="POST" action="backend.php" >
                                                    <td> 
													  <a href="#"  data-target="#correctedartsend<?php echo $val[0]->journal_id; ?>" data-toggle="modal">Select Editor</a>
														<input type='hidden' id='journal_id' name='assign_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
														<input type='hidden' id='journal_user_id' name='journal_user_id' value="<?php echo $val[0]->user_id; ?>" />
														<input type='hidden' id='redirect_url' name='redirect_url' value="chiefeditor.php" />
													   <input type='hidden' id='correction_level' name='correction_level' value="<?php echo $val[1]->correction_level; ?>" />
													    <input type='hidden' id='correction_level' name='status_level' value="<?php echo $val[1]->status_id; ?>" />
                                                    </td>
													<td><a class="assign-submit ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>"  >Assign</a>
													<a  href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'  class="view_comments ad-st-view">ViewComments</a>
													<a class="publish-submit ad-st-view" href="javascript:void(0);" value="<?php echo $val[0]->journal_id; ?>"  >Publish</a>
													</td>
												
													
                                                </tr>
												<div class="container">
                                    <div class="modal fade" id="correctedartsend<?php echo $val[0]->journal_id; ?>">
                                        <div class="modal-dialog" style="top:128px";>
                                            <div class="modal-content">
                                                <div class="modal-header">
													<div class="tab">
													 <div class="tab">
													  <button type="button" class="tablinks" onclick="openCity(event, 'associatecrt<?php echo $val[0]->journal_id; ?>')">Associate</button>
													  <button type="button"  class="tablinks" onclick="openCity(event, 'technicalcrt<?php echo $val[0]->journal_id; ?>')">Technical</button>
													 
													  <button type='button' class="tablinks" onclick="openCity(event, 'refereecrt<?php echo $val[0]->journal_id; ?>')">Referee</button>
													 </div>
													</div>
													<input type='hidden' id='this_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
													 <div id="associatecrt<?php echo $val[0]->journal_id; ?>" class="tabcontent">
													  <select name="journal_assigner_to_ass<?php echo $val[0]->journal_id; ?>[]"  id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_asso"  class='form-control assigned_select increase<?php echo $val[0]->journal_id; ?>' multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==1){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
													  </select>
													</div>
													<div id="technicalcrt<?php echo $val[0]->journal_id; ?>" class="tabcontent">
													  <select name="journal_assigner_to_tech<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_tech" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==2){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
															</select>
													</div>
													<div id="refereecrt<?php echo $val[0]->journal_id; ?>" class="tabcontent" style="height: 300px;">
													  <select name="journal_assigner_to_ref<?php echo $val[0]->journal_id; ?>[]" id="journal<?php echo $val[0]->journal_id; ?>_assigner_to_refree" class="form-control assigned_select<?php echo $val[0]->journal_id; ?>"  multiple="multiple">
																<option>Select</option>
																<?php foreach($val[3] as $adminkey=>$adminval){ if($adminval->admin_cat_id==3){?>
																 <option value="<?php echo $adminval->admin_id; ?>" ><?php echo $adminval->admin_name; ?></option>
																<?php } }?>
															</select>
													</div>
												</div>
												</form>
											</div>
										</div>
								    </div>
						        </div>
												<?php } } } if($re_correction_count==0) { ?>
												<tr>
													<td class="text-center" colspan="3">There is No Corrected Articles</td>
												</tr>
												<?php } ?>
                                            </tbody>
                                        </table>
              </div>
              <!-- /.tab-pane -->
			  <div class="tab-pane" id="publishedart">
                <b>Published Articles:</b>
                <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Author Name</th>
													<th>Title</th>
													<th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
												
                                                 <?php 
                                                 $new_journal_count=0;   
                                                 foreach($journal_total_detail_array as $key=>$val) 
                                                 {
                                                    //  echo "<pre>";
                                                    // print_r($val[1]);continue;
                                                 if(isset($val[1]->correction_level) && isset($val[1]->is_published) && isset($val[1]->is_rejected)){
                                                 if($val[1]->is_published==1 && $val[1]->correction_level==0 && $val[1]->is_rejected==0 ) { $new_journal_count=1; ?>
                                                <tr>
                                                    <td><a  data-toggle="model" id="" data-target="#profileinfo" ><span class="list-enq-name">Author:<?php echo $val[0]->author_name; ?></span><span class="list-enq-city"><?php 
													$lastElement = end($val[2]);
													foreach($val[2] as $autkey=>$authval){
														if($authval==$lastElement){
															echo $authval->author_name.'.';
														}	else{
															echo $authval->author_name.',';
														}
													} ?></span></a>
                                                    </td>
                                                    <td><?php echo $val[0]->title; ?></td>
                                                 
													<form id="journal_assign_form<?php echo $val[0]->journal_id; ?>" name='journal_assign_form<?php echo $val[0]->journal_id; ?>' method="POST" action="backend.php" >
                                                    <td> 
														<a  href='view_comments.php?view=journal_commentview&journal_id=<?php echo $val[0]->journal_id; ?>'  class="view_comments ad-st-view">ViewComments</a>
														<a class="view_journal ad-st-view" href="<?php echo "journal_view.php?journal_view_id=". $val[0]->journal_id .'&user_id='. $val[0]->user_id .'&year='. $val[1]->journal_year .'&journal_path='. $val[1]->journal_path; ?>">View</a>
													 <!-- <a href="#"  data-target="#correctedartsenddata-toggle="modal">Sendeditor</a>-->
														<input type='hidden' id='journal_id' name='assign_journal_id' value="<?php echo $val[0]->journal_id; ?>" />
														<input type='hidden' id='journal_user_id' name='journal_user_id' value="<?php echo $val[0]->user_id; ?>" />
														<input type='hidden' id='redirect_url' name='redirect_url' value="chiefeditor.php" />
													   <input type='hidden' id='correction_level' name='correction_level' value="<?php echo $val[1]->correction_level; ?>" />
													    <input type='hidden' id='correction_level' name='status_level' value="<?php echo $val[1]->status_id; ?>" />
                                                    </td>
													 <?php } } } if($new_journal_count==0) { ?>
												<tr>
													<td class="text-center" colspan=3>There is No Published Articles</td>
												</tr>
												<?php } ?>
													
                                                </tr>
												
                                            </tbody>
                                        </table>
              </div>
			  <!----publish--->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'admin_footer.php'; ?>
