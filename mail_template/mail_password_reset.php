<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo APP_NAME; ?></title>
		<link href="<?php echo APP_URL; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo APP_URL; ?>css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo APP_URL; ?>css/style.css" />
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12 text-center logo_email">
				<img src="<?php echo APP_URL; ?>images/logo.png" alt="Masu Journal Logo" border="0" class="padding10" style="max-width: 100%;height: auto;padding:10px;">
			</div>
			<div class="col-xs-12 content_email">
				<p>Dear <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($user_name); ?></strong></span>,</p>
				<p class="content">You recently requested to reset your password on your Masujournal account. Click the below button to reset it.</p><br>
				<div class="col-12" style="text-align:center;">
				<a href="<?php echo APP_URL; ?>forgot_password.php?action=view-reset-pwd&token=<?php echo $token; ?>"><button type="button" style="background-color: #EE6352;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Reset Password</button></a>
				</div>
				<br>
				<p class="content">If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid for next 20 minutes. </p><br>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>Regards,<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Team - Masu Journal</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>
