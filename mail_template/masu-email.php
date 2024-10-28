<?php
include_once 'common_functions.php';

$mail_data = array();
$mail_data['name'] = 'Karthik';
$mail_data['email'] = 'kpandian110@gmail.com';
$mail_data['password'] = 'sdasasdasd';
$mail_data['url'] = 'auth/login.php';

echo sendEmail('aravinthvelu995@gmail.com', 'Registration Confirmation-Madras Agricultural Journal', 'welcome_editor.php', $mail_data);
print_r(error_get_last());
