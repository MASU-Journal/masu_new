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
  $editors_qry = $db->query("SELECT admin_id, admin_name, admin_cat_id FROM tbl_admin WHERE admin_cat_id IN ('1','2','3') AND is_deleted = '0' order by admin_name ASC");
  if($editors_qry->count > 0){
    foreach($editors_qry->rows as $key => $row){
        $editors[$row->admin_id] = $row->admin_name;
    }
  }
}

$journal_assign_data = $db->query("SELECT assigned_to from tbl_journal_assigned  where 	journal_id = $manuscript");

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
                    <button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="title-file">Title File</button>
                   <!-- <button class="col-lg-3 col-md-3 col-sm-12 btn-view-files" id="info-file">Info Data</button>-->
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

                <?php /*if($journal_data->row->status == '1' || $journal_data->row->status == '6') { */?>
                    <div class="col-md-12 text-right">
                        <a id="download-btn" class="btn btn-secondary" href="<?php echo $main_file;?>" target="_blank">Download</a>
                        <a class="btn btn-info" href="c_author_upload.php?manuscript=<?php echo $journal_data->row->id;?>" target="_blank">Upload</a>
                        <?php if($journal_data->row->status == '6') { ?>
                            <button class="btn btn-primary" id="back-2-author" journal_id="<?php echo $journal_data->row->id;?>">Send back to Author</button>
                        <?php } ?>
                    
                        <?php if(in_array($journal_data->row->status, ['1'])) { ?>
                        <button data-toggle="modal" data-target="#reject-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Revision</button>
                        <button class="btn btn-warning" id="verified-and-approve" data-toggle="modal" data-target="#assign-editors-modal">Request a Reviewer</button>
                        <?php 
                            if(!empty($journal_assign_data->row->assigned_to)){
                                ?>
                                 <button class="btn btn-primary" id="reassign-to-editors"  journal_id="<?php echo $journal_data->row->id;?>" >Re-Assign</button>
                        <?php
                            }
                        } ?>
                        <?php if(in_array($journal_data->row->status, ['11','12'])) { ?>
                            <button class="btn btn-success" id="verified-and-approve" data-toggle="modal" data-target="#assign-editors-modal">Change Reviewer</button>
                        <?php } ?>
                        <?php if(in_array($journal_data->row->status, ['11'])) { ?>
                            <button data-toggle="modal" data-target="#final-reject-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Reject</button>
                        <?php } ?>
                        <?php if(in_array($journal_data->row->status, ['5'])) { ?>
                            <button class="btn btn-warning" id="alert-reviewer" journal_id="<?php echo $journal_data->row->id;?>">Alert Reviewer</button>
                        <?php } ?>
                        <?php
                        if ($journal_data->row->status == '8' || $journal_data->row->status == '1' ) {
                            ?>
                            <button data-toggle="modal" data-target="#final-reject-modal" class="btn btn-danger" id="back-2-form" journal_id="<?php echo $journal_data->row->id;?>">Reject</button>
                            <button class="btn btn-success" id="publishbtn" data-toggle="modal" data-target="#publish-modal">Publish</button>
                        <?php
                        } ?>
                    </div>                
            </div>
        </div>
    </div>
<div class="modal fade basicModalLG" id="assign-editors-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign to Editor</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 14px;"><strong>Note : </strong>Hold control button and click to select multiple users</span>
                    </div>
                </div>
                <br> -->
                <div class="row">
                    <div class="col">
                        <?php 
                        if(!empty($editors)){ ?>
                            <div class="form-group">
                                <label>Editors</label>
                                <select class="form-control select-associate select-editor" editor-type="editors">
                                    <?php foreach($editors as $a_id=>$a_name) { ?>
                                        <option value="<?php echo $a_id; ?>"><?php echo $a_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6>Selected Editor</h6>
                        <input type="hidden" name="selected-editor-id" id="selected-editor-id" value="">
                        <div class="alert alert-warning" id="selected-editors-list" role="alert">No editor selected yet</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="assign-to-editors">Request to review</button>
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
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="reject-journal">Reject Journal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="final-reject-modal" role="dialog" aria-hidden="true">
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
                            <textarea id="final-reject-reason" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="final-reject-journal">Reject Journal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="publish-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Publish Article - <?php echo $journal_data->row->manuscript_id;?></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 14px;"><strong> Are you sure want to publish this article?</strong></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="publish-articlebtn">Publish Article</button>
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

            var selected_editors = {};
              <?php foreach($editors as $key => $val) { ?>
                selected_editors['<?php echo $key; ?>'] = '<?php echo $val; ?>';
              <?php } ?>
            $(".btn-view-files").click(function(){
                $(".btn-view-files").removeClass("active");
                $(this).addClass("active");
            });
            $("#main-file").click(function(){ 
                $("#download-btn").attr("href", "<?php echo $main_file;?>");
                var main_file_type = "<?php echo $main_file_type;?>";
                if(main_file_type == 'pdf'){
                    $(".file-section").empty().html('<embed class="mb-30" id="merged_pdf" src="<?php echo $main_file;?>" width="100%" height="720px" />');
                }
               else{
                  $(".file-section").empty().html("<iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $main_file;?>' width='320' height='240' frameborder='0'></iframe>");
               }
            });
            $("#title-file").click(function(){
                $("#download-btn").attr("href", "<?php echo $title_file;?>");
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
            $(".select-editor").click(function(){
                //alert("sds1");
                $("#selected-editors-list").empty();
                $("#selected-editor-id").val('');
                if(!isEmpty(selected_editors[$(this).val()])){
                    $("#selected-editors-list").html("<p class=\"text-warn\">"+selected_editors[$(this).val()]+"</p>");
                    $("#selected-editor-id").val($(this).val());
                } else {
                    $("#selected-editors-list").html("No editor selected yet");
                }
            });
            $("#reassign-to-editors").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                $(".loader-mask").show();
                console.log(manuscript_id);
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'journal_reassign_by_chief'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#verified-and-approve").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        window.location.replace("<?php echo APP_URL;?>editorial/c-resubmitted-journals.php");
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#verified-and-approve").removeAttr("disabled");
                    }
                });
            });

            $("#assign-to-editors").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                var editors_selected = $("#selected-editor-id").val();
                if(isEmpty(manuscript_id)){
                    return false;
                } else if(isEmpty(editors_selected)){
                    alert("Please select a reviewer!");
                    return false;
                }
                $(".loader-mask").show();
                
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        editors : editors_selected,
                        action : 'journal_assign_by_chief'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#verified-and-approve").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        //if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-pending-journals.php");
                        //}
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#verified-and-approve").removeAttr("disabled");
                    }
                });
            });

            $("#back-2-author").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'back-2-author'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#reject-journal").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        //if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-reviewer-revised.php");
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

            $("#alert-reviewer").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'alert-reviewer'
                    },
                    dataType: 'text',
                    cache: false,
                    beforeSend : function(){
                        $("#alert-reviewer").attr("disabled");
                    },
                    success : function(response){
                        $(".loader-mask").hide();
                        alert(response);
                    },
                    error : function(response){
                        $(".loader-mask").hide();
                        alert(response);
                        $("#alert-reviewer").removeAttr("disabled");
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
                    url: '../chiefeditor_functions.php',
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
                            window.location.replace("<?php echo APP_URL;?>editorial/c-pending-journals.php");
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


            $("#final-reject-journal").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                var reason = $("#final-reject-reason").val();
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
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        reason : reason,
                        action : 'final-reject-journal'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#final-reject-journal").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        //if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-rejected-journals.php");
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

            $("#publish-articlebtn").click(function(){
                var manuscript_id = $(this).attr("journal_id");
               
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        action : 'publish-journal'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#publish-articlebtn").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        //if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-published-journals.php");
                        //}
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#publish-articlebtn").removeAttr("disabled");
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