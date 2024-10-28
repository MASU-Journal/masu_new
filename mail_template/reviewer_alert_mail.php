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
				<p>Dear Dr <span class="span_red"  style="color:#ff5c5c;"><strong><?php echo ucfirst($mail_data['name']); ?></strong></span>,</p>
				<p class="content">Greetings from Madras Agricultural Journal</p>
                <p class="content">A few weeks ago, I invited you to review a paper contributed to MAJ (<?php echo $mail_data['manuscript_id']; ?>) and you agreed to review on <?php echo date("d-m-Y", strtotime($mail_data['assigned_date'])); ?></p>
                <p class="content">But I have not yet heard from you about your review result.</p>
                <p class="content">The authors are EAGER to know the final decision.</p>
                <p class="content">I have to make a decision on the manuscript as soon as possible.</p>
                <p class="content">I hope you realize this status and send me back any message.</p>
				<p class="content">This e-mail is simply a reminder to respond to the invitation to review.
				I appreciate your help in accomplishing our goal of having an expedited reviewing process.
				Please do not hesitate to contact me if I can be of any assistance.</p><br>
				
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