<?php
include_once('connection.php');
include_once('db.php');
include_once('conf.php');

if(empty($_SESSION['admin_login']) || empty($_SESSION['role_id']) || $_SESSION['admin_login'] != 'yes' || ($_SESSION['role_id'] != '1' && $_SESSION['role_id'] != '2' && $_SESSION['role_id'] != '3')){
  header("Location:".APP_URL."logout.php");
}
if(isset($_POST['action']) && $_POST['action'] == 'add_comment'){

	if(empty($_POST['comment']) || empty($_POST['q_id']) || empty($_POST['j_id'])){
		echo '0';exit;
	}

	$comment = $_POST['comment'];
	$q_id = $_POST['q_id'];
	$j_id = $_POST['j_id'];

	$check_qry = $db->query("SELECT id,status,user_id,resubmitted,manuscript_id from tbl_journal WHERE manuscript_id='$j_id'");
	if(empty($check_qry->count) || $check_qry->count < 1){
		echo '0';exit;
	}

	$insert_data = array();
	$insert_data['ques_id'] = $q_id;
	$insert_data['comments'] = $comment;
	$insert_data['journal_id'] = $check_qry->row->id;
	$insert_data['chat_by'] = '0';
	$insert_data['admin_id'] = $_SESSION['admin_id'];
	$insert_data['revision'] = $check_qry->row->resubmitted;
	$insert_data['created_date'] = date("Y-m-d H:i:s");
	$comment_id = $db->insert('tbl_comments', $insert_data);

	// $update_data = array(
	// 	'status' => '4'
	// );
	// $where = array(
	// 	'id' => $manuscript_id
	// );
	// $db->update("tbl_journal", $update_data, $where);
	//$_SESSION['form_status'] = 'Journal Rejected (Manuscript ID - '.$check_qry->row->manuscript_id.')';
	echo '1';exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'journal_decline_by_editor'){
	$manuscript_id = trim($_POST['manuscript_id']);
	$reason_id = trim($_POST['reason_id']);
	$other_reason = trim($_POST['other_reason']);

	$check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '".$manuscript_id."' AND assigned_to='".$_SESSION['admin_id']."'");
    if($check_query->count < 0){
    	echo '0';exit;
    }

	$check_qry = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$manuscript_id");
	if(!isset($check_qry->row->status)){
		echo '0';exit;
	}

	$update_data = array(
		'status' => '11'
	);
	$where = array(
		'id' => $manuscript_id
	);
	$db->update("tbl_journal", $update_data, $where);

	$update_data = array(
		'status' => '3',
		'decline_reason' => $reason_id,
		'decline_other_reason' => $other_reason
	);
	$where = array(
		'id' => $check_query->row->id
	);
	$db->update("tbl_journal_assigned", $update_data, $where);
	$_SESSION['form_success'] = 'Journal Declined (Manuscript ID - '.$check_qry->row->manuscript_id.')';
	echo '1';exit;
}
if(isset($_POST['action']) && $_POST['action'] == 'journal_approve_by_editor'){
	$manuscript_id = trim($_POST['manuscript_id']);

	$check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '".$manuscript_id."' AND status='0' AND assigned_to='".$_SESSION['admin_id']."'");
    if($check_query->count < 0){
    	echo '0';exit;
    }

	$check_qry = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$manuscript_id");
	if(!isset($check_qry->row->status) || $check_qry->row->status != '5'){
		echo '0';exit;
	}

	$update_data = array(
		'status' => '8'
	);
	$where = array(
		'id' => $manuscript_id
	);
	$db->update("tbl_journal", $update_data, $where);

	$update_data = array(
		'status' => '1'
	);
	$where = array(
		'id' => $check_query->row->id
	);
	$db->update("tbl_journal_assigned", $update_data, $where);
	$_SESSION['form_success'] = 'Journal Approved (Manuscript ID - '.$check_qry->row->manuscript_id.')';
	echo '1';exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'journal_reject_by_editor'){
	$manuscript_id = trim($_POST['manuscript_id']);

	$check_query = $db->query("SELECT id FROM tbl_journal_assigned WHERE journal_id = '".$manuscript_id."' AND status='0' AND assigned_to='".$_SESSION['admin_id']."'");
    if($check_query->count < 0){
    	echo '0';exit;
    }

	$check_article = $db->query("SELECT status,manuscript_id from tbl_journal WHERE id=$manuscript_id");
	if(!isset($check_article->row->status) || $check_article->row->status != '5'){
		echo '0';exit;
	}

	$update_data = array(
		'status' => '6'
	);
	$where = array(
		'id' => $manuscript_id
	);
	$db->update("tbl_journal", $update_data, $where);

	$update_data = array(
		'status' => '2'
	);
	$where = array(
		'id' => $check_query->row->id
	);
	$db->update("tbl_journal_assigned", $update_data, $where);
	$_SESSION['form_error'] = 'Revision of Article (Manuscript ID - '.$check_qry->row->manuscript_id.')';
	echo '1';exit;
}