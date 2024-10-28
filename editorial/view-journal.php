<?php
include_once('manager_header.php');
if(!empty($_GET['manuscript'])){
  $manuscript = $_GET['manuscript'];
  $journal_data = $db->query("SELECT id, user_id, title, author, affiliation, subject, type, year, main_file, title_file, info_file, status, manuscript_id, resubmitted,main_file_type,title_file_type FROM tbl_journal WHERE id=$manuscript");
  if(!empty($journal_data->row->id)){
      $main_file_type = $journal_data->row->main_file_type;
      $title_file_type = $journal_data->row->title_file_type;

    $main_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->main_file;
    $title_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->title_file;
   // $info_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->info_file;
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
                        Verify and Approve Journal
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="active col-lg-3 col-md-3 col-sm-12 btn-view-files" id="main-file">Main File</button>
                        <button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="title-file">Title File</button>
                        <!--<button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="info-file">Info Data</button>-->
                    </div>
                </div>
                <div class="col-md-12 file-section mt30">
                <?php if($main_file_type == 'pdf'){
                    ?>
                    <embed class="mb-30" id="pdf_file" src="<?php echo $main_file; ?>" width="100%" height="720px" />
                <?php } else{?>
                   <iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $main_file.'?version='.date('dHis');?>' width='320' height='240' frameborder='0'></iframe>
                   <?php } ?>
                </div>
                <div class="col-md-12 text-right">
                    <a class="btn btn-primary" href="<?php echo $main_file;?>" target="_blank">Download Journal</a>
                    <?php if($journal_data->row->status != '3') { ?>
                    <button data-toggle="modal" data-target="#withdraw-modal" class="btn btn-dark" id="withdraw-journal" journal_id="<?php echo $journal_data->row->id;?>">Withdraw Journal</button>
                    <?php } ?>                   
                   <?php if($journal_data->row->status == '0') { ?>
                    <button data-toggle="modal" data-target="#reject-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Reject with Comments</button>
                    <button class="btn btn-success" id="verified-and-approve" journal_id="<?php echo $journal_data->row->id;?>">Verify and Approve</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reject-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Journal - <?php echo $journal_data->row->manuscript_id;?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 14px;"><strong> Please provide the reason to reject the journal</strong></span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <textarea id="reject-reason" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-danger" id="reject-journal">Reject Journal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="withdraw-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdraw Journal - <?php echo $journal_data->row->manuscript_id;?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 14px;"><strong>Are you sure about withdraw this journal? This action cannot be reverted.!</strong></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-danger" id="withdraw-journal-btn">Withdraw Journal</button>
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
            /*$("#info-file").click(function(){
                $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $info_file;?>" width="100%" height="720px" />');
            });*/
            $("#verified-and-approve").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(manuscript_id == undefined || manuscript_id == null || manuscript_id == ''){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../manager_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'journal_approve_by_manager'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend: function(){
                        $("#verified-and-approve").attr("disabled");
                    },
                    success: function(response){ //console.log(response);
                        $(".loader-mask").hide();
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/pending_journals.php");
                        } else if(response == '0'){
                            alert("Something Went Wrong");
                            $(".loader-mask").hide();
                            $("#verified-and-approve").removeAttr("disabled");
                        }
                    },
                    error: function(response){
                        alert(response);
                        $(".loader-mask").hide();
                        $("#verified-and-approve").removeAttr("disabled");
                    }
                });
            });
            $("#reject-journal").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                var reason = $("#reject-reason").val();
                if(isEmpty(reason)){
                    alert("Please provide reason to reject the journal");
                    return false;
                }
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../manager_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        reason : reason,
                        action : 'reject-journal'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#reject-journal").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        //if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/pending_journals.php");
                        //}
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#reject-journal").removeAttr("disabled");
                    }
                });
            });
            $("#withdraw-journal-btn").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../manager_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'withdraw-journal'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#withdraw-journal-btn").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        window.location.replace("<?php echo APP_URL;?>editorial/view-journal.php");
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#reject-journal-btn").removeAttr("disabled");
                    }
                });
            });
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
<?php include_once('footer.php');