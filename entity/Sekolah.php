<?php 
//Sekolah.php

class Sekolah Extends Db {
	
	private $id;
	private $data;
	private $kabId;
	private $tipeSekolah;
	
	public function __construct($initObj, $cn, $kabId, $tipe) {
		parent::__construct($cn); 
		$this->data = $initObj;
		$this->kabId = $kabId;
		$this->tipeSekolah = $tipe;
	}
	
	public function getInfo() {
		return $this->data[1]." >> ".$this->data[2];
	}
	
	public function simpan() {
		$this->id = $this->tambah("sekolah", 
				array(
							'npsn'=> $this->data[1], 
							'nama'=> mysql_escape_string($this->data[2]), 
							'alamat'=> mysql_escape_string($this->data[3]), 
							'status'=> $this->data[4], 
							'jm_siswa_l'=> $this->data[5], 
							'jm_siswa_p'=> $this->data[6], 
							'jm_siswa_total'=> $this->data[7], 
							'jm_guru_l'=> $this->data[8], 
							'jm_guru_p'=> $this->data[9], 
							'jm_guru_total'=> $this->data[10],
							'jm_ruang_kelas'=> $this->data[11],
							'jm_operator'=> $this->data[12],
							'kabupaten_id'=> $this->kabId,
							'tipe_sekolah'=> $this->tipeSekolah
						)
				);
	}
}

?>