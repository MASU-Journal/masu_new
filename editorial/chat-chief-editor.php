<?php
include_once('chief_header.php');
$que_qry = $db->query("SELECT tq.question_id,tq.question,tq.is_deleted FROM tbl_questions tq");
$c_data = array();
foreach($que_qry->rows as $id => $rw){
    $c_data[$rw->question_id]['question'] = $rw->question;
}
if(!empty($_GET['ref'])){
    $manuscript_id = $_GET['ref'];
    $journal_qry = $db->query("SELECT id, title, user_id, status, manuscript_id, resubmitted FROM tbl_journal WHERE manuscript_id = '$manuscript_id'");
    if(!empty($journal_qry->count)){
        $title = ucfirst($journal_qry->row->title);
        $j_id = $journal_qry->row->id;
        $admin_ids = $user_ids = array();
        $comment_qry = $db->query("SELECT comment_id,ques_id, comments, journal_id, chat_by, user_id, admin_id, revision, created_date FROM tbl_comments WHERE journal_id = '$j_id' ORDER BY ques_id, created_date");
        if(!empty($comment_qry->count)){
            foreach($comment_qry->rows as $key=>$row){
                $cht_by = $row->chat_by;
                if($cht_by == '1'){
                    if(!in_array($row->user_id, $user_ids)){
                        $user_ids[] = $row->user_id;
                    }
                    $user_id = $row->user_id;
                } else {
                    if(!in_array($row->admin_id, $admin_ids)){
                        $admin_ids[] = $row->admin_id;
                    }
                    $user_id = $row->admin_id;
                }
                $c_data[$row->ques_id]['chat'][$row->comment_id]['comment'] = $row->comments;
                $c_data[$row->ques_id]['chat'][$row->comment_id]['chat_by'] = $row->chat_by;
                $c_data[$row->ques_id]['chat'][$row->comment_id]['created_date'] = $row->created_date;
                $c_data[$row->ques_id]['chat'][$row->comment_id]['revision'] = $row->revision;
                $c_data[$row->ques_id]['chat'][$row->comment_id]['messager'] = $user_id;
            }
        }
    }
} else {
    $manuscript_id = '';
}
$user_names = $admin_names = array();
if(!empty($user_ids)){
    foreach($user_ids as $index=>$uid){
        $qry = $db->query("SELECT user_instutename FROM tbl_user WHERE user_id = '$uid'");
        if(!empty($qry->row->user_instutename)){
            $user_names[$uid] = $qry->row->user_instutename;
        }
    }
}
if(!empty($admin_ids)){
    foreach($admin_ids as $index=>$uid){
        $qry = $db->query("SELECT admin_name FROM tbl_admin WHERE admin_id = '$uid'");
        if(!empty($qry->row->admin_name)){
            $admin_names[$uid] = $qry->row->admin_name;
        }
    }
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
    /*.journal-title{
        border-bottom: 1px solid #101010 !important;
    }*/
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

    <?php if(!empty($journal_qry->count)){ ?>
        <div class="alert alert-success" role="alert"><strong>Journal :</strong>  <?php echo $title; ?></div>
    <?php } ?>
            
    <div class="chat-content-area mt-20">
            <?php
                if(!empty($journal_qry->count) && !empty($c_data)){
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
                    if($c_row['chat_by'] == '0'){
                        $name_text = (!empty($admin_names[$c_row['messager']])) ? 'by - '.$admin_names[$c_row['messager']].', ' : '';
                    } else {
                        $name_text = (!empty($user_names[$c_row['messager']])) ? 'by - '.$user_names[$c_row['messager']].', ' : '';
                    }
                    if($c_row['revision'] == '0'){
                        $rev_text = 'First Submission';
                    } else {
                        $rev_text = 'Revision('.$c_row['revision'].')';
                    }
                    ?>
                    <span class="time d-block"><?php echo $name_text.$rev_text.', '.date("d-M h:i A", strtotime($c_row['created_date'])); ?></span>
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
                            url: '../chiefeditor_functions.php',
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
                });
            </script>
<?php include_once('footer.php');