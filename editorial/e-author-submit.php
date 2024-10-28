<?php
include_once('../connection.php');
include_once('../db.php');
include_once('../conf.php');
//var_dump($_SESSION);exit;
//pre($_SERVER);
//pre($_FILES,1);
if(empty($_SESSION)){
    session_start();
}
if(empty($_SESSION['admin_id'])){
    echo json_encode(array("status"=>"failed"));exit;
}
function toRedirect($url){
    header('Location: '.APP_URL.$url);
    exit;
}
if(!function_exists('randomText')){
    function randomText($length) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
if(!empty($_POST['e-author-upload'])){
    $reviwer_id = $_SESSION['admin_id'];
    $journal_id = $_POST['journal-id'];
    //$redirect_url = 'editorial/e_author_upload.php?manuscript='.$journal_id;
    $redirect_url = 'editorial/editor-dashboard.php';
    $pdf_directory = APP_PATH."store_file".DIRECTORY_SEPARATOR."reviewer_author_upload".DIRECTORY_SEPARATOR;

    $check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '".$journal_id."' AND status='0' AND assigned_to='".$_SESSION['admin_id']."'");
    if($check_query->count < 0){
        $_SESSION['form_error'] = 'Article Not valid';
        toRedirect($redirect_url);exit;
    }

    $check_article = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$journal_id");
    if(!isset($check_article->row->status) || $check_article->row->status != '5'){
        $_SESSION['form_error'] = 'Article Not valid.';
        toRedirect($redirect_url);exit;
    }
 
    if(isset($_FILES['reviwer-ceditor-file'])) {
       
        $errors     = array();
        $maxsize    = 20097152;
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
       
        if(($_FILES['reviwer-ceditor-file']['size'] >= $maxsize) || ($_FILES["reviwer-ceditor-file"]["size"] == 0)) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);exit;
        }
        if(!in_array($_FILES['reviwer-ceditor-file']['type'], $acceptable) && (!empty($_FILES["reviwer-ceditor-file"]["type"]))) {
            $_SESSION['form_error'] = 'Invalid file type. Only Word files are allowed';
            toRedirect($redirect_url);exit;
        }
       
        $source_file = $_FILES['reviwer-ceditor-file']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $main_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $main_filename = randomText(30).'_'.date("His").rand().'.'.$main_extention;
       // echo $main_filename; exit;
        $main_file_directory=$pdf_directory;
        
        $main_file_path=$main_file_directory.$main_filename;
        
        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }
        
        if(file_exists($main_file_path))	unlink($main_file_path);
        
        move_uploaded_file($_FILES['reviwer-ceditor-file']['tmp_name'], $main_file_path);
        //echo  "sfdsf"; exit;
        $date = date('Y-m-d H:i:s');
        
       /* $insert_data = array();
        $insert_data['reviwer_id'] = $reviwer_id;
        $insert_data['ceditor_id'] = '83';
        $insert_data['doc_name'] = $db->realEscapeString($main_filename);
        $insert_data['created_date'] = $date;*/
       
        $update_data = array();
        $update_data['reviewer_author_file'] = $db->realEscapeString($main_filename);
        $update_data['status'] = '6';
        $where = array();
        $where['id'] = $journal_id;
        $db->update("tbl_journal", $update_data, $where);

        $update_data = array(
            'status' => '2'
        );
        $where = array(
            'id' => $check_query->row->id
        );
        $db->update("tbl_journal_assigned", $update_data, $where);
        
       /* try{
            $doc_id_val = $db->insert("tbl_reviwer_ceditor_doc", $insert_data);
        } catch(Exception $e){
            echo json_encode(array(
                "status" => "error",
                "submission_error" => $e->getMessage(),
            ));exit;
        }*/
        
    } else {
        $_SESSION['form_error'] = 'Title File not available';
        toRedirect($redirect_url);exit;
    }   
   
    $_SESSION['form_success'] = 'File Uploaded And Revised Succesfully';
    toRedirect($redirect_url);exit;
}
?>