<?php
$include_location = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
include_once($include_location.'connection.php');
include_once($include_location.'db.php');
include_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."modals".DIRECTORY_SEPARATOR."publisherModal.php");
$pm = new publisherModal($db);

function isManager(){
	if(empty($_SESSION['admin_login']) || empty($_SESSION['role_id']) || $_SESSION['admin_login'] != 'yes' || $_SESSION['role_id'] != '5'){
	  return false;
	}
	return true;
}

if(!function_exists("toRedirect")){
	function toRedirect($url){
		header('Location: '.APP_URL.$url);
		exit;
	}
}
function getAllPublishedPapers(){
	global $pm;
	return $pm->select("*","status","1",1);
}
function getPublishedPaper($id){
	global $pm;
	return $pm->select("*","id",$id);
}
if(!empty($_POST) && !empty($_POST['edit_published_journal'])){
	if(!isManager()){
		return false;
	}
	$redirect_url = 'editorial/m_published_journals.php';
	if(!empty($_FILES['journal-file']) && !empty($_FILES['journal-file']['size'])) {
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
			toRedirect($redirect_url);exit;
		}
		if((!empty($_FILES["journal-file"]["type"])) && !in_array($_FILES['journal-file']['type'], $acceptable)) {
			$_SESSION['form_error'] = 'Invalid file type. Only doc,pdf,docx,latex allowed';
			toRedirect($redirect_url);exit;
		}

		$source_file = $_FILES['journal-file']['name'];
		$file_base_name = pathinfo($source_file, PATHINFO_FILENAME);
		$file_extention = pathinfo($source_file, PATHINFO_EXTENSION);		
		$filename = str_replace(" ", "_", $file_base_name).'.'.$file_extention;
		$vol = trim($_POST['volume']);
		$main_file_directory = APP_PATH.$vol;
		if(!is_dir($main_file_directory)) {
			mkdir($main_file_directory, 0777, true);
		}
		$main_file_url = $main_file_directory.'/'.$filename;
		if(file_exists($main_file_url)){
			$i = 1;
			$new_name = $main_file_directory.'/'.str_replace(" ", "_", $file_base_name).'_'.$i.'.'.$file_extention;
			while(file_exists($new_name)){
				$i++;
				$new_name = $main_file_directory.'/'.str_replace(" ", "_", $file_base_name).'_'.$i.'.'.$file_extention;
			}
			rename($main_file_url,$new_name);
		}
		move_uploaded_file($_FILES['journal-file']['tmp_name'], $main_file_url);
	}
	//Edit Authors
	$authors_name = preg_replace('/\d+/u', '', $_POST['authors-name']);
	$authors_name = str_replace("*", "", $authors_name);
	$authors_name = preg_replace('/\sand\s/u', ',', $authors_name);
	//remove full stop
	$authors_name = rtrim(trim($authors_name), '.');
	$keywords = rtrim(trim($_POST['keywords']), '.');
	$title = rtrim(trim($_POST['journal-title']), '.');
	$doi = (!empty($_POST['doi'])) ? rtrim(trim($_POST['doi']), '.') : '';
	$page_start = (!empty($_POST['page_start'])) ? rtrim(trim($_POST['page_start']), '.') : '';
	$page_end = (!empty($_POST['page_end'])) ? rtrim(trim($_POST['page_end']), '.') : '';

	$update_data = array();
	$update_data['updated_by'] = $_SESSION['admin_id'];
	$update_data['updated_at'] = date("Y-m-d H:i:s");
	$update_data['title'] = $db->realEscapeString($title);
	$update_data['authors'] = $db->realEscapeString(trim($authors_name));
	$update_data['volume'] = trim($_POST['volume']);
	$update_data['issue'] = trim($_POST['issue']);
	$update_data['abstract'] = $db->realEscapeString(str_replace("\r", "", str_replace("\n", "", trim($_POST['abstract']))));
	$update_data['keywords'] = $db->realEscapeString(trim($keywords));
	if(!empty($filename)){
		$update_data['file'] = $filename;
	}
	$update_data['doi'] = $doi;
	$update_data['page_start'] = $page_start;
	$update_data['page_end'] = $page_end;

	$where = array();
	$where['id'] = trim($_POST['journal_id']);

	$db->upDate('tbl_publication',$update_data,$where);
	$_SESSION['form_success'] = 'Journal Edited Successfully';
	header('Location: '.APP_URL.$redirect_url);
}