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
                
                    <div class="col-md-12 text-right">
                    
                        <button class="btn btn-success" id="verified-and-approve" data-toggle="modal" data-target="#assign-editors-modal">Re-assign Journal</button>
                    </div>
               
            </div>
        </div>
    </div>
<div class="modal fade basicModalLG" id="assign-editors-modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Editors</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span class="text-info" style="font-size: 14px;"><strong>Note : </strong>Hold control button and click to select multiple users</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <?php 
                        if(!empty($editors['associate'])){ ?>
                            <div class="form-group">
                                <label>Associate</label>
                                <select multiple class="form-control select-associate select-editor" editor-type="Associate">
                                    <?php foreach($editors['associate'] as $a_id=>$a_name) { ?>
                                        <option value="<?php echo $a_id; ?>"><?php echo $a_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col">
                        <?php 
                        if(!empty($editors['technical'])){ ?>
                            <div class="form-group">
                                <label>Technical</label>
                                <select multiple class="form-control select-technical select-editor" editor-type="Technical">
                                    <?php foreach($editors['technical'] as $t_id=>$t_name) { ?>
                                        <option value="<?php echo $t_id; ?>"><?php echo $t_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col">
                        <?php 
                        if(!empty($editors['refree'])){ ?>
                            <div class="form-group">
                                <label>Refree</label>
                                <select multiple class="form-control select-refree select-editor" editor-type="Refree">
                                    <?php foreach($editors['refree'] as $r_id=>$r_name) { ?>
                                        <option value="<?php echo $r_id; ?>"><?php echo $r_name; ?></option>
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
                        <h6>Selected Editors</h6>
                        <div class="alert alert-warning" id="selected-editors-list" role="alert">No editors selected yet</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" journal_id="<?php echo $journal_data->row->id;?>" class="btn btn-primary" id="assign-to-editors">Assign to editors</button>
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
    <script type="text/javascript">
        $(document).ready(function(){
            function isEmpty(value){
                if(value != '' && value != null && value != undefined){
                    return false;
                }
                return true;
            }
            var associate = <?php echo json_encode($editors['associate']); ?>;
            var technical = <?php echo json_encode($editors['technical']); ?>;
            var refree = <?php echo json_encode($editors['refree']); ?>;
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
            $(".select-editor").click(function(){
                //alert("sds1");
                $("#selected-editors-list").empty();
                var total_selected = 0;
                var associate_selected = $(".select-associate").val();
                var technical_selected = $(".select-technical").val();
                var refree_selected = $(".select-refree").val();
                
                if(!isEmpty(associate_selected)){
                    total_selected += associate_selected.length;
                }
                if(!isEmpty(technical_selected)){
                    total_selected += technical_selected.length;
                }
                if(!isEmpty(refree_selected)){
                    total_selected += refree_selected.length;
                }
                if(total_selected == 0){
                //     alert("Sorry.. You cannot choose more than two editors");
                //     var editor_type = $(this).attr();
                //     if(!isEmpty(associate_selected)){
                //         total_selected += associate_selected.length;
                //     }
                //     if(!isEmpty(technical_selected)){
                //         total_selected += technical_selected.length;
                //     }
                //     if(!isEmpty(refree_selected)){
                //         total_selected += refree_selected.length;
                //     }
                $("#selected-editors-list").html("No editors selected yet");
                } else {
                    if(!isEmpty(associate_selected)){
                        $.each(associate_selected, function( index, value ) {
                          $("#selected-editors-list").append("<p class=\"text-warn\"><strong>Associate :</strong> "+associate[value]+"</p>");
                        });
                    }
                    if(!isEmpty(technical_selected)){
                        $.each(technical_selected, function( index, value ) {
                          $("#selected-editors-list").append("<p class=\"text-warn\"><strong>Technical :</strong> "+technical[value]+"</p>");
                        });
                    }
                    if(!isEmpty(refree_selected)){
                        $.each(refree_selected, function( index, value ) {
                          $("#selected-editors-list").append("<p class=\"text-warn\"><strong>Refree :</strong> "+refree[value]+"</p>");
                        });
                    }
                }
            });
            $("#assign-to-editors").click(function(){
                var manuscript_id = $(this).attr("journal_id");
                if(isEmpty(manuscript_id)){
                    return false;
                }
                $(".loader-mask").show();
                var associate_selected = $(".select-associate").val();
                var technical_selected = $(".select-technical").val();
                var refree_selected = $(".select-refree").val();
                var editors_selected = [];
                if(!isEmpty(associate_selected)){
                    editors_selected = editors_selected.concat(associate_selected);
                }
                if(!isEmpty(technical_selected)){
                    editors_selected = editors_selected.concat(technical_selected);
                }
                if(!isEmpty(refree_selected)){
                    editors_selected = editors_selected.concat(refree_selected);
                }
                $.ajax({
                    type: 'POST',
                    url: '../chiefeditor_functions.php',
                    data: {
                        manuscript_id : manuscript_id,
                        editors : editors_selected,
                        action : 'journal_new_assign_by_chief'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                        $("#verified-and-approve").attr("disabled");
                    },
                    success : function(response){ console.log(response);
                        $(".loader-mask").hide();
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-assigned-journals.php");
                        }
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
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
                        if(response == '1'){
                            window.location.replace("<?php echo APP_URL;?>editorial/c-pending-journals.php");
                        }
                    },
                    error : function(response){
                        console.log(response);
                        //alert(response);
                        $(".loader-mask").hide();
                        $("#reject-journal").removeAttr("disabled");
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