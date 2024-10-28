<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
if(isset($_POST['publication-documents'])) {
    $redirect_url = 'editorial/m-publication-documents.php';
    $directory = '';
    $files = array();
    if($_POST['publication-documents'] == 'ai-docs') {
        $directory = 'links-file';
        $files['ai-1-doc'] = 'Main-document-MAJ-Template.doc';
        $files['ai-1-pdf'] = 'Main-document-MAJ-Template.pdf';
        $files['ai-2-doc'] = 'Title-page-MAJ-template.doc';
        $files['ai-2-pdf'] = 'Title-page-MAJ-template.pdf';
    } elseif($_POST['publication-documents'] == 'acri-docs') {
        $files['acri-pdf'] = 'assets/docs/authorcomereviewerinstruction.pdf';
    } elseif($_POST['publication-documents'] == 'cert-docs') {
        $files['cert-pdf'] = 'assets/docs/certificate.pdf';
    } elseif($_POST['publication-documents'] == 'sd-docs') {
        $files['sd-pdf'] = 'assets/docs/studentdeclaration.pdf';
    } elseif($_POST['publication-documents'] == 'coi-docs') {
        $files['coi-pdf'] = 'assets/docs/ConflictofInterest.pdf';
    } elseif($_POST['publication-documents'] == 'ci-docs') {
        $directory = 'links-file';
        $files['ci-1-doc'] = 'Copyright.docx';
        $files['ci-1-pdf'] = 'Copyright.pdf';
        $files['ci-2-doc'] = 'Copyright-Transfer-FORM_MAJ.docx';
        $files['ci-2-pdf'] = 'Copyright-Transfer-FORM_MAJ.pdf';
    } elseif($_POST['publication-documents'] == 'peer-docs') {
        $files['peer-pdf'] = 'peer.pdf';
    } elseif($_POST['publication-documents'] == 'emps-docs') {
        $files['emps-pdf'] = 'assets/docs/EthicsMalpracticeStatements.pdf';
    } elseif($_POST['publication-documents'] == 'ms-docs') {
        $files['ms-pdf'] = 'assets/docs/Membershipsubscription.pdf';
    } elseif($_POST['publication-documents'] == 'plagarism-docs') {
        $files['plagarism-pdf'] = 'assets/docs/plagarism.pdf';
    } elseif($_POST['publication-documents'] == 'open-access-statement-docs') {
        $files['open-access-statement-pdf'] = 'assets/docs/open-access-statement.pdf';
    }
    foreach($files as $key => $val) {
        if(!empty($_FILES[$key]['size'])) {
            if(!empty($directory) && !is_dir($directory)) {
                mkdir($directory, 0777, true);
            }
            $errors     = array();
            $maxsize    = 5097152;
            $acceptable = array(
                'text/css',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/pdf',
                'text/latex'
            );
            if($_FILES[$key]['size'] >= $maxsize || $_FILES[$key]["size"] == 0) {
                $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
                toRedirect($redirect_url);
                exit;
            }
            if((!empty($_FILES["journal-file"]["type"])) && !in_array($_FILES[$key]['type'], $acceptable)) {
                $_SESSION['form_error'] = 'Invalid file type. Only doc,pdf,docx allowed';
                toRedirect($redirect_url);
                exit;
            }

            if(!empty($directory)) {
                $filename = $directory.DIRECTORY_SEPARATOR.$val;
            } else {
                $filename = $val;
            }

            $main_file_url = APP_PATH.$filename;
            if(file_exists($main_file_url)) {
                unlink($main_file_url);
            }
            $_SESSION['form_success'] = 'File Uploaded Successfully.!!';
            try {
                move_uploaded_file($_FILES[$key]['tmp_name'], $main_file_url);
            } catch(Exception $e) {
                print_r($e->getMessage());
            }
        }
    }
    toRedirect($redirect_url);
    exit;
}
