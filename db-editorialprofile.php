<?php 
include 'connection.php';
include 'db.php';
session_start();
$user_id=$_SESSION['user_id'];
$user_ins_name=$_SESSION['user_ins_name'];
$user_email=$_SESSION['user_email'];
$sql="SELECT * FROM  tbl_user where user_id=".$user_id;
$user_data=$db->query($sql);
$user_details=$user_data->rows;
//print_r($user_details);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to Madras Agriculture Journal</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
  
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
	.pro-user {
    position: relative;
    margin-top: -10px;
    box-shadow: 0px 5px 18px -11px rgba(150,150,150,0.8);
    border: 1px solid #f3f2f2;
    border-bottom: 0px;
    z-index: 9;
}
.udb-sec {
    position: relative;
    overflow: hidden;
    margin-top: -66px;
    margin-bottom: 35px;
    background: #fff;
    padding: 25px;
    border-radius: 2px;
    box-shadow: 0px 5px 18px -11px rgba(150,150,150,0.8);
    border: 1px solid #f3f2f2;
}
#save{
  display: none;
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
                        <li><a class="tablinks active" onclick="openCity(event, 'dashboard_edit')" id="defaultOpen">My Dashboard</a></li>
                        <li><a class="tablinks" onclick="openCity(event, 'pro_file_edit')">Profile</a></li>
                        <li><a class="tablinks" onclick="openCity(event, 'my_inbox_edit')">My Inbox</a></li>
                        <li><a class="tablinks" onclick="openCity(event, 'sub_papers_edit')">Submit Papers</a></li>
                        <li><a  class="tablinks" onclick="openCity(event, 'status_bar_edit')">Status</a></li>
                        <li><a class="tablinks" onclick="openCity(event, 'notification_edit')">Notifications</a></li>
                   </ul>
                </div>
            </div>
        </div>
        <div class="stu-db">
            <div class="container pg-inn">
                <div class="col-md-3">
                    <!--<div class="pro-user">
                        <img src="images/user.jpg" alt="user">
                    </div>-->
                    <div class="pro-user-bio">
                        <ul>
                            <li>
                                <h4><?php echo $user_details[0]->first_name.' '.$user_details[0]->last_name; ?></h4>
                            </li>
                            <li>Editorial Board: MASUEB<?php echo $user_details[0]->stud_id; ?></li>
                            <div class="">
								<!--<a href="index.html"><img src="images/logo.png" alt="" style="width: 94px;">
								</a>
								<p style="text-align:justify"> Madras Agricultural Students Union (MASU) started in the year 1911 was registered as a Society during 1923 (Registration No.1/1923 -24)</p>
								<a href="M-index.html">Read more</a>-->
                           </div>
                        </ul>
                    </div>
                </div>
               <div class="tabcontent col-md-9" id="pro_file_edit">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> My Profile</h4>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed
                                to using 'Content here, content here', making it look like readable English.</p>
                            <div class="sdb-tabl-com sdb-pro-table">
                                <table class="responsive-table bordered">
                                    <tbody>
                                        <tr>
                                            <th>Editorial Board Member Name</th>
                                            <th>:</th>
                                            <td><?php echo $user_details[0]->first_name.' '.$user_details[0]->last_name; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Editorial Board Id</th>
                                            <th>:</th>
                                            <td>MASUEB<?php echo $user_details[0]->stud_id; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th>:</th>
                                            <td><?php echo $user_details[0]->user_email; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>:</th>
                                            <td><?php  echo $user_details[0]->user_contact;  ?></td>
                                        </tr>
                                        <tr>
                                            <th>Date of birth</th>
                                            <th>:</th>
                                            <td><?php echo date('d M Y', strtotime($user_details[0]->date_of_birth)); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <th>:</th>
                                            <td><?php  echo $user_details[0]->user_address; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Position</th>
                                            <th>:</th>
                                            <td><span class="db-done"><?php  echo $user_details[0]->position; ?></span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="sdb-bot-edit">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>
                                    <button class="btn btn-info" id="edit"><span class="glyphicon glyphicon-edit"></span>Edit my profile</button>
                                 <button class="btn btn-success"id="save"><span class="glyphicon glyphicon-save"></span> save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				
				<div class="tabcontent col-md-9" id="dashboard_edit">
                    <div class="udb">

                        <!--<div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> <b>My manuscript tracking</b></h4>
							    <nav class="navbar navbar-expand-sm ">
									  <ul class="navbar-nav">
											<li class="nav-item">
											 <a class="nav-link"  style="font-size: 15px;color: rebeccapurple;">My Inbox</a>
											</li>
											<li class="nav-item">
											  <a class="nav-link"  style="font-size: 15px;color: rebeccapurple;">Reviews</a>
											</li>
											<li class="nav-item">
											  <a class="nav-link" href="#" style="font-size: 15px;color: rebeccapurple;">Editorial Assignment</a>
											</li>
									  </ul>
							    </nav>
									<br>
															 <hr>
                        
                        </div>-->
						
						  <!--<div class="udb-sec udb-prof" >
                            <h4><img src="images/icon/db1.png" alt="" /><b>ARTICLE</b></h4>
							<p><b>Lignin Depolymerization Route Derived Commodities Towards Tangible Bio-economy</p></b>
							<p><b>Author</b>:Ramasamy Kumarasamy, Sivakumar Uthandi and Sugitha Thangappan.</p>
							
                            <span><b>DOI</b>:10.29321/MAJ.2017.000046</span>
							 <div class="pg-eve-reg">
                                            <a href="#">View</a>
											
                                        </div>
                       
                        
                        </div><hr>
						  <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /><b>ARTICLE</b></h4>
							<p><b>Diversity of Coastal Vegetation along Cuddalore District of Tamil Nadu</p></b>
							 <p><b>Author</b>:M.P. Sugumaran and S. Avudainayagam</p>

                             <span><b>DOI</b>:10.29321/MAJ.2017.000047</span>
							 <div class="pg-eve-reg">
                                            <a href="#">View</a>
											
                                        </div>
                       
                        
                        </div>--><hr>
					
                    </div>
                </div>
				
				<!----my_inbox-------->
				<div class="tabcontent col-md-9" id="my_inbox_edit">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Myinbox</h4>
								<p>notification msg enabled</p>
                        </div>
                    </div>
                </div>
				
				<!----submit-------->
				<div class="tabcontent col-md-9" id="sub_papers_edit">
                     <div class="udb">
                        <div class="udb-sec udb-prof">
                            	<div class="box-inn-sp admin-form">
                               
                                    <h4>Add Papers</h4>
                                    
                               
                                <div class="tab-inn">
                                    <form>
									   
                                        <div class="row">
                                            <div class="input-field col s6">
											   <h5>Subject</h5>
                                                <select name="subject" id=''  class="form-control">
												  <option>Agriculture</option>
												  <option>Horticulture</option>
												  <option>Agriculture Engineering</option>
												  <option>Foof Science</option>
												  <option>Sericulture</option>
												 </select>
                                            </div>
                                            <div class="input-field col s6">
											    <h5>Article Type<h5>
                                                <select name="arttype" id='' class="form-control">
												  <option>Review Article</option>
												  <option>Conference Paper</option>
												  <option>Original Research</option>
												 </select>
                                            </div>
                                        </div>
                                     
										<h5>Title</h5>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input type="text" id="" value="" class="validate">
                                                <label class="">Enter The Label</label>
                                            </div>
                                           
                                        </div>
										<h5>Author Details:</h5>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <input type="password" id="" name="" value="author" class="validate">
                                                <label class="">Corresponding Author Name</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <input type="password" id="" value="" class="validate">
                                                <label class="">Add Co-author</label>
                                            </div>
                                        </div>
                                        <h5>Images:</h5>
                                        <div class="row">
											<div class="file-field input-field col s6">
												<div class="btn admin-upload-btn">
													<span>File</span>
													<input type="file" id="" name="filepath">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" id="" name="filepath" type="text" placeholder="Profile image">
												</div>
											</div>
											<div class="file-field input-field col s6">
												<div class="btn admin-upload-btn">
													<span>File</span>
													<input type="file" id="" name="imagefile">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" id="" name="pdffile" type="text" placeholder="Upload Pdf File">
												</div>
											</div>
                                        </div>                                        <div class="row">
                                            <div class="input-field col s12">
                                                <i class="waves-effect waves-light btn-large waves-input-wrapper" style="">
												<input type="submit" id="" name="submit"class="waves-button-input"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				<!---------status bar----->
				<div class="tabcontent col-md-9" id="status_bar_edit">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Status</h4>
								<ol class="progtrckr" data-progtrckr-steps="5">
									<li class="progtrckr-done">Order Processing</li>
									
									<li class="progtrckr-done">In Production</li>
									<li class="progtrckr-todo">Shipped</li>
									<li class="progtrckr-todo">Delivered</li>
								</ol>
                        </div>
                    </div>
                </div>
				<!----notification---->
				<div class="tabcontent col-md-9" id="notification_ins">
                    <div class="udb">
                        <div class="udb-sec udb-prof">
                            <h4><img src="images/icon/db1.png" alt="" /> Notification <span id='notification_count'></span></span></h4>
								 <div class="detailBox">
                                <div class="titleBox">
                                  <label>Notification Info</label>
                                    
                                </div>
                               
                                <div class="actionBox">
                                    <ul class="commentList">
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
                                     
                                       
                                    </ul>
                                
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
    <section>
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
                            <a href="course-details.html">Book This Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->

    <!--HEADER SECTION-->
   <?php include 'footer.php';?>

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

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
	
</body>


<!-- Mirrored from rn53themes.net/themes/demo/education-master/db-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Jun 2018 12:23:32 GMT -->
</html>