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
				<p class="content">Reminder mail for  consideration  of correction</p><br>
				<p class="content">I am pleased to remind you a manuscript entitled "<?php echo ucfirst($mail_data['title']); ?>" was submitted already and is still pending for consideration of publication in MAJ.</p><br>
				
				<br>
                <p class="content">Once you access  <a href="<?php echo $mail_data['url']; ?>">masujournal.org</a> and login through admin, you will be directed to your page; dashboard, where you can access the assigned MS. At this stage, if you feel that the MS is unfit, you may reject it. Alternatively, if the MS is eligible to be considered for review, you may click on the “view comments.”</p><br />
                <p class="content">Adding your remarks to the questions asked about the MS in the review pages is self-explanatory. Since it is an interactive review system, the author may also take part in the review process and respond to the reviewer's/editor’s comments. Once the author fully addresses all your comments, you can make your decisions as per the available options. You are also requested to submit confidential comments to the chief Editor about your decision for publishing the article in MAJ.</p>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>With best regards,<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Chief Editor,>br/> Madras Agricultural Journal</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>