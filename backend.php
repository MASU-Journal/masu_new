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
if(!function_exists('randomText')) {
    function randomText($length)
    {
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
function toRedirect($url)
{
    header('Location: '.APP_URL.$url);
    exit;
}
if(isset($_POST['publish_journal_submit'])) {
    $redirect_url = 'editorial/publish-journal.php';
    if(isset($_FILES['journal-file'])) {
        if(!is_dir('store_file/publications/')) {
            mkdir('store_file/publications/', 0777, true);
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
        if($_FILES['journal-file']['size'] >= $maxsize || $_FILES["journal-file"]["size"] == 0) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);
            exit;
        }
        if((!empty($_FILES["journal-file"]["type"])) && !in_array($_FILES['journal-file']['type'], $acceptable)) {
            $_SESSION['form_error'] = 'Invalid file type. Only doc,pdf,docx,latex allowed';
            toRedirect($redirect_url);
            exit;
        }

        $source_file = $_FILES['journal-file']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $file_extention = pathinfo($source_file, PATHINFO_EXTENSION);
        $filename = randomText(30).'.'.$file_extention;
        $vol = trim($_POST['volume']);
        $main_file_directory = APP_PATH.$vol;

        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }
        $main_file_url = $main_file_directory.'/'.$filename;

        if(file_exists($main_file_url)) {
            $_SESSION['form_error'] = 'File Already Exists.. Please upload with different file name';
            toRedirect($redirect_url);
            exit;
        }

        if(!is_dir($main_file_directory)) {
            mkdir($main_file_directory, 0777, true);
        }

        try {
            move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_url);
           
            // HTML Upload
            if ($_POST['journal-file-html']) {
                $uploadDir = APP_PATH.'/store_file/html/';
    
                if(!is_dir('store_file/html/')) {
                    mkdir('store_file/html/', 0777, true);
                }
    
                $html_content = str_replace('src="../', 'src="'.APP_URL, $_POST['journal-file-html']);
            
                $html_file_name = str_replace('.pdf', '', $filename).'.html';
                $html_file_path = $uploadDir.'/'.$html_file_name;
            
                if(file_put_contents($html_file_path, $html_content) === false) {
                    $_SESSION['form_error'] = 'Failed to create HTML file';
                    toRedirect($redirect_url);
                    exit;
                }
            }
        } catch(Exception $e) {
            pre($e->getMessage());
        }

        
    } else {
        $_SESSION['form_error'] = 'File not available';
        toRedirect($redirect_url);
        exit;
    }
    //Edit Authors
    $authors_name = preg_replace('/\d+/u', '', $_POST['authors-name']);
    $authors_name = str_replace("*", "", $authors_name);
    $authors_name = preg_replace('/\sand\s/u', ',', $authors_name);
    //remove full stop
    $authors_name = rtrim(trim($authors_name), '.');
    $keywords = rtrim(trim($_POST['keywords']), '.');
    $title = rtrim(trim($_POST['journal-title']), '.');
    $manuscript_id = rtrim(trim($_POST['manuscript-id']), '.');
    $doi = (!empty($_POST['doi'])) ? rtrim(trim($_POST['doi']), '.') : '';
    $page_start = (!empty($_POST['page_start'])) ? rtrim(trim($_POST['page_start']), '.') : '';
    $page_end = (!empty($_POST['page_end'])) ? rtrim(trim($_POST['page_end']), '.') : '';

    $insert_data = array();
    $insert_data['created_by'] = $_SESSION['admin_id'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['title'] = $db->realEscapeString($title);
    $insert_data['manuscript_id'] = $manuscript_id;
    $insert_data['authors'] = $db->realEscapeString(trim($authors_name));
    $insert_data['volume'] = trim($_POST['volume']);
    $insert_data['issue'] = trim($_POST['issue']);
    $insert_data['abstract'] = $db->realEscapeString(str_replace("\r", "", str_replace("\n", "", trim($_POST['abstract']))));
    $insert_data['keywords'] = $db->realEscapeString(trim($keywords));
    $insert_data['file'] = $filename;
    $insert_data['doi'] = $doi;
    $insert_data['page_start'] = $page_start;
    $insert_data['page_end'] = $page_end;

    $publication_id=$db->insert('tbl_publication', $insert_data);
    if($publication_id > 0) {
        $_SESSION['form_success'] = 'Journal Published Successfully';
    } else {
        $_SESSION['form_error'] = 'Journal cannot be published';
    }
    header('Location: '.APP_URL.$redirect_url);
}
if(isset($_POST['publish_journal_archive'])) {
    $redirect_url = 'editorial/publish-journal-collections.php';

    if(isset($_FILES['journal-file'])) {
        if(!is_dir('store_file/archive/')) {
            mkdir('store_file/archive/', 0777, true);
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
        if($_FILES['journal-file']['size'] >= $maxsize || $_FILES["journal-file"]["size"] == 0) {
            $_SESSION['form_error'] = 'Invalid Size or File Size is too large';
            toRedirect($redirect_url);
            exit;
        }
        if((!empty($_FILES["journal-file"]["type"])) && !in_array($_FILES['journal-file']['type'], $acceptable)) {
            $_SESSION['form_error'] = 'Invalid file type. Only doc,pdf,docx,latex allowed';
            toRedirect($redirect_url);
            exit;
        }

        $source_file = $_FILES['journal-file']['name'];
        $file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
        $file_extention = pathinfo($source_file, PATHINFO_EXTENSION);

        $title_filename = $journal_qry->row->manuscript_id.'_title_RA'.$r_count.'.'.$title_extention;
        $filename = randomText(30).'.'.$file_extention;
        $vol = trim($_POST['volume']);
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
        move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_url);
    } else {
        $_SESSION['form_error'] = 'File not available';
        toRedirect($redirect_url);
        exit;
    }
    $year = (!empty($_POST['year'])) ? $_POST['year'] : '';
    $volume = (!empty($_POST['volume'])) ? $_POST['volume'] : '';
    $issue = (!empty($_POST['issue'])) ? $_POST['issue'] : '';
    if(!empty($issue)) {
        $issue_array = explode("-", $issue);
        if(!empty($issue_array[0])) {
            $issue1 =  ltrim($issue_array[0], "0");
            $issue1 = date('M', mktime(0, 0, 0, $issue1, 10));
            $issue = $issue1;
        }
        if(!empty($issue_array[1])) {
            $issue2 =  ltrim($issue_array[1], "0");
            $issue2 = date('M', mktime(0, 0, 0, $issue2, 10));
            $issue .= "-".$issue2;
        }
    }

    $keywords = (!empty($_POST['keywords'])) ? $_POST['keywords'] : '';
    $abstract = (!empty($_POST['abstract'])) ? $_POST['abstract'] : '';
    $authors = (!empty($_POST['authors-name'])) ? $_POST['authors-name'] : '';

    //Edit Authors
    $authors_name = preg_replace('/\d+/u', '', $authors);
    $authors_name = str_replace("*", "", $authors_name);
    $authors_name = preg_replace('/\sand\s/u', ',', $authors_name);
    //remove full stop
    $authors_name = rtrim(trim($authors_name), '.');
    $keywords = rtrim(trim($_POST['keywords']), '.');
    $title = rtrim(trim($_POST['journal-title']), '.');
    $doi = (!empty($_POST['doi'])) ? rtrim(trim($_POST['doi']), '.') : '';
    $page_start = (!empty($_POST['page_start'])) ? rtrim(trim($_POST['page_start']), '.') : '';
    $page_end = (!empty($_POST['page_end'])) ? rtrim(trim($_POST['page_end']), '.') : '';
    $abstract = trim($abstract);
    if(empty($abstract)) {
        $abstract = $keywords." : ".$title;
    }

    $insert_data = array();
    $insert_data['created_by'] = $_SESSION['admin_id'];
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['title'] = $title;
    $insert_data['authors'] = $authors_name;
    $insert_data['year'] = trim($year);
    $insert_data['volume'] = trim($volume);
    $insert_data['issue'] = trim($issue);
    $insert_data['abstract'] = str_replace("\r", "", str_replace("\n", "", trim($abstract)));
    //$insert_data['keywords'] = trim($keywords);
    $insert_data['file'] = $filename;
    $insert_data['doi'] = $doi;
    $insert_data['page_start'] = $page_start;
    $insert_data['page_end'] = $page_end;
    $publication_id=$db->insert('tbl_archive', $insert_data);
    if($publication_id > 0) {
        $_SESSION['form_success'] = 'Journal Published Successfully';
    } else {
        $_SESSION['form_error'] = 'Journal cannot be published';
    }
    header('Location: '.APP_URL.$redirect_url);
}

$_SESSION['journal_submission_msg']=array();
$_SESSION['journal_assign_msg']=array();
if(isset($_POST['edit_profile'])) {
    if(isset($_POST['student_edit_profile_id'])) {
        $user_id=$_POST['student_edit_profile_id'];
        $firstname=$_POST['edit_stu_name'];
        $stud_id=$_POST['edit_stu_id'];
        $user_email=$_POST['edit_stu_mail'];
        $user_contact=$_POST['edit_stu_contact'];
        $user_age=$_POST['edit_stu_age'];
        $user_address=$_POST['edit_stu_address'];
        $update_data=array(
        "first_name"=>$firstname,
        "stud_id"=>$stud_id,
        "user_email"=>$user_email,
        "user_contact"=>$user_contact,
        "age"=>$user_age,
        "user_address"=>$user_address,
        );
        $where ="user_id=".$user_id;
    }
    $table='tbl_user';
    $update_for_edit=$db->upDate($table, $update_data, $where);
    if($update_for_edit==1) {
        $redirect_url=$_POST['edit_profile'];
        $_SESSION['journal_submission_msg'][]="Your Profile Updated Successfully";
        header('Location: /'.$redirect_url);
    }
}
if(isset($_POST['journal_submit'])) {
    
    $user_id=$_POST['student_submit_profile_id'];
    $redirect_url=$_POST['journal_submit'];
    
    if(isset($_POST['is_resubmit']) && $_POST['is_resubmit']==1) {
        if(isset($_POST['resubmit_journal_id']) && $_POST['resubmit_journal_id']!="") {
            $resub_journal_id=$_POST['resubmit_journal_id'];
            
            $resub_journal=$db->query("SELECT tj.*,tjd.* FROM tbl_journal as tj,tbl_journal_details as tjd WHERE  tj.journal_id=tjd.journal_id  AND  tj.is_published=0 AND tj.is_rejected=0 AND tj.is_deleted=0 AND tj.journal_id=".$resub_journal_id);
            $resub_journal_data=$resub_journal->rows;
            $journal_id=$resub_journal_data[0]->journal_id;
            $user_id=$resub_journal_data[0]->user_id;
            $year=$resub_journal_data[0]->journal_year;
            $file_name=$resub_journal_data[0]->journal_path;
            //print_r($_FILES);exit;
            if(isset($_FILES['journal_file'])) {
                /*if (!is_dir('store_file/user_'.$user_id.'_file')) {
                    mkdir('store_file/user_'.$user_id.'_file', 0777, true);
                }
                if (!is_dir('store_file/user_'.$user_id.'_file'.'/'.date("Y"))) {
                    mkdir('store_file/user_'.$user_id.'_file'.'/'.date("Y"), 0777, true);
                }*/
                $errors     = array();
                $maxsize    = 2097152;
                $acceptable = array(
                    'text/css',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/pdf',
                    'text/latex'

                );
                if(($_FILES['journal_file']['size'] >= $maxsize) || ($_FILES["journal_file"]["size"] == 0)) {
                    $errors[] = 'Invalid Size File Size is too large';
                }

                if(!in_array($_FILES['journal_file']['type'], $acceptable) && (!empty($_FILES["journal_file"]["type"]))) {
                    $errors[] = 'Invalid file type. Only doc,pdf,docx,latex allowed';
                }

                if(count($errors) === 0) {
                    $file="store_file/user_".$user_id."_file"."/".$year."/".$file_name;
                    //echo $file;
                    if (file_exists($file)) {
                        unlink($file);
                        if(move_uploaded_file($_FILES['journal_file']['tmp_name'], 'store_file/user_'.$user_id.'_file'.'/'.$year.'/'.$_FILES['journal_file']['name'])) {
                            $save_file_name=$_POST['journal_file_name'];
                            
                            $journal_updates_data=array(
                            'journal_path'=>$save_file_name,
                            'review_level'=>1,
                            'is_author_reviewed'=>0,
                            'enable_command'=>1
                            );
                            $where=array(
                            'journal_id'=>$journal_id
                            );
                            $update_journal_file=$db->upDate('tbl_journal', $journal_updates_data, $where);
                            if($update_journal_file==1) {
                                $_SESSION['journal_submission_msg'][]="Journal Reupload Successfully";
                            }
                        }
                    } else {
                        $_SESSION['journal_submission_msg'][]="Journal Does't Exist";
                    }
                } else {
                    foreach($errors as $error) {
                        $_SESSION['journal_submission_msg'][]=$error;
                    }

                    //die(); //Ensure no more processing is done
                }
            
            }
        }
    } else {
        $check_if_greater_two_journal=$db->query("SELECT * FROM tbl_journal where user_id=".$user_id.' AND journal_year='.date("Y"));
        /*for 2year submission validation */
        /*if($check_if_greater_two_journal->num_rows>=2){
            $_SESSION['journal_submission_msg'][]="Sorry you already submit 2 journals for current year";
            header('Location: /'.$redirect_url);
            die;
        }*/
        /*for 2year submission validation */
        //print_R($_FILES);exit;
        if(isset($_FILES['journal_img']['name']) && $_FILES['journal_img']['name']="") {
            if (!is_dir('store_img/user_'.$user_id.'_img')) {
                mkdir('store_img/user_'.$user_id.'_img', 0777, true);
            }
            if (!is_dir('store_img/user_'.$user_id.'_img'.'/'.date("Y"))) {
                mkdir('store_img/user_'.$user_id.'_img'.'/'.date("Y"), 0777, true);
            }
            $errors     = array();
            $maxsize    = 1048576;
            $kk = array(
                'image/jpeg',
                'image/jpg',
                'image/png'
            );
            if(($_FILES['journal_img']['size'] >= $maxsize)) {
                $errors[] = 'File too large';
            }

            if(!in_array($_FILES['journal_img']['type'], $acceptable) && (!empty($_FILES["journal_img"]["type"]))) {
                $errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
            }

            if(count($errors) === 0) {
                move_uploaded_file($_FILES['journal_img']['tmp_name'], 'store_img/user_'.$user_id.'_img'.'/'.date("Y").'/'.$_FILES['journal_img']['name']);
            } else {
                foreach($errors as $error) {
                    $_SESSION['journal_submission_msg'][]=$error;
                }

                //die(); //Ensure no more processing is done
            }
        }
        
        if(isset($_FILES['journal_file'])) {
            if (!is_dir('store_file/user_'.$user_id.'_file')) {
                mkdir('store_file/user_'.$user_id.'_file', 0777, true);
            }
            if (!is_dir('store_file/user_'.$user_id.'_file'.'/'.date("Y"))) {
                mkdir('store_file/user_'.$user_id.'_file'.'/'.date("Y"), 0777, true);
            }
            $errors     = array();
            $maxsize    = 2097152;
            $acceptable = array(
                'text/css',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/pdf',
                'text/latex'

            );
            if(($_FILES['journal_file']['size'] >= $maxsize) || ($_FILES["journal_file"]["size"] == 0)) {
                $errors[] = 'Invalid Size File Size is too large';
            }

            if(!in_array($_FILES['journal_file']['type'], $acceptable) && (!empty($_FILES["journal_file"]["type"]))) {
                $errors[] = 'Invalid file type. Only doc,pdf,docx,latex allowed';
            }

            if(count($errors) === 0) {
                move_uploaded_file($_FILES['journal_file']['tmp_name'], 'store_file/user_'.$user_id.'_file'.'/'.date("Y").'/'.$_FILES['journal_file']['name']);
                $journal_file_name=$_POST['journal_file_name'];
                $journal_file_data=array(
                'journal_path'=>$_POST['journal_file_name'],
                'user_id'=>$user_id,
                'journal_year'=>date("Y"),
                'created_date'=>date("Y-m-d h:i:s"),
                'created_by'=>$user_id
                );
                $insert_jornal_id=$db->insert('tbl_journal', $journal_file_data);
                if($insert_jornal_id!='') {
                    $subject=$_POST['subject'];
                    $type_id=$_POST['arttype'];
                    $title=$_POST['journal_title'];
                    $author=$_POST['journal_author'];
                    $co_author=$_POST['coauthor'][0];
                    $journal_file_img=$_POST['journal_img_name'];
                    
                    $update_data=array(
                    "journal_id"=>$insert_jornal_id,
                    "subject"=>$subject,
                    "journal_type"=>$type_id,
                    "title"=>$title,
                    "author_name"=>$author,
                    "co_author"=>$co_author,
                    "profile_img"=>$journal_file_img,
                    "user_id"=>$user_id
                    );
                    $table='tbl_journal_details';
                    $insert_journal_detail_id=$db->insert($table, $update_data);
                    if($insert_journal_detail_id!=0) {
                        foreach($_POST['coauthor'] as $authkey=>$authval) {
                            $journal_authors_data=array(
                                'journal_id'=>$insert_jornal_id,
                                'author_id'=>$authval,
                                'user_id'=>$user_id
                            );
                            $insert_journal_author_id=$db->insert('tbl_journal_author', $journal_authors_data);
                        }
                        $_SESSION['journal_submission_msg'][]="Your Journal Has Submitted Succesfully";
                        header('Location: /'.$redirect_url);
                    }
                }
            } else {
                foreach($errors as $error) {
                    $_SESSION['journal_submission_msg'][]=$error;
                }
                //Ensure no more processing is done
            }
        }
    }
    header('Location: /'.$redirect_url);
}
if(isset($_POST['assign_journal_id'])) {
    
    $redirect_url=$_POST['redirect_url'];
    $status_level=$_POST['status_level'];
    $correction_level=$_POST['correction_level'];
    $assign_journal_id=$_POST['assign_journal_id'];
    $assign_user_id=$_POST['journal_user_id'];
    
    $journal_updates_data=array(
        'status_id'=>$status_level+1,
        'correction_level'=>$correction_level+1,
    );
    /*print_r($_POST['journal_assigner_to_ass'.$assign_journal_id]);
    print_r($_POST['journal_assigner_to_ref'.$assign_journal_id]);
    print_r($_POST['journal_assigner_to_tech'.$assign_journal_id]);
    echo 'slsl';
    die;*/
    if(isset($_POST['journal_assigner_to_ass'.$assign_journal_id])&& $_POST['journal_assigner_to_ass'.$assign_journal_id]!="") {
        $admin_cat_to_save=$_POST['journal_assigner_to_ass'.$assign_journal_id];
    } elseif(isset($_POST['journal_assigner_to_ref'.$assign_journal_id])&& $_POST['journal_assigner_to_ref'.$assign_journal_id]!="") {
        $admin_cat_to_save=$_POST['journal_assigner_to_ref'.$assign_journal_id];
    } elseif(isset($_POST['journal_assigner_to_tech'.$assign_journal_id])&& $_POST['journal_assigner_to_tech'.$assign_journal_id]!="") {
        $admin_cat_to_save=$_POST['journal_assigner_to_tech'.$assign_journal_id];
    }
    $where=array(
        'journal_id'=>$assign_journal_id,
        'user_id'=>$assign_user_id
    );
    $update_journal_status=$db->upDate('tbl_journal', $journal_updates_data, $where);
    if($update_journal_status==1) {
        foreach($admin_cat_to_save as $authkey=>$authval) {
            $admin_cat_get_qry="SELECT tac.admin_cat_id,tac.admin_cat_name FROM tbl_admin_category as tac,tbl_admin as ta where ta.admin_id=".$authval." AND ta.admin_cat_id=tac.admin_cat_id ";
            $admin_cat_id=$db->query($admin_cat_get_qry);
            $admin_cat_id=$admin_cat_id->rows[0]->admin_cat_id;
            $journal_authors_data=array(
                'journal_id'=>$assign_journal_id,
                'admin_id'=>$authval,
                'journal_user_id'=>$assign_user_id,
                'admin_cat_id'=>$admin_cat_id,
                'created_date'=>date("Y-m-d H:i:s"),
                'modified_date'=>date("Y-m-d")
            );
            $insert_journal_author_id=$db->insert('tbl_journal_assign', $journal_authors_data);
                            
        }
        $_SESSION['journal_assign_msg'][]="Journal Has Assigned Succesfully";
        header('Location: /'.$redirect_url);
    } else {
        $_SESSION['journal_assign_msg'][]="Something Went Wrong Please Try Again";
    }
}
if(isset($_POST['do_enable_command']) && $_POST['do_enable_command']=="do_command_enabled") {
    
    $enable_jounnal=$_POST['journal_id'];
    
    $journal_comment_exist=$db->query("SELECT * FROM tbl_comments WHERE journal_id=".$enable_jounnal." AND author_correction=0");
    $command_count=$journal_comment_exist->num_rows;
    //echo $command_count
    if($command_count>0) {
        $update_data=array(
            "author_correction"=>1
        );
        $where=array(
                "journal_id"=>$enable_jounnal,
                "author_correction"=>0
        );
        $update_for_command_enable=$db->upDate('tbl_comments', $update_data, $where);
        if($update_for_command_enable!=0) {
            $journal_is_direct_by_author=$db->query("SELECT * FROM tbl_journal WHERE journal_id=".$enable_jounnal);
            if($journal_is_direct_by_author->rows[0]->correction_level==0) {
                $update_data=array(
                    "is_author_reviewed"=>1,
                    "enable_command"=>0
                );
            } else {
                $update_data=array(
                    "enable_command"=>0
                );
            }
            $where=array(
                    "journal_id"=>$enable_jounnal,
            );
            $update_for_author_handle=$db->upDate('tbl_journal', $update_data, $where);
            $result_data["result"]="success";
            
        } else {
            $result_data["result"]="Comment Send Unsuccessfully";
        }
    } else {
        $result_data["result"]="Please Add The Comment then Send";
    }
    echo json_encode($result_data);
}
if(isset($_POST['notification']) && !empty($_SESSION['user_id'])) {
    $notfication_user_id=$_SESSION['user_id'];
    $check_if_greater_two_journal=$db->query("SELECT DISTINCT DATE_FORMAT(tja.created_date,'%b %e %Y') as assigned_date,tja.assign_id,tja.assign_id,tjd.title,tac.admin_cat_name  FROM tbl_journal as tj,tbl_journal_details as tjd,tbl_journal_assign as tja,
tbl_admin_category as tac where tj.user_id=".$notfication_user_id." AND tj.is_deleted=0  AND tj.user_id=tja.journal_user_id AND tja.admin_cat_id=tac.admin_cat_id AND tj.journal_id=tjd.journal_id  AND tj.journal_id=tja.journal_id AND tja.created_date>=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d'))");

    $check_if_greater_two_journal_new=$db->query("SELECT DISTINCT COUNT(*) as new_notification_count  FROM tbl_journal as tj,tbl_journal_details as tjd,tbl_journal_assign as tja,
tbl_admin_category as tac where tj.user_id=".$notfication_user_id." AND tj.is_deleted=0  AND tj.user_id=tja.journal_user_id AND tja.admin_cat_id=tac.admin_cat_id AND tj.journal_id=tjd.journal_id  AND tj.journal_id=tja.journal_id AND tja.created_date>=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d')) AND tja.is_notification_view=0 ");

    $check_if_command_notification_view=$db->query("SELECT DISTINCT tcn.id,tj.journal_id,DATE_FORMAT(tcn.created_date,'%b %e %Y') as created_date,ta.admin_name,tjd.title FROM tbl_journal as tj,tbl_journal_details AS tjd,tbl_comments as tc,tbl_comment_notification as tcn,tbl_admin as ta where tcn.comment_id=tc.comment_id AND tc.journal_id=tj.journal_id AND tc.admin_id=ta.admin_id AND tcn.created_date >=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d')) AND tjd.journal_id=tj.journal_id AND tj.user_id=".$notfication_user_id);

    $check_if_command_notification_view_count=$db->query("SELECT DISTINCT COUNT(*) as new_notification_count,tcn.id,tcn.created_date,ta.admin_name,tjd.title FROM tbl_journal as tj,tbl_journal_details AS tjd,tbl_comments as tc,tbl_comment_notification as tcn,tbl_admin as ta where tcn.comment_id=tc.comment_id and tcn.is_notification_view=0 AND tc.journal_id=tj.journal_id AND tc.admin_id=ta.admin_id AND tcn.created_date >=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d')) AND tjd.journal_id=tj.journal_id AND tcn.is_stud_view=0 AND tj.user_id=".$notfication_user_id);

    if($check_if_greater_two_journal->num_rows > 0) {
        $result['notification_count']=$check_if_greater_two_journal->num_rows;
        $result['new_notification_count']=$check_if_greater_two_journal_new->rows[0]->new_notification_count;
        $result['notifications']=$check_if_greater_two_journal->rows;
        $result['message']="success";
    } else {
        $result['message']='failure';
    }
    if($check_if_command_notification_view->num_rows > 0) {
        $result['cmd_notification_count']=$check_if_command_notification_view->num_rows;
        $result['cmd_new_notification_count']=$check_if_command_notification_view_count->rows[0]->new_notification_count;
        $result['cmd_notifications']=$check_if_command_notification_view->rows;
        $result['cmd_message']="success";
    } else {
        $result['cmd_message']='failure';
    }
    $result['total_notification_count']=(int)$result['new_notification_count']+(int)$result['cmd_new_notification_count'];
    echo json_encode($result);
}
if(isset($_POST['admin_notification'])) {
    if(isset($_SESSION['admin_id'])&& $_SESSION['admin_id']!="") {
        $notfication_user_id=$_SESSION['admin_id'];
        $check_if_greater_two_journal=$db->query("SELECT DISTINCT tcn.id,tj.journal_id,DATE_FORMAT(tcn.created_date,'%b %e %Y') as created_date,ta.admin_name,tjd.title FROM tbl_journal as tj,tbl_journal_details AS tjd,tbl_comments as tc,tbl_comment_notification as tcn,tbl_admin as ta where tcn.comment_id=tc.comment_id AND tc.journal_id=tj.journal_id AND tc.admin_id=ta.admin_id AND tcn.created_date >=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d')) AND tjd.journal_id=tj.journal_id");
        $check_if_greater_two_journal_new=$db->query("SELECT DISTINCT COUNT(*) as new_notification_count,tcn.id,tcn.created_date,ta.admin_name,tjd.title FROM tbl_journal as tj,tbl_journal_details AS tjd,tbl_comments as tc,tbl_comment_notification as tcn,tbl_admin as ta where tcn.comment_id=tc.comment_id and tcn.is_notification_view=0 AND tc.journal_id=tj.journal_id AND tc.admin_id=ta.admin_id AND tcn.created_date >=(DATE_FORMAT(curdate() - interval 30 day,'%Y-%m-%d')) AND tjd.journal_id=tj.journal_id AND tcn.is_notification_view=0");
        if($check_if_greater_two_journal->num_rows > 0) {
            $result['notification_count']=$check_if_greater_two_journal->num_rows;
            $result['new_notification_count']=$check_if_greater_two_journal_new->rows[0]->new_notification_count;
            $result['notifications']=$check_if_greater_two_journal->rows;
            $result['message']="success";
        } else {
            $result['message']='failure';
        }
        echo json_encode($result);
    }
}

if(isset($_POST['notification_reset'])) {
    $notfication_user_id=$_SESSION['user_id'];
    $where=array(
            'journal_user_id'=>$notfication_user_id
        );
    $journal_updates_data=array(
        'is_notification_view'=>1,
    );
    $update_journal_status=$db->upDate('tbl_journal_assign', $journal_updates_data, $where);
    if($update_journal_status==1) {
        echo json_encode('success');
    }
}
if(isset($_POST['admin_notification_reset'])) {
    $notfication_user_id=$_SESSION['admin_id'];
    $journal_updates_data=array(
        'is_notification_view'=>1,
    );
    $where=array(
        1=>1,
    );
    
    $update_journal_status=$db->upDate('tbl_comment_notification', $journal_updates_data, $where);
    if($update_journal_status==1) {
        echo json_encode('success');
    }
}
if(isset($_POST['correct_journal_id']) && $_POST['correct_journal_id']!="") {
    $journal_id=$_POST['correct_journal_id'];
    $where=array(
        'journal_id'=>$journal_id
    );
    $journal_updates_data=array(
        'is_corrected'=>1,
    );
    $update_journal_status=$db->upDate('tbl_journal', $journal_updates_data, $where);
    if($update_journal_status==1) {
        $_SESSION['journal_assign_msg'][]="Journal Corrected Successfully";
        echo json_encode('success');
    } else {
        $_SESSION['journal_assign_msg'][]="Journal Corrected UnSuccessfully";
        echo json_encode('failure');
    }
}
if(isset($_POST['publish_journal_id']) && $_POST['publish_journal_id']!="") {
    $journal_id=$_POST['publish_journal_id'];
    $check_paper = $db->query("SELECT correction_level,is_rejected,is_deleted FROM tbl_journal WHERE journal_id = '".$journal_id."' LIMIT 1");
    //print_r($check_if_user_exists);exit;
    if(!isset($check_paper->row->correction_level)) {
        $_SESSION['journal_assign_msg'][]="Journal is not available!";
        echo json_encode('failure');
        exit;
    }
    if(isset($check_paper->row->correction_level) && $check_paper->row->correction_level != '0') {
        $_SESSION['journal_assign_msg'][]="Journal is not yet corrected!";
        echo json_encode('failure');
        exit;
    }
    if(isset($check_paper->row->is_rejected) && $check_paper->row->is_rejected != '0') {
        $_SESSION['journal_assign_msg'][]="Journal is rejected!";
        echo json_encode('failure');
        exit;
    }
    if(isset($check_paper->row->is_deleted) && $check_paper->row->is_deleted != '0') {
        $_SESSION['journal_assign_msg'][]="Journal is deleted!";
        echo json_encode('failure');
        exit;
    }
    $where=array(
        'journal_id'=>$journal_id
    );
    $journal_updates_data=array(
        'is_published'=>1,
    );
    $update_journal_status=$db->upDate('tbl_journal', $journal_updates_data, $where);
    if($update_journal_status==1) {
        $_SESSION['journal_assign_msg'][]="Journal Published Successfully";
        echo json_encode('success');
    } else {
        $_SESSION['journal_assign_msg'][]="Journal Published UnSuccessfully";
        echo json_encode('failure');
    }
}
if(isset($_POST['reject_journal_id']) && $_POST['reject_journal_id']!="") {
    $journal_id=$_POST['reject_journal_id'];
    $where=array(
        'journal_id'=>$journal_id
    );
    $journal_updates_data=array(
        'is_rejected'=>1,
    );
    $update_journal_status=$db->upDate('tbl_journal', $journal_updates_data, $where);
    if($update_journal_status==1) {
        $_SESSION['journal_assign_msg'][]="Journal Rejected Successfully";
        echo json_encode('success');
    } else {
        $_SESSION['journal_assign_msg'][]="Journal Rejected UnSuccessfully";
        echo json_encode('failure');
    }

}

?>