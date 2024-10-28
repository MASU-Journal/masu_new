<?php
include_once('manager_header.php');
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
                <h1>Publish Archived Journals</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item">To Publish Archived Journals(2016 and Before)</li>
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
                                    <form id='journal_publish_form' method="POST" action="../excelUpload.php" enctype="multipart/form-data">
                                    <input type="hidden" name='publish_via_excel' value="excel-publish.php"/>
                                        <div class="row formhide" id="id4">
                                            
                                            <div class="file-field form-group col-md-12" id="resub_file">
                                                <h6>Journal File:</h6>
                                                <div class="col-md-12 admin-upload-btn">
                                                    <input type="file" style="background-color: #d5eeff;width: 100%;padding: 8px;" id="journal-file" name="journal-file">
                                                    <span class="validation-error" id="journal-file-error"></span>
                                                </div>
                                                <small>Note: .xlsx types only supported (Please make sure that you have placed all the PDF articles in the article folder)</smallp>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin:auto;">
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
        });
    });
</script>
<?php include_once('footer.php');