<?php
include_once('connection.php');
include_once('db.php');
include_once('conf.php');
include_once('common_functions.php');

if(empty($_SESSION['admin_login']) || empty($_SESSION['role_id']) || $_SESSION['admin_login'] != 'yes' || $_SESSION['role_id'] != '4') {
    header("Location:".APP_URL."logout.php");
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'alert-reviewer') {
    // Get the manuscript
    // check the status is in 5 or not
    // Get the article data, reviewer name, manuscript id, assigned_date, url
    if(empty($_POST['manuscript_id'])) {
        echo "Invalid request";
        exit;
    }
    $manuscript_id = trim($_POST['manuscript_id']);
    $mail_data = array();
    $check_qry = $db->query("SELECT id,title,abstract,status,manuscript_id,resubmitted from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || $check_qry->row->status != '5') {
        echo "Invalid request.!";
        exit;
    }

    $data_qry = $db->query("SELECT tja.assigned_date,ta.admin_name,ta.admin_mail from tbl_journal AS tj INNER JOIN tbl_journal_assigned AS tja ON (tj.id = tja.journal_id) INNER JOIN tbl_admin AS ta ON (ta.admin_id = tja.assigned_to) WHERE tj.id=$manuscript_id AND tj.status='5' LIMIT 1");
    
    if(empty($data_qry->row->assigned_date) || empty($data_qry->row->admin_name)) {
        echo "Invalid request..!";
        exit;
    }
    
    $mail_data['name'] = $data_qry->row->admin_name;
    $mail_data['assigned_date'] = $data_qry->row->assigned_date;
    $emailVal = $data_qry->row->admin_mail;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
        
    $mail_data['url'] = APP_URL.'auth/login.php';
    //sendEmail($emailVal , 'Journal For Review (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'assgin_reviewer_mail.php', $mail_data);
    sendEmail($emailVal, 'MAJ: Review Alert for Article - '.$check_qry->row->manuscript_id, 'reviewer_alert_mail.php', $mail_data);
    echo "Alert mail sent to reviewer.!";
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'journal_assign_by_chief') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $editor = trim($_POST['editors']);
    $revision = 0;
    $mail_data = array();
    $check_qry = $db->query("SELECT id,title,abstract,status,manuscript_id,resubmitted from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || ($check_qry->row->status != '1' && $check_qry->row->status != '11' && $check_qry->row->status != '12')) {
        echo '0';
        exit;
    } else {
        $revision = $check_qry->row->resubmitted;
    }
    if(empty($editor)) {
        echo '0';
        exit;
    }

    $mail_data['article_title'] = $check_qry->row->title;
    $mail_data['article_id'] = $check_qry->row->id;
    $mail_data['article_abstract'] = $check_qry->row->abstract;
    
    $update_data = [
        'status' => '3'
    ];
    $where = [
        'journal_id' => $manuscript_id,
        'status' => '0'
    ];
    $db->upDate("tbl_review_requests", $update_data, $where);

    $dt = date("Y-m-d H:i:s");
    $token = randomText(25);
    $insert_data = array();
    $insert_data['journal_id'] = $manuscript_id;
    $insert_data['reviewer_id'] = $editor;
    $insert_data['revision'] = $revision;
    $insert_data['assigned_date'] = $dt;
    $insert_data['status'] = '0';
    $insert_data['assigned_by'] = $_SESSION['admin_id'];
    $insert_data['token'] = $token;
    $assigned_id = $db->insert('tbl_review_requests', $insert_data);

    // $insert_data = array();
    // $insert_data['journal_id'] = $manuscript_id;
    // $insert_data['assigned_to'] = $editor;
    // $insert_data['revision'] = $revision;
    // $insert_data['assigned_date'] = $dt;
    // $insert_data['status'] = '0';
    // $insert_data['assigned_by'] = $_SESSION['admin_id'];
    // $assigned_id = $db->insert('tbl_journal_assigned', $insert_data);

    $update_data = array(
        'status' => '12'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);

    $userDetails = $db->query("SELECT * FROM tbl_admin where admin_id = '".$editor."' ");
    
    $mail_data['name'] = $userDetails->row->admin_name;
    $emailVal = $userDetails->row->admin_mail;
    $mail_data['email'] = $userDetails->row->admin_mail;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    $mail_data['token'] = $token;
        
    $mail_data['url'] = APP_URL.'auth/login.php';
    $mail_data['redirect_url'] = APP_URL.'editorial/e-view-journal.php?manuscript='.$mail_data['article_id'].'&email='.$mail_data['email'];
    //sendEmail($emailVal , 'Journal For Review (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'assgin_reviewer_mail.php', $mail_data);
    sendEmail($emailVal, 'MAJ: Review Request for Article - '.$check_qry->row->manuscript_id, 'reviewer_request_mail.php', $mail_data);
    $_SESSION['form_success'] = 'Article Review Request sent to the editor - '.$userDetails->row->admin_name.' (Manuscript ID - '.$check_qry->row->manuscript_id.')';
    echo '1';
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'journal_reassign_by_chief') {
    $manuscript_id = trim($_POST['manuscript_id']);
    
    $revision = 0;
    $check_qry = $db->query("SELECT title,status,manuscript_id,resubmitted from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || ($check_qry->row->status != '1' && $check_qry->row->status != '11')) {
        echo '0';
        exit;
    } else {
        $revision = $check_qry->row->resubmitted;
    }

    $assigned_qry = $db->query("SELECT tja.id,tja.assigned_to,ta.admin_name,ta.admin_mail from tbl_journal_assigned tja INNER JOIN tbl_admin ta ON (tja.assigned_to = ta.admin_id) WHERE journal_id=$manuscript_id ORDER BY id DESC LIMIT 1");
    if(!empty($assigned_qry->row->id)) {

        $update_data = [
                'status' => '0',
                'assigned_date' => date('Y-m-d H:i:s')
        ];
        $where =['id' => $assigned_qry->row->id];
        $db->update("tbl_journal_assigned", $update_data, $where);

        $update_data = ['status' => '5'];
        $where = ['id' => $manuscript_id];
        $db->update("tbl_journal", $update_data, $where);

    } else {
        echo '0';
        exit;
    }

    $mail_data = array();
    $mail_data['name'] = $assigned_qry->row->admin_name;
    $mail_data['email'] = $assigned_qry->row->admin_mail;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['article_id'] = $manuscript_id;
    $mail_data['url'] = APP_URL.'auth/login.php';

    sendEmail($assigned_qry->row->admin_mail, 'MAJ: Review Request for Article - '.$check_qry->row->manuscript_id, 're-assign-mail.php', $mail_data);

    $_SESSION['form_success'] = 'Journal Re-assigned to editors (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    echo '1';
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'back-2-author') {
    $manuscript_id = trim($_POST['manuscript_id']);
    
    $revision = 0;
    $check_qry = $db->query("SELECT title,author,status,manuscript_id,resubmitted from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || ($check_qry->row->status != '6')) {
        echo '0';
        exit;
    }

    $update_data = array(
        'status' => '7'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_success'] = 'Article sent bacn to authors (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    $mail_data = array();
    $mail_data['name'] = $check_qry->row->author;
    $mail_data['title'] = $check_qry->row->title;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['url'] = APP_URL.'auth/login.php';

    sendEmail($assigned_qry->row->admin_mail, 'MAJ : Article revision needed - '.$check_qry->row->manuscript_id, 'article_revision_mail.php', $mail_data);

    echo '1';
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'add_comment') {

    if(empty($_POST['comment']) || empty($_POST['q_id']) || empty($_POST['j_id'])) {
        echo '0';
        exit;
    }

    $comment = $_POST['comment'];
    $q_id = $_POST['q_id'];
    $j_id = $_POST['j_id'];

    $check_qry = $db->query("SELECT id,status,user_id,resubmitted,manuscript_id from tbl_journal WHERE manuscript_id='$j_id'");
    if(empty($check_qry->count) || $check_qry->count < 1) {
        echo '0';
        exit;
    }

    $insert_data = array();
    $insert_data['ques_id'] = $q_id;
    $insert_data['comments'] = $comment;
    $insert_data['journal_id'] = $check_qry->row->id;
    $insert_data['chat_by'] = '0';
    $insert_data['admin_id'] = $_SESSION['admin_id'];
    $insert_data['revision'] = $check_qry->row->resubmitted;
    $insert_data['created_date'] = date("Y-m-d H:i:s");
    $comment_id = $db->insert('tbl_comments', $insert_data);



    // $update_data = array(
    // 	'status' => '4'
    // );
    // $where = array(
    // 	'id' => $manuscript_id
    // );
    // $db->update("tbl_journal", $update_data, $where);
    //$_SESSION['form_status'] = 'Journal Rejected (Manuscript ID - '.$check_qry->row->manuscript_id.')';
    echo '1';
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'reject-journal') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $reason = trim($_POST['reason']);
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || $check_qry->row->status != '1') {
        echo '0';
        exit;
    }

    if(empty($reason)) {
        echo '0';
        exit;
    }

    $insert_data = array();
    $insert_data['ques_id'] = '13';
    $insert_data['comments'] = $reason;
    $insert_data['journal_id'] = $manuscript_id;
    $insert_data['chat_by'] = '0';
    $insert_data['user_id'] = $check_qry->row->user_id;
    $insert_data['admin_id'] = $_SESSION['admin_id'];
    $insert_data['revision'] = $check_qry->row->resubmitted;
    $insert_data['created_date'] = date("Y-m-d H:i:s");
    $comment_id = $db->insert('tbl_comments', $insert_data);

    $update_data = array(
        'status' => '4'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_warning'] = 'Revision of Article (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    $userDetails = $db->query("SELECT j.user_id, u.user_instutename, u.user_email FROM tbl_journal j INNER join tbl_user u on u.user_id = j.user_id where j.id='".$manuscript_id."'");
    //var_dump($userDetails); exit;
    $mail_data = array();
    $mail_data['name'] = $userDetails->row->user_instutename;
    $emailVal = $userDetails->row->user_email;
    $mail_data['email'] = $userDetails->row->user_email;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    
    $mail_data['url'] = APP_URL.'auth/login.php';
    sendEmail($emailVal, 'Revision of Article (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_revision_mail.php', $mail_data);


    echo '1';
    exit;
}



if(isset($_POST['action']) && $_POST['action'] == 'final-reject-journal') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $reason = trim($_POST['reason']);
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE id=$manuscript_id");
    

    $insert_data = array();
    $insert_data['ques_id'] = '13';
    $insert_data['comments'] = $reason;
    $insert_data['journal_id'] = $manuscript_id;
    $insert_data['chat_by'] = '0';
    $insert_data['user_id'] = $check_qry->row->user_id;
    $insert_data['admin_id'] = $_SESSION['admin_id'];
    $insert_data['revision'] = $check_qry->row->resubmitted;
    $insert_data['created_date'] = date("Y-m-d H:i:s");
    $comment_id = $db->insert('tbl_comments', $insert_data);

    $update_data = array(
        'status' => '9'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_warning'] = 'Journal Rejected (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    $userDetails = $db->query("SELECT j.user_id, u.user_instutename, u.user_email FROM tbl_journal j INNER join tbl_user u on u.user_id = j.user_id where j.id='".$manuscript_id."'");
    //var_dump($userDetails); exit;
    $mail_data = array();
    $mail_data['name'] = $userDetails->row->user_instutename;
    $emailVal = $userDetails->row->user_email;
    //$emailVal = "hamalton.xavier@gmail.com";
    $mail_data['email'] = $userDetails->row->user_email;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    
    $mail_data['url'] = APP_URL.'auth/login.php';
    sendEmail($emailVal, 'Decision on Your Submission (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_rejected_mail.php', $mail_data);


    echo '1';
    exit;
}


if(isset($_POST['action']) && $_POST['action'] == 'publish-journal') {

    $manuscript_id = trim($_POST['manuscript_id']);
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE id=$manuscript_id");

    $update_data = array(
        'status' => '10',
        'publish_date' => date("Y-m-d H:i:s")
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_success'] = 'Article Published (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    $userDetails = $db->query("SELECT j.user_id, u.user_instutename, u.user_email FROM tbl_journal j INNER join tbl_user u on u.user_id = j.user_id where j.id='".$manuscript_id."'");
    //var_dump($userDetails); exit;
    $mail_data = array();
    $mail_data['name'] = $userDetails->row->user_instutename;
    $emailVal = $userDetails->row->user_email;
    //$emailVal = "hamalton.xavier@gmail.com";
    $mail_data['email'] = $userDetails->row->user_email;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    
    $mail_data['url'] = APP_URL.'auth/login.php';
    sendEmail($emailVal, 'Acceptance of your submission (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_publish_mail.php', $mail_data);

    echo '1';
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'journal_new_assign_by_chief') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $editors = $_POST['editors'];
    $revision = 0;
    $check_qry = $db->query("SELECT title, status,manuscript_id,resubmitted from tbl_journal WHERE id=$manuscript_id");
    
    if(count($editors) < 1) {
        echo '0';
        exit;
    }

    foreach($editors as $index => $editor_id) {
        $insert_data = array();
        $insert_data['journal_id'] = $manuscript_id;
        $insert_data['assigned_to'] = $editor_id;
        $insert_data['revision'] = $revision;
        $insert_data['assigned_date'] = date("Y-m-d H:i:s");
        $insert_data['status'] = '0';
        $insert_data['assigned_by'] = $_SESSION['admin_id'];
        $assigned_id = $db->insert('tbl_journal_assigned', $insert_data);
    }

    $update_data = array(
        'status' => '5'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_success'] = 'Journal Assigned to editors (Manuscript ID - '.$check_qry->row->manuscript_id.')';
    foreach($editors as $index => $editor_id) {
        $userDetails = $db->query("SELECT * FROM tbl_admin where admin_id = '".$editor_id."' ");
        $mail_data = array();
        $mail_data['name'] = $userDetails->row->admin_name;
        $emailVal = $userDetails->row->admin_mail;
        $mail_data['email'] = $userDetails->row->admin_mail;
        $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
        $mail_data['title'] = $check_qry->row->title;
        
        $mail_data['url'] = APP_URL.'auth/login.php';

        //var_dump($mail_data);
        sendEmail($emailVal, 'Journal For Review (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'assgin_reviewer_mail.php', $mail_data);
    }

    echo '1';
    exit;
}



if(isset($_POST['action']) && $_POST['action'] == 'reminderMail') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $assigned_qry = $db->query("SELECT ta.admin_name,ta.admin_mail,tja.journal_id, tj.title, tj.manuscript_id FROM tbl_journal_assigned AS tja INNER JOIN tbl_admin AS ta ON ta.admin_id = tja.assigned_to INNER join tbl_journal tj on tj.id = tja.journal_id WHERE tj.manuscript_id = '$manuscript_id'");
    
    
    $_SESSION['form_success'] = 'Reminder mail to editors (Manuscript ID - '.$manuscript_id.')';
    //

    if(!empty($assigned_qry->count)) {
        foreach($assigned_qry->rows as $k => $rw) {
            $assigned_data[$rw->journal_id][] = $rw->admin_name;
            $mail_data = array();
            $mail_data['name'] = $rw->admin_name;
            $emailVal = $rw->admin_mail;
            //$emailVal = "hamalton.xavier@gmail.com";
            $mail_data['email'] = $rw->admin_mail;
            $mail_data['manuscript_id'] = $rw->manuscript_id;
            $mail_data['title'] = $rw->title;
        
            $mail_data['url'] = APP_URL.'auth/login.php';

            //var_dump($mail_data);
            sendEmail($emailVal, 'Reminder Mail For Jouranl Review (Manuscript ID - '.$manuscript_id.')', 'reviewer_reminder_mail.php', $mail_data);
        }
    }

    

    

    echo '1';
    exit;
}
