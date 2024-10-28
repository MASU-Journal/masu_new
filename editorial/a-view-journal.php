<?php
include_once('header.php');
if(!empty($_GET['manuscript'])){
  $manuscript = $_GET['manuscript'];
  $journal_data = $db->query("SELECT id, user_id, title, author, affiliation, subject, type, year, main_file, title_file, info_file, status, manuscript_id, resubmitted,main_file_type,title_file_type FROM tbl_journal WHERE manuscript_id = '$manuscript' AND user_id = '".$_SESSION['user_id']."'");
  if(!empty($journal_data->row->id)){
    $main_file_type = $journal_data->row->main_file_type;
    $title_file_type = $journal_data->row->title_file_type;
    $main_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->main_file;
    $title_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->title_file;
    //$info_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->info_file;
  }
}
?>
<style type="text/css">
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
<?php if(!empty($journal_data->rows)){ ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mb-30" id="confirmation-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        Current Journal - <?php echo $journal_data->row->title; ?>
                    </h3>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <button class="active col-lg-3 col-md-3 col-sm-12 btn-view-files" id="main-file">Blinded Manuscript </button>
                    <button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="title-file">Title page with cover letter </button>
                    <!--<button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="info-file">Info Data</button>-->
                </div>
            </div>
                <div class="col-md-12 file-section mt30">
                <?php if($main_file_type == 'pdf'){
                    ?>
                    <embed class="mb-30" id="pdf_file" src="<?php echo $main_file; ?>" width="100%" height="720px" />
                <?php } else{?>
                   <iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $main_file;?>' width='320' height='240' frameborder='0'></iframe>
                   <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            function isEmpty(value){
                if(value != '' && value != null && value != undefined){
                    return false;
                }
                return true;
            }
            $(".btn-view-files").click(function(){
                $(".btn-view-files").removeClass("active");
                $(this).addClass("active");
            });
            $("#main-file").click(function(){
                var main_file_type = "<?php echo $main_file_type;?>";
                if(main_file_type == 'pdf'){
                    $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $main_file;?>" width="100%" height="720px" />');
                }
               else{
                  $(".file-section").empty().html("<iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $main_file;?>' width='320' height='240' frameborder='0'></iframe>");
               }
            });
            $("#title-file").click(function(){
                var title_file_type = "<?php echo $title_file_type;?>";
                if(title_file_type == 'pdf'){
                     $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $title_file;?>" width="100%" height="720px" />');
                }
                else{
                    $(".file-section").empty().html("<iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $title_file;?>' width='320' height='240' frameborder='0'></iframe>");
                }
            });
           /* $("#info-file").click(function(){
                $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $info_file;?>" width="100%" height="720px" />');
            });*/
        });
    </script>
<?php } else { ?>
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mb-30" id="confirmation-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        Journal is not available
                    </h3>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
<?php include_once('footer.php');?>
