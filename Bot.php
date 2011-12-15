<?php 
// bot.php
// all those dirty works are here.

class Bot {
	
	private $ch;
	private $html_src;
	private $output;
	
	public function __construct() {
		$this->ch = curl_init(); //create resource cURL
	}
	
	public function hunt($url, $ty){
		//set opsi URL dan opsi lainnya
	  curl_setopt($this->ch, CURLOPT_URL, $url);
	  curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
	  curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($this->ch, CURLOPT_FILETIME, true);
	
	  $this->html_src = curl_exec($this->ch);
	  return $this->doParse($ty);
	}
	
	public function getParamSekolah() {
		return array(
			'totalPaging'=>$this->doParse('sekolah_paging')
		);
	}
	
	public function doParse($type) {
		switch($type) {
			case 'provinsi':
				return $this->doParseProvinsi();
			break;
			case 'kabupaten':
				return $this->doParseKabupaten();
			break;
			case 'sekolah':
				return $this->doParseSekolah();
			break;
			case 'sekolah_tabel':
				return $this->getTabelSekolah();
			break;
		}
	}
	
	private function doParseProvinsi() {
		preg_match_all("~<script type\=\"text\/javascript\"\>(.*?)</script>~s", 
				$this->html_src, $z);
		preg_match_all("~var data \=(.*?)\;~s", 
				$z[0][0], $ar);
		$ob = str_replace("var data = ", "", $ar[0][0]);
		$ob = str_replace(";", "", $ob);

		return json_decode($ob);
	}
	
	private function doParseKabupaten() {
		// remove CDATA
		$this->html_src = str_replace("/*<![CDATA[*/", "", $this->html_src);
		$this->html_src = str_replace("/*]]>*/", "", $this->html_src);
		
		preg_match_all("~<script type\=\"text\/javascript\"\>(.*?)</script>~s", 
				$this->html_src, $z);
		if(count($z[0]) == 0) {
			preg_match_all("~<script\>(.*?)</script>~s", 
					$this->html_src, $z);
		}
		
		preg_match_all("~var data \= (.*?)\;~s", 
					$this->html_src, $ob); //print_r($ob[1]);
					
		return json_decode($ob[1][0]);
	}
	
	private function doParseSekolah() {
		//return $this->html_src;
		preg_match_all("~selected>(.*?)\</option>~s", 
					$this->html_src, $navigasi); 
		preg_match_all("~dari (.*?)\</form>~s", 
					$this->html_src, $navigasi[]);
		
		return array(
			'status'=>$navigasi[1][0],
			'limit'=>$navigasi[1][1],
			'hal'=>$navigasi[1][2],
			'total'=>str_replace(" ", "", $navigasi[2][1][0])
		);
	}
	
	private function getUrlOptSekolah() {
		// negeri - swasta (2-3)
		// paging iterate
		// tipe sekolah 0 s/d 9
		preg_match_all("~selected>(.*?)\</option>~s", 
					$this->html_src, $ob); 
		return $ob;
	}
	
	private function getTabelSekolah() {
		$dom = new DOMDocument;
		$dom->loadHTML($this->html_src);
		$rows = array();
		foreach($dom->getElementsByTagName('tr') as $tr) {
			$cells = array();
			foreach($tr->getElementsByTagName('td') as $td) {
				$cells[] = $td->nodeValue;
			}
			if(count($cells) == 13) // jumlah tabel data yang dicari
				$rows[] = $cells;
		}

		return $rows;
	}
}

?>