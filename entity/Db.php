<?php 
class Db {
	
	private $conn;
	public function __construct($cn) {
		$this->conn = $cn;
	}

	protected function execute($sql) {
		mysql_query($sql, $this->conn);
	}
	
	protected function query($sql) {
		return mysql_query($sql, $this->conn);
	}
	
	protected function tambah($tblName, $param, $where = "") {
		$sParam = "";
		$sKey = "";
		$keys = array_keys($param);
		
		for($i = 0; $i < count($keys); $i++) {
			$sKey .= $keys[$i];	
			$sParam .= "'".$param[$keys[$i]]."'";	
			if($i != (count($keys) - 1)) {
				$sKey .= ",";
				$sParam .= ",";
			}
		}
		
		$prepare = "insert into ".$tblName. "(".$sKey.")"." values(".
				$sParam.
				") ".$where;
		mysql_query($prepare, $this->conn); 
		echo mysql_error();
		
		return mysql_insert_id();
	}
	
	protected function edit($tblName, $param, $where = "") {
	
	}
	
	protected function hapus($tblName, $where ="") {
	
	}
}
?>