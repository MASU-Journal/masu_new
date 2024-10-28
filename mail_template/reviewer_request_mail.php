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
				<p>Dear Dr <span><?php echo ucfirst($mail_data['name']); ?></span>,</p>
				<p class="content">You are herewith invited to review a manuscript for Madras Agricultural Journal.</p>
                <p class="content"><strong>Article Title : </strong><?php echo $mail_data['article_title']; ?></p>
                <p class="content"><strong>Article Abstract : </strong></p>
                <p class="content"><?php echo $mail_data['article_abstract']; ?></p>
                <p class="content">Your Username/Email is :</p>
                <p class="content"><?php echo $mail_data['email']; ?></p>
                <p class="content">We cannot send you the password because of the security reasons. If you forgot your password kindly use <b>"Forgot Password"</b> option in the <a href="<?php echo $mail_data['url']; ?>">login page</a></p>
                <div class="col-12" style="text-align:center;">
				<a href="<?php echo $mail_data['url']; ?>?action=editor_login&token=<?php echo $mail_data['token'];?>&status=accept&manuscript-id=<?php echo $mail_data['article_id'];?>&email=<?php echo $mail_data['email'];?>"><button type="button" style="background-color: #17c3b2;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;">Yes,I wish to review this paper..!</button></a>
				<a href="<?php echo $mail_data['url']; ?>?action=editor_login&token=<?php echo $mail_data['token'];?>&status=decline&manuscript-id=<?php echo $mail_data['article_id'];?>"><button type="button" style="background-color: #fe6d73;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 14px;">sorry, I do not wish to review this paper</button></a>
				</div>
			</div>
			<div class="col-xs-12 content_regard">
				<h5>With best regards,<h5>
				<p><span class="span_red" style="color:#ff5c5c;"><strong>Prof.Senthil Natesan</strong></span></p>
				<p><span class="span_red" style="color:#ff5c5c;"><strong> Editor in Chief (Madras Agricultural Journal)</strong></span></p>
				<p><span class="span_red" style="color:#ff5c5c;"><strong> Dean, School of Post Graduate Studies</strong></span></p>
				<p><span class="span_red" style="color:#ff5c5c;"><strong> Director, Centre for Plant Molecular Biology and Biotechnology,TNAU, Coimbatore</strong></span>.</p>
				<div class="clearfix" style="clear:both;"></div>
				<div class="height20" style="height:20px;"></div>
			</div>
		</div>
	</body>
</html>