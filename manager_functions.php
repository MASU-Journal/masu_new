<?php
include_once('connection.php');
include_once('db.php');
include_once('conf.php');
include_once('common_functions.php');
if(empty($_SESSION['admin_login']) || empty($_SESSION['role_id']) || $_SESSION['admin_login'] != 'yes' || $_SESSION['role_id'] != '5') {
    header("Location:".APP_URL."logout.php");
    exit;
}
if(!function_exists('generateRandomNumber')) {
    function generateRandomNumber($n)
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
}
if(isset($_POST['action']) && $_POST['action'] == 'add_comment') {

    if(empty($_POST['comment']) || empty($_POST['q_id']) || empty($_POST['j_id'])) {
        echo '0';
        exit;
    }

    $comment = $_POST['comment'];
    $q_id = $_POST['q_id'];
    $j_id = $_POST['j_id'];

    $check_qry = $db->query("SELECT status,user_id,resubmitted,manuscript_id from tbl_journal WHERE manuscript_id='$j_id'");
    if(empty($check_qry->count) || $check_qry->count < 1) {
        echo '0';
        exit;
    }

    $insert_data = array();
    $insert_data['ques_id'] = $q_id;
    $insert_data['comments'] = $comment;
    $insert_data['journal_id'] = $j_id;
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

if(isset($_POST['action']) && $_POST['action'] == 'journal_approve_by_manager') {
    $manuscript_id = trim($_POST['manuscript_id']);

    $check_qry = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || $check_qry->row->status != '0') {
        echo '0';
        exit;
    }

    $update_data = array(
        'status' => '1'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_success'] = 'Journal Approved (Manuscript ID - '.$check_qry->row->manuscript_id.')';
    echo '1';
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'reject-journal') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $reason = trim($_POST['reason']);
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE id=$manuscript_id");
    if(!isset($check_qry->row->status) || $check_qry->row->status != '0') {
        echo '0';
        exit;
    }

    if(empty($reason)) {
        echo '0';
        exit;
    }

    $insert_data = array();
    $insert_data['ques_id'] = '12';
    $insert_data['comments'] = $reason;
    $insert_data['journal_id'] = $manuscript_id;
    $insert_data['chat_by'] = '0';
    $insert_data['user_id'] = $check_qry->row->user_id;
    $insert_data['admin_id'] = $_SESSION['admin_id'];
    $insert_data['revision'] = $check_qry->row->resubmitted;
    $insert_data['created_date'] = date("Y-m-d H:i:s");
    $comment_id = $db->insert('tbl_comments', $insert_data);

    $update_data = array(
        'status' => '2'
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
    // pre($emailVal, 0);
    // pre($check_qry->row->manuscript_id, 0);
    // pre($mail_data);
    sendEmail($emailVal, 'Revision of Article (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_revision_mail.php', $mail_data);
    sendEmail('maj@tnau.ac.in', 'Revision of Article (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_revision_mail.php', $mail_data);

    echo '1';
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'withdraw-journal') {
    $manuscript_id = trim($_POST['manuscript_id']);
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE id=$manuscript_id");

    $update_data = array(
        'status' => '3'
    );
    $where = array(
        'id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_warning'] = 'Article Withdrawn (Manuscript ID - '.$check_qry->row->manuscript_id.')';

    $userDetails = $db->query("SELECT j.user_id, u.user_instutename, u.user_email FROM tbl_journal j INNER join tbl_user u on u.user_id = j.user_id where j.id='".$manuscript_id."'");
    //var_dump($userDetails); exit;
    $mail_data = array();
    $mail_data['name'] = $userDetails->row->user_instutename;
    $emailVal = $userDetails->row->user_email;
    $mail_data['email'] = $userDetails->row->user_email;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    
    $mail_data['url'] = APP_URL.'auth/login.php';
    sendEmail($emailVal, 'Withdrawn Confirmation (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_withdrawn_mail.php', $mail_data);

    echo '1';
    exit;
}
if(!empty($_POST['add_editor_action'])) {

    //pre($_POST);

    $insert_data = array();
    if(empty($_POST['name'])) {
        $_SESSION['form_error'] = 'Editor Name not available';
        toRedirect('editorial/add_editors.php');
        exit;
    }
    if(empty($_POST['email'])) {
        $_SESSION['form_error'] = 'Editor Email not available';
        toRedirect('editorial/add_editors.php');
        exit;
    }
    if(empty($_POST['phone'])) {
        $_SESSION['form_error'] = 'Editor phone not available';
        toRedirect('editorial/add_editors.php');
        exit;
    }
    if(empty($_POST['category']) || !in_array($_POST['category'], [1,2,6,3])) {
        $_SESSION['form_error'] = 'Editor category not available';
        toRedirect('editorial/add_editors.php');
        exit;
    }
    if(empty($_POST['category'])) {
        $_SESSION['form_error'] = 'Editor category not available';
        toRedirect('editorial/add_editors.php');
        exit;
    }
    if(!empty($_POST['department'])) {
        $department = $_POST['department'];
    } elseif(!empty($_POST['other_department'])) {
        $insert_data = array();
        $insert_data['department'] = trim($_POST['other_department']);
        $insert_data['institute'] = trim($_POST['other_institute']);
        $department = $db->insert('tbl_departments', $insert_data);
    }
    if(isUserExists($_POST['email'], 1)) {
        $_SESSION['form_error'] = 'Editor already exists';
        toRedirect('editorial/add_editors.php');
        exit;
    }

    $password = randomPassword(6);
    $md5_password = md5($password);
    $insert_data = array();
    $insert_data['admin_name'] = trim($_POST['name']);
    $insert_data['admin_mail'] = trim($_POST['email']);
    $insert_data['admin_phone'] = trim($_POST['phone']);
    $insert_data['admin_cat_id'] = trim($_POST['category']);
    $insert_data['admin_password'] = $md5_password;
    $insert_data['admin_backdoor'] = $password;
    $insert_data['department_id'] = $department;
    $editor_id = $db->insert('tbl_admin', $insert_data);
    $_SESSION['form_success'] = 'Editor added successfully!';

    $mail_data = array();
    $mail_data['name'] = $insert_data['admin_name'];
    $mail_data['email'] = $insert_data['admin_mail'];
    $mail_data['password'] = $password;
    $mail_data['url'] = APP_URL.'auth/login.php';

    sendEmail(trim($_POST['email']), 'Registration Confirmation-Madras Agricultural Journal', 'welcome_editor.php', $mail_data);

    toRedirect('editorial/add_editors.php');
    exit;
}


if(isset($_POST['action']) && $_POST['action'] == 'flashNewsUpdate') {
    
    $insert_data['news'] = trim($_POST['newsVal']);

    $editor_id = $db->insert('tbl_home_flash_news', $insert_data);
    echo "1";

}


if(isset($_POST['action']) && $_POST['action'] == 'flashNewsDelete') {
    
    $newsId = trim($_POST['newsId']);

    $update_data = array(
        'status' => 'deactivate'
     );
    $where = array(
       'id' => $newsId
    );
    $db->update("tbl_home_flash_news", $update_data, $where);

    //$editor_id = $db->insert('tbl_home_flash_news',$insert_data);
    echo "1";

}


if(isset($_POST['action']) && $_POST['action'] == 'newsEvent') {
  
    $redirect_url = 'editorial/news-event.php';
    $pdf_directory = APP_PATH."store_file".DIRECTORY_SEPARATOR."news_event".DIRECTORY_SEPARATOR;
 
    if(isset($_FILES['docFile'])) {
       
        $errors     = array();
        $maxsize    = 6097152;
        // $acceptable = array(
        // 	'application/msword',
        // 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // 	'application/pdf',
        // 	'application/vnd.ms-office'
        // );
        $acceptable = array('application/pdf');
       
       
        if(($_FILES['docFile']['size'] >= $maxsize) || ($_FILES["docFile"]["size"] == 0)) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);
            exit;
        }
        if(!in_array($_FILES['docFile']['type'], $acceptable) && (!empty($_FILES["rdocFile"]["type"]))) {
            $_SESSION['form_error'] = 'Invalid file type. Only PDF files are allowed';
            toRedirect($redirect_url);
            exit;
        }
       
        $source_file = $_FILES['docFile']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $main_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $main_filename = randomText(30).'_'.date("His").rand().'.'.$main_extention;
        // echo $main_filename; exit;
        $main_file_directory=$pdf_directory;
        
        $main_file_path=$main_file_directory.$main_filename;
        
        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }
        
        if(file_exists($main_file_path)) {
            unlink($main_file_path);
        }
        
        move_uploaded_file($_FILES['docFile']['tmp_name'], $main_file_path);
        //echo  "sfdsf"; exit;
        $date = date('Y-m-d H:i:s');
        
        $insert_data = array();
        $insert_data['details'] = $_POST['newsevent'];
        $insert_data['document_name'] = $db->realEscapeString($main_filename);
       
        
        try {
            $doc_id_val = $db->insert("tbl_news_event", $insert_data);
        } catch(Exception $e) {
            echo json_encode(array(
                "status" => "error",
                "submission_error" => $e->getMessage(),
            ));
            exit;
        }
        
    } else {
        $_SESSION['form_error'] = 'File not available';
        toRedirect($redirect_url);
        exit;
    }
    
   
    $_SESSION['form_success'] = 'File Uploaded Successfully';
    toRedirect($redirect_url);
    exit;
}



if(isset($_POST['action']) && $_POST['action'] == 'newsEventDelete') {
    
    $newsId = trim($_POST['newsId']);

    $update_data = array(
        'status' => 'deactivate'
     );
    $where = array(
       'id' => $newsId
    );
    $db->update("tbl_news_event", $update_data, $where);

    //$editor_id = $db->insert('tbl_home_flash_news',$insert_data);
    echo "1";

}


if(isset($_POST['main_action']) && $_POST['main_action'] == 'addMembers') {

    $redirect_url = 'editorial/add_members.php';
    //pre($_FILES,1);
    if(isset($_FILES['bulk-file'])) {
        if(!is_dir('store_file/archive/')) {
            mkdir('store_file/archive/', 0777, true);
        }
        $errors     = array();
        $maxsize    = 50971522;
        $acceptable = array(
            'application/octet-stream',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-excel'
        );
        //pre($_FILES);
        if($_FILES['bulk-file']['size'] >= $maxsize || $_FILES["bulk-file"]["size"] == 0) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);
            exit;
        }
        if((!empty($_FILES["bulk-file"]["type"])) && !in_array($_FILES['bulk-file']['type'], $acceptable)) {
            $_SESSION['form_error'] = 'Invalid file type. Only xlsx type files allowed';
            toRedirect($redirect_url);
            exit;
        }
        $source_file = $_FILES['bulk-file']['name'];
        $file_base_name = generateRandomNumber(15);
        $file_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $filename = $file_base_name.'.'.$file_extention;
        $main_file_directory = APP_PATH.'store_file/archive/';
        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }
        $main_file_url = $main_file_directory.'/'.$filename;

        if(file_exists($main_file_url)) {
            $_SESSION['form_error'] = 'File Already Exists.. Please upload with different file name';
            toRedirect($redirect_url);
            exit;
        }
        move_uploaded_file($_FILES['bulk-file']['tmp_name'], $main_file_url);
    } else {
        $_SESSION['form_error'] = 'File not available';
        toRedirect($redirect_url);
        exit;
    }

    header('Content-Type: text/html');
    require_once '/vendor_custom/php-excel-reader/excel_reader2.php';
    require_once '/vendor_custom/spreadsheet-reader/SpreadsheetReader.php';
    $data = array();
    try {
        $Spreadsheet = new SpreadsheetReader($main_file_url);
        $BaseMem = memory_get_usage();
        $Sheets = $Spreadsheet -> Sheets();
        foreach($Sheets as $Index => $Name) {
            $Time = microtime(true);
            $Spreadsheet -> ChangeSheet($Index);
            $cnt = 0;
            foreach ($Spreadsheet as $Key => $r) {
                if(empty($r[0])) {
                    $cnt++;
                    continue;
                }
                $data[$cnt]['bill_number'] = $r[1];
                $data[$cnt]['name'] = $r[2];
                $data[$cnt]['address'] = $r[3];
                $data[$cnt]['profession'] = $r[4];
                $data[$cnt]['join_date'] = $r[5];
                $data[$cnt]['department'] = $r[6];
                $data[$cnt]['phone'] = $r[7];
                $data[$cnt]['email'] = $r[8];

                if($_POST['action'] == 'addStudentMemberAction') {
                    $data[$cnt]['student_id'] = $r[9];
                }
                $cnt++;
            }
        }
    } catch(Exception $e) {
        echo "<br>==".$e->getMessage()."==<br>";
    }

    $added_members = 0;

    foreach($data as $index=>$row) {

        $password = generateRandomNumber(6);

        $row['join_date'] = $db->realEscapeString($row['join_date']);

        $insert_data = array();

        if($_POST['action'] == 'addLifeMemberAction') {
            $insert_data['valid_date'] = date("Y-m-d", strtotime("+ 15 years", strtotime($row['join_date'])));
            $insert_data['category_id'] = 2;
        } elseif($_POST['action'] == 'addAnnualMemberAction') {
            $insert_data['valid_date'] = date("Y-m-d", strtotime("+ 1 years", strtotime($row['join_date'])));
            $insert_data['category_id'] = 3;
        } elseif($_POST['action'] == 'addInstitutionMemberAction') {
            $insert_data['valid_date'] = date("Y-12-31", strtotime($row['join_date']));
            $insert_data['category_id'] = 1;
        } elseif($_POST['action'] == 'addStudentMemberAction') {

            $st_year = substr($row['student_id'], 0, 4);
            $join_date = date($st_year."-06-01");
            $insert_data['valid_date'] = date("Y-m-d", strtotime("+  42 months", strtotime($join_date)));
            $insert_data['category_id'] = 4;
        }

        
        $insert_data['user_instutename'] = $db->realEscapeString($row['name']);
        $insert_data['user_email'] = $db->realEscapeString($row['email']);
        $insert_data['user_contact'] = $db->realEscapeString($row['phone']);
        $insert_data['user_address'] = $db->realEscapeString($row['address']);
        $insert_data['user_password'] = md5($password);
        $insert_data['user_status'] = 1;
        
        $insert_data['year'] = date("Y", strtotime($row['join_date']));
        $insert_data['user_created_by'] = 'Manager';
        $insert_data['created_admin'] = 1;
        $insert_data['created_date'] = date('Y-m-d');
        $insert_data['user_modified_by'] = 'Manager';
        $insert_data['modified_admin'] = 1;
        $insert_data['modified_date'] = date('Y-m-d');
        
        $insert_data['first_name'] = $db->realEscapeString($row['name']);
        $insert_data['stud_id'] = $db->realEscapeString($row['bill_number']);
        $publication_id=$db->insert('tbl_user', $insert_data);
        if($publication_id > 0) {
            $added_members++;
        } else {
            $_SESSION['form_error'] = 'Unable to add this member';
            echo 'Unable to add this member';
            pre($row);
            toRedirect($redirect_url);
            exit;
        }
    }

    $_SESSION['form_success'] = "Total Members Added : ".$added_members;
    toRedirect($redirect_url);
    exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'add_single_member_action') {

    $redirect_url = 'editorial/add_members.php';

    if(empty($_POST['name'])) {
        $_SESSION['form_error'] = 'Editor Name not available';
        toRedirect($redirect_url);
        exit;
    }
    if(empty($_POST['email'])) {
        $_SESSION['form_error'] = 'Editor Email not available';
        toRedirect($redirect_url);
        exit;
    }
    if(empty($_POST['join-date'])) {
        $_POST['join-date'] = date("Y-m-d");
    }
    if(empty($_POST['bill-no'])) {
        $_SESSION['form_error'] = 'Bill Number not available';
        toRedirect($redirect_url);
        exit;
    }

    $check_qry = $db->query("SELECT user_email from tbl_user WHERE user_email='".$_POST['email']."'");
    if(isset($check_qry->row->user_email)) {
        $_SESSION['form_error'] = 'Email Already Exist';
        toRedirect($redirect_url);
        exit;
    }

    $check_qry = $db->query("SELECT stud_id from tbl_user WHERE stud_id='".$_POST['bill-no']."'");
    if(isset($check_qry->row->stud_id)) {
        $_SESSION['form_error'] = 'Bill Number Already Exist';
        toRedirect($redirect_url);
        exit;
    }

    $insert_data = array();

    if($_POST['member_type'] == 'addLifeMemberAction') {
        $insert_data['valid_date'] = date("Y-m-d", strtotime("+ 15 years", strtotime($_POST['join-date'])));
        $insert_data['category_id'] = 2;
    } elseif($_POST['member_type'] == 'addAnnualMemberAction') {
        $insert_data['valid_date'] = date("Y-m-d", strtotime("+ 1 years", strtotime($_POST['join-date'])));
        $insert_data['category_id'] = 3;
    } elseif($_POST['member_type'] == 'addInstitutionMemberAction') {
        $insert_data['valid_date'] = date("Y-12-31", strtotime($_POST['join-date']));
        $insert_data['category_id'] = 1;
    } elseif($_POST['member_type'] == 'addStudentMemberAction') {
        $st_year = $_POST['st_year'];
        $join_date = date($st_year."-06-01");
        $insert_data['valid_date'] = date("Y-m-d", strtotime("+  42 months", strtotime($join_date)));
        $insert_data['category_id'] = 4;
    }
    $insert_data['user_instutename'] = $db->realEscapeString($_POST['name']);
    $insert_data['user_email'] = $db->realEscapeString($_POST['email']);
    $insert_data['user_contact'] = $db->realEscapeString($_POST['phone']);
    $insert_data['user_address'] = $db->realEscapeString($_POST['address']);
    $insert_data['user_password'] = md5($password);
    $insert_data['user_status'] = 1;
    $insert_data['year'] = date("Y", strtotime($_POST['join-date']));
    $insert_data['user_created_by'] = 'Manager';
    $insert_data['created_admin'] = 1;
    $insert_data['created_date'] = date('Y-m-d');
    $insert_data['user_modified_by'] = 'Manager';
    $insert_data['modified_admin'] = 1;
    $insert_data['modified_date'] = date('Y-m-d');
    $insert_data['first_name'] = $db->realEscapeString($_POST['name']);
    $insert_data['stud_id'] = $db->realEscapeString($_POST['bill-no']);
    $publication_id=$db->insert('tbl_user', $insert_data);
    if($publication_id > 0) {
        $_SESSION['form_success'] = "Member Added Successfully.!";
        toRedirect($redirect_url);
        exit;
    } else {
        $_SESSION['form_error'] = 'Unable to add this member';
        echo 'Unable to add this member';
        pre($_POST);
        toRedirect($redirect_url);
        exit;
    }
}
