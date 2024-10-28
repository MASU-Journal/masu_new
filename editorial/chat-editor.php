<?php
include_once('editor-header.php');
$que_qry = $db->query("SELECT tq.question_id,tq.question,tq.is_deleted FROM tbl_questions tq");
$c_data = array();
$journal_exist = 0;
foreach($que_qry->rows as $id => $rw){
    $c_data[$rw->question_id]['question'] = $rw->question;
}
if(!empty($_GET['ref'])){
    $manuscript_id = $_GET['ref'];

    $journal_qry = $db->query("SELECT id, title, user_id, status, manuscript_id, resubmitted FROM tbl_journal WHERE manuscript_id = '$manuscript_id'");
    if(!empty($journal_qry->count)){
        $title = ucfirst($journal_qry->row->title);
        $j_id = $journal_qry->row->id;
        $check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '$j_id' AND assigned_to='".$_SESSION['admin_id']."'");
        if($check_query->count > 0){
            $journal_exist = 1;
            $comment_qry = $db->query("SELECT comment_id,ques_id, comments, journal_id, chat_by, user_id, admin_id, revision, created_date FROM tbl_comments WHERE journal_id = '$j_id' AND ((admin_id IN (".$_SESSION['admin_id'].",83,84) AND chat_by='0') OR chat_by='1')  ORDER BY ques_id, created_date");
            if(!empty($comment_qry->count)){
                foreach($comment_qry->rows as $key=>$row){
                    $c_data[$row->ques_id]['chat'][$row->comment_id]['comment'] = $row->comments;
                    $c_data[$row->ques_id]['chat'][$row->comment_id]['chat_by'] = $row->chat_by;
                    $c_data[$row->ques_id]['chat'][$row->comment_id]['created_date'] = $row->created_date;
                    $c_data[$row->ques_id]['chat'][$row->comment_id]['revision'] = $row->revision;
                }
            }
        }
    }
} else {
    $manuscript_id = '';
    $j_id = '';
}
?>
<style type="text/css">
    .notification-btn .badge-secondary{
        background: #e1000a;
        -webkit-animation: pulse-secondary 1.5s infinite;
        animation: pulse-secondary 1.5s infinite;
        -webkit-box-shadow: 0 0 0 rgba(255, 0, 10, 0.9);
        box-shadow: 0 0 0 rgba(255, 0, 10, 0.9);
    }
    .notification-btn .badge {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        font-size: 9px;
        line-height: 12px;
    }
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #ff4365;
    }
    .breadcrumb-area .breadcrumb .item {
        display: inline-flex;
        align-items: center;
    }
    .breadcrumb-area .breadcrumb .item::before{
        top : 11px;
    }
    #reviwer-ceditor-file-error{
        color : red;
    }
    /*.journal-title{
        border-bottom: 1px solid #101010 !important;
    }*/
    .chat-container"{
        max-height : 100px !important;
    }
</style>
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area">
        <h1>Comments </h1>
        <ol class="breadcrumb" style="width: 100%;">            
            <li class="item text-right" style="width: 100%;">
                <form action="#" method="get" style="width: 100%;">
                    <input placeholder="Manuscript ID" class="col-md-8 form-control d-inline-block" type="text" name="ref" id="manuscript_id" value="<?php echo $manuscript_id; ?>">
                    <button class="d-inline-block btn btn-info">Get Comments</button>
                </form>
            </li>
        </ol>
    </div>

    <?php if(!empty($journal_qry->count) && $journal_exist){ ?>
        <div class="alert alert-success" role="alert"><strong>Journal :</strong>  <?php echo $title; ?></div>
    <?php } ?>
    <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <div class="chat-content-area mt-20">
            <?php
                if(!empty($journal_qry->count) && !empty($c_data) && $journal_exist){
                    foreach($c_data as $key => $row){
                    ?>
                <div class="content-right" style="width : 100%;margin-bottom: 20px;">
                    <div class="chat-area">
                        <div class="chat-list-wrapper">
                            <div class="chat-list">
                                <div class="chat-list-header d-flex align-items-center" data-toggle="collapse" href="#chat_box_<?php echo $key;?>" role="button" aria-expanded="false" aria-controls="chat_box_<?php echo $key;?>" style="cursor: pointer;">
                                    <div class="header-left d-flex align-items-center mr-3">
                                        <div class="notification-btn">
                                        <h6 class="mb-0 font-weight-bold"><?php echo $key.') '.$row['question']; ?>
                                              
                                        <?php 
                                              if (!empty($row['chat'])) {
                                                  ?>
                                                 <span class="badge badge-secondary">1</span>
                                              <?php
                                              } ?>
                                              
                                        </h6>
                                        </div>  
                                        
                                    </div>
                                </div>
                                <div class="collapse multi-collapse" id="chat_box_<?php echo $key;?>" style="padding: 0;">
                                    <div data-simplebar class="chat-container" >
                                        <div class="chat-content" id="chat_content_<?php echo $key;?>">
<?php 
if(!empty($row['chat'])){
    foreach($row['chat'] as $c_id => $c_row){
        if($c_row['chat_by'] == '1'){
            $chat_class = "chat-left";
            $chat_img = "assets/img/author.png";
        } else {
            $chat_class = "";
            $chat_img = "assets/img/user.png";
        }
        ?>
        <div class="chat <?php echo $chat_class; ?>">
            <div class="chat-avatar">
                <a href="#" class="d-inline-block">
                    <img src="<?php echo $chat_img; ?>" width="50" height="50" class="rounded-circle" alt="image">
                </a>
            </div>
            <div class="chat-body">
                <div class="chat-message">
                    <p><?php echo $c_row['comment']; ?></p>
                    <?php 
                    if($c_row['revision'] == '0'){
                        $rev_text = 'First Submission';
                    } else {
                        $rev_text = 'Revision('.$c_row['revision'].')';
                    }
                    ?>
                    <span class="time d-block"><?php echo $rev_text.', '.date("d-M h:i A", strtotime($c_row['created_date'])); ?></span>
                </div>
            </div>
        </div>  
        <?php
    }
}
?>                                         
                                        </div>
                                    </div>
                                    <div class="chat-list-footer">
                                        <form class="d-flex align-items-center">
                                            <input id="comment_<?php echo $key;?>" type="text" class="form-control" placeholder="Type your message...">

                                            <button type="button" j_id="<?php echo $manuscript_id; ?>" q_id="<?php echo $key;?>" class="send-btn d-inline-block">Send <i class="bx bx-paper-plane"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php }
} else { ?>
            <div class="card mb-30" style="display: block;min-height:300px;">
              <div class="mt-30 card-header d-flex justify-content-between align-items-center journal-title" style="text-align: center;margin-top:80px;">
                  <h3>No comments available</h3>
              </div>                
            </div>

<?php
}
?>
            </div>
        </div>
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
                            <form id='e-author-upload-frm' method="POST" action="e-author-submit.php" enctype="multipart/form-data" >
                                <input type="hidden" name='e-author-upload'  value="e-author-upload" />
                                <input type="hidden" name='journal-id'  value="<?php echo $j_id; ?>" />
                                
                                <div class="file-field input-field" id="resub_file">
                                    <div class="admin-upload-btn">
                                    <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="reviwer-ceditor-file" name="reviwer-ceditor-file">
                                    </div>
                                    <p class="text-muted">Word File only (Maximum 5 MB)</p>
                                </div>
                                <span class="validation-error" id="reviwer-ceditor-file-error"></span>
                                <div class="text-right">
                                    <button type="button" class="btn btn-success" id="verified-and-approve" data-toggle="modal" data-target="#approve-journal">Recommended to publish</button>
                                    <button type="button" class="btn btn-danger" id="verified-and-reject" data-toggle="modal" data-target="#reject-journal">Not Recommended to publish</button>
                                    <button type="button" id="doc_submit" class="btn btn-warning">Revision Required</button>
                                </div>
                            </form>                    
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
                        <button type="button" journal_id="<?php echo $j_id;?>" class="btn btn-primary" id="approve-journal-btn">Yes..Approve.!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reject-journal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <span class="text-info" style="font-size: 18px;"><strong>Are you sure to mark this article as non-recommended?</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" journal_id="<?php echo $j_id;?>" class="btn btn-primary" id="reject-journal-btn">Yes..Approve.!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
            <!-- End -->
            <div class="flex-grow-1"></div>
            <script type="text/javascript">
                $(document).ready(function(){
                    function isEmpty(value){
                        if(value != '' && value != null && value != undefined){
                            return false;
                        }
                        return true;
                    }
                    $(".send-btn").click(function(){
                        var q_id = $(this).attr("q_id");
                        var j_id = $(this).attr("j_id");
                        var comment = $("#comment_"+q_id).val();
                        if(isEmpty(comment)){
                            return false;
                        }
                        $.ajax({
                            type: 'POST',
                            url: '../editor_functions.php',
                            data: {
                                j_id : j_id,
                                q_id : q_id,
                                comment : comment,
                                action : 'add_comment'
                            },
                            dataType: 'json',
                            cache: false,
                            beforeSend : function(){
                                $(".send-btn").attr("disabled");
                            },
                            success : function(response){
                                $(".loader-mask").hide();
                                $("#comment_"+q_id).val("");
                                if(response == '1'){
                                    var chat_content = '<div class="chat"><div class="chat-avatar"><a href="#" class="d-inline-block"><img src="assets/img/user.png" width="50" height="50" class="rounded-circle" alt="image"></a></div><div class="chat-body"><div class="chat-message"><p>'+comment+'</p><span class="time d-block"></span></div></div></div>';
                                    $("#chat_content_"+q_id).append(chat_content);
                                    var y = $("#chat_content_"+q_id).prop("scrollHeight");
                                    $(".simplebar-content-wrapper").scrollTop(y);
                                }
                            },
                            error : function(response){
                                console.log(response);
                                //alert(response);
                                $(".loader-mask").hide();
                                $(".send-btn").removeAttr("disabled");
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
                                recommended : 1,
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
                        var reason_id = 5;
                        var other_reason = '';
                        
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
                                $("#reject-journal-btn-journal-btn").removeAttr("disabled");
                            }
                        });
                    });
                    $("#reviwer-ceditor-file").change(function() {
                        var file = this.files[0];
                        var fileType = file.type;
                        //alert(file);
                        var match = ['application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                        if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                            //alert('Sorry, only Word files are allowed to upload.');
                            //$("#reviwer-ceditor-file").val('');
                            //return false;
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
                            $("#e-author-upload-frm").submit();
                        }
                    });
                });
            </script>



<?php include_once('footer.php');