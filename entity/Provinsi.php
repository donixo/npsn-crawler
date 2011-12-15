<?php 
//Provinsi.php

class Provinsi extends Db {
	private $data;
	private $id;
	
	public function __construct($initObj, $cn) {
		parent::__construct($cn); 
		$this->data = $initObj;
	}
	
	public function getInfo() {
		print_r($this->data);
	}
	
	public function getUrl() {
		if($this->data[0][2] == "") {
			return 'http://npsn.dapodik.org/rekap.propinsi.php?propinsi=901';
		} else {
			return $this->data[0][2].'.dapodik.org/sekolah.php';
		}
	}
	
	public function simpan() {
		$this->id = $this->tambah("provinsi", 
				array('nama'=> $this->getNama(), 'kode'=> $this->getKode()));
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getKode() {
		return $this->data[0][2];
	}
	
	public function getNama() {
		return $this->data[0][1];
	}
}
?>