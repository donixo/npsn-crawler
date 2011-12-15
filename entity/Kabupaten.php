<?php 
//Kabupaten.php

class Kabupaten extends Db {
	private $data;
	private $id;
	private $prov_id;
	
	public function __construct($initObj, $cn, $prov_id) {
		parent::__construct($cn); 
		$this->data = $initObj;
		$this->prov_id = $prov_id;
	}
	
	public function getInfo() {
		print_r($this->data);
	}
	
	public function getUrl() {
		//http://bimakab.dapodik.org/rekap.php?data=&ref=sekolah&tipe=0&status=2&limit=50&hal=6
		return $this->data[0][2].'.dapodik.org/rekap.php?ref=sekolah';
	}
	
	public function simpan() {
		$this->id = $this->tambah("kabupaten", 
				array('nama'=> $this->getNama(), 
						'kode'=> $this->getKode(),
						'provinsi_id'=>$this->prov_id));
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