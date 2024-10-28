<?php
include 'connection.php';
include 'db.php';
include 'conf.php';
include_once "common_functions.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['email'])) {
    $base_url = APP_URL;
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '0';
        exit;
    }
    if(isset($_POST['from_admin']) && $_POST['from_admin'] == '1') {
        $check_if_user_exists = $db->query("SELECT admin_id,admin_name FROM tbl_admin where admin_mail='".$email."' AND is_deleted = '0' LIMIT 1");
        if(empty($check_if_user_exists->row->admin_name)) {
            echo '1';
            exit;
        }
        $user_name = $check_if_user_exists->row->admin_name;
        $user_id = $check_if_user_exists->row->admin_id;
        $is_admin = '1';
    } else {
        $check_if_user_exists = $db->query("SELECT user_id,user_instutename FROM tbl_user where user_email='".$email."' AND is_deleted = '0' LIMIT 1");
        if(empty($check_if_user_exists->row->user_instutename)) {
            echo '1';
            exit;
        }
        $user_name = $check_if_user_exists->row->user_instutename;
        $user_id = $check_if_user_exists->row->user_id;
        $is_admin = '0';
    }
    
    $token = generateRandomString(180);
    $created_at = date("Y-m-d H:i:s");
    $valid_till = date('Y-m-d H:i:s', strtotime("$created_at +20 minutes"));
    $data=array(
        'user_id'=> $user_id,
        'token'=>$token,
        'created_at'=>$created_at,
        'is_admin' => $is_admin,
        'valid_till'=>$valid_till
    );
    $insert_reset_password = $db->insert('tbl_password_reset', $data);
        
    sendEmail($email, 'Password Reset on MasuJournal', 'mail_password_reset.php', "");
    
    echo '2';
    exit;
}
if(isset($_GET['token']) && isset($_GET['action']) && $_GET['action'] == 'view-reset-pwd') {
    $token = trim($_GET['token']);
    $check_if_user_exists = $db->query("SELECT user_id,valid_till FROM tbl_password_reset where token = '".$token."' AND status = '0' LIMIT 1");
    if(empty($check_if_user_exists->row->user_id)) {
        echo 'Sorry.. Invalid request!';
        exit;
    }
    if(date("Y-m-d H:i:s") > $check_if_user_exists->row->valid_till) {
        echo 'Sorry.. Token Expired!';
        exit;
    }
    header("Location: ".APP_URL."auth/login.php?action=reset-password&token=".$token);
    exit;
}
if(isset($_POST['password']) && isset($_POST['rp_token']) && isset($_POST['action']) && $_POST['action'] == 'reset-password') {
    $token = trim($_POST['rp_token']);
    $check_if_user_exists = $db->query("SELECT user_id,valid_till,is_admin FROM tbl_password_reset where token = '".$token."' AND status = '0' LIMIT 1");
    if(empty($check_if_user_exists->row->user_id)) {
        echo '0';
        exit;
    }
    if(date("Y-m-d H:i:s") > $check_if_user_exists->row->valid_till) {
        echo '1';
        exit;
    }
    
    if($check_if_user_exists->row->is_admin == '1') {
        $update_data=array(
            "admin_password"=>MD5($_POST['password'])
        );
        $where=array(
            'admin_id'=>$check_if_user_exists->row->user_id
        );
        $updated=$db->upDate('tbl_admin', $update_data, $where);
    } else {
        $update_data=array(
            "user_password"=>MD5($_POST['password'])
        );
        $where=array(
            'user_id'=>$check_if_user_exists->row->user_id
        );
        $updated=$db->upDate('tbl_user', $update_data, $where);
    }
    
    $update_data=array(
        "status"=>'1'
    );
    $where=array(
        'token'=>$token
    );
    $updated=$db->upDate('tbl_password_reset', $update_data, $where);
    
    echo '2';
    exit;
}
