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
				<p>Dear Dr/Mr/Ms/Prof. <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p><br>
			
                <p class="content">The Editorial team have moved the status of the manuscript "<?php echo ucfirst($mail_data['manuscript_id']); ?>" to <b>"Withdrawn"</b> status, for any of the following reason.</p><br/>

                <p class="content">1) The author requested to withdraw the manuscript</p><br/>
                <p class="content">2) The author did not respond to the query of the editorial team (or) failed to resubmit the manuscript within the given deadline.</p><br/>
				<br>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>Sincerely<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Sivakumar U.<br />Editor-in-Chief,<br/> Madras Agricultural Journal</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>