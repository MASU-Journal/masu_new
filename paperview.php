
   <?php 
   include 'journal_details.php';
   include 'header.php';
   $forum_id=$_GET['journal_view_id'];
   foreach($journal_total_detail_array as $jkey=>$jval){
		if($jval[0]->journal_id==$forum_id){
			$forum_array=$jval;
		}
   }
  foreach($forum_array['enable_comments'] as $ckey=>$cval){ 
			if($cval->is_select_command > 0 ) {
				$select_com=1;
				$myArray = explode('/', $cval->comments); 
			}
	}
	if(isset($_POST['new_answer'])&& $_POST['new_answer']!="" ){
		if(isset($role_id)&& $role_id!=""){
			$set_admin_id=$_POST['ques_command_user_id'];
		}else{
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
		$command_add_query = $db->insert('tbl_comments2',$ins_command_data);
		if($command_add_query!=0){
			//header("Location:view_commands.php?view=journal_commentview&journal_id=".$journal_id"");	
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}
						
   /*echo '<pre>';
   print_r($forum_array);
   echo '</pre>';
   die;*/
   ?>
    <!--SECTION START-->
    <section>
		<div class="pro-menu">
            <div class="container">
                <div class="col-md-9 col-md-offset-3">
                    <ul>
						<li class="active"><a href="#Histroy" data-toggle="tab">Histroy</a></li>
						<!--<li><a href="#Editor" data-toggle="tab">Editor</a></li>-->
						<li><a href="#reviewer1" data-toggle="tab">Reviewer 1</a></li>
						<li><a href="#reviewer2" data-toggle="tab">Reviewer 2</a></li>
					</ul>
				</div>
			</div>
		</div>
        <div class="stu-db">
            <div class="container pg-inn tab-content" id="TabContent">
			    <h5><?php echo $forum_array[0]->title; ?></h5>
				<p><b>Author: </b><?php echo $forum_array[0]->author_name; ?><b style="cursor: pointer;"> Co Author: </b>Dr.S.Natarajan,Dr.T.Balaji.</p>
				<span><b>Subject</b>:<?php echo $forum_array[0]->subject; ?></span><span class="date sub-text" style="margin-left: 18px;"></span>
                 <p>Calcite dissolution by Brevibacterium sp. SOTI06: A futuristic approach for the reclamation of calcareous sodic soils</p>
				<p>Tamilselvi S.M, Chitdeshwari Thiyagarajan and Sivakumar Uthandi*</p>
					<p>Original Research, Madras Agric.J., - Agriculture</p>
					<!--<p>Submitted on: 01 Jul 2016, </p>-->
					<p>Masuscript ID: 217345	</p>			
                <div class="col-md-12 tab-pane fade in active"  id="Histroy">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Histroy</h4>
                            <div class="sdb-tabl-com sdb-pro-table">
                                <table class="responsive-table bordered">
                                    <tbody>
                                        <tr>
                                            <td>01 Jun 2016</td>
                                            <td>:</td>
                                            <td>Article accepted for publication</td>
                                        </tr>
                                        <tr>
                                            <td>01 Jun 2016</td>
                                            <td>:</td>
                                            <td>Review of review editor 2</td>
                                        </tr>
                                        <tr>
                                            <td>09 Jun 2016</td>
                                            <td>:</td>
                                            <td>Corresponding author Resubmited</td>
                                        </tr>       
                                        <tr>
                                            <td>01 Jun 2018</td>
                                            <td>:</td>
                                            <td>Editorial Assignment</td>
                                        </tr>
                                        <tr>
                                            <td>09 Jun 2018</td>
                                            <td>:</td>
                                            <td>reviewer 2 Posted new comments</td>
                                        </tr>
                                        <tr>
                                            <td>01 Jun 2018</td>
                                            <td>:</td>
                                            <td>Reviewer 3 Posted new comments</td>
                                        </tr>
                                        <tr>
                                            <td>31 Jun 2018</td>
                                            <td>:</td>
                                            <td>Reviewer 3 Posted new comments</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				<!----------------end Histroy----------------------->
				<div class="col-md-12 tab-pane fade"  id="Editor">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Editor</h4>
                          
                            <div class="sdb-tabl-com sdb-pro-table">
                                <table class="responsive-table bordered">
                                    <tbody>
                                        <tr>
                                            <td>Associate Editor</td>
                                            <td>:</td>
                                            <td>Kumar</td>
                                        </tr>
                                        <tr>
                                            <td>Submitted Date</td>
                                            <td>:</td>
                                            <td>01Jun2016</td>
                                        </tr>
                                        <tr>
                                            <td>Editorial Assignment Start Date</td>
                                            <td>:</td>
                                            <td>01Jun2016</td>
                                        </tr>
                                        <tr>
                                            <td>Independent Review Start Date</td>
                                            <td>:</td>
                                            <td>03 Jun 1990</td>
                                        </tr>
										<tr>
                                            <td>Interactive Review activated Date</td>
                                            <td>:</td>
                                            <td>03 Jun 1990</td>
                                        </tr>
                                        <tr>
                                            <td>Review Finalized Date</td>
                                            <td>:</td>
                                            <td>03 Jun 1990</td>
                                        </tr>
                                        <tr>
                                            <td>Final Validation date</td>
                                            <td>:</td>
                                            <td><span class="db-done">03 Jun 1990</span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
				<!-----------------------end editor------------------>
				<div class="col-md-12 tab-pane fade"  id="reviewer1" style="background-color: rgba(138, 109, 59, 0.17);">
				
				<div class="container">
					<h3 class=" text-center">Comment Section</h3>
					<div class="messaging">
						  <div class="inbox_msg">
							<div class="mesgs">
							  <div class="msg_history">
							   <?php foreach($static_ques_data as $key=>$val) { ?>
							     <div class="comment1">	
								 <form  method="POST"  action="#">
									<input type='hidden' name='ques_command_user_id'  value="<?php echo $user_id; ?>" />
									<input type='hidden' name='ques_id'  value="<?php echo $val->question_id; ?>" />
									<input type='hidden' name='ques_command_journal_id' id="ques_journal_id" value="<?php echo $journal_id; ?>" />
									<input type='hidden' name='ques_command_role_id' value="0" />
									<div class="incoming_msg">
									  <div class="incoming_msg_img"><p>Q & A </p></div>
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
									<div class="type_msg">
									<div class="input_msg_write">
									  <input type="text" class="write_msg" name="new_answer" value="" colmn="4" placeholder="Type a message" />
									  <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
									</div>
								  </div>
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
				<!-----------------------reviewer1------------------>
				
					<div class="col-md-12 tab-pane fade"  id="reviewer2" style="background-color: rgba(138, 109, 59, 0.17);">
				
				<div class="container">
					<h3 class=" text-center">Comment Section</h3>
					<div class="messaging">
						  <div class="inbox_msg">
							<div class="mesgs">
							  <div class="msg_history">
							   <?php foreach($static_ques_data as $key=>$val) { ?>
							     <div class="comment1">	
								 <form  method="POST"  action="#">
									<input type='hidden' name='ques_command_user_id'  value="<?php echo $user_id; ?>" />
									<input type='hidden' name='ques_id'  value="<?php echo $val->question_id; ?>" />
									<input type='hidden' name='ques_command_journal_id' id="ques_journal_id" value="<?php echo $journal_id; ?>" />
									<input type='hidden' name='ques_command_role_id' value="0" />
									<div class="incoming_msg">
									  <div class="incoming_msg_img"><p>Q & A </p></div>
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
									<div class="type_msg">
									<div class="input_msg_write">
									  <input type="text" class="write_msg" name="new_answer" value="" colmn="4" placeholder="Type a message" />
									  <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
									</div>
								  </div>
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
            </div>
			</div>
        </div>
    </section>
    <!--SECTION END-->
	

    <!--SECTION START-->
    <section>
        <div class="full-bot-book">
            <div class="container">
                <div class="row">
                    <div class="bot-book">
                        <div class="col-md-2 bb-img">
                            <img src="images/3.png" alt="">
                        </div>
                        <div class="col-md-7 bb-text">
                           
                            <p>Original Research Articles related to Agriculture, Horticulture, Forestry, Agricultural Engineering, Food Processing, Home Science, Environmental Science, Biotechnology, Sericulture, Agricultural Economics, Agricultural Extension, Agri-Business Management, Agricultural Bioinformatics and related fields are invited for the publication in the Madras Agric. J., Vol.106 March, 2019 issue.</p>
                        </div>
                        <div class="col-md-3 bb-link">
                            <a >Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
    <!--SECTION END-->
 <?php include 'footer.php';?>