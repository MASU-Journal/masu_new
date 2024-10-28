<?php
include_once('connection.php');
include_once('db.php');

require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function toRedirect($loc)
{
    header("Location:$loc");
    exit;
}

function sendEmail($mail_to, $subject, $content_file, $mail_data, $attachment = '')
{
    try {
        $email_from = $_ENV['FROM_EMAIL'];
        $html = "";
        if ($content_file) {
            ob_start();
            include_once 'mail_template/' . $content_file;
            $html = ob_get_contents();
            ob_end_clean();
        }

        $mail = new PHPMailer;
        // Enable verbose debug output
        $mail->isSMTP();
        // Set mailer to use SMTP
        $mail->Host = $_ENV['SMTP_HOST'];
        // Specify main and backup SMTP servers
        //$mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;
        // Enable SMTP authentication
        $mail->Username = $_ENV['SMTP_USER'];
        // SMTP username
        $mail->Password =  $_ENV['SMTP_PASS'];
        // SMTP password
        $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
        // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $_ENV['SMTP_PORT'];
        // TCP port to connect to
        //Recipients
        $mail->setFrom($email_from, 'MASU');
        $mail->addAddress($mail_to, '');
        // Add a recipient
        $mail->addReplyTo($email_from, '');
        //Attachments
        if (!empty($attachment)) {
            $mail->addAttachment($attachment);
        }
        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content_file ? $html : implode(',', $mail_data);
        $mail->isHTML(true);
        $mail->send();
        return "Mail Send Successfully";
    } catch (Exception $e) {
        throw new Error("Mailer Error: " . $e->errorMessage());
    }
}
function randomPassword($length)
{
    $alphabet = '@#$!*_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1;
    //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
    //turn the array into a string
}
function randomText($length)
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1;
    //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function isUserExists($email, $role = 1)
{
    global $db;
    if ($role == 1) {
        $tbl = 'tbl_admin';
        $field = 'admin_mail';
    } else {
        $tbl = 'tbl_user';
        $field = 'user_email';
    }
    $email = trim($email);
    $checkQry = $db->query("SELECT $field FROM $tbl WHERE $field = '$email' LIMIT 1");
    if (!empty($checkQry->count) && $checkQry->count > 0) {
        return true;
    } else {
        return false;
    }
}
function getCommentViewers($journal_id)
{
    global $db;

    $admin_ids = array();
    $assignedQry = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '$journal_id' ORDER BY id DESC LIMIT 1");
    if (!empty($assignedQry->count)) {
        $assigned_id = $assignedQry->row->id;
    }

    $assignedQry = $db->query("SELECT assigned_to FROM tbl_journal_assigned WHERE journal_id = '$journal_id' ORDER BY id DESC LIMIT 1");
    if (!empty($assignedQry->count)) {
        foreach ($assignedQry->rows as $k => $v) {
            $admin_ids[] = $v->assigned_to;
        }
    }

    $mQry = $db->query("SELECT admin_id,admin_cat_id FROM tbl_admin WHERE admin_cat_id IN ('4','5')");
    if (!empty($mQry->count)) {
        foreach ($mQry->rows as $k => $v) {
            $admin_ids[] = $v->admin_id;
        }
    }
    $mQry = $db->query("SELECT admin_id,admin_cat_id FROM tbl_admin WHERE admin_role_id IN ('4','5')");
    if (!empty($mQry->count)) {
        foreach ($mQry->rows as $k => $v) {
            $admin_ids[] = $v->admin_id;
        }
    }
}
function getDepartments()
{
    global $db;
    $depQRY = $db->query("SELECT id,department FROM tbl_departments WHERE status = '1'");
    $departments = array();
    if (!empty($depQRY->count)) {
        foreach ($depQRY->rows as $k => $v) {
            $departments[$v->id] = $v->department;
        }
    }
    return $departments;
}
