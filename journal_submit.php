<?php
// require_once __DIR__ . '/libmergepdf-master/vendor/autoload.php';
use iio\libmergepdf\Merger;

include_once('connection.php');
include_once('db.php');
include_once('conf.php');
include_once('common_functions.php');
//pre($_SERVER);
//pre($_FILES,1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
if(empty($_SESSION)) {
    session_start();
}
if(empty($_SESSION['user_id'])) {
    echo json_encode(array("status"=>"failed"));
    exit;
}
function toRedirectUrl($url)
{
    header('Location: '.APP_URL.$url);
    exit;
}
function generate_manuscript_id($id)
{
    if($id < 10) {
        $id = '00'.$id;
    } elseif($id < 100) {
        $id = '0'.$id;
    }
    $year = date('Y');

    return 'MAJ-'.$year.'-'.$id;
}
if(isset($_POST['action']) && $_POST['action'] == 'submit_confirmation') {
    $manuscript_id = $_POST['manuscript_id'];
    $check_qry = $db->query("SELECT title, status,user_id,resubmitted,manuscript_id from tbl_journal WHERE manuscript_id='$manuscript_id'");
    $update_data = array(
        'status' => '0'
    );
    $where = array(
        'manuscript_id' => $manuscript_id
    );
    $db->update("tbl_journal", $update_data, $where);
    $_SESSION['form_success'] = 'Journal Submitted (Manuscript ID - '.$manuscript_id.')';
    
    
    $userDetails = $db->query("SELECT j.user_id, u.user_instutename, u.user_email FROM tbl_journal j INNER join tbl_user u on u.user_id = j.user_id where j.manuscript_id='".$manuscript_id."'");
    //var_dump($userDetails); exit;
    $mail_data = array();
    $mail_data['name'] = $userDetails->row->user_instutename;
    $emailVal = $userDetails->row->user_email;
    $mail_data['email'] = $userDetails->row->user_email;
    $mail_data['manuscript_id'] = $check_qry->row->manuscript_id;
    $mail_data['title'] = $check_qry->row->title;
    
    $mail_data['url'] = APP_URL.'auth/login.php';
    sendEmail($emailVal, 'Submission Confirmation (Manuscript ID - '.$check_qry->row->manuscript_id.')', 'article_submit_mail.php', $mail_data);


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

    $check_qry = $db->query("SELECT id,status,user_id,resubmitted,manuscript_id from tbl_journal WHERE manuscript_id='$j_id' AND user_id = '".$_SESSION['user_id']."'");
    if(empty($check_qry->count) || $check_qry->count < 1) {
        echo '0';
        exit;
    }

    $insert_data = array();
    $insert_data['ques_id'] = $q_id;
    $insert_data['comments'] = $comment;
    $insert_data['journal_id'] = $check_qry->row->id;
    $insert_data['chat_by'] = '1';
    $insert_data['user_id'] = $_SESSION['user_id'];
    $insert_data['revision'] = $check_qry->row->resubmitted;
    $insert_data['created_date'] = date("Y-m-d H:i:s");
    $comment_id = $db->insert('tbl_comments', $insert_data);

    $chat_notification = array();
    


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
if(!empty($_POST['journal_resubmit'])) {
    $redirect_url = 'editorial/dashboard.php';
    if(empty($_POST['journal_id'])) {
        $_SESSION['form_error'] = 'Invalid Journal';
        toRedirectUrl($redirect_url);
        exit;
    }
    $redirect_url = 'editorial/resubmit.php?ref='.$_POST['journal_id'];
    $journal_id = trim($_POST['journal_id']);
    $journal_qry = $db->query("SELECT user_id,year,status,manuscript_id,resubmitted FROM tbl_journal WHERE id='$journal_id'");
    if(!empty($journal_qry->count)) {
        if($journal_qry->row->status != '2' && $journal_qry->row->status != '4' && $journal_qry->row->status != '7') {
            $_SESSION['form_error'] = 'Invalid Journal';
            toRedirectUrl($redirect_url);
            exit;
        }
    } else {
        $_SESSION['form_error'] = 'Invalid Journal';
        toRedirectUrl($redirect_url);
        exit;
    }

    $user_id = $journal_qry->row->user_id;
    $year = $journal_qry->row->year;

    $pdf_directory = APP_PATH."store_file".DIRECTORY_SEPARATOR."user_".$user_id."_file".DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR;
    if(!is_dir($pdf_directory)) {
        mkdir($pdf_directory, 0777, true);
    }
    //print_r($_FILES);exit;
    if(isset($_FILES['journal-file'])) {
        $errors     = array();
        $maxsize    = 10097152;
        // $acceptable = array(
        // 	'application/msword',
        // 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // 	'application/pdf',
        // 	'application/vnd.ms-office'
        // );
        //$acceptable = array('application/pdf');
        $acceptable = array(
           'application/msword',
           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           'application/vnd.ms-office',
           'application/octet-stream'
        );

        if(($_FILES['journal-file']['size'] >= $maxsize) || ($_FILES["journal-file"]["size"] == 0)) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirectUrl($redirect_url);
            exit;
        }
        if(!in_array($_FILES['journal-file']['type'], $acceptable) && (!empty($_FILES["journal-file"]["type"]))) {
            $_SESSION['form_error'] = 'Invalid file type. Only word files are allowed';
            toRedirectUrl($redirect_url);
            exit;
        }
    } else {
        $_SESSION['form_error'] = 'Blinded Manuscript file not available';
        toRedirectUrl($redirect_url);
        exit;
    }

    //pre($_FILES,1);

    if(isset($_FILES['title-file'])) {

        //pre('sdsdfsdf',1);

        $errors     = array();
        $maxsize    = 10097152;
        // $acceptable = array(
        // 	'application/msword',
        // 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // 	'application/pdf',
        // 	'application/vnd.ms-office'
        // );
        //$acceptable = array('application/pdf');
        $acceptable = array(
           'application/msword',
           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           'application/vnd.ms-office',
           'application/octet-stream'
        );

        if($_FILES['title-file']['size'] >= $maxsize) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirectUrl($redirect_url);
            exit;
        }
        if(!in_array($_FILES['title-file']['type'], $acceptable) && (!empty($_FILES["title-file"]["type"]))) {
            $_SESSION['form_error'] = 'Invalid file type. Only word files are allowed';
            toRedirectUrl($redirect_url);
            exit;
        }

        $source_file = $_FILES['title-file']['name'];
        $title_extention = pathinfo($source_file, PATHINFO_EXTENSION);

        $r_count = $journal_qry->row->resubmitted;

        if($journal_qry->row->status == '7') {
            $r_count++;
        }

        $title_filename = $journal_qry->row->manuscript_id.'_title_RA'.$r_count.'.'.$title_extention;
        $title_file_path = $pdf_directory.$title_filename;

        //pre($title_file_path);

        if(file_exists($title_file_path)) {
            unlink($title_file_path);
        }
        move_uploaded_file($_FILES['title-file']['tmp_name'], $title_file_path);

    } else {
        $_SESSION['form_error'] = 'Title File not available';
        toRedirectUrl($redirect_url);
        exit;
    }

    //pre($_FILES,1);

    $source_file = $_FILES['journal-file']['name'];
    $main_extention = pathinfo($source_file, PATHINFO_EXTENSION);

    $r_count = $journal_qry->row->resubmitted;

    if($journal_qry->row->status == '7') {
        $r_count++;
    }

    $main_filename = $journal_qry->row->manuscript_id.'_RA'.$r_count.'.'.$main_extention;
    $main_file_path = $pdf_directory.$main_filename;

    if(file_exists($main_file_path)) {
        unlink($main_file_path);
    }
    move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_path);

    $update_data = array();
    $update_data['resubmitted'] = $r_count;
    $update_data['status'] = '0';
    $update_data['title_file'] = $title_filename;
    $update_data['main_file'] = $main_filename;
    $where = array();
    $where['id'] = $journal_id;

    //print_r($update_data);
    //print_r($where);exit;

    $db->update("tbl_journal", $update_data, $where);

    $_SESSION['form_success'] = 'Journal Resubmitted - '.$journal_qry->row->manuscript_id;
    toRedirectUrl('editorial/dashboard.php');
    exit;
}
if(!empty($_POST['journal_submit'])) {
    
    $authors = array();
    $user_id=trim($_POST['student_submit_profile_id']);
    $redirect_url = 'editorial/submit-paper.php';
    $t=time();
    $journal_random_name = "main_document_".$_POST['student_submit_profile_id']."_".$t;
    $journal_type = trim($_POST['journal_type']);
    $subject = trim($_POST['subject']);
    $journal_title = trim($_POST['journal_title']);
    $authors[] = $journal_author = trim($_POST['journal_author']);
    $journal_author_last_name = trim($_POST['author_last_name']);
    $affiliation = trim($_POST['affiliation']);
    $year = date('Y');

    $pdf_directory = APP_PATH."store_file".DIRECTORY_SEPARATOR."user_".$user_id."_file".DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR;

    $insert_data['user_id'] = $user_id;
    if(isset($_FILES['journal-file2'])) {
        $errors     = array();
        $maxsize    = 10097152;
        // $acceptable = array(
        // 	'application/msword',
        // 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // 	'application/pdf',
        // 	'application/vnd.ms-office'
        // );
        //$acceptable = array('application/pdf');
        $acceptable = array(
           'application/msword',
           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           'application/vnd.ms-office',
           'application/octet-stream'
        );
        if(($_FILES['journal-file2']['size'] >= $maxsize) || ($_FILES["journal-file2"]["size"] == 0)) {
            echo json_encode(array(
                "status" => "error",
                "submission_error" => "Title File - Invalid Size or File Size is too large (Maximum 5 MB)",
            ));
            exit;
        }
        if(!in_array($_FILES['journal-file2']['type'], $acceptable) && (!empty($_FILES["journal-file2"]["type"]))) {
            echo json_encode(array(
                "status" => "error",
                "submission_error" => "Article File - Invalid file type. Only Word files are allowed",
            ));
            exit;
        }
        $source_file = $_FILES['journal-file2']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $title_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $title_filename = randomText(30).'_'.date("His").rand().'.'.$title_extention;

        $title_file_directory=$pdf_directory;

        $title_file_path=$title_file_directory.$title_filename;

        if(!is_dir($title_file_directory)) {
            mkdir($title_file_directory, 0777, true);
        }

        if(file_exists($title_file_path)) {
            unlink($title_file_path);
        }

        move_uploaded_file($_FILES['journal-file2']['tmp_name'], $title_file_path);
    } else {
        echo json_encode(array(
            "status" => "error",
            "submission_error" => "Title File not available",
        ));
        exit;
    }
    
    if(isset($_FILES['journal-file'])) {
        $errors     = array();
        $maxsize    = 5242880;
        // $acceptable = array(
        // 	'application/msword',
        // 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        // 	'application/pdf',
        // 	'application/vnd.ms-office'
        // );
        //$acceptable = array('application/pdf');
        $acceptable = array(
           'application/msword',
           'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
           'application/vnd.ms-office',
           'application/octet-stream'
        );
        if(($_FILES['journal-file']['size'] >= $maxsize) || ($_FILES["journal-file"]["size"] == 0)) {
            echo json_encode(array(
                "status" => "error",
                "submission_error" => "Article File - Invalid Size or File Size is too large(Maximum 5 MB)",
            ));
            exit;
        }
        if(!in_array($_FILES['journal-file']['type'], $acceptable) && (!empty($_FILES["journal-file"]["type"]))) {
            echo json_encode(array(
                "status" => "error",
                "submission_error" => "Article File - Invalid file type. Only Word files are allowed",
            ));
            exit;
        }
        $source_file = $_FILES['journal-file']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $main_extention = pathinfo($source_file, PATHINFO_EXTENSION);

        $main_filename = randomText(30).'_'.date("His").rand().'.'.$main_extention;

        $main_file_directory=$pdf_directory;

        $main_file_path=$main_file_directory.$main_filename;

        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }

        if(file_exists($main_file_path)) {
            unlink($main_file_path);
        }

        move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_path);
    } else {
        echo json_encode(array(
                "status" => "error",
                "submission_error" => "Article File not available",
            ));
        exit;
    }

    $date = date('Y-m-d H:i:s');

    $insert_data = array();
    $insert_data['user_id'] = $user_id;
    $insert_data['title'] = $db->realEscapeString($journal_title);
    $insert_data['journal_random_name'] = $db->realEscapeString($journal_random_name);
    $insert_data['author'] = $db->realEscapeString($journal_author);
    $insert_data['last_name'] = $db->realEscapeString($journal_author_last_name);
    $insert_data['affiliation'] = $db->realEscapeString($affiliation);
    $insert_data['subject'] = $db->realEscapeString($subject);
    $insert_data['type'] = $journal_type;
    $insert_data['year'] = $year;
    $insert_data['resubmitted'] = '0';
    $insert_data['status'] = '-1'; //Non verified submission
    $insert_data['added_date'] = $date;
    //$insert_data['manuscript_id'] = '0';
    $insert_data['keywords'] = $db->realEscapeString(trim($_POST['keywords']));
    $insert_data['abstract'] = $db->realEscapeString(trim($_POST['abstract']));
    $insert_data['main_file'] = $main_filename;
    $insert_data['title_file'] = $title_filename;
    $insert_data['main_file_type'] = $db->realEscapeString($main_extention);
    $insert_data['title_file_type'] = $db->realEscapeString($title_extention);
    $insert_data['submitted_other_journal'] = $db->realEscapeString($_POST['q1']);
    $insert_data['submitted_here_before'] = $db->realEscapeString($_POST['q2']);
    $insert_data['conflict_of_interest'] = $db->realEscapeString($_POST['q3']);
    $insert_data['ethical_guidelines'] = $db->realEscapeString($_POST['q4']);
    $insert_data['approved_by_authors'] = $db->realEscapeString($_POST['q5']);

    try {
        $journal_id = $db->insert("tbl_journal", $insert_data);
    } catch(Exception $e) {
        echo json_encode(array(
                "status" => "error",
                "submission_error" => $e->getMessage(),
            ));
        exit;
    }
    
    if($journal_id > 0) {
        $manuscript_id = generate_manuscript_id($journal_id);
        $update_data = array('manuscript_id'=>$manuscript_id);
        $where = array('id'=>$journal_id);
        $db->upDate('tbl_journal', $update_data, $where);

        $insert_data = array();
        $insert_data['journal_id'] = $journal_id;
        $insert_data['action'] = 'submitted';
        $insert_data['action_date'] = $date;
        $insert_data['action_by'] = $user_id;
        $db->insert('tbl_journal_history', $insert_data);

        if(!empty($_POST['co_firstname'])) {
            foreach ($_POST['co_firstname'] as $key => $value) {
                $insert_data = array();
                $insert_data['journal_id'] = $journal_id;
                $insert_data['first_name'] = $db->realEscapeString($value);
                $insert_data['last_name'] = (!empty($_POST['co_lastname'][$key])) ? $db->realEscapeString($_POST['co_lastname'][$key]) : '';
                $insert_data['email'] = (!empty($_POST['co_email'][$key])) ? $db->realEscapeString($_POST['co_email'][$key]) : '';
                $insert_data['country'] = (!empty($_POST['co_country'][$key])) ? $db->realEscapeString($_POST['co_country'][$key]) : '';
                $insert_data['affiliation'] = (!empty($_POST['co_affiliation'][$key])) ? $db->realEscapeString($_POST['co_affiliation'][$key]) : '';
                $db->insert('tbl_co_author', $insert_data);

                $authors[] = $insert_data['first_name']." ".$insert_data['last_name'];
            }
        }

        //$_SESSION['form_success'] = 'Journal added Successfully..!';
        //toRedirect($redirect_url);exit;

        //PDF Generation
        $pdf_data = array();
        $pdf_data['title'] = $journal_title;
        $pdf_data['manuscript_id'] = $manuscript_id;
        $pdf_data['subject'] = $subject;
        $pdf_data['type'] = $journal_type;
        $pdf_data['keywords'] = trim($_POST['keywords']);
        $pdf_data['abstract'] = trim($_POST['abstract']);
        // $pdf_data['authors'] = $authors;
        // $pdf_data['author'] = trim($_POST['journal_author']);
        $pdf_data['directory'] = $pdf_directory;
        $pdf_data['file_name'] = date("His").rand().'.pdf';
        
        // include_once('TCPDF/examples/example_006.php');

        // //pre('1');

        // generatePDF($pdf_data);

        // $_SESSION['merged_pdf_path'] = $pdf_directory."merged_".$manuscript_id.".pdf";
        /*$merger = new Merger;
        $merger->addIterator([
            $pdf_data['directory'].$pdf_data['file_name'],
            $title_file_path,
            $main_file_path
        ]);
        $exception = FALSE;
        try{
            $createdPdf = $merger->merge();
        } catch(Exception $e){
            $exception = TRUE;
        }

        if($exception){
            $update_data = array(
                "merged_file"=>$pdf_data['file_name'],
                "info_file"=>$pdf_data['file_name']
            );
            $where = array("id"=>$journal_id);
            $db->update('tbl_journal',$update_data,$where);

            echo json_encode(array(
                "status" => "warning",
                "data" => [
                    "merged_file" => 'Error in merging',
                    "manuscript_id" => $manuscript_id,
                    "info_pdf" => APP_URL.'store_file/user_'.$_SESSION['user_id'].'_file/'.date('Y').'/'.$pdf_data['file_name']
                ]
            )); exit;
        }

        $merged_file_url = APP_URL.'store_file/user_'.$_SESSION['user_id'].'_file/'.date('Y').'/merged_'.$manuscript_id.'.pdf';
        if(file_exists($_SESSION['merged_pdf_path'])){

            $update_data = array(
                "merged_file"=>'merged_'.$manuscript_id.'.pdf',
                "info_file"=>$pdf_data['file_name']
            );
            $where = array("id"=>$journal_id);
            $db->update('tbl_journal',$update_data,$where);

            echo json_encode(array(
                "status" => "success",
                "data" => [
                    "merged_file" => $merged_file_url,
                    "manuscript_id" => $manuscript_id
                ]
            )); exit;
        } else {
            echo json_encode(array(
                "status" => "failed"
            )); exit;
        }*/
        echo json_encode(array(
            "status" => "success",
            "data" => [
                "merged_file" => '',
                "manuscript_id" => $manuscript_id
            ]
        ));
        exit;
    } else {
        echo json_encode(array(
                "status" => "error",
                "submission_error" => 'Article not added..Please try again..!',
            ));
        exit;
    }
}
