<html lang="en">
	<head>
		<link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css" />
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12 text-center logo_email">
				
			</div>
			<div class="col-xs-12 content_email">
				<p>Dear Dr/Mr/Ms/Prof. <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p>
                <p class="content">Congratulations !!!</p><br/>
                <p class="content">I am pleased to inform you that your paper has been accepted for publication in Madras Agricultural Journal. Your accepted manuscript will now be transferred to our production department. We will create a proof which you will be asked to check </p><br/>
                <p class="content">Thank you for submitting your work to Madras Agricultural Journal. We hope you consider us again for future submissions.</p><br/>
				<br>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>Sincerely<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Sivakumar U.<br />Editor-in-Chief,<br /> Madras Agricultural Journal</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>