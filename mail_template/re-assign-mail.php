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
				<p>Dear <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p>
				<p class="content">Greetings from Madras Agricultural Journal</p><br>
				<p class="content">The author of article entitled <?php echo $mail_data['manuscript_id']; ?> submitted a revised manuscript in the interactive review forum</p><br>
				<p class="content">Please click here to access this manuscript directly:</p><br>
				<div class="col-12" style="text-align:center;">
				<a href="<?php echo $mail_data['url']; ?>?action=editor_login&article_id=<?php echo $mail_data['article_id']; ?>&email=<?php echo $mail_data['email']; ?>"><button type="button" style="background-color: #EE6352;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Login Now</button></a>
				</div>
				<br>
				<p class="content">Please submit your comments to the authors in the interactive review forum now. If the authors' replies addressed your comments carefully to your satisfaction, you accept the paper. If not, reject with justification.</p><br>
				<p class="content">If the article requires further revision. YOu may request so. Accordingly, the chief editor directs the author to do so. </p><br>
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