<!DOCTYPE html>
<html lang="en">


<head>
    <title>MADRAS AGRICULTURAL JOURNAL</title>
      <!-- META TAGS -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="MASU AGRICULTURAL JOURNAL - TamilNadu Agricultural University">
      <meta name="keyword" content="Madras Agricultural University,Agricultural Journal,MASU,Tamilnadu Agricultural University,Agriculture Unniversity,TNAU,MAJ,Publish Journal,Institution Journal,Student Publish ">
      <!-- FAV ICON(BROWSER TAB ICON) -->
      <link rel="shortcut icon" href="images/masu_logo.jpg" type="image/x-icon">
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <style>
p.groove {border-style: groove;}
 blink {
        animation: blinker 0.6s linear infinite;
        color: #1c87c9;
       }
      @keyframes blinker {  
        50% { opacity: 0; }
       }
       .blink-one {
         animation: blinker-one 1s linear infinite;
       }
       @keyframes blinker-one {  
         0% { opacity: 0; }
       }
       .blink-two {
         animation: blinker-two 1.4s linear infinite;
       }
       @keyframes blinker-two {  
         100% { opacity: 0; }
       }
</style>
</head>

<body style="background-color:#fff;">

  <?php include 'header.php' ;?>
    <section>
        <div class="head-2">
            <div class="container">
                <div class="head-2-inn">
                    <h1>Copyright Information</h1>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION START-->
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-bottom: 30px;margin-right : 100px;">
                <h3 style="color: #002147;">Copyright </h3>
                <a href="links-file/Copyright.docx"><h5 style="color:#0077b6;">Click Here to Download (.doc) <i class="fa fa-file"></i></h5></a>
                
                <embed src="links-file/Copyright.pdf" width="100%" height="720px" />
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <h3 style="color: #002147;">Copyright Transfer FORM_MAJ</h3>
                <a href="links-file/Copyright-Transfer-FORM_MAJ.docx"><h5 style="color:#0077b6;">Click Here to Download (.doc) <i class="fa fa-file"></i></h5></a>
                <embed src="links-file/Copyright-Transfer-FORM_MAJ.pdf" width="100%" height="720px" />
              </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->


    <!--SECTION START-->
   
    <!--SECTION END-->

   <?php include 'footer.php' ;?>

    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
  <script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
</body>

</html>