<?php include 'journal_details.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to MASU</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/fav.png" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
    <link href="css/style-mob.css" rel="stylesheet" />
  
</head>

<body>

   <?php 
   if(isset($_SESSION['admin_id'])&& $_SESSION['admin_id']!=""){
	   
   include_once 'admin_header.php' ;
   }else{
	  include_once 'header.php' ;
   }
	?>
    <section>
        <div class="container com-sp">
            <div class="row">
                <div class="cor about-sp">
                    <div class="ed-about-tit">
						<?php if(count($journal_total_detail_array)>0){ foreach($journal_total_detail_array as $key=>$val){ if($val[0]->journal_id==$view_journal_id) {?>
                        <div class="con-title">
							
						  <!---<a href="" style="    margin-right: 891px;" >Journals > Vol:105 > March > </a>--->
                            <h2 align="left"><?php echo $val[0]->title; ?></h2>
                            
                        </div>
                        <div>
                            <div class="ho-event pg-eve-main">
                                <ul>
                                   <li>
                                        <div class="ho-ev-link pg-eve-desc">
                                           <!-- <a href="#.html">
                                                <h4 style="font-size: 16px"> </h4>
                                            </a>-->
											
									
											<p><b>Author: </b><?php echo $val[0]->author_name; ?><b>&nbsp Co Author: </b><?php 
													$lastElement = end($val[2]);
													foreach($val[2] as $autkey=>$authval){
														if($authval==$lastElement){
															echo $authval->author_name.'.';
														}	else{
															echo $authval->author_name.',';
														}
													} ?>
											</p>
											<span><b>Subject</b>:<?php echo $val[0]->subject; ?></span>
                                        </div>
                                        <div class="pg-eve-reg">
                                            <a href="<?php echo $path_file; ?>" target="_blank">Download</a>
											<!--<a href="event-details.html">Read more</a>-->
                                        </div>
                                    </li>
								</ul>
							</div>
						</div>
						<!---<h3>Abstract</h3>
						<p align="justify"> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; 
						&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;	
						<?php if(file_exists($path_file)){ ?>--->
						<iframe class="doc" src="https://docs.google.com/gview?url=<?php echo $_SERVER['HTTP_HOST'].'/'.$path_file; ?>&embedded=true" width='100%' height="1200px"></iframe>
						<!---<p><b>Key words : </b> Drought, Germination percentage, Tolerance index, Vigour index.</p>--->
						<?php }}}} ?>
					</div>
				</div>
			</div>
		</div>
		
	</section>
 
  
    <!-- FOOTER COURSE BOOKING -->
   
 <?php 
   if(isset($_SESSION['admin_id']) && $_SESSION['admin_id']!=""){
   include_once 'admin_footer.php' ;
   }else{
	  include_once 'footer.php' ;
   }
	?>

    <!-- SOCIAL MEDIA SHARE -->


    <!--Import jQuery before materialize.js-->
   