<?php
include_once('manager1_header.php');
?>
<style type="text/css">
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #ff4365;
    }
    .d-flex{
      display: block !important;
    }
    .card {
      display: block !important;
    }
    .card .card-header{
      margin-bottom: 0px;
    }
    .journal-info{
      margin-bottom: 10px;
    }
    .manuscript-span{
      background-color: #FF686B;
      width : 20%;
      height : 50px;
      display: inline-block;
      color : white;
      padding: 10px 5px 10px 20px;
      font-weight: bold;
      font-size: 21px;
    }
    .title-span {
      width : 75%;
      height: 50px;
      display: inline-block;
      color : #195143;
      padding-left : 20px;
      font-weight: bold;
      font-size: 17px;
    }
    .header-card{
      width : 100%;
      background-color: #84DCC6;
      height : 50px;
    }
    .j-btn-section{
      margin : 20px 30px;
    }
    .validation-error{
    color : red;
    font-weight : bold;
    font-size : 12px;
    display : none;
}
</style>
            <!-- Breadcrumb Area -->
            <div class="breadcrumb-area">
                <h1>Publish Journal Collections</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item">To Publish Old Journals(All Before 2018)</li>
                </ol>
            </div>
            <?php if(!empty($_SESSION['form_error'])){ ?>
              <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
            <?php unset($_SESSION['form_error']); } ?>
            <?php if(!empty($_SESSION['form_success'])){ ?>
              <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
            <?php unset($_SESSION['form_success']); } ?>
            <?php if(!empty($_SESSION['form_warning'])){ ?>
              <div class="alert alert-warning" role="alert"><?php echo $_SESSION['form_warning']; ?></div>
            <?php unset($_SESSION['form_warning']); } ?>
      <div>
            <div class="card mb-30">
                <div class="card-body">
                    <?php if(!empty($_SESSION['form_error'])){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
                                    <?php unset($_SESSION['form_error']); } ?>
                                    <?php if(!empty($_SESSION['form_success'])){ ?>
                                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
                                    <?php unset($_SESSION['form_success']); } ?>
                                    <form id='journal_publish_form' method="POST" action="../backend.php" enctype="multipart/form-data" >
                                    <input type="hidden" name='publish_journal_archive' value="aPanel.php"/> 
                                        <div class="row" id="resub_title">
                                            <h6>Journal Title:</h6>
                                            <div class="col-12 form-group ">
                                                <input type="text" id="journal-title" name="journal-title"  placeholder="Journal Title" class="form-control validate"
                                                value="">
                                                <span class="validation-error" id="journal-title-error"></span>
                                            </div>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <h6>Authors Name:</h6>
                                            <div class="form-group col-12 ">
                                                <input type="text" id="authors-name" name="authors-name"  placeholder="Authors Name (separated by commas)" class="form-control validate"
                                                value="">
                                                <span class="validation-error" id="authors-name-error"></span>
                                            </div>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h6>Year:</h6>
                                                <input type="text" name="year" id='year'  placeholder="Year" class="form-control validate"
                                                value="">
                                                <span class="validation-error" id="year-error"></span>
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h6>Volume:</h6>
                                                <input type="text" name="volume" id='volume'  placeholder="Volume" class="form-control validate"
                                                value="">
                                                <span class="validation-error" id="volume-error"></span>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <h6>Issue:</h6>
                                                <input type="text" name="issue" id='issue'  placeholder="issue" class="form-control validate"
                                                value="">
                                                <span class="validation-error" id="issue-error"></span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                                                <h6>Start Page : </h6>
                                                <div class="form-group">
                                                    <input type="text" id="page_start" name="page_start" placeholder="Start" class="form-control col-md-12 validate" value="">
                                                    <span class="validation-error" id="page_start-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                <h6>End Page : </h6>
                                                <div class="form-group">
                                                    <input type="text" id="page_end" name="page_end" placeholder="End" class="form-control col-md-12 validate" value="">
                                                    <span class="validation-error" id="page_end-error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="abstract_row" style="padding:15px;">
                                            <h6>Abstract:</h6>
                                            <textarea class="form-control col-md-12" name="abstract" id="abstract"></textarea>
                                            <span class="validation-error" id="abstract-error"></span>
                                        </div>
                                        <div class="row" id="resub_title">
                                            <h6>Keywords : </h6>
                                            <div class="form-group col-12 ">
                                                <input type="text" id="keywords" name="keywords" placeholder="Keywords (separated by commas)" class="form-control validate"
                                                    value="">
                                                <span class="validation-error" id="keywords-error"></span>
                                            </div>
                                        </div>
                                        <div class="row " id="id4">
                                            <h6>Journal File:</h6>
                                            <div class="file-field form-group col-md-12" id="resub_file">
                                                <div class="col-md-12 admin-upload-btn">
                                                    <input type="file" style="background-color: #d5eeff;width: 100%;padding: 8px;border: 1px dashed;" id="journal-file" name="journal-file">
                                                    <span class="validation-error" id="journal-file-error"></span>
                                                </div>
                                                <p>Note:(doc,docs,pdf only Can upload  )</p>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="form-group col s12">
                                                <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                                                <input type="submit" id="publish_journal_submit_btn" name="journal_submit_button" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;"></button></i>
                                            </div>
                                        </div>
                                    </form>
                </div>
            </div>
          </div>
          <script type="text/javascript">
    $(document).ready(function(){
        $(".validation-error").prev().keyup(function(){
            $(this).next().hide();
            $(".form-error, .form-success").hide();
        });
        $("#journal-file").change(function(){
            $(".form-error, .form-success").hide();
        });
        $('#journal_publish_form').submit(function(e){
            $(".loader-mask").show();
            $(".validation-error").empty().hide();
            var error = 0;
            //Title validation
            $title_regex = "[^.*$]{5,}";
            if(!$("#journal-title").val().match($title_regex)) {
               $("#journal-title-error").html("Journal title must contain atleast 5 characters").show();
               error = 1;
            }
            //Authors Validation
            // $author_regex = "[^.*$]{5,}";
            // if(!$("#authors-name").val().match($author_regex)) {
            //    $("#authors-name-error").html("Authors name must contain atleast 3 characters").show();
            //    error = 1;
            // }
            //Volume validation
            $volume_regex = "^[0-9]{1,5}$";
            if(!$("#volume").val().match($volume_regex)) {
               $("#volume-error").html("Volume is numeric and must contain atleast 1 characters").show();
               error = 1;
            }
            //Issue Validation
            $issue_regex = "[^.*$]{3,}";
            if(!$("#issue").val().match($issue_regex)) {
               $("#issue-error").html("Issue must contain atleast 5 characters").show();
               error = 1;
            }
            //Abstract Validation
            // $abstract_regex = "[^.*$]{100,}";
            // var abstract = $.trim($("#abstract").val());
            // if(!abstract.match($abstract_regex)) {
            //    $("#abstract-error").html("Abstract must contain atleast 100 characters").show();
            //    error = 1;
            // }
            //Keywords Validation
            // $keyword_regex = "^.{5,}$";
            // if(!$("#keywords").val().match($keyword_regex)) {
            //    $("#authors-name-error").html("Keywords must contain atleast 5 characters").show();
            //    error = 1;
            // }
            //File Validation
            //$file_regex = "";
            if(error == 1){
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php include_once('footer.php');