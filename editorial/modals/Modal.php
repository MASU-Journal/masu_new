<?php
class Modal{
	function __construct(){
		//
	}

	public function pre($obj, $exit = 0){
		echo "<pre>";
		echo "<br>";
		print_r($obj);
		echo "<br>";
		if($exit == '1'){
			exit;
		} 
	}
	public function is_admin(){
		if(!empty($_SESSION['admin_id']) && $_SESSION['admin_id'] == '1'){
			return true;
	    }
	    return false;
	}

	public function is_client(){
		if(!empty($_SESSION['user_id'])){
			return true;
	    }
	    return false;
	}
}
?>
