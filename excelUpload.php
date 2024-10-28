<?php
error_reporting(0);
ini_set('display_errors', 0);
include 'connection.php';
include 'db.php';
include_once('conf.php');
if(empty($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
    header("location:index.php");
    exit;
}
function toRedirect($url)
{
    header('Location: '.APP_URL.$url);
    exit;
}
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
function isFileExists($filename)
{
    global $db;
    $qry = $db->query("SELECT id FROM tbl_archive WHERE file='$filename'");
    if($qry->count > 0 && !empty($qry->row->id)) {
        return true;
    }
    return false;
}
if(isset($_POST['publish_via_excel'])) {
    $redirect_url = 'editorial/excel-publish.php';
    //pre($_FILES,1);
    if(isset($_FILES['journal-file'])) {
        if(!is_dir('store_file/archive/')) {
            mkdir('store_file/archive/', 0777, true);
        }
        $errors     = array();
        $maxsize    = 50971522;
        $acceptable = array(
            'application/octet-stream',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if($_FILES['journal-file']['size'] >= $maxsize || $_FILES["journal-file"]["size"] == 0) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);
            exit;
        }
        if((!empty($_FILES["journal-file"]["type"])) && !in_array($_FILES['journal-file']['type'], $acceptable)) {
            $_SESSION['form_error'] = 'Invalid file type. Only xlsx type files allowed';
            toRedirect($redirect_url);
            exit;
        }
        $source_file = $_FILES['journal-file']['name'];
        $file_base_name = generateRandomNumber(15);
        $file_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $filename = $file_base_name.'.'.$file_extention;
        $main_file_directory = APP_PATH.'store_file/archive/';
        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }
        $main_file_url = $main_file_directory.$filename;
        if(file_exists($main_file_url)) {
            $_SESSION['form_error'] = 'File Already Exists.. Please upload with different file name';
            toRedirect($redirect_url);
            exit;
        }
        try {
            move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_url);
        } catch(Exception $e) {
            pre($e->getMessage());
        }
    } else {
        $_SESSION['form_error'] = 'File not available';
        toRedirect($redirect_url);
        exit;
    }

    header('Content-Type: text/html');
    require('/vendor_custom/php-excel-reader/excel_reader2.php');
    require('/vendor_custom/spreadsheet-reader/SpreadsheetReader');
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

                
                if(empty($r[0]) || empty($cnt)) {
                    $cnt++;
                    continue;
                }
                if(empty($r[0]) && empty($r[1]) && empty($r[2])) {
                    break;
                }
                
                $data[$cnt]['id'] = trim($r[0]);
                $data[$cnt]['filename'] = trim($r[1]);
                $data[$cnt]['volume'] = trim($r[2]);
                $data[$cnt]['issue'] = trim($r[3]);
                $data[$cnt]['year'] = trim($r[4]);
                $data[$cnt]['title'] = trim($r[5]);
                $data[$cnt]['author'] = trim($r[6]);
                $data[$cnt]['keywords'] = trim($r[7]);
                $data[$cnt]['abstract'] = trim($r[8]);
                $data[$cnt]['doi'] = trim($r[9]);
                $data[$cnt]['start'] = trim($r[10]);
                $data[$cnt]['end'] = trim($r[11]);
                $cnt++;
                //pre($data,0);
            }
            break;
        }
    } catch (Exception $E) {
        echo $E -> getMessage();
    }

    // pre($data,1);

    // exit;

    $added_journals = 0;

    $db->query('START TRANSACTION');

    foreach($data as $index=>$row) {

        if(isFileExists($row['filename'])) {
            continue;
        }

        $current_file = APP_PATH.'store_file/archive/'.$row['filename'];

        if(!file_exists($current_file)) {
            $_SESSION['form_error'] = 'File Not Exists.. Please copy the files in "store_file/archive/" folder : '.$current_file ;
            toRedirect($redirect_url);
            exit;
        }

        $issue = explode("-", $row['issue']);
        if(empty($issue[0]) || empty($issue[1])) {
            $_SESSION['form_error'] = 'Invalid Issue : '.$current_file ;
            toRedirect($redirect_url);
            exit;
        }

        $issue1 = $issue[0];
        $issue2 = $issue[1];
        
        $insert_data = array();
        $insert_data['created_by'] = '134';
        $insert_data['created_at'] = date("Y-m-d H:i:s");
        $insert_data['title'] = $db->realEscapeString($row['title']);
        $insert_data['authors'] = $db->realEscapeString($row['author']);
        $insert_data['volume'] = $row['volume'];
        $insert_data['issue'] = date('M', mktime(0, 0, 0, $issue1, 10)).'-'.date('M', mktime(0, 0, 0, $issue2, 10));
        $insert_data['year'] = $row['year'];
        $insert_data['abstract'] = $db->realEscapeString($row['abstract']);
        $insert_data['keywords'] = $db->realEscapeString($row['keywords']);
        $insert_data['file'] = $row['filename'];
        $insert_data['page_start'] = $row['start'];
        $insert_data['page_end'] = $row['end'];
        $insert_data['doi'] = $row['doi'];
        try {

        } catch(Exception $e) {
            $db->query('ROLLBACK');
            pre($e->getMessage($e));
        }
        $publication_id=$db->insert('tbl_archive', $insert_data);
        if($publication_id > 0) {
            $added_journals++;
        } else {
            $db->query('ROLLBACK');
            $_SESSION['form_error'] = 'Journal cannot be published';
            toRedirect($redirect_url);
            exit;
        }
    }

    $db->query('COMMIT');

    $_SESSION['form_success'] = "Total Journals Added : ".$added_journals;
    toRedirect($redirect_url);
    exit;
}
