<?php 
error_reporting( E_ALL );
ini_set('display_errors', 1);
//$_SESSION['journal_submission_msg']=array();
if((isset($_SESSION['user_id']) && $_SESSION['user_id']!="")){	
	$user_id=$_SESSION['user_id'];
	$user_ins_name=$_SESSION['user_ins_name'];
	$user_email=$_SESSION['user_email'];
	$sql="SELECT * FROM  tbl_user where user_id=".$user_id;
	$user_data=$db->query($sql);
	$user_details=$user_data->rows;
}
?>