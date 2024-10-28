 <?php
if(empty($_SESSION['user_id'])) {
    header('Location:index.php');
}
include 'journal_details.php';

$select_com=0;
?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>Welcome to Madras Agriculture Journal</title>
     <!-- META TAGS -->
     <meta charset="utf-8">

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
     <link href="css/style.css" rel="stylesheet" />
     <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
     <link href="css/style-mob.css" rel="stylesheet" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
     <link rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
     <!--dashboard_stud-->
     <style>
         .pro-user {
             position: relative;
             margin-top: -10px;
             box-shadow: 0px 5px 18px -11px rgba(150, 150, 150, 0.8);
             border: 1px solid #f3f2f2;
             border-bottom: 0px;
             z-index: 9;
         }

         .udb-sec {
             position: relative;
             overflow: hidden;
             margin-top: 0px;
             margin-bottom: 35px;
             background: #fff;
             padding: 25px;
             border-radius: 2px;
             box-shadow: 0px 5px 18px -11px rgba(150, 150, 150, 0.8);
             border: 1px solid #f3f2f2;
         }

         ol.progtrckr {
             margin: 0;
             padding: 0;
             list-style-type: none;
         }

         ol.progtrckr li {
             display: inline-block;
             text-align: center;
             line-height: 3.5em;
         }

         ol.progtrckr[data-progtrckr-steps="2"] li {
             width: 49%;
         }

         ol.progtrckr[data-progtrckr-steps="3"] li {
             width: 33%;
         }

         ol.progtrckr[data-progtrckr-steps="4"] li {
             width: 24%;
         }

         /*ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }*/
         ol.progtrckr[data-progtrckr-steps="6"] li {
             width: 16%;
         }

         ol.progtrckr[data-progtrckr-steps="7"] li {
             width: 14%;
         }

         ol.progtrckr[data-progtrckr-steps="8"] li {
             width: 12%;
         }

         ol.progtrckr[data-progtrckr-steps="9"] li {
             width: 11%;
         }

         ol.progtrckr li.progtrckr-done {
             color: black;
             border-bottom: 4px solid yellowgreen;
         }

         ol.progtrckr li.progtrckr-todo {
             color: silver;
             border-bottom: 4px solid silver;
         }

         ol.progtrckr li:after {
             content: "\00a0\00a0";
         }

         ol.progtrckr li:before {
             position: relative;
             bottom: -2.5em;
             float: left;
             left: 50%;
             line-height: 1em;
         }

         ol.progtrckr li.progtrckr-done:before {
             content: "\2713";
             color: white;
             background-color: yellowgreen;
             height: 2.2em;
             width: 2.2em;
             line-height: 2.2em;
             border: none;
             border-radius: 2.2em;
         }

         ol.progtrckr li.progtrckr-todo:before {
             content: "\039F";
             color: silver;
             background-color: white;
             font-size: 2.2em;
             bottom: -1.2em;
         }
     </style>
 </head>

 <body>
     <!--HEADER SECTION-->
     <?php include 'header.php';?>
     <!--END HEADER SECTION-->
     <!--SECTION START-->
     <section>
         <div class="pro-menu">
             <div class="container">
                 <div class="col-md-9 col-md-offset-3">
                     <ul>
                         <li><a class="tablinks active" onclick="openCity(event, 'dashboard_stud')" id="defaultOpen">My
                                 Dashboard</a></li>
                         <li><a class="tablinks " onclick="openCity(event, 'pro_file_stud')">Profile</a></li>
                         <!--<li><a class="tablinks" onclick="openCity(event, 'my_inbox_stud')">My Inbox</a></li>-->
                         <li><a class="tablinks" onclick="openCity(event, 'sub_papers_stud')">Submit Papers</a></li>
                         <!--<li><a class="tablinks" onclick="openCity(event, 'resub_papers_stud')">Paper ReSubmission</a></li>-->
                         <li><a class="tablinks" onclick="openCity(event, 'status_bar_stud')">Status</a></li>
                         <!--<li><a id='notification_checking_but' class="tablinks" onclick="openCity(event, 'notification_stud')">Notifications <span class='badge badge-light' id='notification_count'></span></a></li>-->
                     </ul>
                 </div>
             </div>
         </div>
         <div class="stu-db">
             <div class="container pg-inn">
                 <?php if(!empty($_SESSION['journal_submission_msg'])) {
                     foreach($_SESSION['journal_submission_msg'] as $key=>$val) { ?>
                 <div class="alert alert-success" id="success-alert">
                     <button type="button" class="close" data-dismiss="alert">x</button>
                     <strong><?php echo $val; ?></strong>
                 </div>
                 <?php }
                     } $_SESSION['journal_submission_msg']=array();?>
                 <div class="col-md-3">
                     <!--<div class="pro-user">
                        <img src="images/user.jpg" alt="user">
                    </div>-->
                     <div class="pro-user-bio"
                         style="background: #2f4f73;border: 1px solid #c0c8d1;    box-shadow: 0px 10px 16px -8px rgba(150,150,150,0.8);">
                         <ul>
                             <li>
                                 <h4 style="color:white">
                                     <?php echo $user_details[0]->first_name.' '.$user_details[0]->last_name; ?>
                                 </h4>
                             </li>
                             <li style="color:white">Student Id :
                                 STU<?php echo $user_details[0]->user_id; ?>
                             </li>
                             <div class="">
                                 <!--<a ><img src="images/logo.png" alt="" style="width: 94px;">
									</a>-->
                                 <!--<p style="text-align:justify"> Madras Agricultural Students Union (MASU) started in the year 1911 was registered as a Society during 1923 (Registration No.1/1923 -24)</p>-->

                             </div>
                         </ul>
                     </div>
                 </div>
                 <div class="tabcontent col-md-9" id="pro_file_stud">
                     <div class="udb">
                         <form id='student_edit_form' method="POST" action="backend.php">
                             <input type="hidden" name='student_edit_profile_id'
                                 value="<?php  echo $user_details[0]->user_id; ?>" />
                             <input type="hidden" name='edit_profile' value="db-profile.php" />
                             <div class="udb-sec udb-prof">
                                 <h4><img src="images/icon/db1.png" alt="" /> My Profile</h4>
                                 <div class="sdb-tabl-com sdb-pro-table">
                                     <table class="responsive-table bordered">
                                         <tbody>
                                             <tr>
                                                 <th>Student Name</th>
                                                 <th>:</th>
                                                 <!--<td class="edit_td"><?php echo $user_details[0]->first_name.' '.$user_details[0]->last_name; ?>
                                                 </td>-->
                                                 <td><?php echo $user_details[0]->user_instutename; ?>
                                                 </td>
                                                 <!--<td class="edit_field"><input type="text" name="edit_stu_name" value="<?php  echo $user_details[0]->first_name; ?>"
                                                 id="edit_stu_name"></td>-->
                                             </tr>
                                             <tr>
                                                 <th>Student Id</th>
                                                 <th>:</th>
                                                 <td>STU<?php echo $user_details[0]->user_id; ?>
                                                 </td>
                                                 <!--<td class="edit_td"><?php  echo $user_details[0]->stud_id; ?>
                                                 </td>
                                                 <td class="edit_field"><input type="text" name="edit_stu_id"
                                                         value="<?php  echo $user_details[0]->stud_id; ?>"
                                                         id="edit_stu_id"></td>-->
                                             </tr>
                                             <tr>
                                                 <th>Email</th>
                                                 <th>:</th>
                                                 <td class="edit_td">
                                                     <?php echo $user_details[0]->user_email; ?>
                                                 </td>
                                                 <td class="edit_field"><input type="email" name="edit_stu_mail"
                                                         value="<?php echo $user_details[0]->user_email; ?>"
                                                         id="edit_stu_mail" /></td>
                                             </tr>
                                             <tr>
                                                 <th>Phone</th>
                                                 <th>:</th>
                                                 <td class="edit_td">
                                                     <?php  echo $user_details[0]->user_contact;  ?>
                                                 </td>
                                                 <td class="edit_field"><input name="edit_stu_contact" type="number"
                                                         maxlength="10" minlength="10"
                                                         value="<?php echo $user_details[0]->user_contact; ?>"
                                                         id="edit_stu_contact" /></td>
                                             </tr>
                                             <!-- <tr>
                                            <th>Age</th>
                                            <th>:</th>
                                            <td class="edit_td"><?php  echo $user_details[0]->age;  ?>
                                             </td>
                                             <td class="edit_field"><input name="edit_stu_age" type="number"
                                                     maxlength="2"
                                                     value="<?php echo $user_details[0]->age; ?>"
                                                     id="edit_stu_age" /></td>
                                             </tr>-->
                                             <!--<tr>
                                            <th>Address</th>
                                            <th>:</th>
                                            <td class="edit_td"><?php  echo $user_details[0]->user_address;  ?>
                                             </td>
                                             <td class="edit_field"><textarea name="edit_stu_address"
                                                     id="edit_stu_address" cols=2
                                                     rows=2><?php echo $user_details[0]->user_address; ?></textarea>
                                             </td>
                                             </tr>-->
                                             <tr>
                                                 <th>Status</th>
                                                 <th>:</th>
                                                 <td><span
                                                         class="db-done"><?php echo($user_details[0]->status==0 ? 'Active' : 'Inactive');?></span>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>

                                     <!--<div class="sdb-bot-edit">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
									<button type='button' class="btn btn-info" id="edit_stu_edit"><span class="glyphicon glyphicon-edit"></span>Edit my profile</button>
                                 <button type='button' class="btn btn-success" id="edit_stu_save"><span class="glyphicon glyphicon-save"></span>Save</button>
                                 <button type='button' class="btn btn-info" id="edit_stu_cancel"><span class="glyphicon glyphicon-save"></span>Cancel</button>
                                 
                                    <!--<a href="#" class="waves-effect waves-light btn-large sdb-btn sdb-btn-edit"><i class="fa fa-pencil"></i> Edit my profile</a>
                                </div>-->
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
                 <!----First Paper-------->
                 <div class="tabcontent col-md-9" id="dashboard_stud"
                     style="display: block;padding: 0px 12px;border: 0.5px solid #fbfbfb;">
                     <div class="udb">

                         <?php if(count($journal_total_detail_array)>0) {
                             foreach($journal_total_detail_array as $key=>$val) {?>
                         <div class="udb-sec udb-prof">

                             <a class="tablinks "
                                 onclick="openCity(event, '<?php echo $val[0]->journal_id; ?>')">
                                 <h4 style="border-bottom: 1px solid #c4c4c5;">
                                     <b><?php echo $val[0]->title; ?></b>
                                 </h4>
                             </a>
                             <p><b>Author:
                                 </b><?php echo $val[0]->author_name; ?><b
                                     style="cursor: pointer;">&nbsp Co Author: </b><?php
                                        $lastElement = end($val[2]);
                                 foreach($val[2] as $autkey=>$authval) {
                                     if($authval==$lastElement) {
                                         echo $authval->author_name.'.';
                                     } else {
                                         echo $authval->author_name.',';
                                     }
                                 }
                                 ?></p>
                             <span><b>Subject</b>:<?php echo $val[0]->subject; ?></span>
                             <div class="pg-eve-reg">
                                 <a
                                     href="<?php echo 'paperview.php?journal_view_id='.$val[0]->journal_id.'&'.'journal_forum=forum'; ?>">Review
                                     Forum</a>
                                 <a
                                     href="<?php echo 'journal_view.php?journal_view_id='.$val[0]->journal_id.'&'.'user_id='.$val[0]->user_id.'&'.'year='.$val[1]['year'].'&'.'journal_path='.$val[1]['journal_path']; ?>">View</a>
                                 <!--<a href="" class="resub" journal_id = "<?php echo $val[0]->journal_id; ?>">Resubmission</a>-->

                             </div>
                         </div>
                         <hr>
                         <?php }
                             } ?>
                     </div>
                 </div>
                 <!----my_inbox-------->
                 <div class="tabcontent col-md-9" id="my_inbox_stud">
                     <div class="udb">
                         <div class="udb-sec udb-prof">
                             <h4><img src="images/icon/db1.png" alt="" /> Myinbox</h4>
                             <p>notification msg enabled</p>
                         </div>
                     </div>
                 </div>
                 <!----submit-------->
                 <div class="tabcontent col-md-9" id="sub_papers_stud">
                     <div class="udb">
                         <div class="udb-sec udb-prof">
                             <div class="box-inn-sp admin-form">
                                 <h4>Add Papers</h4>
                                 <div class="tab-inn">
                                     <form id='journal_submit_form' method="POST" action="backend.php"
                                         enctype="multipart/form-data">
                                         <input type="hidden" name='student_submit_profile_id'
                                             value="<?php  echo $user_details[0]->user_id; ?>" />
                                         <input type="hidden" name='journal_submit' value="db-profile.php" />
                                         <div class="row" id="resub_sub">
                                             <div class="input-field col s6 formhide" id="resub_sub">
                                                 <h5>Subject:</h5>
                                                 <select name="subject" id='journal_subject' name="journal_subject">
                                                     <option value="Agriculture" selected>Agriculture</option>
                                                     <option value="Horticulture">Horticulture</option>
                                                     <option value="Agriculture Engineering">Agriculture Engineering
                                                     </option>
                                                     <option value="Foof Science">Foof Science</option>
                                                     <option value="Sericulture">Sericulture</option>
                                                 </select>
                                             </div>
                                             <div class="input-field col s6 formhide" id="resub_artticle">
                                                 <h5>Article Type:<h5>
                                                         <select name="arttype" id='journal_type' name="journal_type">
                                                             <option value="Review Article">Review Article</option>
                                                             <option value="Conference Paper">Conference Paper</option>
                                                             <option value="Original Research">Original Research
                                                             </option>
                                                         </select>
                                             </div>
                                         </div>
                                         <div class="row" id="resub_title">
                                             <h5>Title:</h5>
                                             <div class="input-field col s12 formhide">
                                                 <input type="text" id="journal_title" name="journal_title" value=""
                                                     placeholder="Title" class="validate">
                                             </div>
                                         </div>
                                         <h5>Author Details:</h5>
                                         <div class="row" id="resub_detail">
                                             <div class="input-field col s6 formhide">
                                                 <input type="text" id="journal_author" name="journal_author" value=""
                                                     placeholder="Author name" class="validate">

                                             </div>
                                             <div class="input-field col s6 formhide">
                                                 <select name="coauthor[]" id="journal_coauthor" multiple="multiple"
                                                     multiple searchable="Search here..">
                                                     <option value="0">Add co-author name</option>
                                                     <?php if($author_data->num_rows > 0) {
                                                         foreach($author_data->rows as $key=>$val) { ?>
                                                     <option
                                                         value="<?php echo $val->author_id; ?>">
                                                         <?php echo $val->author_name; ?>
                                                     </option>
                                                     <?php }
                                                         } ?>
                                                 </select>

                                             </div>
                                         </div>

                                         <div class="row formhide" id="id4">
                                             <!--<div class="file-field input-field col s6" id="resub_img" >
												<div class="btn admin-upload-btn">
													<span>File</span>
													<input type="file" id="journal_img" name="journal_img">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" id="journal_img_placeholder" name="journal_img_name" type="text" placeholder="Profile image">
												</div>
											</div>-->
                                             <h5>Journal File:</h5>
                                             <div class="file-field input-field col s6" id="resub_file">
                                                 <div class="btn admin-upload-btn">
                                                     <span>File</span>
                                                     <input type="file" id="journal_file" name="journal_file">
                                                 </div>
                                                 <div class="file-path-wrapper">
                                                     <input class="file-path validate" id="journal_file_placeholder"
                                                         name="journal_file_name" type="text"
                                                         placeholder="Upload Journal File">
                                                 </div>
                                                 <p>Note:(doc,docs,only Can upload )</p>
                                             </div>

                                             <!--<div class="input-field col s6" id="resub_select" style="display: none">
											     <select name="resubmit_journal_id" id="resubmit_paper"  class="form-control">
														<option value="">--SELECT---</option>
													<?php foreach($journal_total_detail_array as $jkey=>$jval) { ?>

                                             <option
                                                 value="<?php echo $jval[0]->journal_id; ?>">
                                                 <?php echo $jval[0]->title; ?>
                                             </option>
                                             <?php } ?>
                                             </select>
                                         </div>-->
                                 </div>
                                 <!--<input type="checkbox" name="resubmit_check" value="" id=""><label for="resubmit_check"> <a href="">I Agree Terms and condition</a></label>-->
                                 <!--<input type="checkbox" name="resubmit_check" value="" id="resubmit_check"><label for="resubmit_check"> Resubmit</label>-->
                                 <div class="row">
                                     <div class="input-field col s12">
                                         <i class="waves-effect waves-light btn-large waves-input-wrapper" style="">
                                             <button type="button" id="journal_submit" name="journal_submit_but"
                                                 class="btn">Submit</button></i>
                                     </div>
                                 </div>
                                 </form>
                                 <hr />
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!----resubmit-------->
             <div class="tabcontent col-md-9" id="resub_papers_stud"
                 style="border: 1px solid #ffffff;padding: 0px 12px;">
                 <div class="udb">
                     <div class="udb-sec udb-prof">
                         <div class="box-inn-sp admin-form">
                             <h4>Papers Resubmittion</h4>
                             <div class="tab-inn">
                                 <form id='journal_submit_form1' method="POST" action="backend.php"
                                     enctype="multipart/form-data">
                                     <input type="hidden" name='student_submit_profile_id'
                                         value="<?php  echo $user_details[0]->user_id; ?>" />
                                     <input type="hidden" name='journal_submit' value="db-profile.php" />
                                     <div class="row" id="resub_sub">
                                         <div class="input-field col s6 formhide" id="resub_sub">
                                             <h5>Subject:</h5>
                                             <select name="subject" id='journal_subject' name="journal_subject"
                                                 class="form-control">
                                                 <option value="Agriculture" selected>Agriculture</option>
                                                 <option value="Horticulture">Horticulture</option>
                                                 <option value="Agriculture Engineering">Agriculture Engineering
                                                 </option>
                                                 <option value="Foof Science">Foof Science</option>
                                                 <option value="Sericulture">Sericulture</option>
                                             </select>
                                         </div>
                                         <div class="input-field col s6 formhide" id="resub_artticle">
                                             <h5>Article Type:<h5>
                                                     <select name="arttype" id='journal_type' name="journal_type"
                                                         class="form-control">
                                                         <option value="Review Article">Review Article</option>
                                                         <option value="Conference Paper">Conference Paper</option>
                                                         <option value="Original Research">Original Research</option>
                                                     </select>
                                         </div>
                                     </div>

                                     <div class="row" id="resub_title">
                                         <h5>Title:</h5>
                                         <div class="input-field col s12 formhide">
                                             <input type="text" id="journal_title" name="journal_title" value=""
                                                 placeholder="Title" class="validate">

                                         </div>
                                     </div>
                                     <!--<h5>Author Details:</h5>
                                        <div class="row" id="resub_detail">
                                            <div class="input-field col s6 formhide">
                                               <input type="text" id="journal_author" name="journal_author" value="" placeholder="Author name" class="validate">
                                             
                                            </div>
                                            <div class="input-field col s6 formhide">
											    <select name="coauthor[]" id="journal_coauthor"  multiple="multiple" class="form-control selectpicker mdb-select md-form colorful-select dropdown-primary" multiple searchable="Search here..">
												    <option value="0">Add co-author name</option>
													<?php if($author_data->num_rows > 0) {
													    foreach($author_data->rows as $key=>$val) { ?>
                                     <option
                                         value="<?php echo $val->author_id; ?>">
                                         <?php echo $val->author_name; ?>
                                     </option>
                                     <?php }
													    } ?>
                                     </select>

                             </div>
                         </div>-->
                         <h5>Images:</h5>
                         <div class="row formhide" id="id4">
                             <div class="file-field input-field col s6" id="resub_img">
                                 <div class="btn admin-upload-btn">
                                     <span>File</span>
                                     <input type="file" id="journal_img" name="journal_img">
                                 </div>
                                 <div class="file-path-wrapper">
                                     <input class="file-path validate" id="journal_img_placeholder"
                                         name="journal_img_name" type="text" placeholder="Profile image">
                                 </div>
                             </div>
                             <div class="file-field input-field col s6" id="resub_file">
                                 <div class="btn admin-upload-btn">
                                     <span>File</span>
                                     <input type="file" id="journal_file" name="journal_file">
                                 </div>
                                 <div class="file-path-wrapper">
                                     <input class="file-path validate" id="journal_file_placeholder"
                                         name="journal_file_name" type="text" placeholder="Upload Journal File">
                                 </div>
                                 <p>Note:(Can upload .doc,.docx,.pdf,.latex only allowed)</p>
                             </div>

                             <!--<div class="input-field col s6" id="resub_select" style="display: none">
											     <select name="resubmit_journal_id" id="resubmit_paper"  class="form-control">
														<option value="">--SELECT---</option>
													<?php foreach($journal_total_detail_array as $jkey=>$jval) { ?>

                             <option
                                 value="<?php echo $jval[0]->journal_id; ?>">
                                 <?php echo $jval[0]->title; ?>
                             </option>
                             <?php } ?>
                             </select>
                         </div>-->
                     </div>
                     <input type="checkbox" name="resubmit_check" value="" id=""><label for="resubmit_check"> <a
                             href="">I Agree Terms and condition</a></label>
                     <!--<input type="checkbox" name="resubmit_check" value="" id="resubmit_check"><label for="resubmit_check"> Resubmit</label>-->
                     <div class="row">
                         <div class="input-field col s12">
                             <i class="waves-effect waves-light btn-large waves-input-wrapper" style="">
                                 <button type="button" id="journal_submit1" name="journal_submit_but"
                                     class="btn">Submit</button></i>
                         </div>
                     </div>
                     </form>

                     <hr />


                 </div>
             </div>
         </div>
         </div>
         </div>
         <!---------status bar----->
         <div class="tabcontent col-md-9" id="status_bar_stud">
             <div class="udb">
                 <div class="udb-sec udb-prof">
                     <h4><img src="images/icon/db1.png" alt="" /> Status</h4>
                     <ol class="progtrckr" data-progtrckr-steps="5">
                         <li class="progtrckr-done">View Submission</li>
                         <li class="progtrckr-done">Quality Check</li>
                         <li class="progtrckr-done">Edit Submission</li>
                         <li class="progtrckr-todo">Delete Submission</li>
                         <li class="progtrckr-todo">Aprove Submission</li>
                     </ol>
                 </div>
             </div>
         </div>
         <!---------status bar end----->
         <!---------status bar----->
         <!--	<?php foreach($journal_total_detail_array as $key=>$val) { ?>
         <div class="tabcontent col-md-9"
             id="<?php echo $val[0]->journal_id; ?>">
             <div class="col-sm-12 col-md-12">
                 <div class="udb-sec udb-prof">
                     <h4><img src="images/icon/db1.png"
                             alt="" /><?php echo $val[0]->title; ?>
                     </h4>
                     <tbody>
                         <tr>
                             <th>Status</th>
                             <th>:</th>
                             <?php if($val[1]['correction_level']!=0 && $val[1]['is_published']==0 && $val[1]['is_rejected']==0) { ?>
                             <th>Under Review</th>
                             <?php } elseif($val[1]['is_published']==1 && $val[1]['is_rejected']==0) { ?>
                             <th>Publish </th>
                             <?php } elseif($val[1]['is_published']==0 && $val[1]['is_rejected']==1) { ?>
                             <th>Rejected </th>
                             <?php } elseif($val[1]['is_published']==0 && $val[1]['is_rejected']==0 && $val[1]['is_author_reviewed']==1 && $val[1]['correction_level']==0) { ?>
                             <th>Author Review</th>
                             <?php } ?>
                         </tr>
                     </tbody>
                 </div>
                 <h4><img src="images/icon/db1.png" alt="" />Chief Editor Comments</h4>
                 <?php if(count($val['enable_comments'])>0 && $val[1]['is_command_can_enable']==0) { ?>
                 <?php foreach($val['enable_comments'] as $ckey=>$cval) {
                     if($cval->is_select_command > 0) {
                         $select_com=1;
                         $myArray = explode('/', $cval->comments);
                                            
                         ?>
                 <div class="col-sm-12 col-md-12" style="margin-top: 83px;">
                     <form>
                         <input type="hidden" name='student_edit_profile_id'
                             value="<?php  echo $user_details[0]->user_id; ?>" />
                         <input type="hidden" name='edit_profile' value="db-profile.php" />
                         <div class="udb-sec udb-prof">
                             <h4><img src="images/icon/db1.png" alt="" />Paper Comments</h4>

                             <div class="sdb-tabl-com sdb-pro-table">
                                 <table class="responsive-table bordered">
                                     <tbody>
                                         <?php foreach($myArray as $mkey=>$mval) {
                                             $table_head_val = explode(':', $mval);
                                             ?>
                                         <tr>
                                             <th><?php if(isset($table_head_val[0]) && $table_head_val[0]!="") {
                                                 echo $table_head_val[0];
                                             } ?>
                                             </th>
                                             <th>:</th>
                                             <th><?php if(isset($table_head_val[0]) && $table_head_val[0]!="") {
                                                 echo $table_head_val[1];
                                             } ?>
                                             </th>
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
                 <?php }
                     }
                 }?>
                 <?php if($select_com==0) { ?>
                 <div class="col-md-12"><br><br><br>
                     <?php } else { ?>
                     <div class="col-md-12" style="overflow-x: hidden;;height: 200px;">
                         <?php } ?>
                         <h4>Comments:</h4>
                         <?php if(count($val['enable_comments'])>0 && $val[1]['is_command_can_enable']==0) { ?>
                         <ul class="commentList">
                             <?php foreach($val['enable_comments'] as $key1=>$val1) {
                                 if($val1->is_select_command ==0) {?>
                             <li>
                                 <div class="commenterImage">
                                     <img src="images/adv/header_icon.png" />
                                 </div>
                                 <div class="commentText">
                                     <h3 class="">
                                         <?php echo $val1->admin_name; ?>
                                     </h3>
                                     <p class="">
                                         <?php echo $val1->comments; ?>
                                     </p>
                                     <span class="date sub-text">
                                         <?php echo date('M Y', strtotime(".$val1->created_date.")); ?>
                                     </span>
                                 </div>
                             </li>
                         </ul>
                         <?php }
                                 }
                         } else { ?>
                         <div class='col-xs-12'>
                             <h2>No Comments Yet ! </h2>
                         </div>
                         <?php } ?>
                         <?php if(count($val['enable_comments'])>0 && $val[1]['is_command_can_enable']==0) { ?>
                         <form
                             id='journal_resubmit_form<?php echo $val[0]->journal_id; ?>'
                             method="POST" action="backend.php" enctype="multipart/form-data">
                             <h5>Resubmit:</h5>

                             <div class="row formhide" id="id4">
                                 <div class="file-field input-field col s6">
                                     <div class="btn admin-upload-btn">
                                         <span>File</span>
                                         <input type="file"
                                             id="rejournal_file<?php echo $val[0]->journal_id; ?>"
                                             name="journal_file">
                                     </div>

                                     <div class="file-path-wrapper">
                                         <input class="file-path validate"
                                             id="journal_file_placeholder<?php echo $val[0]->journal_id; ?>"
                                             name="journal_file_name" type="text" placeholder="Upload Journal File">
                                     </div>
                                     <p>Note:( doc,.docs, only Can upload)</p>
                                 </div>
                                 <input type="hidden" name='student_submit_profile_id'
                                     value="<?php  echo $user_details[0]->user_id; ?>" />
                                 <input type="hidden" name='journal_submit' value="db-profile.php" />
                                 <input type="hidden" name='sub_journal'
                                     value='<?php echo $val[0]->journal_id; ?>'
                                     value="db-profile.php" />
                                 <input type="hidden"
                                     id='is_resubmit<?php echo $val[0]->journal_id; ?>'
                                     name='is_resubmit' value="0" />
                                 <div class="input-field col s6" id="resub_select">
                                     <select name="resubmit_journal_id"
                                         id="resubmit_paper<?php echo $val[0]->journal_id; ?>"
                                         class="form-control">
                                         <option value="">SELECT YOUR OLD JOURNAL</option>
                                         <?php foreach($journal_total_detail_array as $jkey=>$jval) {
                                             if($jval[0]->journal_id==$val[0]->journal_id) { ?>

                                         <option
                                             value="<?php echo $jval[0]->journal_id; ?>">
                                             <?php echo $jval[0]->title; ?>
                                         </option>
                                         <?php }
                                             } ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="input-field col s12">
                                     <i class="waves-effect waves-light btn-large waves-input-wrapper" style="">
                                         <button type="button" class="journal_resubmit"
                                             id="<?php echo $val[0]->journal_id; ?>"
                                             name="journal_submit_but" class="btn">Submit</button></i>
                                 </div>
                             </div>
                         </form>
                         <?php } ?>
                         <?php if($select_com==0) { ?>
                     </div>
                     <?php } else { ?>
                 </div>
                 <?php } ?>
             </div>
         </div>
         <?php } ?>-->
         <!----notification---->
         <div class="tabcontent col-md-9" id="notification_stud">
             <div class="udb">
                 <div class="udb-sec udb-prof">
                     <h4><img src="images/icon/db1.png" alt="" /> Notification</span></h4>
                     <div class="detailBox">
                         <div class="titleBox">
                             <label>Notification Info</label>

                         </div>

                         <div class="actionBox">
                             <!-- <ul id="notifications_ul" class="commentList">
                                        <li>
                                            <div class="commenterImage">
                                              <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                <p class=""><a href=""><b>Chief Editor</b> Assigned to your Paper</a></p> <span class="date sub-text">on March 5th, 2014</span>
                            
                                            </div>
                                        </li>
                                        <li>
                                            <div class="commenterImage">
                                              <img src="images/adv/header_icon.png" />
                                            </div>
                                            <div class="commentText">
                                                 <p class=""><a href=""><b>Associate  Editor</b> Command on your Paper</a></p> <span class="date sub-text">on March 5th, 2014</span>
                            
                                            </div>
                                        </li>
                                     
                                       
                                    </ul>-->

                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
         </div>
     </section>
     <!--SECTION END-->


     <!--SECTION START-->
     <!---<section>
        <div class="full-bot-book">
            <div class="container">
                <div class="row">
                    <div class="bot-book">
                        <div class="col-md-2 bb-img">
                            <img src="images/3.png" alt="">
                        </div>
                        <div class="col-md-7 bb-text">
                            <h4>therefore always free from repetition</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                        </div>
                        <div class="col-md-3 bb-link">
                            <a href="">Book This Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
     <!--SECTION END-->

     <!--HEADER SECTION-->
     <section>
         <div class="full-bot-book">
             <div class="container">
                 <div class="row">
                     <div class="bot-book">
                         <div class="col-md-2 bb-img">
                             <img src="images/3.png" alt="">
                         </div>
                         <div class="col-md-7 bb-text">

                             <h3 style="color:#fff;"> Madras Agricultural Journal Vol.106(10-12) December, 2019 issue.
                             </h3>
                             <p>Original Research Articles related to
                             <div class="col-md-4 foot-tc-mar-t-o">
                                 <ul>
                                     <li><i class="fa fa-angle-double-right"></i> Agriculture </li>
                                     <li><i class="fa fa-angle-double-right"></i> Forestry</li>
                                     <li><i class="fa fa-angle-double-right"></i> Agricultural Engineering</li>
                                     <li><i class="fa fa-angle-double-right"></i> Sericulture</li>
                                     <li><i class="fa fa-angle-double-right"></i> Agricultural Economics</li>
                                 </ul>
                             </div>

                             <div class="col-md-4">
                                 <ul>
                                     <li><i class="fa fa-angle-double-right"></i> Food Processing</li>
                                     <li><i class="fa fa-angle-double-right"></i> Environmental Science</li>
                                     <li><i class="fa fa-angle-double-right"></i> Agricultural Extension</li>
                                     <li><i class="fa fa-angle-double-right"></i> Agri-Business Management</li>
                                     <li><i class="fa fa-angle-double-right"></i> Biotechnology</li>
                                 </ul>
                             </div>
                             <div class="col-md-4">
                                 <ul>
                                     <li><i class="fa fa-angle-double-right"></i> Home Science</li>
                                     <li><i class="fa fa-angle-double-right"></i> Agricultural Bioinformatics</li>
                                     <li><i class="fa fa-angle-double-right"></i> Horticulture</li>
                                     <li><i class="fa fa-angle-double-right"></i> Home Science</li>
                                 </ul>
                             </div>

                             </p>
                         </div>
                         <!--<div class="col-md-3 bb-link">
                            <a href="">Submit Now</a>
                        </div>-->
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <?php include 'footer.php';?>

     <!--Import jQuery before materialize.js-->
     <script src="js/main.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/materialize.min.js"></script>
     <script src="js/custom.js"></script>
     <script>
         $('select').selectdatepicker();
     </script>


 </body>

 </html>