<?php

include_once "../conf.php";
include_once "../connection.php";
include_once "../db.php";
include_once "../common_functions.php";

if(!empty($_GET['manuscript-id']) && !empty($_GET['status']) && !empty($_GET['token'])) {
    $article_id = trim($_GET['manuscript-id']);
    $status = trim($_GET['status']);
    $token = trim($_GET['token']);
    $email = trim($_GET['email']);

    $qry = $db->query("SELECT * FROM tbl_review_requests WHERE journal_id='$article_id' AND token='$token' LIMIT 1");

    if(empty($qry->count) || empty($qry->row)) {
        $err_msg = "Sorry..! Article Not Available..!";
    } else {
        $row = $qry->row;
        if($row->status != 0) {
            if($row->status == 1) {
                $adminQry = $db->query("SELECT * FROM tbl_admin WHERE admin_id = ".$row->reviewer_id." AND admin_mail = '$email' LIMIT 1");
                if(!empty($adminQry->count) && $adminQry->count > 0) {
                    $_SESSION['role_id']=$adminQry->row->admin_cat_id;
                    $_SESSION['admin_id']=$adminQry->row->admin_id;
                    if($adminQry->row->admin_cat_id==1) {
                        $_SESSION['admin_active']=true;
                    }
                    $_SESSION['admin_login']="yes";
                    $_SESSION['user_name']=$adminQry->row->admin_name;
                    $_SESSION['user_email']=$adminQry->row->admin_mail;
                    $data["role_id"]=$adminQry->row->admin_cat_id;

                    header("Location:".APP_URL.'editorial/e-view-journal.php?email='.$adminQry->row->admin_mail.'&manuscript='.$article_id);
                    exit;
                }
            }
            $err_msg = "Sorry..! Article Not Available to reject or accept..!";
        } else {
            $request_update_data = array();
            if($status == 'accept') {
                $request_update_data['status'] = '1';
                $editor = $row->reviewer_id;
                $revision = $row->revision;
                $mail_data = array();
                $check_qry = $db->query("SELECT id,title,abstract,status,manuscript_id,resubmitted from tbl_journal WHERE id=$article_id");
                if(!isset($check_qry->row->status) || ($check_qry->row->status != '12')) {
                    $err_msg = "Sorry..! Article Not Available to reject or accept...!";
                } else {

                    $db->query("UPDATE tbl_review_requests SET status= '1' WHERE journal_id='$article_id' AND token='$token' LIMIT 1");

                    $dt = date("Y-m-d H:i:s");

                    $insert_data = array();
                    $insert_data['journal_id'] = $article_id;
                    $insert_data['assigned_to'] = $editor;
                    $insert_data['revision'] = $revision;
                    $insert_data['assigned_date'] = $dt;
                    $insert_data['status'] = '0';
                    $insert_data['assigned_by'] = '83';
                    $assigned_id = $db->insert('tbl_journal_assigned', $insert_data);

                    $update_data = array(
                        'status' => '5'
                    );
                    $where = array(
                        'id' => $article_id
                    );
                    $db->update("tbl_journal", $update_data, $where);

                    $userDetails = $db->query("SELECT * FROM tbl_admin where admin_id = '".$editor."' ");
                    
                    $mail_data['name'] = $userDetails->row->admin_name;
                    $emailVal = $userDetails->row->admin_mail;
                    $mail_data['email'] = $userDetails->row->admin_mail;
                    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
                    $mail_data['title'] = $check_qry->row->title;
                        
                    $mail_data['url'] = APP_URL.'auth/login.php';
                    $mail_data['redirect_url'] = APP_URL.'editorial/e-view-journal.php?action=editor_login&manuscript='.$article_id.'&email='.$mail_data['email'];
                    sendEmail($emailVal, 'Journal For Review (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'assgin_reviewer_mail.php', $mail_data);

                    $select_data=mysqli_query($con, "select * from tbl_admin where admin_mail='".$mail_data['email']."'");
                    if($row=mysqli_fetch_array($select_data)) {
                        $data=array();
                        $_SESSION['role_id']=$row['admin_cat_id'];
                        $_SESSION['admin_id']=$row['admin_id'];
                        if($row['admin_cat_id']==1) {
                            $_SESSION['admin_active']=true;
                        }
                        $_SESSION['admin_login']="yes";
                        $_SESSION['user_name']=$row['admin_name'];
                        $_SESSION['user_email']=$row['admin_mail'];
                        $data["role_id"]=$row['admin_cat_id'];
                    }

                    header("Location:".APP_URL.'editorial/e-view-journal.php?manuscript='.$article_id);
                    exit;
                }
            } elseif($status == 'decline') {
                $request_update_data['status'] = '2';

                $check_qry = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$article_id");
                if(!isset($check_qry->row->status) || ($check_qry->row->status != '12')) {
                    $err_msg = "Sorry..! Article Not Available to reject or accept....!";
                } else {
                    $update_data = array(
                        'status' => '11'
                    );
                    $where = array(
                        'id' => $article_id
                    );
                    $db->update("tbl_journal", $update_data, $where);
                    $success_msg = 'Article Review Declined (Manuscript ID - '.$check_qry->row->manuscript_id.')';
                }
            }
            if(empty($err_msg) && !empty($success_msg)) {
                $where = array(
                    'journal_id' => $article_id,
                    'token' => $token
                );
                $db->update("tbl_review_requests", $request_update_data, $where);
            }
        }
    }
} elseif(!empty($_GET['article_id']) && !empty($_GET['email']) && !empty($_GET['action']) && $_GET['action'] == 'editor_login') {
    $adminQry = $db->query("SELECT * FROM tbl_admin WHERE admin_mail = '".trim($_GET['email'])."' LIMIT 1");
    if(!empty($adminQry->count)) {
        $article_id = trim($_GET['article_id']);
        $admin_id = $adminQry->row->admin_id;
        $qry = $db->query("SELECT * FROM tbl_journal_assigned WHERE journal_id='$article_id' AND assigned_to = '$admin_id' AND status IN ('0', '1') LIMIT 1");
        if(!empty($qry->count) || !empty($qry->row)) {
            $_SESSION['role_id']=$adminQry->row->admin_cat_id;
            $_SESSION['admin_id']=$adminQry->row->admin_id;
            if($adminQry->row->admin_cat_id==1) {
                $_SESSION['admin_active']=true;
            }
            $_SESSION['admin_login']="yes";
            $_SESSION['user_name']=$adminQry->row->admin_name;
            $_SESSION['user_email']=$adminQry->row->admin_mail;
            $data["role_id"]=$adminQry->row->admin_cat_id;

            header("Location:".APP_URL.'editorial/e-view-journal.php?email='.$adminQry->row->admin_mail.'&manuscript='.$article_id);
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon.ico">
	<title>MASU - Authentication</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />
	<link rel="shortcut icon" href="../images/masu_logo.png" type="image/x-icon">
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<!-- CSS Files -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />
	<style type="text/css">
		.loader-mask {
			width: 100%;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.7);
			z-index: 999999999999999999999999999;
			position: fixed;
			top: 0;
			left: 0;
			display: none;
		}

		.loader-image {
			height: 50px;
			left: 48%;
			top: 45%;
			position: fixed;
		}

		.reg-icon {
			font-size: 20px;
			margin-top: 10px;
		}

		.sub-buttons {
			background-color: #FFFFFF !important;
			border: 2px solid #4caf50 !important;
			color: #494850 !important;
		}

		.sub-buttons:hover {
			background-color: #4caf50 !important;
			border: 2px solid #4caf50 !important;
			color: #FFFFFF !important;
		}

		.rp-div,
		.fp-div,
		.reg-msg,
		.admin-error,
		.login-error,
		.register-error,
		.admin-fp-error,
		.fp-error {
			display: none;
		}

		.reg-msg,
		.admin-error,
		.login-error,
		.register-error,
		.admin-fp-error,
		.fp-error,
		.rp-error {
			text-align: center;
		}

		.reg-msg span {
			color: green;
			font-size: 14px;
			font-weight: bold;
		}

		.admin-error span,
		.login-error span,
		.register-error span,
		.admin-fp-error span,
		.fp-error span,
		.rp-error span {
			color: red;
			font-size: 13px;
			font-weight: bold;
		}

		/*.btnn-forgot{
			background-color: #FFFFFF;
			border : 2px solid #4caf50;
		}*/
	</style>
</head>

<body>
	<div class="loader-mask">
		<img class="loader-image" src="../images/loader.gif" alt="Loading.. Please wait">
	</div>
	<div class="image-container set-full-height" style="background-image: url('back.jpg')">
		<!--   Big container   -->
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<!--      Wizard container        -->
					<div class="wizard-container">
						<div class="card wizard-card" data-color="green" id="wizardProfile">
							<form action="" method="">
								<div class="wizard-header" style="padding:10px 10px 20px 10px;">
									<div class="row">
										<div class="col-12">
											<img src="../images/logo.png" alt="MASU" style="width:670px;">
										</div>
									</div>
								</div>
								<?php
                                        if(!empty($success_msg)) { ?>
								<div class="row">
									<div class="col-12" style="margin:auto;text-align:center;">
										<h6 style="color:#2a9d8f;">
											<strong><?php echo $success_msg; ?></strong>
										</h6>
									</div>
								</div>
								<?php } elseif(!empty($err_msg)) { ?>
								<div class="row">
									<div class="col-12" style="margin:auto;text-align:center;">
										<h6 style="color:#e63946;">
											<strong><?php echo $err_msg; ?></strong>
										</h6>
									</div>
								</div>
								<?php } ?>
								<div class="row rp-div">
									<div class="col-md-12">
										<h4 class="info-text admin-login-info">
											Kindly set a valid password for your account!</h4>
										<input type="hidden" name="rp-token" id="rp-token" value="">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">fingerprint</i>
											</span>
											<div class="form-group label-floating">
												<label class="control-label">Password</label>
												<input id="rp-password" password="new-password" name="rp-1"
													type="password" class="form-control" autocomplete="off">
											</div>
										</div>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">fingerprint</i>
											</span>
											<div class="form-group label-floating">
												<label class="control-label">Confirm Password</label>
												<input id="rp-cpassword" password="new-password" name="rp-2"
													type="password" class="form-control" autocomplete="off">
											</div>
										</div>
										<div class="rp-error">
											<span></span>
										</div>
										<div class="pull-right">
											<input type='button' class='btn btn-cancel btn-fill btn-default btn-wd'
												name='Cancel' value='Back to Login' />
											<input type='button' class='btn btn-rp btn-fill btn-success btn-wd'
												name='reset-password' value='Reset Password' />
										</div>
									</div>
								</div>
								<div class="wizard-navigation">
									<ul>
										<li><a id="about-tab" href="#about" data-toggle="tab">Author Login</a></li>
										<li><a id="address-tab" href="#address" data-toggle="tab">Reviewer Login</a>
										</li>
									</ul>
								</div>
								<div class="tab-content">
									<div class="tab-pane" id="about">
										<div class="row" id="author-login">
											<h4 class="info-text login-info"> Login into your account! <br>Kindly
												Re-register your account </h4>
											<div class="reg-msg">
												<span></span>
											</div>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="row">
													<span>
														Don't have an account?
														<button class="btn btn-success sub-buttons r-trigger">
															Authors Register
														</button>
													</span>
												</div>
												<div class="row">
													<span>
														Forgot Account Password?
														<button class="btn btn-success sub-buttons btn-fp-author"
															value="1">
															Forgot Password
														</button>
													</span>
												</div>
											</div>
											<div class="col-sm-6 login-div">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Email Id</label>
														<input id="ins_username" password="new-password" name="lname"
															type="text" class="form-control" autocomplete="off">
													</div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">fingerprint</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Password</label>
														<input id="ins_pass" name="lpass" type="password"
															class="form-control">
													</div>
												</div>
												<div class="login-error">
													<span></span>
												</div>
												<div class="pull-right">
													<input type='button'
														class='btn btn-login btn-fill btn-success btn-wd' name='Login'
														value='Login' />
												</div>
											</div>
											<div class="col-sm-6 fp-div">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Email Id</label>
														<input id="fp-email" password="new-password" name="lname"
															type="text" class="form-control" autocomplete="off">
													</div>
												</div>
												<div class="fp-error">
													<span></span>
												</div>
												<div class="pull-right">
													<input type='button'
														class='btn btn-cancel btn-fill btn-default btn-wd' name='Cancel'
														value='Back to Login' />
													<input is_admin="0" type='button'
														class='btn btn-fp btn-fill btn-success btn-wd'
														name='forgot-password' value='Forgot Password' />
												</div>
											</div>
										</div>
										<div class="row" id="author-registration" style="display: none;">
											<div class="register-error">
												<span></span>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">person</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Full Name</label>
															<input id="reg-name" name="name" type="text"
																class="form-control" required>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">phone</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Contact Number</label>
															<input id="reg-number" name="number" type="tel"
																class="form-control" pattern="[0-9]{10}" required>
														</div>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">thumb_up</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Specialization</label>
															<input id="reg-special" name="special" type="text"
																class="form-control" required>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">email</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Email Id</label>
															<input id="reg-email" name="email" type="text"
																class="form-control" required>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">fingerprint</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Password</label>
															<input id="reg-pass" name="password" type="password"
																class="form-control" required>

														</div>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">fingerprint</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Confirm Password</label>
															<input id="reg-conpass" name="c_password" type="password"
																class="form-control" required>
														</div>
													</div>
												</div>
												<div class="col-sm-7">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">room</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Address for
																Communication</label>
															<input id="reg-address" name="address" type="text"
																class="form-control" required>
														</div>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="reg-icon material-icons">menu_book</i>
														</span>
														<div class="form-group label-floating">
															<label class="control-label">Select Membership</label>
															<select id="reg-annual" name="membership"
																class="form-control" required>
																<option selected>Select Membership</option>
																<option value="non_number">Non Member </option>
																<option value="institute_member">Institute Member
																</option>
																<option value="Life">Life Member</option>
																<option value="Annual">Annual Member</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div style="text-align:center;">
													<input type='button'
														class='btn btn-cancel btn-fill btn-default btn-wd' name='Cancel'
														value='Back to Login' />
													<input type='button'
														class='btn btn-register btn-fill btn-success btn-wd'
														name='Register' value='Register' />
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="address">
										<div class="row">
											<h4 class="info-text admin-login-info">Login into your admin account!</h4>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="row">
													<span>
														Forgot Account Password?
														<button class="btn btn-success sub-buttons btn-fp-admin">
															Forgot Password
														</button>
													</span>
												</div>
											</div>
											<input type="hidden" id="adminlogin" name="adminlogin" value="admins">
											<div class="col-sm-6 login-div">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Admin Email</label>
														<input id="adminname" name="email" type="text"
															class="form-control">
													</div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">fingerprint</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Password</label>
														<input id="adminpass" name="password" type="password"
															class="form-control">
													</div>
												</div>
												<div class="admin-error">
													<span></span>
												</div>
												<div class="pull-right">
													<input type='button'
														class='btn btn-admin-login btn-fill btn-success btn-wd'
														name='Login' value='Login' />
												</div>
											</div>
											<div class="col-sm-6 fp-div">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
														<label class="control-label">Email Id</label>
														<input id="fp-admin-email" password="new-password" name="lname"
															type="text" class="form-control" autocomplete="off">
													</div>
												</div>
												<div class="admin-fp-error">
													<span></span>
												</div>
												<div class="pull-right">
													<input type='button'
														class='btn btn-cancel btn-fill btn-default btn-wd' name='Cancel'
														value='Back to Login' />
													<input is_admin="1" type='button'
														class='btn btn-fp btn-fill btn-success btn-wd'
														name='forgot-password' value='Forgot Password' />
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div> <!-- wizard container -->
				</div>
			</div><!-- end row -->
		</div> <!--  big container -->
		<div class="footer">
			<div class="container text-center">
				<p>Copyright @ 2023 Madras Agricultural Journal |<a href="http://masujournal.org/" target="_blank"
						style="color:white;"><i> Masu Journal</i> </a> All right reserved.</p>

			</div>
		</div>
	</div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>
<!--  Plugin for the Wizard -->
<script src="assets/js/material-bootstrap-wizard.js"></script>
<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
		};
		var rp_action = getUrlParameter('action');
		if (rp_action == 'reset-password') {
			//alert('2');
			var rp_token = getUrlParameter('token');
			if (rp_token !== undefined && rp_token !== '' && rp_token !== null) {
				$("#rp-token").val(rp_token);
				$(".rp-div").show();
				$(".wizard-navigation, .tab-content").hide();
			}
		}

		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}

		function showLoader() {
			$(".loader-mask").css("display", "block");
		}

		function hideLoader() {
			$(".loader-mask").css("display", "none");
		}
		$('#adminpass').keypress(function(e) {
			if (e.which == 13) // the enter key code
			{
				$('.btn-admin-login').click();
				return false;
			}
		});
		$('#adminname').keypress(function(e) {
			if (e.which == 13) // the enter key code
			{
				$('.btn-admin-login').click();
				return false;
			}
		});
		$('#ins_username').keypress(function(e) {
			if (e.which == 13) // the enter key code
			{
				$(".btn-login").click();
				return false;
			}
		});
		$('#ins_pass').keypress(function(e) {
			if (e.which == 13) // the enter key code
			{
				$(".btn-login").click();
				return false;
			}
		});
		$(".r-trigger").click(function(e) {
			$("#author-login").hide();
			$("#author-registration").show();
		});
		$(".sub-buttons").click(function(e) {
			e.preventDefault();
		});
		$(".btn-fp-admin, .btn-fp-author").click(function(e) {
			$(".admin-login-info, .login-info").html(
				'Enter your registered email ID to reset your passsword!');
			$(".login-div").hide();
			$(".fp-div").show();
			e.preventDefault();
		});
		$(".btn-cancel").click(function(e) {
			$(".wizard-navigation, .tab-content").show();
			$(".rp-div").hide();
			$(".admin-login-info").html('Login into your admin account!');
			$(".login-info").html('Login into your account!');
			$(".login-div").show();
			$(".fp-div").hide();
			$("#author-login").show();
			$("#author-registration").hide();
			e.preventDefault();
		});
		$("#ins_username, #ins_pass").keyup(function(e) {
			$('.login-error').hide();
		});
		$(".form-control").keyup(function(e) {
			$('.register-error').hide();
			$('.login-error').hide();
		});
		$(".form-control").change(function(e) {
			$('.register-error').hide();
			$('.login-error').hide();
		});
		$(".btn-login").click(function(e) {
			var login_mail = $('#ins_username').val();
			var pass = $('#ins_pass').val();
			if (login_mail == "") {
				$("#ins_username").parent('div').addClass('has-error');
				return false;
			}
			if (pass == "") {
				$("#ins_pass").parent('div').addClass('has-error');
				return false;
			}
			if (!isEmail(login_mail)) {
				alert('Please enter an valid Email ID');
				$("#ins_username").parent('div').addClass('has-error');
				return false;
			}
			showLoader();
			$.ajax({
				type: 'post',
				url: '../do_login.php',
				data: {
					do_login: "do_login",
					email: login_mail,
					password: pass
				},
				dataType: "json",
				success: function(response) {
					if (response.result != "success") {
						hideLoader();
						$(".login-error span").html(
							'Sorry..! Email or Passwosrd is incorrect.!').parent().show();
						return false;
					}
					if (response.category_id == 1) {
						window.location.href = "../editorial/dashboard.php";
					} else if ((response.category_id == 2 || response.category_id == 3) &&
						response.type_id == 1) {
						window.location.href = "../editorial/dashboard.php";
					} else if ((response.category_id == 2 || response.category_id == 3) &&
						response.type_id == 2) {
						window.location.href = "../editorial/dashboard.php";
					} else {
						hideLoader();
						$(".login-error span").html('Sorry..! Something went wrong!!').parent()
							.show();
						return false;
					}
				},
				error: function(response) {
					$(".login-error span").html(
							'Sorry..!Something wrong with the Authentication.!').parent()
						.show();
					hideLoader();
				}
			});
			e.preventDefault();
		});
		$(".btn-register").click(function(e) {
			var lfname = $("#reg-name").val();
			var lfaddress = $("#reg-address").val();
			var lfcommunication = $("#reg-special").val();
			var lfemail = $("#reg-email").val();
			var lfphone = $("#reg-number").val();
			var lfpass = $("#reg-pass").val();
			var lfconpass = $("#reg-conpass").val();
			var lfannual = $("#reg-annual").val();
			if (lfname == '' || lfaddress == '' || lfcommunication == '' || lfemail == '' || lfphone ==
				'' || lfpass == '' || lfconpass == '' || lfannual == '') {
				$(".register-error span").html('Please fill all fields.!').parent().show();
				return false;
			} else {
				if ((lfpass.length) < 8) {
					$(".register-error span").html('Password should atleast 8 character in length.!')
						.parent().show();
					return false;
				}
				if ((lfphone.length) < 10) {
					$(".register-error span").html('Phone number should  10 numbers in length.!').parent()
						.show();
					return false;
				}

				if (!isEmail(lfemail)) {
					$(".register-error span").html('Please Enter Valid Email Address.!').parent().show();
					return false;
				}
				if (lfpass != lfconpass) {
					$(".register-error span").html("Passwords Doesn't Match.!").parent().show();
					return false;
				}
			}
			showLoader();
			$.ajax({
				type: 'post',
				url: '../do_login.php',
				data: {
					lf_register: "lf_register",
					lfname: lfname,
					lfaddress: lfaddress,
					lfcommunication: lfcommunication,
					lfemail: lfemail,
					lfphone: lfphone,
					lfpass: lfpass,
					lfannual: lfannual
				},
				dataType: "json",
				success: function(response) {
					if (response.result == "success") {
						hideLoader();
						$("#about-tab").click();
						$(".reg-msg span").html(
								'Registered Successfully.! Please continue to login..!')
							.parent().show();
						$(".form-control input").val();
					} else {
						$(".register-error span").html(response.result).parent().show();
						hideLoader();
						return false;
					}
				},
				error: function(response) {
					$(".register-error span").html(
						'Sorry..!Something wrong with the Registration.!').parent().show();
					hideLoader();
				}
			});
			e.preventDefault();
		});
		$(".btn-admin-login").click(function(e) {
			var login_mail = $('#adminname').val();
			var pass = $('#adminpass').val();
			var role_val = $('#adminlogin').val();
			if (login_mail == "") {
				$(".admin-error span").html('Please enter username').parent().show();
				return false;
			}
			if (pass == "") {
				$(".admin-error span").html('Please enter password').parent().show();
				return false;
			}
			showLoader();
			$.ajax({
				type: 'post',
				url: '../do_login.php',
				data: {
					do_login: "do_login",
					email: login_mail,
					password: pass,
					role_val: role_val
				},
				dataType: "json",
				success: function(response) {
					if (response.result == "success") {
						if (response.role_id == 1 || response.role_id == 2 || response
							.role_id == 3 || response.role_id == 6) {
							window.location.href = "../editorial/editor-dashboard.php";
						} else if (response.role_id == 4) {
							window.location.href = "../editorial/chief.php";
						} else if (response.role_id == 5) {
							window.location.href = "../editorial/manager.php";
						} else if (response.role_id == 15) {
							window.location.href =
								"../editorial/publish-journal-collections.php";
						} else if (response.role_id == 7) {
							window.location.href = "../editorial/press-publish-article.php";
						}

					} else {
						hideLoader();
						$(".admin-error span").html(
							'Sorry.! Username or password is incorrect.!').parent().show();
						return false;
					}
				},
				error: function(response) {
					$(".admin-error span").html(
							'Sorry..!Something wrong with the Authentication.!').parent()
						.show();
					hideLoader();
				}
			});
			e.preventDefault();
		});
		$(".btn-fp").click(function(e) {
			e.preventDefault();
			var is_admin = $(this).attr('is_admin');
			if (is_admin == 0) {
				var email = $("#fp-email").val();
				var from_admin = 0;
				var notification = 'fp-error';
			} else {
				var email = $("#fp-admin-email").val();
				var from_admin = 1;
				var notification = 'admin-fp-error';
			}
			if (email == undefined || email == '' || email == null) {
				$("." + notification + " span").html('Please enter the registered email ID').parent()
					.show();
				return false;
			} else if (!isEmail(email)) {
				$("." + notification + " span").html('Please provide a valid Email ID').parent().show();
				return false;
			}
			showLoader();
			$.ajax({
				type: 'post',
				url: '../forgot_password.php',
				data: {
					email: email,
					from_admin: from_admin
				},
				dataType: "text",
				success: function(response) {
					if (response == "0") {
						$("." + notification + " span").html(
							"Sorry..Please enter an valid email address").parent().show();
					} else if (response == "1") {
						$("." + notification + " span").html(
							"Sorry.. The email is not available!").parent().show();
					} else if (response == "2") {
						$("." + notification + " span").html(
								"We have sent a password reset link to the given email ID!")
							.css("color", "green").parent().show();
					} else {
						$("." + notification + " span").html("Something is not right !")
							.parent().show();
					}
					hideLoader();
				},
				error: function(response) {
					$("." + notification + " span").html('Sorry..!Something wrong.!').parent()
						.show();
					hideLoader();
				}
			});
			return false;
		});
		$(".btn-rp").click(function(e) {
			e.preventDefault();
			var password = $("#rp-password").val();
			var cpassword = $("#rp-cpassword").val();
			var rp_token = $("#rp-token").val();
			//alert(rp_token);exit;
			if (cpassword != password) {
				$(".rp-error span").html('Sorry..Passwords doesnot match').parent().show();
				return false;
			}
			if (password.length < 8) {
				$(".rp-error span").html('Sorry..Password should have minimum 8 characters').parent()
					.show();
				return false;
			}
			showLoader();
			$.ajax({
				type: 'post',
				url: '../forgot_password.php',
				data: {
					rp_token: rp_token,
					password: password,
					action: 'reset-password'
				},
				dataType: "text",
				success: function(response) {
					if (response == "0") {
						$(".rp-error span").html('Sorry..invalid Request!').parent().show();
					} else if (response == "1") {
						$(".rp-error span").html('Sorry.. Token expired').parent().show();
					} else if (response == "2") {
						$(".rp-error span").html('Password updated successfully!').css("color",
							"green").parent().show();
					} else {
						$(".rp-error span").html('Something is not right!').parent().show();
					}
					hideLoader();
				},
				error: function(response) {
					$(".rp-error span").html('Sorry..!Something wrong.!').parent().show();
					hideLoader();
				}
			});
			return false;
		});
	});
</script>

</html>