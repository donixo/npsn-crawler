<?php 
//GetAllers.php

class GetAllers extends Db {

	public function __construct($cn) {
		parent::__construct($cn); 
	}
	
	public function getAllProvinsi() {
		return $this->query("select * from provinsi order by provinsi_id asc");
	}
	
	public function reset() {
		$this->execute("truncate table sekolah");
		$this->execute("truncate table kabupaten");
		$this->execute("truncate table provinsi");
	}
}
?>