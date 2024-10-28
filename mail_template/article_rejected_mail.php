<html lang="en">
	<head>
		<link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php echo $base_url; ?>css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $base_url; ?>css/style.css" />
	</head>
	<body>
		<div class="container">
			<div class="col-xs-12 text-center logo_email"></div>
			<div class="col-xs-12 content_email">
				<p>Dear Dr/Mr/Ms/Prof. <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p>
                <p class="content">Your manuscript entitled "<?php echo ucfirst($mail_data['manuscript_id']); ?>" has now been reviewed by our editorial board and the reviewers' comments are furnished below. In the light of their advice and on my own behalf, I regret to inform you that we cannot publish your manuscript in Madras Agricultural Journal.</p><br/>
                <p class="content">Despite your work is of interest, substantive concerns were raised by the reviewers', which suggest that your paper does not fulfil the publication requirements for Madras Agricultural Journal. </p><br/>
                <p class="content">The reviewers felt that there were significant problems associated with the manuscript.</p><br/>
                <p class="content">I hope you will find the enclosed comments helpful as you progress with your studies.</p><br/>
                <p class="content">Thank you for the opportunity to consider your work. I am sorry that we cannot be more positive on this occasion and hope you will not be deterred from submitting future work to Madras Agricultural Journal.</p><br/>
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