<html lang="en">
	<head>
		<link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css" />
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12 text-center logo_email">
				<img src="<?php echo $base_url; ?>images/logo.png" alt="Masu Journal Logo" border="0" class="padding10" style="max-width: 100%;height: auto;padding:10px;">
			</div>
			<div class="col-xs-12 content_email">
				<p>Dear Prof/Dr/Mr/Ms. <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p>
				<p class="content">Thank you for submitting your manuscript entitled "<?php echo ucfirst($mail_data['title']); ?>"  to our Madras Agricultural Journal.</p><br>
				<p class="content">Your manuscript ID is <?php echo ucfirst($mail_data['manuscript_id']); ?>.</p><br>
				<p class="content">This manuscript ID should be used in all future communications.</p><br>
				<p>You can view the status of your manuscript at any time by logging in to website using your author credentials.</p><br/>
				<div class="col-12" style="text-align:center;">
				<a href="<?php echo $mail_data['url']; ?>?action=editor_login"><button type="button" style="background-color: #EE6352;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Login Now</button></a>
				</div>
				<br>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>With best regards,<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Editorial Office, Madras Agricultural Journal</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>