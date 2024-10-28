<html lang="en">

<head>
	<title>Welcome Editor</title>
	<link href="<?php echo APP_URL; ?>css/bootstrap.min.css"
		rel="stylesheet" media="screen">
	<link href="<?php echo APP_URL; ?>css/font-awesome.min.css"
		rel="stylesheet">
	<link rel="stylesheet"
		href="<?php echo APP_URL; ?>css/style.css" />
</head>

<body>
	<div class="container">
		<div class="col-xs-12 text-center logo_email">
			<img src="<?php echo APP_URL; ?>images/logo.png"
				alt="Masu Journal Logo" border="0" class="padding10" style="max-width: 100%;height: auto;padding:10px;">
		</div>
		<div class="col-xs-12 content_email">
			<p>Dear <span class="span_red"
					style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,
			</p>
			<p class="content">You have registered as an Editor on the online journal management system of Madras
				Agricultural Journal.</p><br>
			<p class="content">Your Login Mail ID is:
				<?php echo $mail_data['email']; ?>
			</p><br>
			<p class="content">Your PasswordD is:
				<?php echo $mail_data['password']; ?>
			</p><br>
			<div class="col-12" style="text-align:center;">
				<a
					href="<?php echo $mail_data['url']; ?>?action=editor_login"><button
						type="button"
						style="background-color: #EE6352;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Login
						Now</button></a>
			</div>
			<br>
		</div>
		<div class="col-xs-12 content_regard">
			<h5>With best regards,<h5>
					<p><span class="span_red" style="color:#ff5c5c;"><strong>Editorial Office, Madras Agricultural
								Journal</strong></span>.</p>
					<div class="clearfix" style="clear:both;"></div>
					<div class="height20" style="height:20px;"></div>
		</div>
	</div>
</body>

</html>