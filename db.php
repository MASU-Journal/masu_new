<?php
$db = new DataBase($con);

class DataBase{
	private $mysqli;
	function __construct($con) {
		$this->mysqli = $con;
	}
	public function realEscapeString($str){
		return $this->mysqli->real_escape_string($str);
	}
	public function query($sql){
		$result = $this->mysqli->query($sql) or die ("Error in query: $sql ".'mysql_error()');
		if(isset($result->num_rows)){
			$i = 0;
			$data = array();
			while ($row = $result->fetch_object()) { //pre($row);
				$data[$i] = $row;
				$i++;
			}
			$query = new stdClass();
			$query->row = isset($data[0]) ? $data[0] : array();
			$query->rows = $data;
			$query->num_rows = $result->num_rows;
			$query->count = $result->num_rows;
			$result->close();
			unset($data);
			return $query;
		}else{
			$query = new stdClass();
			$query->row =  array();
			$query->rows = array();
			$query->num_rows = false;
			return $query;
		}
    }
              function delete($sql){
					$result = $this->mysqli->query($sql) or die ("Error in query: $sql ".'mysql_error()');
					return $result;
			}
	function insert($table,$data){
		if(empty($table) || empty($data)){
			die('check Values');
		}
		$data = $this->convert($data);
		if($data){
			$sql = 'INSERT INTO '.$table." SET ".$data;
			$result = $this->mysqli->query($sql) or die ("Error in query: $sql ".'mysql_error()');
			return $this->mysqli->insert_id;
		}else{
			 die('Values Not Valide');
		}
    }
	function upDate($table,$data,$where){
		if(empty($table) || empty($data) || empty($where)){
			die('check Values');
		}
		$data = $this->convert($data);
		$where = $this->convertWhere($where);
		if($data && $where){	
			$sql = 'UPDATE '.$table." SET ".$data." WHERE ".$where;
			return $this->mysqli->query($sql) or die ("Error in query: $sql ".'mysql_error()');
		}
    }
	private function convert($data){
		$string =false;
		if(is_array($data)){
			foreach($data as $key=>$val){
				$string .=	$key."='".$val."',";
			}
		}else{
			$string =$data;
		}
		return trim($string,",");
	}
	private function convertWhere($data){
		$string =false;
		if(is_array($data)){
			foreach($data as $key=>$val){
				$string .=	$key."='".$val."' AND ";
			}
		}else{
			$string =$data;
		}
		return trim($string," AND ");
	}
}
?>