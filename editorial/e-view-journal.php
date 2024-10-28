<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('editor-header.php');
if(!empty($_GET['manuscript'])){
  $manuscript = $_GET['manuscript'];
  $journal_data = $db->query("SELECT id, user_id, title, author, affiliation, subject, type, year, main_file, title_file, info_file, status, manuscript_id, resubmitted,main_file_type,title_file_type FROM tbl_journal WHERE id=$manuscript");
  if(!empty($journal_data->row->id)){
    $main_file_type = $journal_data->row->main_file_type;
    $title_file_type = $journal_data->row->title_file_type;
    $check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '".$journal_data->row->id."' AND assigned_to='".$_SESSION['admin_id']."'");
    if($check_query->count > 0){
        $main_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->main_file;
        $title_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->title_file;
        $info_file = APP_URL.'store_file/user_'.$journal_data->row->user_id.'_file/'.$journal_data->row->year.'/'.$journal_data->row->info_file;
    } else {
        $main_file = $title_file = $info_file = '';
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
<?php if(!empty($journal_data->rows)){ ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mb-30" id="confirmation-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        Verify and Assign Journal
                    </h3>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <button class="active col-lg-3 col-md-3 col-sm-12 btn-view-files" id="main-file">Main File</button>
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
                <a class="btn btn-primary" href="<?php echo $main_file;?>" target="_blank">Download</a>
                <?php if($journal_data->row->status == '5') { ?>
                    <!-- <a class="btn btn-danger" href="e_author_upload.php?manuscript=<?php echo $manuscript;?>">Upload & Revise</a> -->
                        
                    <a href="chat-editor.php?ref=<?php echo $journal_data->row->manuscript_id; ?>">
                    <button class="btn btn-success"journal_id="<?php echo $journal_data->row->manuscript_id;?>">Add Comments / Upload Document</button>
                    </a>
                    <button data-toggle="modal" data-target="#decline-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Decline</button>
                    <!-- <button data-toggle="modal" data-target="#reject-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Revise</button> -->
                    <!-- <button class="btn btn-success" id="verified-and-approve" data-toggle="modal" data-target="#approve-journal">Accept Article</button> -->
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="approve-journal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <span class="text-info" style="font-size: 18px;"><strong>Are you sure to approve this journal ?</strong></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="approve-journal-btn">Yes..Approve.!</button>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="decline-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <span class="text-info" style="font-size: 18px;"><strong>Please indicate one reason for not taking up the review</strong></span>
                    </div>
                    <div class="col-12" style="margin-top: 15px;">
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="decline-1" name="radio-stacked" required value='1'>
                            <label class="custom-control-label" for="decline-1">I do not have time right now.</label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="decline-2" name="radio-stacked" required value='2'>
                            <label class="custom-control-label" for="decline-2">There is a conflict of interest.</label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="decline-3" name="radio-stacked" required value='3'>
                            <label class="custom-control-label" for="decline-3">It does not fall within my area of expertise.</label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="decline-4" name="radio-stacked" required value='4'>
                            <label class="custom-control-label" for="decline-4">Other</label>
                          </div>
                    </div>
                    <div class="col-12" style="margin-top: 15px;" >
                        <textarea class="form-control" name="other_reason" id="other_reason" style="display: none;"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-danger" id="decline-journal-btn">Yes..Decline.!</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reject-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 18px;"><strong>Are you sure to reject this journal ?</strong></span><br>
                        <span class="text-danger" style="font-size: 14px;">Please make sure you have added the comments</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="reject-journal-btn">Yes..Revise.!</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cheifEditor-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 18px;"><strong>Upload Article to Cheif Editor</strong></span><br>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="reject-journal-btn">Yes..Reject.!</button>
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

            $("input[name=radio-stacked]").change(function(){
                if($(this).val() == '4'){
                    $("#other_reason").show();
                } else {
                    $("#other_reason").hide();
                }
            });
            
            $("#main-file").click(function(){
                var main_file_type = "<?php echo $main_file_type;?>";
                if(main_file_type == 'pdf'){
                    $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $main_file.'?version='.date('dHis');?>" width="100%" height="720px" />');
                }
               else{
                  $(".file-section").empty().html("<iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $main_file.'?version='.date('dHis');?>' width='320' height='240' frameborder='0'></iframe>");
               }
            });
            $(".btn-view-files").click(function(){
                $(".btn-view-files").removeClass("active");
                $(this).addClass("active");
            });
            // $("#title-file").click(function(){
            //     $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $title_file;?>" width="100%" height="720px" />');
            // });
            // $("#info-file").click(function(){
            //     $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $info_file;?>" width="100%" height="720px" />');
            // });
            $("#decline-journal-btn").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                var reason_id = $("input[name=radio-stacked]:checked").val();
                var other_reason = $("#other_reason").val();
                if(reason_id == '4'){
                    if(other_reason == '' || other_reason == null || other_reason == undefined){
                        alert('Please enter the Reason for the rejection');
                        return false;
                    }
                }

                if(reason_id == '' || reason_id == null || reason_id == undefined){
                        alert('Please enter the Reason for the rejection');
                        return false;
                }

                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../editor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        reason_id : reason_id,
                        other_reason : other_reason,
                        action : 'journal_decline_by_editor'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#decline-journal-btn").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/editor-dashboard.php");
                        }
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#decline-journal-btn").removeAttr("disabled");
                    }
                });
            });
            $("#approve-journal-btn").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../editor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'journal_approve_by_editor'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#approve-journal-btn").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/editor-dashboard.php");
                        }
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#approve-journal-btn").removeAttr("disabled");
                    }
                });
            });
            $("#reject-journal-btn").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../editor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'journal_reject_by_editor'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#reject-journal-btn").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/editor-dashboard.php");
                        }
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