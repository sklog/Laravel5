<?php namespace App\Libs;

class Cookie {
	
	public $arr=array();
	public $db_arr=array();
	public function get() {
		foreach ($_COOKIE as $key=>$value) {
			$key=(int)$key;
			if($key>0) {
				$this->arr[$key]=$value;
			}
		}
		return $this->arr;
	}
	
	public function get_db(){
		$db = $this->get();
		foreach($this->arr as $key=>$value){
			$this->db_arr[] = $key;
		}
		return $this->db_arr;
	}

}