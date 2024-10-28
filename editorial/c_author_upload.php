<?php
include_once('chief_header.php');
if(!empty($_GET['manuscript'])){
    $manuscript = $_GET['manuscript'];
    $journal_data = $db->query("SELECT id, user_id, title, author, affiliation, subject, type, year, main_file, title_file, info_file, status, manuscript_id, resubmitted,main_file_type,title_file_type FROM tbl_journal WHERE id=$manuscript");
    if(!empty($journal_data->row->id)){
      $main_file_type = $journal_data->row->main_file_type;
      $title_file_type = $journal_data->row->title_file_type;
      $main_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->main_file;
      $title_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->title_file;
      //$info_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->info_file;
    }
    $editors = array();
    $editors_qry = $db->query("SELECT admin_id, admin_name, admin_cat_id FROM tbl_admin WHERE admin_cat_id IN ('1','2','3') AND is_deleted = '0'");
    if($editors_qry->count > 0){
      foreach($editors_qry->rows as $key => $row){
          if($row->admin_cat_id == '1'){
              $editors['associate'][$row->admin_id] = $row->admin_name;
          } else if($row->admin_cat_id == '2'){
              $editors['technical'][$row->admin_id] = $row->admin_name;
          } else if($row->admin_cat_id == '3'){
              $editors['refree'][$row->admin_id] = $row->admin_name;
          }
      }
    }
  }
?>
<style type="text/css">
    .text-warn{
        color : #856404 !important;
    }
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #ff4365;
    }
    .btn-view-files.active{
        background-color: #20A4F3;
        color: #FFFFFF;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .btn-view-files{
        color: #475F7B;
        border-radius: 5px;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        text-decoration: none;
        background-color: #ffffff;
        background-color: #f7f7f7;
        font-size: 15px;
        font-weight: 700;
        padding-left: 25px;
        padding-right: 25px;
        padding-top: 12px;
        padding-bottom: 12px;
        border: 1px solid transparent;
        margin-right: 20px;
    }
    .file-section{
        margin-top: 30px;
    }
</style>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mb-30" id="confirmation-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                       Upload Document To Author
                    </h3>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <?php if(!empty($_SESSION['form_error'])){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
                                    <?php unset($_SESSION['form_error']); } ?>
                                    <?php if(!empty($_SESSION['form_success'])){ ?>
                                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
                                    <?php unset($_SESSION['form_success']); } ?>
					<form id='cheif-author-upload-frm' method="POST" action="cheif-author-submit.php" enctype="multipart/form-data" >
						<input type="hidden" name='cheif-author-upload'  value="cheif-author-upload" />
                        <input type="hidden" name='journal-id'  value="<?php echo $manuscript?>" />
                        
						<div class="file-field input-field" id="resub_file">
                            <div class="admin-upload-btn">
                            <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="reviwer-ceditor-file" name="reviwer-ceditor-file">
                            </div>
                            <p class="text-muted">Word File only (Maximum 5 MB)</p>
                        </div>
                        <span class="validation-error" id="reviwer-ceditor-file-error"></span>
                        <div class="text-right">
                            <button type="button" id="doc_submit" class="btn btn-success">Submit Document</button>
                        </div>
					</form>                    

                </div>
            </div>
               
               
            </div>
        </div>
    </div>
<script>
	$(document).ready(function(){
		 $("#reviwer-ceditor-file").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            console.log(fileType);
            var match = ['application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only Word files are allowed to upload.');
                $("#reviwer-ceditor-file").val('');
                return false;
            }
        });
        $("#reviwer-ceditor-file").change(function(){
            $(".form-error, .form-success").hide();
            $(".validation-error").hide();
        });
        
        $('#doc_submit').click(function(e){
            $(".loader-mask").show();
            $(".validation-error").empty().hide();
            var error = 0;
            
             $doc_file = "[^.*$]{1,}";
            if(!$("#reviwer-ceditor-file").val().match($doc_file)) {
               $("#reviwer-ceditor-file-error").html("Please select a file").show();
               error = 1;
            }
            
            if(error == 1){
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            } else {
                $("#cheif-author-upload-frm").submit();
            }
        });
	});
</script>


<?php include_once('footer.php');

