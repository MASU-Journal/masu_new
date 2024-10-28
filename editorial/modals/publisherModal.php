<?php
include_once("Modal.php");
class publisherModal extends Modal{
	function __construct($db){
		$this->table = "tbl_publication";
		$this->db = $db;
		$this->datetime = date("Y-m-d H:i:s");
		$this->all_fields = ['title','authors','volume','issue','abstract','keywords','file','created_at','created_by','updated_at','updated_by','status','doi','page_start','page_end'];

		$this->required = ['title','authors','volume','issue','abstract','keywords','file','page_start'];
		$this->non_required = ['status','doi','page_end'];

		$this->user_addable = false;
		$this->admin_addable = $this->all_fields;

		$this->user_editable = false;
		$this->admin_editable = $this->all_fields;

		$this->user_deletable = false;
		$this->admin_deletable = false;
	}
	public function select($field, $where = false, $where_val = false, $multiple = false){
		if(is_array($field)){
			$field = implode(",", $field);
		}
		$cond = '';
		if(!empty($where)){
			$cond = " WHERE $where = '$where_val'";
		}
		$user_info = array();
		$table = $this->table;
		$user_qry = $this->db->query("SELECT $field FROM $table $cond");
		if($user_qry->count > 0){
			return ($multiple) ? $user_qry->rows : $user_qry->row;
		} else {
			return false;
		}
	}
	public function selectForUpdate($field, $where, $where_val){
		if(is_array($field)){
			$field = implode(",", $field);
		}
		$user_info = array();
		$table = $this->table;
		$user_qry = $this->db->query("SELECT $field FROM $table WHERE $where = '$where_val' FOR UPDATE");
		if($user_qry->count > 0){
			return $user_qry->row;
		} else {
			return false;
		}
	}
	public function selectByConditions($field, $conditions, $multiple = false){
		if(is_array($field)){
			$field = implode(",", $field);
		}
		$user_info = array();
		$table = $this->table;
		$user_qry = $this->db->query("SELECT $field FROM $table WHERE $conditions");
		if($user_qry->count > 0){
			return ($multiple) ? $user_qry->rows : $user_qry->row;
		} else {
			return false;
		}
	}
	public function validate($post){
		$return_data = array();
		$required = $this->required;
		$non_required = $this->non_required;
		foreach($required as $key){
			if(empty($_POST[$key])){
				mlmRedirect('error', 'a-add-books', "$key is not available");
				exit;
			} else {
				$return_data[$key] = trim($_POST[$key]);
			}
		}
		foreach($non_required as $key){
			if(!empty($_POST[$key])){
				$return_data[$key] = trim($_POST[$key]);
			}
		}
		return $return_data;
	}
	public function insert($insert_data){
		if(empty($insert_data)) return false;
		if($this->is_client()){
			if(!$this->user_addable){
				return false;
			} else {
				foreach($insert_data as $key => $value){
					if(!in_array($key, $this->user_addable)){
						return false;
					}
				}
			}			
		} else if($this->is_admin()){
			if(!$this->admin_addable){
				return false;
			} else {
				foreach($insert_data as $key => $value){
					if(!in_array($key, $this->admin_addable)){
						return false;
					}
				}
			}			
		}

		$new_id = $this->db->insert($this->table, $insert_data);

		if($new_id > 0){
			return $new_id;
		} else {
			return false;
		}
	}
	public function update($update_data, $where){
		if(empty($update_data)) return false;
		else if(empty($where)) return false;
		if($this->is_client()){
			if(!$this->user_editable){
				return false;
			} else {
				foreach($update_data as $key => $value){
					if(!in_array($key, $this->user_editable)){
						return false;
					}
				}
			}			
		} else if($this->is_admin()){
			if(!$this->admin_editable){
				return false;
			} else {
				foreach($update_data as $key => $value){
					if(!in_array($key, $this->admin_editable)){
						return false;
					}
				}
			}			
		}

		$this->db->upDate($this->table, $update_data, $where);

		return true;
	}
	public function delete($where, $where_val, $limit = 1){
		$table = $this->table;
		if(empty($where)) return false;
		else if(empty($where_val)) return false;
		if(($this->is_client() && !$this->user_deletable) || ($this->is_admin() && !$this->admin_deletable)) {
			return false;		
		}
		$this->db->query("DELETE FROM $table WHERE $where = '$where_val' LIMIT $limit");
		return true;
	}
}